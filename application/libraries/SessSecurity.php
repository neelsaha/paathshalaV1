<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$GLOBALS['_FILENAME'] = basename(__FILE__);
class SessSecurity{
    private static $_roles = array(
        "student" => 1,
        "parent" => 2,
        "teacher" => 3,
        "schoolAdmin" => 4,
        "superAdmin" => 5
    );
    public function checkSession(&$oStatusCode,$iToken,$iRole = 'student'){
        TRC_LOG('debug',"REQUEST TYPE :: ".$_SERVER['REQUEST_METHOD']);
        TRC_LOG('debug',"Inside checkSession");
        $aStatus = false;
        //echo ($_SESSION['sessArr']['token']==$iToken);
        if(isset($_SESSION['sessArr']) && isset($_SESSION['sessArr']['token']) && $_SESSION['sessArr']['token'] == $iToken){
            if($this->checkRole($iRole)){
                $oStatusCode = 200;
                $aStatus = true;
            }else{
                $oStatusCode = 401;
            }
        }else{
            $oStatusCode = 401;
        }
        TRC_LOG('debug',"Check status: ".($aStatus?'true':'false'));
        return $aStatus;
    }
    public function destroy(){
        session_destroy();
    }
    public function getVariableValue($iKey){
        TRC_LOG('debug',"Inside getVariableValue key: ".$iKey);
        $aValue = "";
        if(isset($_SESSION['sessArr'][$iKey])){
            $aValue = $_SESSION['sessArr'][$iKey];
        }else{
            TRC_LOG('error',"No value found for variable: ".$iKey);
        }
        TRC_LOG('debug',"Returning key: ".$iKey." value: ".$aValue);
        return $aValue;
    }
    private function checkRole($iRole){
        $aStatus = false;
        TRC_LOG('debug','Session Role: '.$this->getVariableValue('role').' Required Role: '.self::$_roles[$iRole]);
        if($_SESSION['sessArr']['role'] >= self::$_roles[$iRole]){
            $aStatus = true;
        }
        TRC_LOG('debug',"CheckRole status: ".($aStatus?'true':'false'));
        return $aStatus;
    }
}
?>