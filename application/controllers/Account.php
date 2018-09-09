<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {

    function __construct(){
        parent::__construct();

        $this->_topSubNavigation = array('profile' => '', 'password' => 'password');

    }

    public function index() {
        $this->_viewName = 'account/profile';
        $this->render_page();
    }

    public function password(){
        $this->_viewName = 'account/password';
        $this->render_page();
    }

    public function logout(){
        $this->session->unset_userdata('user');
        $this->session->sess_destroy();
        $this->session->set_userdata('isLogged',FALSE);
        redirect(base_url('login'),'refresh');
    }
}
