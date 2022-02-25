<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meter_ctrl extends CI_Controller {

	function __construct() {
    parent::__construct();
		$this->load->database();
		$this->load->model(array('Costcenter_model','Company_model','Location_model','Meter_model'));
  }

	function getMeterById(){
		$lid = $this->input->post('lid');
		$result = $this->Meter_model->meter_list($lid);
		if(count($result)>0){
			echo json_encode(array('data'=>$result[0],'status'=>200));
		} else {
			echo json_encode(array('msg'=>'No record found.','status'=>500));
		}
	}

	function getMeters(){
		$result = $this->Meter_model->meter_list();
		
		if(!is_null($result) && count($result)>0){
			echo json_encode(array('data'=>$result,'status'=>200));
		} else {
			echo json_encode(array('msg'=>'No record found.','status'=>500));
		}
	}

  function index(){
	  	$data['meters'] = $this->Meter_model->meter_list();
	  	$data['locations'] = $this->Location_model->location_list();
		$data['costceners'] = $this->Costcenter_model->costcenter_list();
		$data['companies'] = $this->Company_model->Company_list();
		
		if ($this->input->server('REQUEST_METHOD') === 'GET') {
			$data['main_content'] = $this->load->view('master/meter',$data,true);
	  		$this->load->view('admin_layout',$data);
		} else {
			$this->form_validation->set_rules('bpno', 'BP no.', 'required|trim');
			$this->form_validation->set_rules('mtype', 'Meter type', 'required|trim');
			$this->form_validation->set_rules('cid', 'Company', 'required|trim');
			$this->form_validation->set_rules('costc_id ', 'Cost-center', 'required|trim');
			$this->form_validation->set_rules('loc_id ', 'Location', 'required|trim');
			$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');
			if ($this->form_validation->run()){
				$lid = $this->input->post('mid');
				$db_data['bpno'] = $this->input->post('bpno');
				$db_data['mtype'] = $this->input->post('mtype');
				$db_data['cid'] = $this->input->post('cid');
				$db_data['costc_id'] = $this->input->post('costc_id');
				$db_data['loc_id'] = $this->input->post('loc_id');
				$db_data['created_by'] = $this->session->userdata('user_id');
				$db_data['created_at'] = date('Y-m-d');
				if($lid == ''){
					$result = $this->Meter_model->create_meter($db_data);
				} else {
					$result = $this->Meter_model->update_meter($db_data,$lid);
				}
				if($result){
					$data['companies'] = $this->Meter_model->meter_list();
					if($lid == ''){
						$this->session->set_flashdata('msg','Meter created successfully.');
					} else {
						$this->session->set_flashdata('msg','Meter updated successfully.');
					}
					redirect(current_url());
				} else{
					$this->session->set_flashdata('msg','Something went wrong.');

					$data['main_content'] = $this->load->view('master/meter',$data,true);
	  				$this->load->view('admin_layout',$data);
				}
			} else {
				$data['main_content'] = $this->load->view('master/meter',$data,true);
	  			$this->load->view('admin_layout',$data);
			}
		}
  }

  function delete_meter(){
	  $mid = $this->input->post('mid');
	  $result = $this->Meter_model->meter_delete($mid);
	  
	  if($result){
		  echo json_encode(array('msg'=>'Meter deleted successfully.','status'=>200));
	  } else {
		echo json_encode(array('msg'=>'Something went wrong.','status'=>500));
	  }
  }
}
