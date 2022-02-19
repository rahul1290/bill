<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'auth';

$route['admin/user'] = 'User_ctrl';
$route['admin/user/(:num)'] = 'User_ctrl/index/$1';

$route['admin/company'] = 'Company_ctrl';
$route['admin/company/(:num)'] = 'Company_ctrl/index/$1';

$route['admin/cost-center'] = 'Costcenter_ctrl';
$route['admin/cost-center/(:num)'] = 'Costcenter_ctrl/index/$1';

$route['admin/location'] = 'Location_ctrl';
$route['admin/location/(:num)'] = 'Location_ctrl/index/$1';

$route['admin/meter'] = 'Service_ctrl';
$route['admin/meter/(:num)'] = 'Service_ctrl/index/$1';

$route['user'] = 'User_ctrl';
$route['user/(:num)'] = 'User_ctrl/user/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
