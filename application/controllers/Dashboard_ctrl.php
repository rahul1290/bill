<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_ctrl extends CI_Controller {

	function __construct() {
    parent::__construct();
		$this->load->database();
		$this->load->model(array('Costcenter_model','Company_model','Location_model','User_model','Assigntask_model','Meter_model'));
  }

  function index(){
    $role = $this->session->userdata('role');
    $data['pending_reading'] = '';
    $data['pending_billupload'] = '';
    $data['main_content'] = $this->load->view('dashboard',$data,true);
  	$this->load->view('admin_layout',$data);
  }
}