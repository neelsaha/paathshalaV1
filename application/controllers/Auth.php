<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$GLOBALS['_FILENAME'] = basename(__FILE__);
class Auth extends CI_Controller {
	public function login(){
		TRC_LOG('debug',"Inside login()");
		$aStatusCode = 500;
		$aToken = substr($this->input->get_request_header('Authorization', TRUE),7);
		$aResponse = array();
		if(!$this->sesssecurity->checkSession($aStatusCode,$aToken)){
			$this->load->model('Login');
			$aData = $this->inputoutput->getRequest();
			$aResponse = $this->Login->authenticate($aStatusCode,$aData);
		}else{
			TRC_LOG('debug','Already logged in');
			$aStatusCode = 400;
		}
		$this->inputoutput->setResponse($aStatusCode,$aResponse);
	}

	public function logout(){
		TRC_LOG('debug',"Inside logout");
		$this->sesssecurity->destroy();
		$this->inputoutput->setResponse(200);
	}
}
?>
