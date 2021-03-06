<?php
/**
 * Created Shahrokh Nabavi.
 * Date: 8/29/2017
 * Time: 9:45 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Galleries extends CI_Controller
{
	public function __construct(){
		parent::__construct();

		$this->load->model('gallery');
	}

	public function thumbImage( $id ){

		if( !is_numeric($id) )
			show_error('[' . __CLASS__ . ']: The type of parameter is not valid. Error is on line ' . __LINE__ );

		$record = $this->gallery->getRecordById( $id );

		if( !$record )
			show_error('[' . __CLASS__ . ']: This record does not exist. Error is on line ' . __LINE__ );

		$files = glob(realpath(FCPATH . 'assets/uploads') . '/' . $id . '-' . $record['file_name'] . '_thumb*');
		if(file_exists($files[0])){
			$filename = basename($files[0]);
			$file_extension = strtolower(substr(strrchr($filename,"."),1));

			switch( $file_extension ) {
				case "gif": $ctype="image/gif"; break;
				case "png": $ctype="image/png"; break;
				case "jpeg":
				case "jpg": $ctype="image/jpeg"; break;
				default:
			}

			header('Content-type: ' . $ctype);
			readfile($files[0]);
		}
		die();
	}

	public function resizeImage($dir, $ext, $name, $w, $h){
		$this->image_lib->clear();
		$info = getimagesize($dir . $ext);
		$config['source_image']   = $dir . $ext;
		$config['new_image']      = $dir . '_' . $name . $ext;
		$config['maintain_ratio'] = true;
		$config['create_thumb']   = false;
		if($info[0]/$info[1] > $w / $h)
			$config['height'] = $h;
		else
			$config['width']  = $w;
		$this->image_lib->initialize($config);
		$this->image_lib->resize();

		$this->image_lib->clear();
		$info = getimagesize($dir . '_' . $name . $ext);
		$config['source_image']   = $dir . '_' . $name . $ext;
		$config['create_thumb']   = false;
		$config['maintain_ratio'] = false;
		$config['width']          = $w;
		$config['height']         = $h;
		if($info[0]>$info[1])
			$config['x_axis'] = floor(($info[0] - $w)/2);
		else
			$config['y_axis'] = floor(($info[1] - $h)/2);
		$this->image_lib->initialize($config);
		$this->image_lib->crop();
	}


	private function upload( $sqlData, $id = null, $fileData = null ){
		if ( $id === null ) {
			$config['upload_path'] = '../public_html/assets/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['file_name'] = 'temp' . $sqlData['file_name'];
			$config['file_ext_tolower'] = true;
			$config['max_size'] = '2048';

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('myFile')) {
				$this->session->set_flashdata('error', array('error' => $this->upload->display_errors()));
				return false;
			}
			return $this->upload->data();
		}
		else
		{
			$dir = dirname($fileData['full_path']) . '/' . $id . '-' . $sqlData['file_name'];
			rename($fileData['full_path'], $dir . $fileData['file_ext']);

			$this->load->library('image_lib');

			$this->resizeImage( $dir, $fileData['file_ext'], 'thumb', 75, 75);
			$this->resizeImage( $dir, $fileData['file_ext'], '255X193', 255, 193);
		}
	}

	/**
	 * @param $page
	 * @param $id
	 */
	public function form(  $page, $id  ){

		$this->user->loggedIn('admin', false);

		$validation = array(
			array(
				'field' => 'name',
				'label' => 'Image Name',
				'rules' => 'trim|required|regex_match[/^[a-zA-Z0-9 ]+$/]'
			)
		);
		$this->form_validation->set_rules($validation);


		if( $this->form_validation->run() === true ) {
			$this->load->helper('string');
			$sqlData = array(
				'name'      => $this->input->post('name',true),
				'admin_id'  => $this->user->cUser('id')
			);

			if( $id )
			{
				if( !is_numeric($id) )
					show_error('[' . __CLASS__ . ']: The type of parameter is not valid. Error is on line ' . __LINE__ );

				$isEdit = true;
				$sqlData['updated_at'] = date("Y-m-d H:i:s");

				if (!empty($_FILES['myFile']['name']) ) {
					$sqlData['file_name'] = random_string('alnum', 8);
					if ($fileData = $this->upload($sqlData) and $fileData === false) {
						$isEdit = false;
					}
				}

				if( $isEdit ) {
					if( $fileData ) {
						$this->deleteFiles($id);
						$this->upload($sqlData, $id, $fileData);
					}

					$this->gallery->edit($sqlData, ['id' => $id]);

					$this->session->set_flashdata('reg-success', 'Your image is <b>UPDATED</b> successfuly.');
					redirect('admin/gallery');
				}
			}
			else
			{
				$sqlData['file_name'] = random_string('alnum', 8);
				if( $fileData = $this->upload( $sqlData ) and $fileData !== false ) {
					$id = $this->gallery->add($sqlData);

					$this->upload($sqlData, $id, $fileData);

					$this->session->set_flashdata('reg-success', 'Your image is <b>ADDED</b> successfuly.');
					redirect('admin/gallery');
				}
			}
		}

		$id = (int) $id;
		$pg = array(
			'cPageNumbr' => (int) $page,
			'count'		 => $this->gallery->count(),
			'perPage'	 => 10
		);

		$data = array(
			'currentPageName'  => 'Gallery',
			'currentPageIcon'  => 'picture',
			'list'   	 => $this->gallery->getAll( $pg['perPage'], $pg['cPageNumbr'] ),
			'update' 	 => $this->gallery->getByField('id', (int) $id ),
			'paginating' => $pg
		);
		$this->load->view('admins/gallery', $data);
	}

	/**
	 * Type: Page
	 * Desc: delete a record
	 *
	 * @param $id
	 */
	public function delete( $id ){
		$this->user->loggedIn('admin', false);

		if( !is_numeric($id) )
			show_error('[' . __CLASS__ . ']: The type of parameter is not valid. Error is on line ' . __LINE__ );

		$this->deleteFiles( $id );

		$this->gallery->delete($id );
		redirect('admin/gallery');
	}

	private function deleteFiles( $id ){
		$record = $this->gallery->getRecordById( $id );

		$files = realpath(FCPATH . 'assets/uploads') . '/' . $id . '-' . $record['file_name'] . '*';
		foreach( glob($files) as $file ){
			unlink($file);
		}
	}
}
