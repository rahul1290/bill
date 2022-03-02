<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_ctrl extends CI_Controller {

	function __construct() {
    parent::__construct();
		$this->load->database();
    $this->load->model('Auth_model');
    if($this->session->userdata('user_id') != null){
      if($this->session->userdata('role') == 'super_admin' || $this->session->userdata('role') == 'admin'){
        redirect('/Company_ctrl');
      } else {
        redirect('/Bill-upload');
      }
    } 
  }

  function login(){
    if ($this->input->server('REQUEST_METHOD') === 'GET') {
      $this->load->view('login');
    } else {
      $this->form_validation->set_rules('identity', 'Identity', 'required|trim');
      $this->form_validation->set_rules('password', 'Password', 'required|trim');
      if ($this->form_validation->run()){

        $data['identity'] = $this->input->post('identity');
        $data['password'] = sha1($this->input->post('password'));

        $result = $this->Auth_model->login($data);
        if($result){
          $this->session->set_userdata(array(
            'user_id' => $result[0]['uid'],
            'name' => $result[0]['fname'].' '.$result[0]['lname'],
            'role' => $result[0]['type_name'],
          ));
          if($this->session->userdata('role') == 'super_admin' || $this->session->userdata('role') == 'admin'){
            redirect('/Company_ctrl');
          } else {
            redirect('/Bill-upload');
          }
        }
      } else {
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');
        $this->load->view('login');
      }
    }
  }
}
