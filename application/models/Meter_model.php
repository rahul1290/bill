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
		$result = $this->db->get_where('meter_master',array('loc_id'=>$lid,'parent_meter'=>null,'status'=>1))->result_array();
		return $result;
	}

	function getSubMeters($mid){
		$this->db->select('*');
		$result = $this->db->get_where('meter_master',array('parent_meter'=>$mid,'status'=>1))->result_array();
		return $result;
	}

	function meter_list($mid=null){
	    $uid = $this->session->userdata('user_id');
	    if($this->session->userdata('role') != 'super_admin' || $this->session->userdata('role') != 'admin'){
	        $this->db->select('ta.reading_frq,max(mr.reading_date) as last_reading_date');
	    }
		$this->db->select('m.*,ccm.name as cost_center,ccm.costc_id,cm.cid,cm.name as company_name,u.uid,u.fname,u.lname,lm.loc_id,lm.name as location_name');
		$this->db->join('cost_center_master ccm','ccm.costc_id = m.costc_id AND ccm.status = 1');
		if(!is_null($mid)){
			$this->db->where('m.mid',$mid);
		}
		$this->db->join('company_master cm','cm.cid = m.cid AND cm.status = 1');
		$this->db->join('location_master lm','lm.loc_id = m.loc_id AND lm.status = 1');
		$this->db->join('users u','u.uid = m.created_by');
		if($this->session->userdata('role') != 'super_admin' || $this->session->userdata('role') != 'admin'){
		  $this->db->join('task_assign ta',"ta.user_id = $uid AND ta.meter_reading = 1 AND (ta.sno_id = m.mid OR ta.sub_meter_id = m.mid)",'left');
		  $this->db->join('meter_reading mr','mr.bpno = m.mid','left');
		  $this->db->order_by('m.mid','DESC');
		  $this->db->group_by('m.bpno');
		}
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
		if(!is_null($uid)){
			$result = $this->db->query("select t2.meter_id,mm.mtype,mm2.bpno as parent_meter,mm.bpno,ccm.name as cost_center,lm.name as location_name,t2.reading_frq,t1.reading_date,t1.reading_value,MAX(t1.reading_date) as last_reading_date from meter_reading as t1
			right join (select if(isnull(sub_meter_id),sno_id,sub_meter_id) as meter_id,reading_frq
			from task_assign WHERE user_id = $uid and meter_reading = 1 AND status = 1) as t2 on t2.meter_id = t1.bpno
			JOIN meter_master mm on mm.mid = t2.meter_id AND mm.status = 1
			left JOIN meter_master mm2 on mm2.mid = mm.parent_meter AND mm2.status = 1
			JOIN cost_center_master ccm on ccm.costc_id = mm.costc_id AND ccm.status = 1
			JOIN location_master lm on lm.loc_id = mm.loc_id AND lm.status = 1
			GROUP by t2.meter_id")->result_array();
		} else {
			$readings = $this->db->query("select t1.*,mm.mtype,mm.parent_meter,mm.bpno,ccm.name as cost_center,lm.name as location_name,u.fname,u.lname,t1.reading_date as last_reading_date
				from (select mr.* from meter_reading mr,
						(select bpno,max(reading_date) as last_reading_date
								from meter_reading
								group by bpno) max_sales
				where mr.bpno=max_sales.bpno
				and mr.reading_date=max_sales.last_reading_date) as t1
				JOIN meter_master mm on mm.mid = t1.bpno AND mm.status = 1
				JOIN cost_center_master ccm on ccm.costc_id = mm.costc_id AND ccm.status = 1
				JOIN location_master lm on lm.loc_id = mm.loc_id AND lm.status = 1
				JOIN users u on u.uid = t1.created_by")->result_array();
			
			$this->db->select('mm.mid,mm.bpno,mm.mtype,mm2.bpno as parent_meter,ccm.name as cost_center,lm.name as location_name');
			$this->db->join('cost_center_master ccm','ccm.costc_id = mm.costc_id AND ccm.status = 1');
			$this->db->join('location_master lm','lm.loc_id = mm.loc_id AND lm.status = 1');
			$this->db->join('meter_master mm2','mm2.mid = mm.parent_meter','left');
			$meters = $this->db->get_where('meter_master mm',array('mm.status'=>1))->result_array();

			
			//print_r($meters); die;
			$finalarray = array();
			foreach($meters as $meter){
				$temp = array();
				$flag = 1;
				foreach($readings as $reading){
					if($meter['bpno'] == $reading['bpno']){
						$temp = $reading;
						$flag = 0;
						break;
					}
				}

				if($flag){
				 	$temp['mr_id'] = $meter['mid'];
					$temp['cost_center'] = $meter['cost_center'];
					$temp['location_name'] = $meter['location_name'];
					$temp['parent_meter'] = $meter['parent_meter'];
					$temp['bpno'] = $meter['bpno'];
					$temp['mtype'] = $meter['mtype'];
					$temp['last_reading_date'] = '';
				}
				$finalarray[] = $temp;
			}	
			$result = $finalarray; 
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
