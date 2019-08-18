<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ClassSecModel extends CI_Model {

    public function getList($iOrga,&$oStatusCode){
        TRC_LOG('debug',"Inside getList");
        $aData = array();
        try{
            $this->db->select('class_value,sec_value,teacher_first_name,teacher_last_name');
            $this->db->from('organization_class_mapping');
            $this->db->join('class','class.id = organization_class_mapping.class');
            $this->db->join('section','section.id = organization_class_mapping.section');
            $this->db->join('teacher','teacher.teacher_id = organization_class_mapping.class_teacher_id','left');
            $this->db->where(array("organization_class_mapping.organization_id" => $iOrga));
            $aResult = $this->db->get()->result();
            $aData = array("list" => $aResult, "num_rows" => count($aResult));
            TRC_LOG('debug',"QUERY :: ".$this->db->last_query());
            TRC_LOG('debug',"DATA :: ".json_encode($aData, JSON_UNESCAPED_SLASHES));
            $oStatusCode = 200;
        }catch(Exception $e){
            TRC_LOG('error', $e->getMessage());
            $oStatusCode = 500;
        }
        return $aData;
    }

}

?>