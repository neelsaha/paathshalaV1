<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Student extends CI_Controller {
    public function viewStudentDetails($iStudentId){
        TRC_LOG('debug',"Inside viewStudentDetails");
        $aToken = substr($this->input->get_request_header('Authorization', TRUE),7);
        $aStatusCode = 500;
        $aResponse = array();
        if($this->sesssecurity->checkSession($aStatusCode, $aToken, 'teacher')){
            $this->load->model('StudentModel');
            try{
                $this->StudentModel->isViewAllowed($iStudentId,$aStatusCode);
                if($aStatusCode == 200){
                    $aResponse = $this->StudentModel->getDetails($iStudentId,$aStatusCode);
                }
            }catch(Exception $e){
                TRC_LOG('error',$e->getMessage());
            }
        }else{
            TRC_LOG('debug','Unaothorized access');
            $aStatusCode = 401;
        }
        $this->inputoutput->setResponse($aStatusCode,$aResponse);
    }
}

?>