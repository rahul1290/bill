<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Task_ctrl extends REST_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model(array('Company_model','Costcenter_model','Location_model'));
        $this->jwt = new JWT();
        
        $this->header = ($this->input->request_headers());
        
        if(isset($this->header['Token']) &&  $this->header['Token'] != null){
            $this->user_data = $this->my_lib->is_valid($this->header['Token']);
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
    
    
    function billupload_task_summary_get(){
        if(($this->jwt->decode($this->header['Token'])->role) == 'super_admin'){
            
        } else {
            $result = $this->db->query("select count(*) total,bill_status from (select t2.date_of_bill,
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
                    WHERE 1=1 and status = 1) t3 on t3.snoid = t1.mid AND t3.user_id = ".$this->jwt->decode($this->header['Token'])->user_id."
                    WHERE t1.mid = t2.mid) as tt1
                    GROUP by bill_status")->result_array();
            
            if(count($result) > 0){
                $final_array = array();
                
                foreach($result as $r){
                    if($r['bill_status'] == 'NOT FILLED')
                        $final_array['not_filled'] = (int)$r['total'];
                        
                    if($r['bill_status'] == 'OVER DUE')
                      $final_array['over_due'] = (int)$r['total'];
                        
                    if($r['bill_status'] == 'URGENT')
                       $final_array['urgent'] = (int)$r['total'];
                            
                    if($r['bill_status'] == 'DUE')
                       $final_array['due'] = (int)$r['total'];
                                    
                }
                $this->response(array(
                    'data'=>$final_array,
                    'msg' => 'Bill-Upload Task Summary.',
                    'status'=>200),
                    200);
            }
            else {
                $this->response(array(
                    'msg' => 'No record found.',
                    'status'=>501),
                    200);
            }
        }
        
    }
    
    function index_get(){
        $this->db->select('*');
        $result = $this->db->get_where('users',array('status'=>1))->result_array();
        $this->response($result,200);
    }
    
}
