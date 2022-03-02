<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Auth_ctrl/login';
$route['master/Company'] = 'company_ctrl';
$route['master/Cost-Center'] = 'costcenter_ctrl';
$route['master/Location'] = 'location_ctrl';
$route['master/Meter'] = 'meter_ctrl';
$route['master/User'] = 'user_ctrl';
$route['Assign-meter'] = 'Assigntask_ctrl';
$route['Assign-meter-show'] = 'Assigntask_ctrl/assign_user_list';
$route['Bill-upload'] = 'Meter_ctrl/bill_upload';
$route['Meter-Reading'] = 'Meter_ctrl/meter_reading';
$route['Show-Meter-Reading'] = 'Meter_ctrl/show_meter_readings';
$route['Log-Out'] = 'Company_ctrl/logout';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
