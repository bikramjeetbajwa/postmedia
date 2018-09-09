<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pm extends MY_Controller {

    function __construct(){
        parent::__construct();

        $this->_pageTitle = 'Preventive Maintenance - Coming Soon !';
        //$this->_topSubNavigation = array('Service' => '', 'Misc' => 'Misc');

    }

    public function index() {

        $this->_viewName = 'Pm/list';
        $this->render_page();
    }

}