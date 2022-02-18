<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Auth extends REST_Controller {
	
	function __construct() {
        parent::__construct();
		$this->jwt = new JWT();
    }

	function index_get(){
		$jwtsecrateKey = 'rahul';
		$data = array(
			'userid' => 145,
			'email' => 'asd'
		);
		$token = $this->jwt->encode($data,$jwtsecrateKey,'HS256');
		
		 $this->response(array('data'=>$token), 200);
	}
	function index_put(){
		 $this->response(array('data'=>'put request'), 200);
	}
	function login_post(){
		$token = $this->jwt->decode('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyaWQiOjE0NSwiZW1haWwiOiJhc2QifQ.gfHGugyAYWZGEkN2GBNJIbNRxXAujVtUFx3VYXEdygs','rahul');
		$this->response(array('data'=>$token), 200);
	}
}
