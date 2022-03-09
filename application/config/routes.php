<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Auth_ctrl/login';
$route['master/company'] = 'company_ctrl';
$route['master/cost-center'] = 'costcenter_ctrl';
$route['master/location'] = 'location_ctrl';
$route['master/meter'] = 'meter_ctrl';
$route['master/user'] = 'user_ctrl';
$route['assign-meter'] = 'Assigntask_ctrl';
$route['assign-meter-show'] = 'Assigntask_ctrl/assign_user_list';
$route['bill-upload'] = 'Meter_ctrl/bill_upload';
$route['bill-list'] = 'Meter_ctrl/bill_list';
//$route['pending-bill'] = 'Meter_ctrl/bill_pending';

$route['payment/add-payment'] = 'Payment_ctrl/payment';
$route['payment/payment-detail'] = 'Payment_ctrl/payment_detail';

$route['Meter-Reading'] = 'Meter_ctrl/meter_reading';
$route['Show-Meter-Reading'] = 'Meter_ctrl/show_meter_readings';
$route['Dashboard'] = 'Dashboard_ctrl';
$route['forgot-password'] = 'User_ctrl/change_password';
$route['log-out'] = 'Company_ctrl/logout';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
