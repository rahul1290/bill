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
      if($this->session->userdata('role') == 'super_admin' || $this->session->userdata('role') == 'admin'){
          $data['service_no'] = $this->Meter_model->meterlistUserWise();
          $data['companies'] = $this->db->query("select * from company_master where status = 1")->result_array();
          $data['readings'] = $this->Meter_model->show_meter_readings();
      }  else {
          $data['service_no'] = $this->Meter_model->meterlistUserWise($this->session->userdata('user_id'));
          $data['companies'] = $this->db->query("select * from company_master where cid in (
          select cid from meter_master
          WHERE mid in(SELECT if(isnull(sub_meter_id),sno_id,sub_meter_id) as meter FROM task_assign WHERE user_id = $uid)
          GROUP by cid)")->result_array();
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
          $this->form_validation->set_rules('checkno', 'Check No', 'trim');
          
          $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
          if ($this->form_validation->run()){
              
              $this->db->where('bill_no',$this->input->post('bill_no'));
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
      $data['main_content'] = $this->load->view('payment_detail','',true);
      $this->load->view('admin_layout',$data);
  }
  
  function paymentDetails(){
      $result = $this->db->query("select b.*,mm.bpno,mm.cid,mm.costc_id,mm.loc_id,cm.name as company_name,ccm.name as cost_center,lm.name as location_name
        from bill b
        JOIN meter_master mm on mm.mid = b.sno_id and mm.status = 1
        JOIN company_master cm on cm.cid = mm.cid AND cm.status = 1
        JOIN cost_center_master ccm on ccm.costc_id = mm.costc_id and ccm.status = 1
        JOIN location_master lm on lm.loc_id = mm.loc_id AND lm.status = 1
        where b.bill_id in (SELECT max(bill_id) FROM bill WHERE status = 1 group by sno_id)")->result_array();
      
      echo json_encode(array('data'=>$result,'status'=>200));
  }
}
