<<<<<<< HEAD
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
    
    
    function billupload_task_summary_get($task_category=null){
        if(!is_null($task_category)){
            if($task_category == 'not_filled')
                $task_category = 'NOT FILLED';
            
            if($task_category == 'today')
                $task_category = 'URGENT';
            
            if($task_category == 'over_due')
                $task_category = 'OVER DUE';
            
            if($task_category == 'due')
               $task_category = 'DUE';
        }
        
        if(($this->jwt->decode($this->header['Token'])->role) == 'super_admin'){
            
        } else {
            if(!is_null($task_category)){
            if($task_category == 'NOT FILLED'){
                $result = $this->db->query("select service_no,company_name,costcenter_name,location_name,snoid from (select mm.bpno as service_no,cm.name as company_name,ccm.name as costcenter_name,lm.name as location_name,mm.mid as snoid,(select count(*) from bill WHERE sno_id  = t2.snoid) not_filled from meter_master mm
                    JOIN (SELECT if(isnull(sub_meter_id),sno_id,sub_meter_id) as snoid FROM task_assign WHERE user_id = ".$this->jwt->decode($this->header['Token'])->user_id."  and status = 1) t2 on t2.snoid = mm.mid
                    JOIN company_master cm on cm.cid = mm.cid AND cm.status = 1
                    JOIN cost_center_master ccm on ccm.costc_id = mm.costc_id and ccm.status = 1
                    JOIN location_master lm ON lm.loc_id = mm.loc_id AND lm.status = 1 AND mm.status = 1
                    HAVING not_filled = 0) t")->result_array();
            } else {   
                $result = $this->db->query("select mm.bpno as service_no,cm.name as company_name,ccm.name as costcenter_name,lm.name as location_name,b.sno_id as snoid,max(b.date_of_bill) as date_of_bill,m.bill_upload,m.upload_frq,
                            if(b.date_of_bill IS NOT NULL,
                               if(m.bill_upload = 1,
                                  (CASE
                                   WHEN (b.date_of_bill + INTERVAL m.upload_frq MONTH + INTERVAL 7 DAY) > CURRENT_DATE() THEN 'DUE'
                                   WHEN (b.date_of_bill + INTERVAL m.upload_frq MONTH + INTERVAL 7 DAY) = CURRENT_DATE() THEN 'URGENT'
                                   ELSE 'OVER DUE'
                                   END),'NOT FILLED'),'NOT FILLED') as bill_status
                            from bill b
                            RIGHT JOIN (SELECT if(isnull(sub_meter_id),sno_id,sub_meter_id) as snoid,bill_upload,upload_frq FROM task_assign WHERE user_id=".$this->jwt->decode($this->header['Token'])->user_id." AND  status = 1) m on m.snoid = b.sno_id
                            JOIN meter_master mm on mm.mid = m.snoid AND mm.status = 1
                            JOIN company_master cm on cm.cid = mm.cid AND cm.status = 1
                            JOIN cost_center_master ccm on ccm.costc_id = mm.costc_id AND ccm.status = 1
                            JOIN location_master lm on lm.loc_id = mm.loc_id AND lm.status = 1
                            and b.status = 1
                            GROUP by b.sno_id HAVING bill_status = '".$task_category."'")->result_array();
            }
            if(count($result) > 0){
                $this->response(array(
                    'data'=>$result,
                    'msg' => 'Bill-Upload list on '.$task_category.' category.',
                    'status'=>200),
                    200);
            } else {
                $this->response(array(
                    'msg' => 'No record found.',
                    'status'=>501),
                    200);
            }
            }
            else {
                $result = $this->db->query("select bill_status,count(*) as total from (SELECT b.sno_id,b.bill_id,max(date_of_bill),if(b.date_of_bill IS NOT NULL,
                                        if(m.bill_upload = 1,
                                        (CASE
                                            WHEN (b.date_of_bill + INTERVAL m.upload_frq MONTH + INTERVAL 7 DAY) > CURRENT_DATE() THEN 'DUE'
                                            WHEN (b.date_of_bill + INTERVAL m.upload_frq MONTH + INTERVAL 7 DAY) = CURRENT_DATE() THEN 'URGENT'
                                            ELSE 'OVER DUE'
                                        END),'NOT FILLED'),'NOT FILLED') as bill_status
                                        from bill b
                                        join (SELECT if(isnull(sub_meter_id),sno_id,sub_meter_id) as snoid,bill_upload,upload_frq FROM task_assign WHERE user_id=".$this->jwt->decode($this->header['Token'])->user_id." AND  status = 1) as m on m.snoid = b.sno_id
                                        JOIN meter_master mm on mm.mid = m.snoid AND mm.status = 1
                                        WHERE b.status = 1
                                        GROUP BY b.sno_id) as t
                                        GROUP BY bill_status;")->result_array();
                
                $result_notFilled = $this->db->query("select count(*) as total from (select mm.bpno as service_no,cm.name as company_name,ccm.name as costcenter_name,lm.name as location_name,mm.mid as snoid,(select count(*) from bill WHERE sno_id  = t2.snoid AND status = 1) not_filled from meter_master mm
                    JOIN (SELECT if(isnull(sub_meter_id),sno_id,sub_meter_id) as snoid FROM task_assign WHERE user_id = ".$this->jwt->decode($this->header['Token'])->user_id."  and status = 1) t2 on t2.snoid = mm.mid
                    JOIN company_master cm on cm.cid = mm.cid AND cm.status = 1
                    JOIN cost_center_master ccm on ccm.costc_id = mm.costc_id and ccm.status = 1
                    JOIN location_master lm ON lm.loc_id = mm.loc_id AND lm.status = 1 AND mm.status = 1
                    HAVING not_filled = 0) t;")->result_array();
                
                
                if(count($result) > 0){
                    $final_array = array();
                    
                    foreach($result as $r){
                        $final_array[$r['bill_status']] = (int)$r['total'];
                    }
                    
                    $final_array['not_filled'] = (int)$result_notFilled[0]['total'];
                    
                    
                    
                    if(!isset($final_array['not_filled'])){
                        $final_array['not_filled'] = 0;
                    }
                    if(!isset($final_array['OVER DUE'])){
                        $final_array['over_due'] = 0;
                    } else {
                        $final_array['over_due'] = $final_array['OVER DUE'];
                        unset($final_array['OVER DUE']);
                    }
                    if(!isset($final_array['URGENT'])){
                        $final_array['today'] = 0;
                    } else {
                        $final_array['today'] = $final_array['URGENT'];
                        unset($final_array['URGENT']);
                    }
                    if(!isset($final_array['DUE'])){
                        $final_array['due'] = 0;
                    } else {
                        $final_array['due'] = $final_array['DUE'];
                        unset($final_array['DUE']);
                    }
                    
                    $this->response(array(
                        'data'=>$final_array,
                        'msg' => 'Bill-Upload Task Summary.',
                        'status'=>200),
                        200);
                }
                else {
                    $final_array = array();
                    $final_array['not_filled'] = (int)$result_notFilled[0]['total'];
                    $final_array['over_due'] = 0;
                    $final_array['today'] = 0;
                    $final_array['due'] = 0;
                    $this->response(array(
                        'data' => $final_array,
                        'msg' => 'Bill-Upload Task Summary.',
                        'status'=>200),
                        200);
                }
            }
        }
    }
    
    function index_get(){
        $this->db->select('*');
        $result = $this->db->get_where('users',array('status'=>1))->result_array();
        $this->response($result,200);
    }
    
}
=======
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
>>>>>>> b8649bfae6c73219475d2f68c496ec4191cab5fc
