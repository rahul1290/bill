<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Auth_ctrl/login';

$route['admin/user'] = 'api/User_ctrl';
$route['admin/user/(:num)'] = 'api/User_ctrl/index/$1';

$route['admin/company'] = 'api/Company_ctrl';
$route['admin/company/(:num)'] = 'api/Company_ctrl/index/$1';

$route['admin/cost-center'] = 'api/Costcenter_ctrl';
$route['admin/cost-center/(:num)'] = 'api/Costcenter_ctrl/index/$1';

$route['admin/location'] = 'api/Location_ctrl';
$route['admin/location/(:num)'] = 'api/Location_ctrl/index/$1';

$route['admin/meter'] = 'api/Service_ctrl';
$route['admin/meter/(:num)'] = 'api/Service_ctrl/index/$1';

$route['user'] = 'api/User_ctrl';
$route['user/(:num)'] = 'api/User_ctrl/user/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
