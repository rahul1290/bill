<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Admin_ctrl extends REST_Controller {

	function __construct() {
        parent::__construct();

		$this->load->model('User_model');
		$this->jwt = new JWT();
  }

	function create_user_post(){

		$this->form_validation->set_rules('fname', 'First name', 'required|trim');
    $this->form_validation->set_rules('lname', 'Last name', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim');

    if ($this->form_validation->run()){
			$data['fname'] = $this->post('fname');
			$data['lname'] = $this->post('lname');
			$data['email'] = $this->post('email');
			$data['contact_no'] = $this->post('contact');
			$data['password'] = $this->post('password');
			$data['sex'] = $this->post('sex');
			$data['utype'] = $this->post('utype');
			$data['created_by'] = $this->post('created_by');
			$data['created_at'] = date('Y-m-d h:i:s');

			$result = $this->User_model->create_user($data);
			if($result){
				$this->response(array('msg'=>'user created.','status'=>'200'),201);
			}
			$this->response(array('msg'=>'somthing went wrong.','status'=>'500'),500);
		} else {
			$data = validation_errors();
			$this->response(array('msg'=>$data,'status'=>500),500);
		}
	}
}
