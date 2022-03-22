<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_ctrl extends CI_Controller {

	function __construct() {
    parent::__construct();
    $this->load->library('upload');
		$this->load->database();
		$this->load->model(array('Costcenter_model','Company_model','Location_model','Meter_model')); 
  }
  
  function payment(){
      $uid = $this->session->userdata('user_id');
      if($this->session->userdata('role') == 'super_admin'){
          $data['service_no'] = $this->Meter_model->meterlistUserWise();
          $data['readings'] = $this->Meter_model->show_meter_readings();
      }  else {
          $data['service_no'] = $this->Meter_model->meterlistUserWise($this->session->userdata('user_id'));
          $data['readings'] = $this->Meter_model->show_meter_readings($this->session->userdata('user_id'));
          
          $finalarray = array();
          foreach($data['readings'] as $reading){
              if($reading['last_reading_date'] != ''){
                  if(date('Y-m-d') >= date('Y-m-d', strtotime($reading['last_reading_date']. ' + '.$reading['reading_frq'].' days'))){
                      $finalarray[] = $reading;
                  }
              } else {
                  $finalarray[] = $reading;
              }
          }
          $data['readings'] = $finalarray;
      }
      $data['companies'] = $this->Company_model->get_my_companies();
      
      if ($this->input->server('REQUEST_METHOD') === 'GET') {
          $data['main_content'] = $this->load->view('payment',$data,true);
          $this->load->view('admin_layout',$data);
      } else {
          $this->form_validation->set_rules('company', 'Company', 'required|trim');
          $this->form_validation->set_rules('serviceno', 'Service No', 'required|trim');
          $this->form_validation->set_rules('costcenter', 'Cost-Center', 'required|trim');
          $this->form_validation->set_rules('location', 'location', 'required|trim');
          $this->form_validation->set_rules('bill_no', 'Bill No', 'required|trim');
          $this->form_validation->set_rules('bill_date', 'Bill Date', 'required|trim');
          $this->form_validation->set_rules('bill_amount', 'Bill Amount', 'required|trim');
          $this->form_validation->set_rules('due_date', 'Due Date', 'required|trim');
          $this->form_validation->set_rules('payment_amount', 'Payment Amount', 'required|trim');
          $this->form_validation->set_rules('payment_date', 'Payment Date', 'required|trim');
          $this->form_validation->set_rules('p_type', 'Payment Type', 'required|trim');
          if($this->input->post('p_type') == 'cheque'){
            $this->form_validation->set_rules('checkno', 'Cheque No', 'trim|required');
          }
          
          $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
          if ($this->form_validation->run()){
              
              $this->db->where('bill_id',$this->input->post('bill_no'));
              $this->db->update('bill',array(
                 'payment_amount' => $this->input->post('payment_amount'),
                  'payment_date' => $this->input->post('payment_date'),
                  'payment_by' => $this->session->userdata('user_id'),
                  'payment_type' => $this->input->post('p_type'),
                  'check_no' => $this->input->post('checkno'),
              ));
               $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">
                payment successfull.
              </div>');
                  redirect(current_url());
              
          } else {
              $data['main_content'] = $this->load->view('payment',$data,true);
              $this->load->view('admin_layout',$data);
          }
      }
  }
  
  
  function payment_detail(){
      $data['companies'] = $this->Company_model->get_my_companies();
      $data['main_content'] = $this->load->view('payment_detail',$data,true);
      $this->load->view('admin_layout',$data);
  }
  
  function paymentDetails(){
      $company = $this->input->post('company');
      $costcenter = $this->input->post('costcenter');
      $location = $this->input->post('location');
      $search = $this->input->post('search');
      
      if($this->session->userdata('role') != 'super_admin'){
        $query = "select mm.bpno,cm.cid,cm.name as company_name,ccm.costc_id,ccm.name as cost_center,lm.loc_id,lm.name as location_name,b.*,DATE_FORMAT(b.date_of_bill,'%d/%m/%Y') as date_of_bill,DATE_FORMAT(b.due_date,'%d/%m/%Y') as due_date,IFNULL(DATE_FORMAT(b.payment_date,'%d/%m/%Y'),'') as payment_date from bill b 
                	JOIN meter_master mm on mm.mid = b.sno_id AND mm.status = 1
                    JOIN company_master cm on cm.cid = mm.cid";
                    
        if($company != ''){
            $query .= " AND cm.cid = ".$company; 
        }
        $query .= " AND cm.status = 1
                    JOIN cost_center_master ccm on ccm.costc_id = mm.costc_id";
        if($costcenter != ''){
            $query .= " AND ccm.costc_id =".$costcenter;
        }
       $query .= " AND ccm.status = 1
                    JOIN location_master lm on lm.loc_id = mm.loc_id";
       if($location != ''){
           $query .= " AND lm.loc_id =".$location;
       }
       $query .= " AND lm.status = 1
                	WHERE sno_id in (SELECT if(ISNULL(sub_meter_id),sno_id,sub_meter_id) as meters FROM `task_assign` 
                                    	WHERE user_id = ".$this->session->userdata('user_id')." AND status = 1)
                	AND b.status = 1";
       if($search != ''){
           $query .= " AND b.bill_no like '%".$search."%'";
       }
        $query .= " order by b.bill_id desc"; 
      }
      else {
        $query = "select mm.bpno,cm.cid,cm.name as company_name,ccm.costc_id,ccm.name as cost_center,lm.loc_id,lm.name as location_name,b.*,DATE_FORMAT(b.date_of_bill,'%d/%m/%Y') as date_of_bill,DATE_FORMAT(b.due_date,'%d/%m/%Y') as due_date,IFNULL(DATE_FORMAT(b.payment_date,'%d/%m/%Y'),'') as payment_date from bill b 
                    JOIN meter_master mm on mm.mid = b.sno_id AND mm.status = 1
                    JOIN company_master cm on cm.cid = mm.cid";
        if($company != ''){
            $query .= " AND cm.cid = ".$company;
        }
        $query .= " AND cm.status = 1
                    JOIN cost_center_master ccm on ccm.costc_id = mm.costc_id";
        if($costcenter != ''){
            $query .= " AND ccm.costc_id =".$costcenter;
        }
        $query .= " AND ccm.status = 1
                    JOIN location_master lm on lm.loc_id = mm.loc_id";
        if($location != ''){
            $query .= " AND lm.loc_id =".$location;
        }
        $query .= " AND lm.status = 1
                    where b.status = 1";
        if($search != ''){
            $query .= " AND b.bill_no like '%".$search."%'";
        }
        $query .= " order by b.bill_id desc";   
      }
      $result = $this->db->query($query)->result_array();
      
      if(count($result)>0){
        echo json_encode(array('data'=>$result,'status'=>200));
      } else {
          echo json_encode(array('status'=>500));
      }
  }
}
