<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$GLOBALS['_FILENAME'] = basename(__FILE__);
class InputOutput{
    public function getRequest(){
        TRC_LOG('debug','Inside getRequest');
        $aData = array();
        if($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'PUT'){
            $aData = json_decode(file_get_contents('php://input'), true);
        }else if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $aData = $this->uri->uri_to_assoc(3);
        }
        if(isset($aData['password']))
            $aData['password'] = hash('sha256',$aData['password']);
        LOG_REQ($aData);
        return $aData;
    }
    public function setResponse($iStatusHeader,$iResponse = NULL){
        $ci =&get_instance();
        $ci->output->set_content_type('application/json');
        $ci->output->set_status_header($iStatusHeader);
        if($iResponse){
            $ci->output->set_output(json_encode($iResponse, JSON_UNESCAPED_SLASHES));
            TRC_LOG('debug',"RESPONSE :: ".json_encode($iResponse, JSON_UNESCAPED_SLASHES));
        }
    }
}
?>