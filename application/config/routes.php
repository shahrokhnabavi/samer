<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'site';
$route['translate_uri_dashes'] = FALSE;


// Admin Panel by Shahrokh
$route['admin']           = 'admins/login';
$route['admin/dashboard'] = 'site/dashboard';
$route['admin/setting']   = 'site/setting';
$route['admin/logout']    = 'admins/logout';

$route['admin/user([0-9]*|[0-9]*/[0-9]*)']  = 'admins/form/$1/$2';
$route['admin/delete-user/([0-9]*)']  = 'admins/delete/$1';

$route['admin/gallery([0-9]*|[0-9]*/[0-9]*)']  = 'galleries/form/$1/$2';
$route['admin/delete-gallery/([0-9]*)']  = 'galleries/delete/$1';


$route['admin/gallery([0-9]*|[0-9]*/[0-9]*)'] = 'galleries/form/$1/$2';
$route['admin/delete-gallery/([0-9]*)']       = 'galleries/delete/$1';
$route['thumb-gallery/([0-9]*)']  = 'galleries/thumbImage/$1';


// Admin Panel by Sheril
$route['admin/content']    = 'post';
$route['admin/delete-content/([0-9]*)']  = 'post/delete/$1';
$route['admin/edit-content/(:num)']  = 'post/edit/$1';
$route['admin/content_update']    = 'post/update';


//front end routes
$route['home'] = 'front_end';
$route['gallery'] = 'front_end/gallery';
$route['about'] = 'front_end/about';
$route['subscribe'] = 'subscribe/add_member';