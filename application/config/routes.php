<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'auth';
$route['admin/create-user'] = 'admin/Admin_ctrl/create_user';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
