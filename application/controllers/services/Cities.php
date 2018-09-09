<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cities extends MY_Controller {
    private $_return_code   = '';
    private $_return_data   = '';

    function __construct(){
        /* Set _loginRequired to FALSE for all pre login pages,
         * before calling the parent controller, by default it is TRUE.
           ---------------------- */
        $this->_loginRequired       = FALSE;
        /* ---------------------- */
        parent::__construct();

        $this->load->model('Adm_cities');
    }

    public function index() {



    }

    public function get() {
        $filter = $this->input->get('filter');
        $result = $this->Adm_cities->read($filter);
        show_json_result($result);
    }
}
