<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_controller extends CI_Controller {

	function index(){
		 $this->response(array('data'=>'get request'), 200);
	}
	
	function token(){
		$jwt = new JWT();
		$jwtsecrateKey = 'rahul';
		$data = array(
			'userid' => 145,
			'email' => 'asd'
		);
		
		$token = $jwt->encode($data,$jwtsecrateKey,'HS256');
		echo $token;
	}
}
