<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Exams extends CI_Controller {

    public function getExamsForClass($iClass,$iSection){
        TRC_LOG('debug',"Inside getExamsForClass");
        $aToken = substr($this->input->get_request_header('Authorization', TRUE),7);
        $aStatusCode = 500;
        $aResponse = array();
        if($this->sesssecurity->checkSession($aStatusCode, $aToken)){
            try{
                $this->load->model('ExamsModel');
                $aResponse = $this->ExamsModel->getExamDetailsClass($iClass,$iSection,$aStatusCode);
            }catch(Exception $e){
                TRC_LOG('error',$e->getMessage());
            }
        }else{
            TRC_LOG('debug','Unaothorized access');
        }
        $this->inputoutput->setResponse($aStatusCode,$aResponse);
    }

    public function getExamsForOrga($iOrga){
        TRC_LOG('debug',"Inside getExamsForOrga");
        $aToken = substr($this->input->get_request_header('Authorization', TRUE),7);
        $aStatusCode = 500;
        $aResponse = array();
        if($this->sesssecurity->checkSession($aStatusCode, $aToken, 'teacher')){
            try{
                $this->load->model('ExamsModel');
                $aResponse = $this->ExamsModel->getExamDetails($iOrga,$aStatusCode);
            }catch(Exception $e){
                TRC_LOG('error',$e->getMessage());
            }
        }else{
            TRC_LOG('debug','Unaothorized access');
        }
        $this->inputoutput->setResponse($aStatusCode,$aResponse);
    }

    public function addExam($iClass,$iSection){
        TRC_LOG('debug',"Inside addExam");
        $aToken = substr($this->input->get_request_header('Authorization', TRUE),7);
        $aStatusCode = 500;
        $aResponse = array();
        if($this->sesssecurity->checkSession($aStatusCode, $aToken, 'teacher')){
            try{
                $aData = $this->inputoutput->getRequest();
                $this->load->model('ExamsModel');
                $aResponse = $this->ExamsModel->setExamDetails($iClass,$iSection,$aData,$aStatusCode);
            }catch(Exception $e){
                TRC_LOG('error',$e->getMessage());
                $aStatusCode = 500;
            }
        }else{
            TRC_LOG('debug','Unaothorized access');
        }
        $this->inputoutput->setResponse($aStatusCode,$aResponse);
    }

}

?>