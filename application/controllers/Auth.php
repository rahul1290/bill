<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Auth extends REST_Controller {
	
	function __construct() {
        parent::__construct();
		$this->load->database();
		$this->load->model('Auth_model');
		$this->jwt = new JWT();
    }

	function index_get(){
		$data = array(
			'userid' => 145,
			'email' => 'asd'
		);
		$token = $this->jwt->encode($data,$this->config->item('jwtsecrateKey'),'HS256');
		
		 $this->response(array('data'=>$token), 200);
	}
	function index_put(){
		 $this->response(array('data'=>'put request'), 200);
	}
	function login_post(){
		
		$data['identity'] = trim($this->post('identity'));
		$data['password'] = trim($this->post('password'));
		
		$result = $this->Auth_model->login($data);
		if(!is_null($result)){
			$response = array(
				'user_id' => $result[0]['uid'],
				'role' => $result[0]['type_name']
			);

			$token =$this->jwt->encode($response,$this->config->item('jwtsecrateKey'),'HS256');
			$this->response(array('data'=>array('token'=>$token),'msg'=>'login successfully.','status'=>'200'),200);
		}
		else {
			$this->response(array('msg'=>'Login failed.','status'=>'500'),500);
		}
		//$token = $this->jwt->decode('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyaWQiOjE0NSwiZW1haWwiOiJhc2QifQ.gfHGugyAYWZGEkN2GBNJIbNRxXAujVtUFx3VYXEdygs','rahul');
		//$this->response(array('data'=>$token), 200);
	}
}
