<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Company_model extends CI_Model {

	function create_company($data){

		$result = $this->db->insert('company_master',$data);
		if($result){
			return true;
		} else {
			return null;
		}
	}

	function update_company($data,$cid){
		$this->db->select('*');
		$result = $this->db->get_where('company_master',array('cid'=>$cid,'status'=>1))->result_array();
		if(count($result)>0){
			$this->db->where('cid',$cid);
			$result = $this->db->update('company_master',$data);
			if($result){
				return true;
			} else {
				return null;
			}
		} else {
			return null;
		}
	}

	function company_list($cid=null){
		$this->db->select('*');
		if(!is_null($cid)){
			$this->db->where('cid',$cid);
		}
		$result = $this->db->get_where('company_master',array('status'=>1))->result_array();
		if(count($result)>0){
			return  $result;
		} else {
			return  null;
		}
	}

	function company_delete($cid){
		$this->db->where('cid',$cid);
		$result = $this->db->update('company_master',array('status'=>0));
		//$result = $this->db->delete('company_master',array('cid'=>$cid));
		if($result){
			return true;
		} else {
			return null;
		}
	}
}
