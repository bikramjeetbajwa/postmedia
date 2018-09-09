<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ownerships extends MY_Controller {

    function __construct(){
        parent::__construct();

        $this->_pageTitle = 'Ownerships - Coming Soon !';
        //$this->_topSubNavigation = array('Service' => '', 'Misc' => 'Misc');

    }

    public function index() {

        $this->render_page();
    }

}