<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function TRC_LOG($iType, $iMsg){
    $aFile = basename(debug_backtrace()[0]['file']);
    $aLine = debug_backtrace()[0]['line'];
    $aSessionId = session_id();
    $aLogMsg = "<".$aFile.">#".$aLine.":: ".$aSessionId." :: ".$iMsg;
    log_message($iType,$aLogMsg); 
}

function LOG_REQ($req){
    $aFile = basename(debug_backtrace()[0]['file']);
    $aLine = debug_backtrace()[0]['line'];
    $aSessionId = session_id();
    $aMsg = json_encode($req);
    $aLogMsg = "<".$aFile.">#".$aLine.":: ".$aSessionId." :: REQUEST :: ".$aMsg;
    log_message('debug',$aLogMsg);
}

function LOG_RES($res){
    $aFile = basename(debug_backtrace()[0]['file']);
    $aLine = debug_backtrace()[0]['line'];
    $aSessionId = session_id();
    $aMsg = json_encode($res);
    $aLogMsg = "<".$aFile.">#".$aLine.":: ".$aSessionId." :: RESPONSE :: ".$aMsg;
    log_message('debug',$aLogMsg);
}

?>
