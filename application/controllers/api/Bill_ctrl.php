<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
//header('Content-Type: application/json; charset=utf-8');

class Bill_ctrl extends REST_Controller {

	function __construct() {
    parent::__construct();
        $this->load->database();
		$this->load->model(array('Company_model','Costcenter_model','Location_model'));
		$this->jwt = new JWT();

		$this->header = ($this->input->request_headers());
		if(isset($this->header['token']) &&  $this->header['token'] != null){
			$this->user_data = $this->my_lib->is_valid($this->header['token']);
			if(is_null($this->user_data)){
				http_response_code(401);
				echo json_encode(array('msg'=>'Invalid token.','status'=>'401'));
				die;
			}
		}
		else { //token not set
			http_response_code(400);
			echo json_encode(array('errors'=>'Token not set.','status'=>400));
			die;
		}
  }


  function index_get($companyId=null,$costCenterId=null,$location=null){
      $data['companies'] = $this->Company_model->company_list();
      $data['cost_centers'] = $this->Costcenter_model->costcenter_list($companyId);
      $data['locations'] = $this->Location_model->getLocationByCostcenterId($costCenterId);
      $status = $this->input->get('status');
      
      if(($this->jwt->decode($this->header['token'])->role) == 'super_admin'){
          $query = "select t3.*,t1.mid,t1.bpno,t2.bill_id,t2.date_of_bill,b1.*,cm.name as companyName,ccm.name as costcenterName,lm.name as locationName,
                    if(t2.date_of_bill IS NOT NULL,
                       if(t3.bill_upload = 1,
                          (CASE
                           WHEN (t2.date_of_bill + INTERVAL t3.upload_frq MONTH) > CURRENT_DATE() THEN 'DUE'
                           WHEN (t2.date_of_bill + INTERVAL t3.upload_frq MONTH) = CURRENT_DATE() THEN 'URGENT'
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
                    WHERE t1.mid = t2.mid";
          if(!is_null($companyId)){
              $query .= " AND cm.cid=".$companyId;
          }
          if(!is_null($costCenterId)){
              $query .= " AND ccm.costc_id=".$costCenterId;
          }
          if(!is_null($location)){
              $query .= " AND lm.loc_id=".$location;
          }
          $bills =  $this->db->query($query)->result_array();
      } else{
          $query = "SELECT t3.*,ta.meter_reading,ta.reading_frq,ta.bill_upload,ta.upload_frq,
                    if(t3.date_of_bill IS NOT NULL,
                       if(ta.bill_upload = 1,
                          (CASE
                           WHEN (t3.date_of_bill + INTERVAL ta.upload_frq MONTH) > CURRENT_DATE() THEN 'DUE'
                           WHEN (t3.date_of_bill + INTERVAL ta.upload_frq MONTH) = CURRENT_DATE() THEN 'URGENT'
                           ELSE 'OVER DUE'
                           END),'NOT FILLED'),'NOT FILLED') as bill_status
                    FROM task_assign ta
                    join (select t1.mid,t1.bpno,b1.*,cm.cid,ccm.costc_id,lm.loc_id,cm.name as companyName,ccm.name as costcenterName,lm.name as locationName from meter_master as t1
                    join (SELECT b.bill_id,max(b.date_of_bill) as date_of_bill,mm.mid from meter_master mm
                    LEFT JOIN bill b on b.sno_id = mm.mid group by mm.mid) as t2
                    LEFT JOIN bill b1 on b1.bill_id = t2.bill_id
                    JOIN company_master cm on cm.cid = t1.cid
                    JOIN cost_center_master ccm on ccm.costc_id = t1.costc_id
                    JOIN location_master lm on lm.loc_id = t1.loc_id
                    WHERE t1.mid = t2.mid) as t3 on t3.mid = if(isnull(ta.sub_meter_id),ta.sno_id,ta.sub_meter_id)
                    WHERE ta.user_id = ".   $this->jwt->decode($this->header['token'])->user_id." and ta.status = 1";
          if(!is_null($companyId)){
              $query .= " AND t3.cid=".$companyId;
          }
          if(!is_null($costCenterId)){
              $query .= " AND t3.costc_id=".$costCenterId;
          }
          if(!is_null($location)){
              $query .= " AND t3.loc_id=".$location;
          }
          
          $bills = $this->db->query($query)->result_array();
      }
      $this->response(array(
                            'data'=>array('bills'=>$bills),
                            'msg' => 'All bills',
                            'status'=>200),
                      200);
  }
}
