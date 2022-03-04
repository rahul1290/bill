<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Meter_model extends CI_Model {

	function create_meter($data){

		$result = $this->db->insert('meter_master',$data);
		if($result){
			return true;
		} else {
			return null;
		}
	}

	function update_meter($data,$mid){
		$this->db->where('mid',$mid);
		$result = $this->db->update('meter_master',$data);

		if($result){
			return true;
		} else {
			return null;
		}
	}

	function getMeterByLocationId($lid){
		$this->db->select('*');
		return $result = $this->db->get_where('meter_master',array('loc_id'=>$lid,'parent_meter'=>null,'status'=>1))->result_array();
	}

	function getSubMeters($mid){
		$this->db->select('*');
		return $result = $this->db->get_where('meter_master',array('parent_meter'=>$mid,'status'=>1))->result_array();
	}

	function meter_list($mid=null){
		$this->db->select('m.*,ccm.name as cost_center,ccm.costc_id,cm.cid,cm.name as company_name,u.uid,u.fname,u.lname,lm.loc_id,lm.name as location_name');
		$this->db->join('cost_center_master ccm','ccm.costc_id = m.costc_id AND ccm.status = 1');
		if(!is_null($mid)){
			$this->db->where('m.mid',$mid);
		}
		$this->db->join('company_master cm','cm.cid = m.cid AND cm.status = 1');
		$this->db->join('location_master lm','lm.loc_id = m.loc_id AND lm.status = 1');
		$this->db->join('users u','u.uid = m.created_by');
		$result = $this->db->get_where('meter_master m',array('m.status'=>1))->result_array();
		
		if(count($result)>0){
			return  $result;
		} else {
			return  null;
		}
	}
	
	
	function meterlistUserWise($uid=null){
	    $result = array();
	    if(is_null($uid)){
	        $result = $this->db->query("SELECT * from meter_master m
                            join (SELECT  IFNULL(sub_meter_id,sno_id) as mno FROM `task_assign` WHERE status = 1) m2 on m2.mno = m.mid where m.status = 1")->result_array();
	    } else {
	       $result = $this->db->query("SELECT * from meter_master m
                            join (SELECT  IFNULL(sub_meter_id,sno_id) as mno FROM `task_assign` WHERE user_id = $uid and status = 1) m2 on m2.mno = m.mid where m.status = 1")->result_array();
	    }
	    
	    if(count($result)>0){
	        return  $result;
	    } else {
	        return  null;
	    }
	}

	function show_meter_readings($uid=null){

		// $this->db->select('mr.*,u.fname,u.lname,mm.bpno,ta.upload_frq,ta.bill_upload');
		// $this->db->join('users u','u.uid = mr.user_id');
		// if(!is_null($uid)){
		// 	$this->db->where('mr.user_id',$uid);
		// }
		// $this->db->join("(SELECT task_id,if(isnull(sub_meter_id),sno_id,sub_meter_id) as bpno,upload_frq,bill_upload FROM task_assign) as ta",'ta.bpno = mr.bpno');
		// $this->db->join('meter_master mm','mm.mid = mr.bpno AND mm.status = 1');
		// $result = $this->db->get_where('meter_reading mr',array('mr.status'=>1))->result_array();
		if(!is_null($uid)){
			$result = $this->db->query("select t2.meter_id,mm.mtype,mm2.bpno as parent_meter,mm.bpno,ccm.name as cost_center,lm.name as location_name,t2.reading_frq,t1.reading_date,t1.reading_value,MAX(t1.reading_date) as last_reading_date from meter_reading as t1
			right join (select if(isnull(sub_meter_id),sno_id,sub_meter_id) as meter_id,reading_frq
			from task_assign WHERE user_id = $uid and meter_reading = 1 AND status = 1) as t2 on t2.meter_id = t1.bpno
			JOIN meter_master mm on mm.mid = t2.meter_id AND mm.status = 1
			left JOIN meter_master mm2 on mm2.mid = mm.parent_meter AND mm2.status = 1
			JOIN cost_center_master ccm on ccm.costc_id = mm.costc_id AND ccm.status = 1
			JOIN location_master lm on lm.loc_id = mm.loc_id AND lm.status = 1
			GROUP by t2.meter_id")->result_array();
		}

		return $result;
	}

	function meter_delete($mid){
		$this->db->where('mid',$mid);
		$result = $this->db->update('meter_master',array('status'=>0));

		//$result = $this->db->delete('users',array('uid'=>$uid));
		if($result){
			return true;
		} else {
			return null;
		}
	}
	
	function bill_entry($data){
	    $result = $this->db->insert('bill',$data);
	    if($result){
	     return $result;   
	    } else{
	        return null;
	    }
	}

	function meter_reading($data){
		$this->db->select('*');
		$records = $this->db->get_where('meter_reading',array('bpno'=>$data['bpno'],'reading_date'=>$data['reading_date'],'status'=>1))->result_array();

		if(count($records)>0){
			$this->db->where('mr_id',$records[0]['mr_id']);
			$result = $this->db->update('meter_reading',array(
				'bpno' => $data['bpno'],
				'user_id' => $data['user_id'],
				'reading_value' => $data['reading_value'],
				'created_at' => date('Y-m-d'),
				'created_by' => $this->session->userdata('user_id')
			));
		} else {
			$result = $this->db->insert('meter_reading',$data);
		}
	    if($result){
	     return true;   
	    } else{
	        return false;
	    }
	}
}
