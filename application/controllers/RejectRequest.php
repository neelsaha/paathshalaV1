<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RejectRequest extends CI_Controller{

    public function status405(){
        $this->inputoutput->setResponse(405);
    }
}


?>