
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_ctrl extends CI_Controller {

	function __construct() {
    parent::__construct();
		$this->load->database();
		$this->load->model(array('Costcenter_model','Company_model','Location_model','User_model','Assigntask_model','Meter_model'));
  }

  
  function bill_upload_data(){
      if($this->session->userdata('role') == 'super_admin'){
              $bills =  $this->db->query("CALL bill_upload_record_super_admin()")->result_array();
              $this->db->reconnect();
              $payment_pending = $this->db->query("select count(*) as total from bill WHERE sno_id in (SELECT if(isnull(sub_meter_id),sno_id,sub_meter_id) as sno_id FROM task_assign WHERE  status = 1)
                                                AND status = 1
                                                AND payment_amount IS NULL")->result_array();
              
      } else if($this->session->userdata('role') == 'manager'){
          $bills =  $this->db->query("CALL bill_upload_record_manager(".$this->session->userdata('user_id').")")->result_array();
          $this->db->reconnect();
          $payment_pending = $this->db->query("select count(*) as total from bill WHERE sno_id in (SELECT if(isnull(sub_meter_id),sno_id,sub_meter_id) as sno_id FROM task_assign WHERE user_id in (SELECT uid from users WHERE reporting_to = ".$this->session->userdata('user_id')." AND status = 1) AND status = 1)
                                                AND status = 1
                                                AND payment_amount IS NULL")->result_array();
      }else {
          $bills =  $this->db->query("CALL bill_upload_record_operator(".$this->session->userdata('user_id').")")->result_array();
          $this->db->reconnect();
          $payment_pending = $this->db->query("select count(*) as total from bill WHERE sno_id in (SELECT if(isnull(sub_meter_id),sno_id,sub_meter_id) as sno_id FROM task_assign WHERE user_id = ".$this->session->userdata('user_id')." AND status = 1)
                                                AND status = 1
                                                AND payment_amount IS NULL")->result_array();
      }
      $finalarray = array();
      $finalarray['OVER DUE'] = '0';
      $finalarray['DUE'] = '0';
      $finalarray['NOT FILLED'] = '0';
      $finalarray['NOT ASSIGN'] = '0';
      $finalarray['URGENT'] = '0';
      
      foreach($bills as $bill){
          $temp = array();
          if($bill['status'] == 'OVER DUE'){
              $finalarray['OVER DUE'] = $bill['total'];
          }
          if($bill['status'] == 'DUE'){
              $finalarray['DUE'] = $bill['total'];
          }
          if($bill['status'] == 'NOT FILLED'){
              $finalarray['NOT FILLED'] = $bill['total'];
          }
          if($bill['status'] == 'URGENT'){
              $finalarray['URGENT'] = $bill['total'];
          }
          if($bill['status'] == 'NOT ASSIGN'){
              $finalarray['NOT ASSIGN'] = $bill['total'];
          }
      } 
      
      $finalarray['total_meters'] = $finalarray['NOT ASSIGN'] + $finalarray['OVER DUE'] + $finalarray['DUE'] + $finalarray['NOT FILLED']+ $finalarray['URGENT'];
      $finalarray['payment_pending'] = $payment_pending[0]['total'];
      echo json_encode(array('data'=>$bills,'data1'=>$finalarray,'status'=>200)); 
  }
  
  
  function bill_payments(){
      $company = $this->input->post('company');
      if($this->input->post('month') != ''){
        $month = $this->input->post('month');
      } else {
          $month = date('m');
      }
      if($this->input->post('year') != ''){
        $year = $this->input->post('year');
      } else {
          $year = date('Y');
      }
      
      $fromdate = $year.'-'.str_pad($month, 2, '0', STR_PAD_LEFT).'-'.'01';
      //echo $fromdate;
      $last_date = cal_days_in_month(CAL_GREGORIAN,$month,$year);
      $todate = $year.'-'.str_pad($month, 2, '0', STR_PAD_LEFT).'-'.$last_date;
      
      $query = "select mm.cid,cm.name as company_name,sum(b.gross_amount) as total_bill from meter_master mm
                        JOIN bill b on b.sno_id = mm.mid AND b.from_date BETWEEN '".$fromdate."' AND '".$todate."'
                        JOIN company_master cm on cm.cid = mm.cid";
      if($company != ''){
          $query .= " AND cm.cid = ".$company;
      }
  
    $query .= " GROUP by cid";
      
      
      $result = $this->db->query($query)->result_array();
      if(count($result)>0) {
          echo json_encode(array('data'=>$result,'status'=>200));
      } else {
          echo json_encode(array('msg'=>'no record found.','status'=>500));
      }
  }
  
  
  function index(){
    $data['companies'] = $this->Company_model->company_list();
    $data['main_content'] = $this->load->view('dashboard',$data,true);
  	$this->load->view('admin_layout',$data);
  }
}