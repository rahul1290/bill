<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meter_ctrl extends CI_Controller {

	function __construct() {
    parent::__construct();
    $this->load->library('upload');
		$this->load->database();
		$this->load->model(array('Costcenter_model','Company_model','Location_model','Meter_model')); 
  }

	function getMeterById(){
		$lid = $this->input->post('lid');
		$result = $this->Meter_model->meter_list($lid);
		
		if(count($result)>0){
		    echo json_encode(array('data'=>$result[0],'status'=>200));
		} else {
			echo json_encode(array('msg'=>'No record found.','status'=>500));
		}
	}

	function getMeters($mid=null){
		$result = $this->Meter_model->meter_list($mid);
		$payment_detail = array();
		
		if(!is_null($result) && count($result)>0){
    		$last_bill_entry =  $this->db->query("select * FROM bill
                                WHERE date_of_bill = (select max(date_of_bill) from bill 
                                WHERE sno_id = ".$result[0]['mid']." AND status = 1)
                                AND sno_id = ".$result[0]['mid']."
                                AND status = 1")->result_array();
    		
    		if(count($last_bill_entry) > 0) {
        		$this->db->select('*');
        		$payment_detail = $this->db->get_where('bill',array('bill_id'=>$last_bill_entry[0]['bill_id']))->result_array();
        		
        		
        		
        		$payment_detail[0]['from_date'] = date('Y-m-d', strtotime('+1 day', strtotime($payment_detail[0]['to_date'])));
        		$no_of_days = date('t',strtotime($payment_detail[0]['from_date']));
        		
        		$payment_detail[0]['to_date'] = date('Y-m-d', strtotime('-1 day',strtotime('+'.$no_of_days.' day', strtotime($payment_detail[0]['from_date']))));
    		}
		}
		
		if(!is_null($result) && count($result)>0){
		    echo json_encode(array('data'=>$result,'last_bill_entry'=>$last_bill_entry,'payment_detail'=>$payment_detail,'status'=>200));
		} else {
			echo json_encode(array('msg'=>'No record found.','status'=>500));
		}
	}

	function getMeterByLocationId($lid){
		$result = $this->Meter_model->getMeterByLocationId($lid);
		
		if(!is_null($result) && count($result)>0){
			echo json_encode(array('data'=>$result,'status'=>200));
		} else {
			echo json_encode(array('msg'=>'No record found.','status'=>500));
		}
	}

	function getSubMeters($mid){
		$result = $this->Meter_model->getSubMeters($mid);
		
		if(!is_null($result) && count($result)>0){
			echo json_encode(array('data'=>$result,'status'=>200));
		} else {
			echo json_encode(array('msg'=>'No record found.','status'=>500));
		}
	}

  function index(){
	  	$data['meters'] = $this->Meter_model->meter_list();
	  	$data['locations'] = $this->Location_model->location_list();
		$data['costceners'] = $this->Costcenter_model->costcenter_list();
		$data['companies'] = $this->Company_model->Company_list();
		
		if ($this->input->server('REQUEST_METHOD') === 'GET') {
			$data['main_content'] = $this->load->view('master/meter',$data,true);
	  		$this->load->view('admin_layout',$data);
		} else {
			$this->form_validation->set_rules('bpno', 'BP no.', 'required|trim');
			$this->form_validation->set_rules('mtype', 'Meter type', 'required|trim');
			if($this->input->post('mtype') == 'sub-meter'){
			    $this->form_validation->set_rules('main_meter', 'Main Meter', 'required|trim');
			} else if($this->input->post('mtype') == 'main-meter'){
// 			    $this->form_validation->set_rules('connection_type', 'Connection Type', 'required|trim');
// 			    $this->form_validation->set_rules('connection_from_date', 'Connection from date', 'required|trim');
// 			    $this->form_validation->set_rules('connection_to_date', 'Connection to date', 'required|trim');
			}
			$this->form_validation->set_rules('cid', 'Company', 'required|trim');
			$this->form_validation->set_rules('costc_id', 'Cost-center', 'required|trim');
			$this->form_validation->set_rules('loc_id', 'Location', 'required|trim');
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if ($this->form_validation->run()){
				$mid = $this->input->post('mid');
				$db_data['parent_meter'] = $this->input->post('main_meter') == '' ? null : $this->input->post('main_meter');
				$db_data['bpno'] = $this->input->post('bpno');
				$db_data['mtype'] = $this->input->post('mtype');
				$db_data['cid'] = $this->input->post('cid');
				$db_data['costc_id'] = $this->input->post('costc_id');
				$db_data['loc_id'] = $this->input->post('loc_id');
				$db_data['created_by'] = $this->session->userdata('user_id');
				$db_data['created_at'] = date('Y-m-d');
				$db_data['connection_type'] = $this->input->post('connection_type');
				$db_data['connection_from_date'] = $this->input->post('connection_from_date');
				$db_data['connection_to_date'] = $this->input->post('connection_to_date');
				if($mid == ''){
					$result = $this->Meter_model->create_meter($db_data);
				} else {
					$result = $this->Meter_model->update_meter($db_data,$mid);
				}
				if($result){
					$data['companies'] = $this->Meter_model->meter_list();
					if($mid == ''){
						$this->session->set_flashdata('msg','Meter created successfully.');
					} else {
						$this->session->set_flashdata('msg','Meter updated successfully.');
					}
					redirect(current_url());
				} else{
					$this->session->set_flashdata('msg','Something went wrong.');

					$data['main_content'] = $this->load->view('master/meter',$data,true);
	  				$this->load->view('admin_layout',$data);
				}
			} else {
				$data['main_content'] = $this->load->view('master/meter',$data,true);
	  			$this->load->view('admin_layout',$data);
			}
		}
  }

  function delete_meter(){
	  $mid = $this->input->post('mid');
	  $result = $this->Meter_model->meter_delete($mid);
	  
	  if($result){
		  echo json_encode(array('msg'=>'Meter deleted successfully.','status'=>200));
	  } else {
		echo json_encode(array('msg'=>'Something went wrong.','status'=>500));
	  }
  }
  
  
  function bill_upload($sno_id=null){
      if(!is_null($sno_id)){
           $data['selected_service_no'] = $sno_id;        
      }
      if($this->session->userdata('role') == 'super_admin'){
          $data['service_no'] = $this->Meter_model->meterlistUserWise();
      } else {
          $data['service_no'] = $this->Meter_model->meterlistUserWise($this->session->userdata('user_id'));
      }
      
      
      $data['companies'] = $this->Company_model->get_my_companies();
      
      if ($this->input->server('REQUEST_METHOD') === 'GET') {
          $data['main_content'] = $this->load->view('bill-upload',$data,true);
          $this->load->view('admin_layout',$data);
      } else {
          $this->form_validation->set_rules('serviceno', 'Service No', 'required|trim');
          $this->form_validation->set_rules('billing_period_from', 'Billing Period From', 'required|trim');
          $this->form_validation->set_rules('billing_period_to', 'Billing Period To', 'required|trim');
          $this->form_validation->set_rules('bill_no', 'Bill No', 'required|trim');
          $this->form_validation->set_rules('bill_date', 'Bill Date', 'required|trim');
          $this->form_validation->set_rules('due_date', 'Due Date', 'required|trim');
          $this->form_validation->set_rules('current_reading', 'Current Reading', 'required|trim');
          $this->form_validation->set_rules('current_reading_date', 'Current Reading Date', 'required|trim');
          $this->form_validation->set_rules('previous_reading', 'Previous Reading', 'required|trim');
          $this->form_validation->set_rules('previous_reading_date', 'Previous Reading Date', 'required|trim');
          
          $this->form_validation->set_rules('total_consumption', 'Total Consumption', 'required|trim');
          $this->form_validation->set_rules('highest_demand_rating', 'Highest Demand Rating', 'trim');
          $this->form_validation->set_rules('sum', 'Sum', 'required|trim');
          $this->form_validation->set_rules('cess', 'cess', 'trim');
          $this->form_validation->set_rules('concession_amount', 'Concession Amount', 'trim');
          $this->form_validation->set_rules('vca', 'VCA', 'trim');
          $this->form_validation->set_rules('past_due', 'Past Due', 'required|trim');
          $this->form_validation->set_rules('payable_amount', 'Payable Amount', 'required|trim');
          $this->form_validation->set_rules('surcharge', 'surcharge', 'required|trim');
          $this->form_validation->set_rules('total_bill', 'Total Bill', 'required|trim');
          
          
          $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
          if ($this->form_validation->run()){
            $config = array(
              'upload_path' => APPPATH."../upload/bills/",
              'allowed_types' => "gif|jpg|png|jpeg|PDF|pdf",
              'encrypt_name' => TRUE,
              // 'overwrite' => TRUE,
              // 'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
              // 'max_height' => "768",
              // 'max_width' => "1024"
            );
            $this->upload->initialize($config);
            $this->load->library('upload', $config);
            if($this->upload->do_upload('userfile')){
              $fdata = array('upload_data' => $this->upload->data());
              $db_data['image'] = $fdata['upload_data']['file_name'];
            }

              $db_data['sno_id'] = $this->input->post('serviceno');
              $db_data['from_date'] = $this->input->post('billing_period_from');
              $db_data['to_date'] = $this->input->post('billing_period_to');
              $db_data['bill_no'] = $this->input->post('bill_no');
              $db_data['date_of_bill'] = $this->input->post('bill_date');
              $db_data['due_date'] = $this->input->post('due_date');
              $db_data['reading'] = $this->input->post('current_reading');
              $db_data['reading_date'] = $this->input->post('current_reading_date');
              
              $db_data['previous_reading'] = $this->input->post('previous_reading');
              $db_data['previous_reading_date'] = $this->input->post('previous_reading_date');
              
              $db_data['power_consumption'] = $this->input->post('power_consumption');
              $db_data['power_factor'] =   $this->input->post('power_factor');
              $db_data['total_consumption'] = $this->input->post('total_consumption');
              $db_data['highest_demand_reading'] = $this->input->post('highest_demand_rating');
              $db_data['je_ae_name'] = $this->input->post('je_ae_name');
              $db_data['je_ae_contact_no'] = $this->input->post('je_ae_contact');
              $db_data['ae_ee_name'] = $this->input->post('ae_ee_name');
              $db_data['ae_ee_contact_no'] = $this->input->post('ae_ee_contact');
              $db_data['fixed_demand_charges'] = $this->input->post('fix_demand');
              $db_data['minimum_charges'] = $this->input->post('minimum_charge');
              $db_data['energy_charges'] = $this->input->post('energy_charges');
              $db_data['total_charges'] = $this->input->post('sum');
              $db_data['electricity_duty'] = $this->input->post('electricity_duty');
              $db_data['cess'] = $this->input->post('cess');
              $db_data['welding_capacitor_overload'] = $this->input->post('capacitor_overload');
              $db_data['meter_fare'] = $this->input->post('meter_fare');
              $db_data['vca_charge'] = $this->input->post('vca');
              $db_data['security_deposit'] = $this->input->post('security_deposit');
              $db_data['concession_amount'] = $this->input->post('concession_amount');
              $db_data['total_bill'] = $this->input->post('total_bill');
              $db_data['deviation_adjustment'] = $this->input->post('deviation');
              $db_data['past_dues'] = $this->input->post('past_due');
              $db_data['security_fund_outstanding'] = $this->input->post('security_fund_outstanding');
              $db_data['payable_amount'] =$this->input->post('payable_amount');
              $db_data['extra'] = $this->input->post('extra');
              $db_data['gross_amount'] = $this->input->post('surcharge');
              $db_data['overload'] = $this->input->post('overload');
              $db_data['created_at'] = date('Y-m-d');
              $db_data['created_by'] = $this->session->userdata('user_id');
              
              if(is_null($this->input->post('selected_service_no')) || $this->input->post('selected_service_no') == ''){
                  
                $result = $this->Meter_model->bill_entry($db_data);
                
              
                if(!is_null($result)){
                  $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">
                        Bill entry successfully.
                      </div>');
                  redirect('/bill-list');
                  } else {
                      $this->session->set_flashdata('msg','<div class="alert alert-warning" role="alert">
                            something went wrong.
                          </div>');
                      redirect(current_url());
                  }
              } else {
                  $result = $this->Meter_model->bill_entry($db_data,$this->input->post('selected_service_no'));
                  if(!is_null($result)){
                      $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">
                        Bill updated successfully.
                      </div>');
                      redirect('/bill-list');
                  } else {
                      $this->session->set_flashdata('msg','<div class="alert alert-warning" role="alert">
                            something went wrong.
                          </div>');
                      redirect(current_url());
                  }
              }
              
          } else {
              $data['main_content'] = $this->load->view('bill-upload',$data,true);
              $this->load->view('admin_layout',$data);
          }
      }
  }
  
  
  function bill_list($companyId=null,$costCenterId=null,$location=null){
      $data['companies'] = $this->Company_model->get_my_companies();
      $data['cost_centers'] = $this->Costcenter_model->costcenter_list($companyId);
      $data['locations'] = $this->Location_model->getLocationByCostcenterId($costCenterId);
      $status = $this->input->get('status');
      
      if($this->session->userdata('role') == 'super_admin'){
          $query = "select t3.*,t1.mid,t1.bpno,t2.bill_id,t2.date_of_bill,b1.*,cm.name as companyName,ccm.name as costcenterName,lm.name as locationName from meter_master as t1
                    join (SELECT b.bill_id,b.date_of_bill as date_of_bill,mm.mid from meter_master mm
                    LEFT JOIN bill b on b.sno_id = mm.mid) as t2
                    LEFT JOIN bill b1 on b1.bill_id = t2.bill_id
                    JOIN company_master cm on cm.cid = t1.cid
                    JOIN cost_center_master ccm on ccm.costc_id = t1.costc_id
                    JOIN location_master lm on lm.loc_id = t1.loc_id
                    LEFT JOIN (SELECT *,if(isnull(sub_meter_id),sno_id,sub_meter_id) as snoid FROM task_assign
                    WHERE 1=1 and status = 1) t3 on t3.snoid = t1.mid
                    WHERE t1.mid = t2.mid";
          if(!is_null($companyId)){
              $query .= " AND cm.cid=".$companyId;
          }
          if(!is_null($costCenterId)){
              $query .= " AND ccm.costc_id=".$costCenterId;
          }
          if(!is_null($location)){
              $query .= " AND lm.loc_id=".$location;
          }
          $query .= " order by t2.date_of_bill desc";
          
          $bills =  $this->db->query($query)->result_array();
      } else{ 
          $query = "SELECT t3.*,ta.meter_reading,ta.reading_frq,ta.bill_upload,ta.upload_frq
                    FROM task_assign ta
                    join (select t1.mid,t1.bpno,b1.*,cm.cid,ccm.costc_id,lm.loc_id,cm.name as companyName,ccm.name as costcenterName,lm.name as locationName from meter_master as t1
                    join (SELECT b.bill_id,b.date_of_bill as date_of_bill,mm.mid from meter_master mm
                    LEFT JOIN bill b on b.sno_id = mm.mid) as t2
                    LEFT JOIN bill b1 on b1.bill_id = t2.bill_id
                    JOIN company_master cm on cm.cid = t1.cid
                    JOIN cost_center_master ccm on ccm.costc_id = t1.costc_id
                    JOIN location_master lm on lm.loc_id = t1.loc_id
                    WHERE t1.mid = t2.mid) as t3 on t3.mid = if(isnull(ta.sub_meter_id),ta.sno_id,ta.sub_meter_id)
                    WHERE ta.user_id = ".$this->session->userdata('user_id')." and ta.status = 1";
          if(!is_null($companyId)){
              $query .= " AND t3.cid=".$companyId;
          }
          if(!is_null($costCenterId)){
              $query .= " AND t3.costc_id=".$costCenterId;
          }
          if(!is_null($location)){
              $query .= " AND t3.loc_id=".$location;
          }
          
          $query .= " ORDER by t3.date_of_bill DESC";
          $bills = $this->db->query($query)->result_array();
      }
      
      $final_array = array();
      
      foreach($bills as $bill){
          $temp = array();
          $temp = $bill;
          
          if($bill['date_of_bill'] != ''){
              $temp['next_ittration'] = date('Y-m-d', strtotime($bill['date_of_bill'].'+'.$bill['upload_frq'].' month'));
              
              $date1 = date('Y-m-d', strtotime('+7 days',strtotime($bill['date_of_bill'].'+'.$bill['upload_frq'].' month')));
              $date2 = date('Y-m-d');
              
              $date1=date_create($date1);
              $date2=date_create($date2);
              $diff=date_diff($date2,$date1);
              if($diff->format("%R") == '+'){
                  if($diff->format("%a")){
                      $temp['status'] = $diff->format("%a").' Days left';
                  } else {
                      $temp['status'] = 'Today';
                  }
              } else {
                  $temp['status'] = 'Date passed';
              }
          } else {
              $temp['status'] = 'Not Filled';
          }
          $final_array[] = $temp;
      }
      
      $data['bills'] = $final_array;
      
      if(isset($status) && $status != ''){
          $final_array = array();
          foreach($data['bills'] as $bill){
              if($status == 'date_passed' && $bill['status'] =='Date passed'){
                  $final_array[] = $bill;
              }
              else if($status == 'today' && $bill['status'] =='Today'){
                  $final_array[] = $bill;
              }
              else if($status == 'not_filled' && $bill['status'] =='Not Filled'){
                  $final_array[] = $bill;
              } else if($bill['status'] =='date_remaining'){
                  $final_array[] = $bill;
              }
          }
          $data['bills'] = $final_array;
      }
      
      $data['main_content'] = $this->load->view('bill-list',$data,true);
      $this->load->view('admin_layout',$data);
  }
  
  function bill_pending(){
      $uid = $this->session->userdata('user_id');
      if($this->session->userdata('role') == 'super_admin' || $this->session->userdata('role') == 'admin'){
          $data['service_no'] = $this->Meter_model->meterlistUserWise();
          $data['companies'] = $this->db->query("select * from company_master where status = 1")->result_array();
          $data['readings'] = $this->Meter_model->show_meter_readings();
      }  else {
          $data['service_no'] = $this->Meter_model->meterlistUserWise($this->session->userdata('user_id'));
          $data['companies'] = $this->db->query("select * from company_master where cid in (
          select cid from meter_master
          WHERE mid in(SELECT if(isnull(sub_meter_id),sno_id,sub_meter_id) as meter FROM task_assign WHERE user_id = $uid)
          GROUP by cid)")->result_array();
          $data['readings'] = $this->Meter_model->show_meter_readings($this->session->userdata('user_id'));
          
          $finalarray = array();
          foreach($data['readings'] as $reading){
              if($reading['last_reading_date'] != ''){
                  if(date('Y-m-d') >= date('Y-m-d', strtotime($reading['last_reading_date']. ' + '.$reading['reading_frq'].' days'))){
                      $finalarray[] = $reading;
                  }
              } else {
                  $finalarray[] = $reading;
              }
          }
          $data['readings'] = $finalarray;
      }
      if ($this->input->server('REQUEST_METHOD') === 'GET') {
          $data['main_content'] = $this->load->view('meter-reading',$data,true);
          $this->load->view('admin_layout',$data);
      } else {
          $this->form_validation->set_rules('serviceno', 'Service No', 'required|trim');
          $this->form_validation->set_rules('company', 'Company', 'required|trim');
          $this->form_validation->set_rules('costcenter', 'Cost-Center', 'required|trim');
          $this->form_validation->set_rules('location', 'location', 'required|trim');
          $this->form_validation->set_rules('reading_date', 'Reading Date', 'required|trim');
          $this->form_validation->set_rules('reading_value', 'Reading Value', 'required|trim');
          
          $config = array(
              'upload_path' => APPPATH."../upload/",
              'allowed_types' => "gif|jpg|png|jpeg|pdf",
              'encrypt_name' => TRUE,
              // 'overwrite' => TRUE,
              // 'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
              // 'max_height' => "768",
              // 'max_width' => "1024"
          );
          $this->upload->initialize($config);
          $this->load->library('upload', $config);
          if($this->upload->do_upload('userfile')){
              $fdata = array('upload_data' => $this->upload->data());
              $db_data['image'] = $fdata['upload_data']['file_name'];
          }
          
          $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
          if ($this->form_validation->run()){
              $db_data['bpno'] = $this->input->post('serviceno');
              $db_data['user_id'] = $this->session->userdata('user_id');
              $db_data['reading_date'] = date('Y-m-d', strtotime(str_replace('/','-',$this->input->post('reading_date'))));
              $db_data['reading_value'] = $this->input->post('reading_value');
              $db_data['created_at'] = date('Y-m-d');
              $db_data['created_by'] = $this->session->userdata('user_id');
              if($this->Meter_model->meter_reading($db_data)){
                  $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">
                Meter reading submitted.
              </div>');
                  redirect(current_url());
              }
          } else {
              $data['main_content'] = $this->load->view('meter-reading',$data,true);
              $this->load->view('admin_layout',$data);
          }
      }
  }
  
  function meter_reading(){
      $uid = $this->session->userdata('user_id');
      if($this->session->userdata('role') == 'super_admin' || $this->session->userdata('role') == 'admin'){
        $data['service_no'] = $this->Meter_model->meterlistUserWise();
        $data['companies'] = $this->db->query("select * from company_master where status = 1")->result_array();
        $data['readings'] = $this->Meter_model->show_meter_readings();
      }  else { 
        $data['service_no'] = $this->Meter_model->meterlistUserWise($this->session->userdata('user_id'));
        $data['companies'] = $this->db->query("select * from company_master where cid in (
          select cid from meter_master 
          WHERE mid in(SELECT if(isnull(sub_meter_id),sno_id,sub_meter_id) as meter FROM task_assign WHERE user_id = $uid)
          GROUP by cid)")->result_array();
        $data['readings'] = $this->Meter_model->show_meter_readings($this->session->userdata('user_id'));
        
        $finalarray = array();
        foreach($data['readings'] as $reading){
            if($reading['last_reading_date'] != ''){
                if(date('Y-m-d') >= date('Y-m-d', strtotime($reading['last_reading_date']. ' + '.$reading['reading_frq'].' days'))){
                   $finalarray[] = $reading;
                }
            } else {
                $finalarray[] = $reading;
            }
        }
        $data['readings'] = $finalarray;
      }
      if ($this->input->server('REQUEST_METHOD') === 'GET') {
          $data['main_content'] = $this->load->view('meter-reading',$data,true);
          $this->load->view('admin_layout',$data);
      } else {
          $this->form_validation->set_rules('serviceno', 'Service No', 'required|trim');
          $this->form_validation->set_rules('company', 'Company', 'required|trim');
          $this->form_validation->set_rules('costcenter', 'Cost-Center', 'required|trim');
          $this->form_validation->set_rules('location', 'location', 'required|trim');
          $this->form_validation->set_rules('reading_date', 'Reading Date', 'required|trim');
          $this->form_validation->set_rules('reading_value', 'Reading Value', 'required|trim');

          $config = array(
            'upload_path' => APPPATH."../upload/",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'encrypt_name' => TRUE,
            // 'overwrite' => TRUE,
            // 'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            // 'max_height' => "768",
            // 'max_width' => "1024"
          );
          $this->upload->initialize($config);
          $this->load->library('upload', $config);
          if($this->upload->do_upload('userfile')){
            $fdata = array('upload_data' => $this->upload->data());
            $db_data['image'] = $fdata['upload_data']['file_name'];
          }
          
          $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
          if ($this->form_validation->run()){
              $db_data['bpno'] = $this->input->post('serviceno');
              $db_data['user_id'] = $this->session->userdata('user_id');
              $db_data['reading_date'] = date('Y-m-d', strtotime(str_replace('/','-',$this->input->post('reading_date'))));
              $db_data['reading_value'] = $this->input->post('reading_value');
              $db_data['created_at'] = date('Y-m-d');
              $db_data['created_by'] = $this->session->userdata('user_id');
              if($this->Meter_model->meter_reading($db_data)){
                $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">
                Meter reading submitted.
              </div>');
                redirect(current_url());
              }
          } else {
              $data['main_content'] = $this->load->view('meter-reading',$data,true);
              $this->load->view('admin_layout',$data);
          }
      }
  }
  
  
  function getbill_detail($bill_no){
      $this->db->select('b.*,mm.mid,ccm.costc_id,ccm.name as cost_center,lm.loc_id,lm.name as location_name,cm.cid,cm.name as company_name');
      $this->db->join('meter_master mm','mm.mid = b.sno_id');
      $this->db->join('cost_center_master ccm','ccm.costc_id = mm.costc_id');
      $this->db->join('location_master lm','lm.loc_id = mm.loc_id');
      $this->db->join('company_master cm','cm.cid = mm.cid');
      $result = $this->db->get_where('bill b',array('b.bill_id'=>$bill_no,'b.status'=>1))->result_array();
      echo json_encode(array('data'=>$result[0],'status'=>200));
  }

  function show_meter_readings(){
      $user_id = $this->session->userdata('user_id');
      if($this->session->userdata('role') == 'super_admin' || $this->session->userdata('role') == 'admin'){
        $data['readings'] = $this->Meter_model->show_meter_readings();
      } else {
        $data['readings'] = $this->Meter_model->show_meter_readings($user_id);
      }
      print_r($this->db->last_query()); die;
      $data['main_content'] = $this->load->view('meter-reading-show',$data,true);
      $this->load->view('admin_layout',$data);
  }
  
  
  function remove_Meter_bill($bill_no){
      $this->db->where('bill_id',$bill_no);
      $this->db->update('bill',array('image'=>Null));
      echo json_encode(array('status'=>200));
  }
  
  
  function get_bill_nos($mid){
      $query = "SELECT bill_id,bill_no FROM bill
          JOIN meter_master mm on mm.mid = ".$mid."
          WHERE payment_amount is NULL order by bill_no asc";
      
      $result = $this->db->query($query)->result_array();
      
      if(count($result)>0){
          echo json_encode(array('data'=>$result,'status'=>200));
      } else {
          echo json_encode(array('status'=>500));
      }
  }
  
  function get_my_meters($com_id,$costc_id,$loc_id){
      if($this->session->userdata('role') != 'super_admin'){
      $query = "select * from meter_master where mid in (SELECT if(ISNULL(sub_meter_id),sno_id,sub_meter_id) as meters FROM `task_assign` WHERE user_id = ".$this->session->userdata('user_id')." AND status = 1)
          AND cid = ".$com_id."
          AND costc_id = ".$costc_id."
          AND loc_id = ".$loc_id;
      } else {
      $query = "select * from meter_master where cid = ".$com_id."
          AND costc_id = ".$costc_id."
          AND loc_id = ".$loc_id;
      }
      $result = $this->db->query($query)->result_array();
      if(count($result)>0){
          echo json_encode(array('data'=>$result,'status'=>200));
      } else {
          echo json_encode(array('status'=>500));
      }
  }
  
}
