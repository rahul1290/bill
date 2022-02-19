<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Costcenter_model extends CI_Model {

	function create_costcenter($data){

		$result = $this->db->insert('cost_center_master',$data);

		if($result){
			return true;
		} else {
			return null;
		}
	}

	function update_costcenter($data,$cid){
		$this->db->where('costc_id',$cid);
		$result = $this->db->update('cost_center_master',$data);

		if($result){
			return true;
		} else {
			return null;
		}
	}

	function costcenter_list($cid=null){
		$this->db->select('ccm.*,cm.name as company_name');
		if(!is_null($cid)){
			$this->db->where('ccm.costc_id',$cid);
		}
		$this->db->join('company_master cm','cm.cid = ccm.company_id');
		$result = $this->db->get_where('cost_center_master ccm',array('ccm.status'=>1))->result_array();
		if(count($result)>0){
			return  $result;
		} else {
			return  null;
		}
	}

	function costcenter_delete($cid){
		$this->db->where('costc_id',$cid);
		$result = $this->db->update('cost_center_master',array('status'=>0));

		if($result){
			return true;
		} else {
			return null;
		}
	}
}
