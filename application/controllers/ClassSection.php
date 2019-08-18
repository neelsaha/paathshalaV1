<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$GLOBALS['_FILENAME'] = basename(__FILE__);
class ClassSection extends CI_Controller {
	/*public function getDetails(){
        TRC_LOG('debug','Inside getDetails');
        $aToken = substr($this->input->get_request_header('Authorization', TRUE),7);
        $aStatusCode = 500;
        $aResponse = array();
        if($this->sesssecurity->checkSession($aStatusCode,$aToken)){
            $aResponse = $this->getDetailsImpl($aStatusCode);
        }else{
            TRC_LOG('debug','Unaothorized access');
            $aStatusCode = 401;
        }
        $this->inputoutput->setResponse($aStatusCode,$aResponse);
    }

    public function getDetails($iParam){
        TRC_LOG('debug','Inside getDetails');
        $aToken = substr($this->input->get_request_header('Authorization', TRUE),7);
        $aStatusCode = 500;
        $aResponse = array();
        if($this->sesssecurity->checkSession($aStatusCode,$aToken,"teacher")){
            $aResponse = $this->getDetailsImpl($aStatusCode);
        }else{
            TRC_LOG('debug','Unaothorized access');
            $aStatusCode = 401;
        }
        $this->inputoutput->setResponse($aStatusCode,$aResponse);
    }*/
    
    public function getClassList($iOrga = NULL){
        TRC_LOG('debug','Inside getClassList');
        $aToken = substr($this->input->get_request_header('Authorization', TRUE),7);
        $aStatusCode = 500;
        $aResponse = array();
        $aOrga = NULL;
        if($this->sesssecurity->checkSession($aStatusCode,$aToken,'superAdmin')){
            TRC_LOG('debug',"Super Admin");
            $aOrga = $iOrga;
        }else if($this->sesssecurity->checkSession($aStatusCode,$aToken,'teacher')){
            $aOrga = $this->sesssecurity->getVariableValue('orga');
        }else{
            TRC_LOG('debug','Unaothorized access');
            $aStatusCode = 401;
        }

        if($aStatusCode != 401 && $aOrga){
            $this->load->model('ClassSecModel');
            $aResponse = $this->ClassSecModel->getList($aOrga,$aStatusCode);
        }else if($aStatusCode != 401 && !$aOrga){
            $aStatusCode = 400;
        }

        $this->inputoutput->setResponse($aStatusCode,$aResponse);
    }

    //Fetching class details
    private function getDetailsImpl(&$oStatusCode){
        TRC_LOG('debug','Inside getDetailsImpl');
        $aClassTeacher = "";
        $aClass = array();
        $aSec = array();
        $aSchoolDetails = array();
        $this->model->load('classSecModel');
        $aClass = $this->classSecModel->getClassDetails($oStatusCode);
        if($oStatusCode == 200)
            $aSec = $this->classSecModel->getSecDetails($oStatusCode);
        
        if($oStatusCode == 200){
            $this->model->load('teacherModel');
            $aClassTeacher = $this->teacherModel->getDetails($aClass['id'],$aSec['id'],$oStatusCode);
        }

        if($oStatusCode == 200){
            $this->model->load('schoolModel');
            $aSchoolDetails = $this->schoolModel->getDetails($oStatusCode);
        }

        if($oStatusCode == 200){
            $aResponse = array("class"=>$aClass['value'],"section"=>$aSec['value'],"classTeacher"=>$aClassTeacher,"schoolDetails"=>$aSchoolDetails);
            TRC_LOG('debug','Success...');
        }else{
            $aResponse = $this->inputoutput->setError("kInternalError");
            TRC_LOG('debug','Failed...');
        }
        return $aResponse;
    }
}
?>
