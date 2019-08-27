<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentModel extends CI_Model{
    private static $_roles = array(
        "student" => 1,
        "parent" => 2,
        "teacher" => 3,
        "schoolAdmin" => 4,
        "superAdmin" => 5
    );

    public function isStudentIdExists($iStudentId){
        TRC_LOG('debug',"Inside isStudentIdExists");
        $aStatus = false;
        $aData = $this->db->get_where('student',array("student_id" => $iStudentId, "isDeleted" => "N"))->row();
        if($aData){
            $aStatus = true;
        }
        TRC_LOG('debug',"Returning status: ".($aStatus?"true":"false"));
        return $aStatus;
    }

    public function isViewAllowed($iStudentId,&$oStatusCode){
        TRC_LOG('debug',"Inside isViewAllowed");
        TRC_LOG('debug',"Student Id: ".$iStudentId);
        $oStatusCode = 200;
        try{
            if(!$this->isStudentIdExists($iStudentId)){
                $oStatusCode = 404;
            }else{
                if($this->sesssecurity->getVariableValue('role') <= self::$_roles['schoolAdmin']){
                    $aUserId = $this->sesssecurity->getVariableValue('userId');
                    $studentOrg = $this->db->get_where('student',array("student_id" => $iStudentId))->row()->organization_id;
                    $userOrg = $this->db->get_where('login',array("user_id" => $aUserId))->row()->organization_id;
                    if($studentOrg != $userOrg){
                        $oStatusCode = 403;
                    }
                }
            }
        }catch(Exception $e){
            TRC_LOG('error',$e->getMessage());
            $oStatusCode = 500;
        }
        
        TRC_LOG('debug',"Returning status code: ".$oStatusCode);
    }

    public function getDetails($iStudentId,&$oStatusCode){
        TRC_LOG('debug',"Inside getDetails");
        $aData = array();
        try{
            $this->db->select('student_first_name,student_last_name,registration_id,rollno,org_name,class_value,sec_value,first_name,last_name,mobile,attd_percentage');
            $this->db->from('student');
            $this->db->join('login','student.student_id = login.student_id','left');
            $this->db->join('organization','organization.organization_id = student.organization_id');
            $this->db->join('class','class.id = student.class');
            $this->db->join('section','section.id = student.section');
            $this->db->where( array('student.student_id =' => $iStudentId, 'student.isDeleted =' => 'N'));
            $aData = $this->db->get()->row();
            TRC_LOG('debug',"QUERY :: ".$this->db->last_query());
            TRC_LOG('debug',"DATA :: ".json_encode($aData, JSON_UNESCAPED_SLASHES));
        }catch(Exception $e){
            TRC_LOG('error',$e->getMessage());
            $oStatusCode = 500;
        }
        return $aData;
    }

    public function getList($iClass,$iSection,$aStatusCode){
        TRC_LOG('debug',"Inside getList");
        $aData = array();
        try{
            $this->db->select('student_first_name,student_last_name,registration_id,rollno,org_name,class_value,sec_value,attd_percentage');
            $this->db->from('student');
            $this->db->join('organization','organization.organization_id = student.organization_id');
            $this->db->join('class','class.id = student.class');
            $this->db->join('section','section.id = student.section');
            if($this->sesssecurity->getVariableValue('role') == self::$_roles['superAdmin']){
                TRC_LOG('debug',"super admin");
                $this->db->where( array('student.class =' => $iClass, 'student.section =' => $iSection, 'student.isDeleted =' => 'N'));
            }else{
                $this->db->where( array('student.organization_id =' => $this->sesssecurity->getVariableValue('orga'), 'student.class =' => $iClass, 'student.section =' => $iSection, 'student.isDeleted =' => 'N'));
            }
            $aResult = $this->db->get()->result();
            $aData = array("list" => $aResult, "num_rows" => count($aResult));
            TRC_LOG('debug',"QUERY :: ".$this->db->last_query());
            TRC_LOG('debug',"DATA :: ".json_encode($aResult, JSON_UNESCAPED_SLASHES));
        }catch(Exception $e){
            TRC_LOG('error',$e->getMessage());
            $oStatusCode = 500;
        }
        return $aData;
    }
}

?>