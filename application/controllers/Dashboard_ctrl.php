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
          $query = "select count(*) total,bill_status from (select t2.date_of_bill,
                    t3.upload_frq,
                    t3.bill_upload,
                    if(t2.date_of_bill IS NOT NULL,
                    if(t3.bill_upload = 1,
                    (CASE
                        WHEN (t2.date_of_bill + INTERVAL t3.upload_frq MONTH + INTERVAL 7 DAY) > CURRENT_DATE() THEN 'DUE'
                        WHEN (t2.date_of_bill + INTERVAL t3.upload_frq MONTH + INTERVAL 7 DAY) = CURRENT_DATE() THEN 'URGENT'
                        ELSE 'OVER DUE'
                    END),'NOT FILLED'),'NOT FILLED') as bill_status
                    from meter_master as t1
                    join (SELECT b.bill_id,max(b.date_of_bill) as date_of_bill,mm.mid from meter_master mm
                    LEFT JOIN bill b on b.sno_id = mm.mid group by mm.mid) as t2
                    LEFT JOIN bill b1 on b1.bill_id = t2.bill_id
                    JOIN company_master cm on cm.cid = t1.cid
                    JOIN cost_center_master ccm on ccm.costc_id = t1.costc_id
                    JOIN location_master lm on lm.loc_id = t1.loc_id
                    LEFT JOIN (SELECT *,if(isnull(sub_meter_id),sno_id,sub_meter_id) as snoid FROM task_assign
                    WHERE 1=1 and status = 1) t3 on t3.snoid = t1.mid
                    WHERE t1.mid = t2.mid) as tt1
                    GROUP by bill_status";
          
          $bills =  $this->db->query($query)->result_array();
      } else {
          $query = "select count(*) total,bill_status from (SELECT if(t3.date_of_bill IS NOT NULL,if(ta.bill_upload = 1,
                    (CASE
                        WHEN (t3.date_of_bill + INTERVAL ta.upload_frq MONTH + INTERVAL 7 DAY) > CURRENT_DATE() THEN 'DUE'
                        WHEN (t3.date_of_bill + INTERVAL ta.upload_frq MONTH + INTERVAL 7 DAY) = CURRENT_DATE() THEN 'URGENT'
                        ELSE 'OVER DUE'
                    END),'NOT FILLED'),'NOT FILLED') as bill_status,
                    t3.*,ta.meter_reading,ta.reading_frq,ta.bill_upload,ta.upload_frq
                    FROM task_assign ta
                    join (select t1.mid,t1.bpno,b1.*,cm.cid,ccm.costc_id,lm.loc_id,cm.name as companyName,ccm.name as costcenterName,lm.name as locationName from meter_master as t1
                    join (SELECT b.bill_id,max(b.date_of_bill) as date_of_bill,mm.mid from meter_master mm
                    LEFT JOIN bill b on b.sno_id = mm.mid group by mm.mid) as t2
                    LEFT JOIN bill b1 on b1.bill_id = t2.bill_id
                    JOIN company_master cm on cm.cid = t1.cid
                    JOIN cost_center_master ccm on ccm.costc_id = t1.costc_id
                    JOIN location_master lm on lm.loc_id = t1.loc_id
                    WHERE t1.mid = t2.mid) as t3 on t3.mid = ta.sno_id
                    WHERE ta.user_id = ".$this->session->userdata('user_id')." and ta.status = 1 group by t3.mid)as tt1
                    GROUP by bill_status";
          $bills = $this->db->query($query)->result_array();
      }
      $finalarray = array();
      $finalarray['OVER DUE'] = '0';
      $finalarray['DUE'] = '0';
      $finalarray['NOT FILLED'] = '0';
      $finalarray['NOT ASSIGN'] = '0';
      $finalarray['URGENT'] = '0';
      
      foreach($bills as $bill){
          $temp = array();
          if($bill['bill_status'] == 'OVER DUE'){
              $finalarray['OVER DUE'] = $bill['total'];
          }
          if($bill['bill_status'] == 'DUE'){
              $finalarray['DUE'] = $bill['total'];
          }
          if($bill['bill_status'] == 'NOT FILLED'){
              $finalarray['NOT FILLED'] = $bill['total'];
          }
          if($bill['bill_status'] == 'URGENT'){
              $finalarray['URGENT'] = $bill['total'];
          }
          if($bill['bill_status'] == 'NOT ASSIGN'){
              $finalarray['NOT ASSIGN'] = $bill['total'];
          }
      } 
      
      $finalarray['total_meters'] = $finalarray['NOT ASSIGN'] + $finalarray['OVER DUE'] + $finalarray['DUE'] + $finalarray['NOT FILLED']+ $finalarray['URGENT'];
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