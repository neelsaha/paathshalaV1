<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {
    private static $_roles = array(
        "student" => 1,
        "parent" => 2,
        "teacher" => 3,
        "schoolAdmin" => 4,
        "superAdmin" => 5
    );
    //Updating user details
    public function update(&$oStatusCode,$iParam){
        TRC_LOG('debug','Inside update');
        $aData = array();
        try{
            $aUserId = $this->sesssecurity->getVariableValue('userId');
            $aUsername = $this->sesssecurity->getVariableValue('username');
            $this->db->set($iParam);
            $this->db->where('user_id',$aUserId);
            $this->db->update('login');
            TRC_LOG('debug',"QUERY :: ".$this->db->last_query());
            $aData = $this->getDetails($oStatusCode,$aUsername);
            TRC_LOG('debug',"DATA :: ".json_encode($aData, JSON_UNESCAPED_SLASHES));
            TRC_LOG('debug','Success...');
        }catch(Exception $e){
            TRC_LOG('error','Database operation failed: '.$e->getMessage());
            $oStatusCode = 500;
        }
        return $aData;
    }

    //fetching details of a user
    public function getDetails(&$oStatusCode,$iUsername){
        TRC_LOG('debug','Inside getDetails');
        $data = Array();
        try{
            if($this->sesssecurity->getVariableValue('role') <= self::$_roles['parent']){
                TRC_LOG('debug',"Role parent or student");
                $this->db->select('first_name,last_name,mobile,student_first_name,student_last_name,registration_id,rollno,org_name,class_value,sec_value,attd_percentage');
                $this->db->from('login');
                $this->db->join('student','student.student_id = login.student_id');
                $this->db->join('organization','organization.organization_id = login.organization_id');
                $this->db->join('class','class.id = student.class');
                $this->db->join('section','section.id = student.section');
                $this->db->where( array('username =' => $iUsername, 'login.isDeleted =' => 'N'));
            }else if($this->sesssecurity->getVariableValue('role') == self::$_roles['teacher']){
                TRC_LOG('debug',"Role teacher");
                $this->db->select('first_name,last_name,mobile,org_name,class_value,sec_value,qualification');
                $this->db->from('login');
                $this->db->join('teacher','teacher.teacher_id = login.teacher_id');
                $this->db->join('organization','organization.organization_id = login.organization_id');
                $this->db->join('class','class.id = teacher.class');
                $this->db->join('section','section.id = teacher.section');
                $this->db->where( array('username =' => $iUsername, 'login.isDeleted =' => 'N'));
            }else if($this->sesssecurity->getVariableValue('role') == self::$_roles['schoolAdmin']){
                TRC_LOG('debug',"Role School Admin");
                $this->db->select('first_name,last_name,mobile,org_name,name');
                $this->db->from('login');
                $this->db->join('organization','organization.organization_id = login.organization_id');
                $this->db->join('board_master','board_master.board_id = organization.board_id');
                $this->db->where( array('username =' => $iUsername, 'login.isDeleted =' => 'N'));
            }else if($this->sesssecurity->getVariableValue('role') == self::$_roles['superAdmin']){
                TRC_LOG('debug',"Role Super Admin");
                $this->db->select('first_name,last_name,mobile');
                $this->db->from('login');
                $this->db->where( array('username =' => $iUsername, 'login.isDeleted =' => 'N'));
            }
            $aData = $this->db->get()->row();
            TRC_LOG('debug',"QUERY :: ".$this->db->last_query());
            TRC_LOG('debug',"DATA :: ".json_encode($aData, JSON_UNESCAPED_SLASHES));
            $oStatusCode = 200;
        }catch(Exception $e){
            TRC_LOG('error',"ERROR: ".$e->getMessage());
        }
        
        return $aData;
    }

    public function isUsernameExists($iUsername){
        TRC_LOG('debug',"Inside checkUserExists");
        $aStatus = false;
        $aData = $this->db->get_where('login',array("username" => $iUsername))->row();
        if($aData){
            $aStatus = true;
        }
        TRC_LOG('debug',"Returning status: ".$aStatus);
        return $aStatus;
    }

    public function isOperationsAllowed($iUserId){
        return true;
    }

    /*
    public function isStudentDisplayAllowed($studentId){
        TRC_LOG('debug',"Inside isOperationsAllowed");
        $aStatus = false;
        if($this->sesssecurity->getVariableValue('role') == self::$_roles['superAdmin']){
            $aStatus = true;
        }else{
            $this->db->from('login');
            $this->db->join('student','student.organization_id = login.organization_id');
            $this->db->join('section','section.id = teacher.section');
            $this->db->where( array('username =' => $iUsername, 'login.isDeleted =' => 'N'));
        }
    }
    */

    //Fetching class details
    public function getClassDetails(&$oStatusCode){
        TRC_LOG('debug','Inside getClassDetails');
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
            $this->model->load('schoolDetails');
            $aSchoolDetails = $this->schoolDetails->getDetails($oStatusCode);
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