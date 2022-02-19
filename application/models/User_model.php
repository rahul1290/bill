<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model {

	function create_user($data){

		$result = $this->db->insert('users',$data);
		if($result){
			return true;
		} else {
			return null;
		}
	}

	function update_user($data,$uid){
		$this->db->where('uid',$uid);
		$result = $this->db->update('users',$data);

		if($result){
			return true;
		} else {
			return null;
		}
	}

	function user_list($uid=null){
		$this->db->select('u.uid,u.fname,u.lname,u.email,u.contact_no,u.sex,ut.type_name as role');
		$this->db->join('user_type ut','ut.utype_id = u.utype');
		if(!is_null($uid)){
			$this->db->where('u.uid',$uid);
		}
		$result = $this->db->get_where('users u',array('u.status'=>1))->result_array();
		if(count($result)>0){
			return  $result;
		} else {
			return  null;
		}
	}

	function user_delete($uid){
		$this->db->where('uid',$uid);
		$result = $this->db->update('users',array('status'=>0));

		//$result = $this->db->delete('users',array('uid'=>$uid));
		if($result){
			return true;
		} else {
			return null;
		}
	}
}
