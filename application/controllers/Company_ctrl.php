<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_ctrl extends CI_Controller {

	function __construct() {
    parent::__construct();
		$this->load->database();
		$this->load->model('Company_model');
  }

	function getCompanyById(){
		$cid = $this->input>post('cid')
		$result = $this->Company_model->company_list($cid);
		if(count($result)>0){
			echo json_encode(array('data'=>$result,'status'=>200));
		} else {
			echo json_encode(array('msg'=>'No record found.','status'=>500));
		}
	}

  function index(){
		$data['companies'] = $this->Company_model->company_list();
		if ($this->input->server('REQUEST_METHOD') === 'GET') {
			$data['main_content'] = $this->load->view('company',$data,true);
	    $this->load->view('admin_layout',$data);
		} else {
			$this->form_validation->set_rules('name', 'Company name', 'required|trim');
			$this->form_validation->set_rules('address', 'Compnay address', 'required|trim');
			$this->form_validation->set_rules('email', 'Email', 'valid_email|trim');
			$this->form_validation->set_rules('contact', 'Contact No', 'required|min_length[10]|max_length[13]|trim|is_natural');
			$this->form_validation->set_rules('alternet_no', 'Alternet Contact No', 'min_length[10]|max_length[13]|trim|is_natural');

			if ($this->form_validation->run()){

				$data['name'] = $this->post('name');
				$data['address'] = $this->post('address');
				$data['email'] = $this->post('email');
				$data['contact_no'] = $this->post('contact');
				$data['alternet_no'] = $this->post('alternet_no');
				$data['created_by'] = $this->user_data->user_id;
				$data['created_at'] = date('Y-m-d');

				$result = $this->Company_model->create_company($data);
				if($result){
					$this->response(array('msg'=>'company created.','status'=>'200'),201);
				} else{
					$this->response(array('msg'=>'somthing went wrong.','status'=>'500'),500);
				}
			} else {
				$data = validation_errors();
				$this->response(array('errors'=>$data,'status'=>500),500);
			}
		}
  }
}
