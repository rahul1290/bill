<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assigntask_ctrl extends CI_Controller {

	function __construct() {
    parent::__construct();
		$this->load->database();
		$this->load->model(array('Costcenter_model','Company_model','Location_model','User_model','Assigntask_model','Meter_model'));
  }

	function getUserById(){
		$uid = $this->input->post('uid');
		$result = $this->User_model->user_list($uid);
		if(count($result)>0){
			echo json_encode(array('data'=>$result[0],'status'=>200));
		} else {
			echo json_encode(array('msg'=>'No record found.','status'=>500));
		}
	}

	function getUsers(){
		$result = $this->User_model->user_list();
		
		if(!is_null($result) && count($result)>0){
			echo json_encode(array('data'=>$result,'status'=>200));
		} else {
			echo json_encode(array('msg'=>'No record found.','status'=>500));
		}
	}

	function getSubMeterDetail($mid){
		$this->db->select('*');
		return $result = $this->db->get_where('meter_master',array('parent_meter'=>$mid,'status'=>1))->result_array();
	}

  function index(){
		$data['companies'] = $this->Company_model->Company_list();
		$data['users'] = $this->User_model->user_list();
		$data['meters'] = $this->Meter_model->Meter_list();
	
		$totalLength = count($data['meters']);

		$main_meters = array();
		
		if ($this->input->server('REQUEST_METHOD') === 'GET') {
			$data['main_content'] = $this->load->view('assigntask',$data,true);
	  		$this->load->view('admin_layout',$data);
		} else {
			$this->form_validation->set_rules('company', 'Company', 'required|trim');
			$this->form_validation->set_rules('costc_id', 'Cost Center', 'required|trim');
			$this->form_validation->set_rules('loc_id', 'Location', 'required|trim');
			$this->form_validation->set_rules('meter', 'Service No', 'required|trim|is_natural');
			$this->form_validation->set_rules('sub-meter', 'Sub Meter', 'trim');
			$this->form_validation->set_rules('user', 'Employee', 'required|trim|is_natural');
			
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if ($this->form_validation->run()){
				$utid = $this->input->post('utid');
				$db_data['sno_id'] = $this->input->post('meter');
				$db_data['sub_meter_id'] = $this->input->post('sub-meter') == '' ? null : $this->input->post('sub-meter');
				$db_data['user_id'] = $this->input->post('user');
				$db_data['meter_reading'] = $this->input->post('meter_reading') == 'on' ? '1' : '0';
				$db_data['reading_frq'] = $this->input->post('reading_frq');
				$db_data['bill_upload'] = $this->input->post('bill_upload') == 'on' ? '1' : '0';
				$db_data['upload_frq'] = $this->input->post('upload_frq');
				$db_data['created_by'] = $this->session->userdata('user_id');
				$db_data['created_at'] = date('Y-m-d');
				if($utid == ''){
					$result = $this->Assigntask_model->create_task($db_data);
				} else {
					$result = $this->Assigntask_model->update_task($db_data,$utid);
				}
				if($result){
					$data['companies'] = $this->Company_model->Company_list();
					$data['users'] = $this->User_model->user_list();
					$data['tasks'] = $this->Assigntask_model->task_list();
					if($utid == ''){
						$this->session->set_flashdata('msg','task created successfully.');
					} else {
						$this->session->set_flashdata('msg','task updated successfully.');
					}
					redirect(current_url());
				} else{
					$this->session->set_flashdata('msg','Something went wrong.');

					$data['main_content'] = $this->load->view('assigntask',$data,true);
	  				$this->load->view('admin_layout',$data);
				}
			} else {
				//echo validation_errors(); die;
				$data['main_content'] = $this->load->view('assigntask',$data,true);
	  			$this->load->view('admin_layout',$data);
			}
		}
  }

  function delete_user(){
	  $uid = $this->input->post('uid');
	  $result = $this->User_model->user_delete($uid);
	  
	  if($result){
		  echo json_encode(array('msg'=>'Location deleted successfully.','status'=>200));
	  } else {
		echo json_encode(array('msg'=>'Something went wrong.','status'=>500));
	  }
  }

  function assign_user_list(){
	$data['records'] = $this->db->query("SELECT mm.mid,if(isnull(mm.parent_meter),'main-meter','sub-meter') as mtype,mm.bpno,mm.parent_meter,
								cm.name as company,ccm.name as cost_center_name,lm.name as location,ta.user_id,ta.meter_reading,ta.reading_frq,
								ta.bill_upload,ta.upload_frq
								FROM meter_master mm
								left JOIN meter_master mm2 on mm2.parent_meter = mm.mid
								JOIN company_master cm on cm.cid = mm.cid
								JOIN cost_center_master ccm on ccm.costc_id = mm.costc_id
								JOIN location_master lm on lm.loc_id = mm.loc_id
								left JOIN (SELECT task_id,if(isnull(sub_meter_id),sno_id,sub_meter_id) as meter_id,user_id,meter_reading,reading_frq,bill_upload,upload_frq FROM task_assign WHERE status = 1) as ta on ta.meter_id = mm.mid
								group by mm.bpno
								order by mm.mid")->result_array();

	$this->db->select('*');
	$data['users'] = $this->db->get_where('users',array('status'=>1))->result_array();
	
	$data['main_content'] = $this->load->view('assigntask-show',$data,true);
	$this->load->view('admin_layout',$data);
  }
}
