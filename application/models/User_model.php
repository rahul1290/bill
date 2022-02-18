<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model {

	function create_user($data){

		$result = $this->db->insert('users',$data);
		if($result){
			return true;
		}
		return null;
	}
}
