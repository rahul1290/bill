<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Costcenter_model extends CI_Model {

	function create_costcenter($data){

	    $this->db->select('*');
	    $result = $this->db->get_where('cost_center_master',array('company_id'=>$data['company_id'],'cc_id'=>$data['cc_id'],'status'=>1))->result_array();
	    if(count($result)>0){
	        $result = true;
	    } else {
		  $result = $this->db->insert('cost_center_master',$data);
	    }

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
		$this->db->select('ccm.*,u.fname,u.lname,ut.type_name,cm.name as company_name');
		if(!is_null($cid)){
			$this->db->where('ccm.company_id',$cid);
		}
		$this->db->join('company_master cm','cm.cid = ccm.company_id AND cm.status = 1');
		$this->db->join('users u','u.uid = cm.created_by');
		$this->db->join('user_type ut','ut.utype_id = u.utype');
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

	function getCostcenterByCompnayId($cid){
	    if($this->session->userdata('role') != 'super_admin'){
	        $this->db->select('ccm.*,cm.name as companyname,u.fname,u.lname');
	        $this->db->join('company_master cm','cm.cid = ccm.company_id AND cm.status = 1 AND cm.cid in (select mm.cid from meter_master mm
                        JOIN company_master cm on cm.cid = mm.cid
                        WHERE mid in (SELECT if(ISNULL(sub_meter_id),sno_id,sub_meter_id) as meters FROM `task_assign` WHERE user_id = 2 AND status = 1)
                        GROUP by mm.cid)');
	        $this->db->join('users u','u.uid = cm.created_by',false);
	        if(!is_null($cid)){
	            $this->db->where('ccm.company_id',$cid);
	        }
	        $result = $this->db->get_where('cost_center_master ccm',array('ccm.status'=>1))->result_array();
	        print_r($this->db->last_query()); die;
	    } else {
    		$this->db->select('ccm.*,cm.name as companyname,u.fname,u.lname');
    		$this->db->join('company_master cm','cm.cid = ccm.company_id AND cm.status = 1');
    		$this->db->join('users u','u.uid = cm.created_by');
    		if(!is_null($cid)){
    		    $this->db->where('ccm.company_id',$cid);
    		}
    		$result = $this->db->get_where('cost_center_master ccm',array('ccm.status'=>1))->result_array();
	    }
		return $result;
	}
}
