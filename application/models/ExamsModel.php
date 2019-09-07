<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ExamException extends Exception{}
class ExamsModel extends CI_Model {
    private static $_roles = array(
        "student" => 1,
        "parent" => 2,
        "teacher" => 3,
        "schoolAdmin" => 4,
        "superAdmin" => 5
    );
    public function getExamDetailsClass($iClass,$iSection,&$oStatusCode){
        TRC_LOG('debug',"Inside getExamDetailsClass");
        $aOrg = $this->sesssecurity->getVariableValue('orga');
        $aRole = $this->sesssecurity->getVariableValue('role');
        $aData = array();
        try{
            $this->db->select('exam_name,subject_name,org_name,class_value,sec_value,total_marks,timestamp');
            $this->db->from('exam');
            $this->db->join('organization','exam.organization_id = organization.organization_id');
            $this->db->join('class','class.id = exam.class');
            $this->db->join('section','section.id = exam.section');
            $this->db->join('subject','subject.subject_id = exam.subject_id');
            $this->db->where(array("exam.class" => $iClass, "exam.section" => $iSection));
            if($aRole != self::$_roles['superAdmin']){
                $this->db->where(array("exam.organization_id" => $aOrg));
            }
            $aResult = $this->db->get()->result();
            $aData = array("list" => $aResult, "num_rows" => count($aResult));
            TRC_LOG('debug',"QUERY :: ".$this->db->last_query());
            TRC_LOG('debug',"DATA :: ".json_encode($aResult, JSON_UNESCAPED_SLASHES));
            $oStatusCode = 200;
        }catch(Exception $e){
            TRC_LOG('error', $e->getMessage());
            $oStatusCode = 500;
        }
        return $aData;
    }

    public function getExamDetails($iOrga,&$oStatusCode){
        TRC_LOG('debug',"Inside getExamDetails");
        $aData = array();
        if($this->isViewAllowed($iOrga)){
            try{
                $this->db->select('exam_name,subject_name,org_name,class_value,sec_value,total_marks,timestamp');
                $this->db->from('exam');
                $this->db->join('organization','exam.organization_id = organization.organization_id');
                $this->db->join('class','class.id = exam.class');
                $this->db->join('section','section.id = exam.section');
                $this->db->join('subject','subject.subject_id = exam.subject_id');
                $this->db->where(array("exam.organization_id" => $iOrga));
                $aResult = $this->db->get()->result();
                $aData = array("list" => $aResult, "num_rows" => count($aResult));
                TRC_LOG('debug',"QUERY :: ".$this->db->last_query());
                TRC_LOG('debug',"DATA :: ".json_encode($aResult, JSON_UNESCAPED_SLASHES));
                $oStatusCode = 200;
            }catch(Exception $e){
                TRC_LOG('error', $e->getMessage());
                $oStatusCode = 500;
            }
        }else{
            $oStatusCode = 403;
        }
        return $aData;
    }

    public function setExamDetails($iClass,$iSection,$iParam,&$oStatusCode){
        TRC_LOG('debug',"Inside setExamDetails");
        $aData = array();
        try{
            $this->addOrgaToRequest($iParam);
            $this->addOtherParameters($iParam,$iClass,$iSection);
            $this->db->insert('exam',$iParam);
            TRC_LOG('debug',"QUERY :: ".$this->db->last_query());
            // $aData = $this->getDetails($oStatusCode,$aUsername);
            // TRC_LOG('debug',"DATA :: ".json_encode($aData, JSON_UNESCAPED_SLASHES));
            // TRC_LOG('debug','Success...');
        }catch(ExamException $e){
            TRC_LOG('error','Validation failed: '.$e->getMessage());
            $aData['error'] = $e->getMessage();
            $oStatusCode = 400;
        }catch(Exception $e){
            TRC_LOG('error','Database operation failed: '.$e->getMessage());
            $oStatusCode = 500;
        }
        return $aData;
    }

    private function addOtherParameters(&$ioParam,$iClass,$iSection){
        TRC_LOG('debug',"Inside addOtherParameters");
        $this->load->model('ClassSecModel');
        if(!$this->ClassSecModel->isClassExist($iClass)){
            throw new ExamException("Invalid class : ".$iClass);
        }elseif(!$this->ClassSecModel->isSectionExist($iSection)){
            throw new ExamException("Invalid section : ".$iSection);
        }else{
            $ioParam['class'] = $iClass;
            $ioParam['section'] = $iSection;
            $ioParam['added_by'] = $this->sesssecurity->getVariableValue('userId');
        }
    }

    private function addOrgaToRequest(&$ioParam){
        TRC_LOG('debug',"Inside addOrgaToRequest");
        $aRole = $this->sesssecurity->getVariableValue('role');
        $aOrga = $this->sesssecurity->getVariableValue('orga');
        if($aRole == self::$_roles['superAdmin'] && !array_key_exists('organization_id', $ioParam)){
            throw new ExamException("Organization id missing for role: ".$aRole);
        }elseif ($aRole != self::$_roles['superAdmin'] && array_key_exists('organization_id', $ioParam)) {
            throw new ExamException("Organization id added for role: ".$aRole);
        }elseif ($aRole != self::$_roles['superAdmin'] && !array_key_exists('organization_id', $ioParam)){
            $ioParam['organization_id'] = $aOrga;
        }
    }

    private function isViewAllowed($iOrga){
        TRC_LOG('debug',"Inside isViewAllowed");
        $aRole = $this->sesssecurity->getVariableValue('role');
        $aOrg = $this->sesssecurity->getVariableValue('orga');
        $aStatus = false;
        if($aRole == self::$_roles['superAdmin']){
            $aStatus = true;
        }else if($aOrg === $iOrga){
            $aStatus = true;
        }
        TRC_LOG('debug',"Orga: ".$iOrga." Status: ".($aStatus?"true":"false"));
        return $aStatus;
    }
}
?>