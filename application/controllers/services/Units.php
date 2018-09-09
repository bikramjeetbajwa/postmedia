<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Units extends MY_Controller {
    private $_return_code   = '';
    private $_return_data   = '';

    function __construct(){
        /* Set _loginRequired to FALSE for all pre login pages,
         * before calling the parent controller, by default it is TRUE.
           ---------------------- */
        $this->_loginRequired       = FALSE;
        /* ---------------------- */
        parent::__construct();


        if(!$this->input->is_ajax_request()){
            $this->_return_code = 'ERROR';
            $this->_return_data = array(
                'message'   => 'Invalid Request !'
            );
            show_json_message($this->_return_code , $this->_return_data );
        }
        header('Cache-Control: no-cache, must-revalidate');
        header('Content-Type: application/json');


        $this->load->model('Ym_units');
        $this->load->model('Rep_service_calls');
    }

    public function index() {



    }

    public function get($uni_id = 0) {
        $result = array();
        if($uni_id > 0){
            $result = $this->Ym_units->get($uni_id);
        } else {

            $data = $this->input->post('data', TRUE);
            $result = $this->Ym_units->get_by($data);
        }
        show_json_result($result);

    }

    public function get_history($uni_id = 0){
        $result = array();
        if($uni_id > 0){
            $result = $this->Rep_service_calls->readUnitHistory($uni_id);
        }
        show_json_result($result, TRUE);
    }
}
