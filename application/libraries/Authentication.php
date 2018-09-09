<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication {

    private $ci;
    function __construct()
    {
        $this->ci =& get_instance();
        //$this->ci->library->load('session');

        log_message('debug', "Navigation Class Initialized");
    }



    public function setUserSessions($user){
        $this->session->set_userdata('user',$user);
        $this->session->set_userdata('isLogged',TRUE);
    }




    public function isLoggedIn(){
        return $this->session->userdata('isLogged')?TRUE:FALSE;
    }

    
}