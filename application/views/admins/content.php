<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('admins/include/header');

if($this->input->post('action', true) === 'add')
	{
	echo validation_errors();
	}

$administrator_id = $this->session->userdata('cUser');
echo $this->session->flashdata('msg-succes');

$rowNumber = 0;

 ?>
<form action="<?php echo base_url('admin/content');?>" method="POST">
Title<input type="text" name="title" placeholder="Title" value="<?=set_value('title');?>">
<br><br>
Description
<br><br>
<textarea rows="10" cols="30" name="description" placeholder="Description" value="<?=set_value('description');?>">
</textarea>
<br><br>
Content
<br><br>
<textarea rows="20" cols="100" name="content" placeholder="Content" value="<?=set_value('content');?>">
</textarea>
<br><br>
Slug
<br><br>
<input type="text" name="slug" placeholder="Slug" value="<?=set_value('slug');?>">
<br><br>
<input type="hidden" name="action_id" value="<?= $administrator_id; ?>">
<input type="hidden" name="action" value="add">
<br><br>
<input type="submit" value="Submit">

</form>





<div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach($all_posts_in_db as $posting) { ?>
                    <tr>
                        <th scope="row"><?= ++$rowNumber; ?></th>
                        <td><?= $posting['title']; ?></td>
                        <td><?= $posting['description']; ?></td>
                        <td>
                            <a class="btn btn-warning btn-xs" href="<?= base_url( 'admin/user/' . $posting['id']); ?>">
                                <i class="glyphicon glyphicon-pencil"></i>Edit
                            </a>
                            <a class="btn btn-danger btn-xs" href="<?= base_url('admin/delete-content/' . $posting['id']); ?>">
                                <i class="glyphicon glyphicon-trash"></i>Delete
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

<?php
$this->load->view('admins/include/footer');