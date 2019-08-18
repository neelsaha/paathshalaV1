<?php

function JOB_LOG($iType,$iMsg){
    $aTxt = $iType." :: ".$iMsg."\n";
    $file = 'logs/deleteLogs_'.date("Y-m-d").'.txt';
    $fp = fopen($file, 'a');//opens file in append mode  
    fwrite($fp, $aTxt);  
    fclose($fp);  
}

function purgeLogs($iPath,$iDate){
    $iterator = new FilesystemIterator($iPath);
    foreach($iterator as $fileInfo){
        if($fileInfo->isFile()){
            $aCreationDate = strtotime(substr($fileInfo->getFileName(),-14,10));
            if($aCreationDate < $iDate && $fileInfo->getFileName() != "index.html"){
                JOB_LOG('DEBUG',"Deleting file: ". $fileInfo->getFileName() . " file Creation date " . date('d-m-Y',$aCreationDate));
                if (!unlink($iPath.'/'.$fileInfo->getFileName())){
                    JOB_LOG ("ERROR","ERROR while deleting ".$fileInfo->getFileName());
                }
            }
        }
    }
}

JOB_LOG('DEBUG','JOB STARTING............');
$path = dirname(__FILE__);
$aDate = strtotime("-30 day");
$appLogPath = '../application/logs';
$jobLogPath = 'Logs';
JOB_LOG('DEBUG',"Date 30 days ago: ".date('d-m-Y',$aDate));
JOB_LOG('DEBUG',"Processing APPLICATION logs");
purgeLogs($appLogPath,$aDate);
JOB_LOG('DEBUG',"Processing JOB logs");
purgeLogs($jobLogPath,$aDate);
JOB_LOG("DEBUG","JOB SUCCESS!");

?>