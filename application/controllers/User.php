<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$GLOBALS['_FILENAME'] = basename(__FILE__);
class User extends CI_Controller {
	public function update(){
        TRC_LOG('debug','Inside update');
        $aToken = substr($this->input->get_request_header('Authorization', TRUE),7);
        $aStatusCode = 500;
        $aResponse = array();
        if($this->sesssecurity->checkSession($aStatusCode,$aToken)){
            $aData = $this->inputoutput->getRequest();
            $this->load->model('UserModel');
            $aResponse = $this->UserModel->update($aStatusCode,$aData);
        }else{
            TRC_LOG('debug','Unaothorized access');
        }
        $this->inputoutput->setResponse($aStatusCode,$aResponse);
    }
    

    //GET details of any user
    public function getUserDetails($iParam){
        TRC_LOG('debug','Inside getUserDetails');
        $aToken = substr($this->input->get_request_header('Authorization', TRUE),7);
        $aStatusCode = 500;
        $aResponse = array();
        if($this->sesssecurity->checkSession($aStatusCode,$aToken,'teacher')){
            $aUsername = $iParam;
            $this->load->model('UserModel');
            try{
                if(!isUserExists($aUserId)){
                    $aStatusCode = 404;
                }else{
                    $aStatusCode = 200;
                }
                if($aStatusCode == 200 && isOperationsAllowed($aUserId)){
                    $aResponse = $this->UserModel->getDetails($aStatusCode,$aUsername);
                }else if($aStatusCode == 200){
                    $aStatusCode = 405;
                }
            }catch(Exception $e){
                TRC_LOG('error',$e->getMessage());
            }
            

        }else{
            TRC_LOG('debug','Unaothorized access');
        }
        $this->inputoutput->setResponse($aStatusCode,$aResponse);
    }

    public function getMyDetails(){
        TRC_LOG('debug','Inside getMyDetails');
        $aToken = substr($this->input->get_request_header('Authorization', TRUE),7);
        $aStatusCode = 500;
        $aResponse = array();
        if($this->sesssecurity->checkSession($aStatusCode,$aToken)){
            $aUsername= $this->sesssecurity->getVariableValue('username');
            $this->load->model('UserModel');
            $aResponse = $this->UserModel->getDetails($aStatusCode,$aUsername);
        }else{
            TRC_LOG('debug','Unaothorized access');
        }
        $this->inputoutput->setResponse($aStatusCode,$aResponse);
    }
}
?>
