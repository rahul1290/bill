<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Location_model extends CI_Model {

	function create_location($data){

		$result = $this->db->insert('location_master',$data);
		if($result){
			return true;
		} else {
			return null;
		}
	}

	function update_location($data,$lid){
		$this->db->where('loc_id',$lid);
		$result = $this->db->update('location_master',$data);

		if($result){
			return true;
		} else {
			return null;
		}
	}

	function location_list($lid=null){
		$this->db->select('l.*,ccm.name as cost_center,ccm.costc_id');
		$this->db->join('cost_center_master ccm','ccm.costc_id = l.cost_center_id');
		if(!is_null($lid)){
			$this->db->where('l.loc_id',$lid);
		}
		$result = $this->db->get_where('location_master l',array('l.status'=>1))->result_array();
		if(count($result)>0){
			return  $result;
		} else {
			return  null;
		}
	}

	function location_delete($lid){
		$this->db->where('loc_id',$lid);
		$result = $this->db->update('location_master',array('status'=>0));

		//$result = $this->db->delete('users',array('uid'=>$uid));
		if($result){
			return true;
		} else {
			return null;
		}
	}
}
