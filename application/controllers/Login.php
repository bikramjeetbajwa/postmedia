<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
    private $_return_code      = '';
    private $_return_data   = '';

    function __construct() {
        /* Set _loginRequired to FALSE for all pre login pages,
         * before calling the parent controller, by default it is TRUE.
           ---------------------- */
        $this->_loginRequired       = FALSE;
        /* ---------------------- */
        
        parent::__construct();

        /* Special case for Login to hide the navigation even if the user is logged in
           ---------------------- */
        //$this->data['isLogged']     = FALSE;
        $this->_showSideNavigation  = FALSE;
        $this->_showTopSubNavigation  = FALSE;
        /* ---------------------- */

        $this->load->model('Ym_users');
        $this->load->model('Ym_customers');
        $this->load->model('Sys_time_zones');
    }

    public function index() {

        $this->render_page();
    }

    public function forgot(){


        $this->_viewName = 'forgot';
        $this->render_page();

    }

    public function authenticate() {

        $data = $this->input->post('data', TRUE);

        $user = $this->Ym_users->authenticate($data);
        if($user){

            $userAccess = ''; //todo: get user access here
            $user->ACCESS = $userAccess;

            $customer               = $this->Ym_customers->get($user->CUS_ID);
            $user->CUSTOMER_CODE    = $customer->CODE;
            $user->CUSTOMER_NAME    = $customer->NAME;

            $timeZone = $this->Sys_time_zones->get($user->TIMZON_ID);
            $user->TIMEZONE = $timeZone->NAME;

            $this->session->set_userdata('user',$user);
            $this->session->set_userdata('isLogged',TRUE);

            $url = 'dashboard';
            if($user->CHANGE_PWD_FLAG == 'Y'){
                $url = 'account/password';
            }

            $this->_return_code = 'SUCCESS';
            $this->_return_data = array(
                'url'   => $url
            );
        }
        else{
            $this->_return_code = 'ERROR';
            $error = $this->Ym_users->_error;
            $this->_return_data = array(
                'message'   => $error['message']
            );

        }
        show_json_message($this->_return_code , $this->_return_data );
    }

}

