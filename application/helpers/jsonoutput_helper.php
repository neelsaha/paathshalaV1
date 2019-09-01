<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function json_output($iStatusHeader, $iResponse){
    $ci =&get_instance();
    $ci->output->set_content_type('application/json');
    $ci->output->set_status_header($iStatusHeader);
    if($iResponse)
        $ci->output->set_output(json_encode($iResponse));
}

?>
