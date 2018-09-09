<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller {
    private $_return_code   = '';
    private $_return_data   = '';

    function __construct(){
        /* Set _loginRequired to FALSE for all pre login pages,
         * before calling the parent controller, by default it is TRUE.
           ---------------------- */
        $this->_loginRequired       = FALSE;
        /* ---------------------- */
        parent::__construct();

        $this->_showTopSubNavigation = FALSE;
    }

    public function index() {

        $this->data['contact'] = $this->config->item('contact');

        $this->render_page();
    }

    public function send(){
        $data = $this->input->post('data', TRUE);
        if(sizeof($data) > 0){
            $this->load->library('email');
            $contact = $this->config->item('contact');
            $this->email->from($data['EMAIL']);
            $this->email->reply_to($data['EMAIL']);
            if(ENVIRONMENT == 'production'){
                $this->email->to($contact['email']);
            }
            else{
                $this->email->to($this->config->item('test_email'));
            }
            $this->email->subject('Contact Us');
            $message = ' <h1>Contact Us</h1><br>';
            $message .= ' Name : '.$data['NAME'].'<br>';
            $message .= ' Email : '.$data['EMAIL'].'<br>';
            $message .= ' Phone : '.$data['PHONE'].'<br>';
            $message .= ' Company : '.$data['COMPANY'].'<br>';
            $message .= ' Message : <br>'.$data['MESSAGE'];
            $this->email->message($message);
            if($this->email->send()){
                $this->_return_code = 'SUCCESS';
                $this->_return_data = array(
                    'message'   => $data['NAME'].', thank you for contacting us, we will contact you soon !'
                );
            }
            else{
                //$res = explode('<br />', $this->email->print_debugger());
                $this->_return_code = 'ERROR';
                $this->_return_data = array(
                    'message'   => 'Something went wrong, Please contact administrator !'
                );
            }
        }
        show_json_message($this->_return_code , $this->_return_data );
    }
}
