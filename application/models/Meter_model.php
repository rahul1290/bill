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
		$result = $this->db->update('location_master',$data);

		if($result){
			return true;
		} else {
			return null;
		}
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
}
