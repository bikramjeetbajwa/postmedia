<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {
    private $_return_code      = '';
    private $_return_data   = '';

    function __construct() {
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

        $this->load->model('Ym_users');

    }

    public function change_password(){

        $data = $this->input->post('data', TRUE);
        if($data){
            $user = $this->_user;
            if($user->USE_ID > 0){
                $valData = array(
                    'PASSWORD'      => $data['CURRENTPASSWORD'],
                    'EMAIL'         => $user->EMAIL
                );
                $tempUser = $this->Ym_users->authenticate($valData);
                if($tempUser){
                    $oldPassword = $this->Ym_users->getEncryptedPassword($data['CURRENTPASSWORD'], $user->SALT);
                    $newPassword = $this->Ym_users->getEncryptedPassword($data['NEWPASSWORD'], $user->SALT);
                    if($oldPassword != $newPassword){
                        $updData = array(
                            'PASSWORD'          => '--NOT USED--',      //Can not set it to NULL due to DB constraint
                            'ENCRYPTED_PWD'     => $newPassword,
                            'CHANGE_PWD_FLAG'   => 'N',
                        );
                        if($this->Ym_users->update($user->USE_ID, $updData)){
                            //If password changed successfully, logout user and ask to login again
                            $this->session->unset_userdata('user');
                            //$this->session->sess_destroy();
                            $this->session->set_userdata('isLogged',FALSE);

                            $url = 'login'; //'account/logout';
                            $this->_return_code = 'SUCCESS';
                            $this->_return_data = array(
                                'url'   => $url
                            );
                            $this->session->set_flashdata('success', 'Password changed successfully, Please login again');
                            show_json_message($this->_return_code , $this->_return_data );
                        }
                    }
                    else{
                        $this->_return_code = 'ERROR';
                        $this->_return_data = array(
                            'message'   => 'Old and new passwords can not be same.'
                        );
                        show_json_message($this->_return_code , $this->_return_data );
                    }
                }
            }
        }
        $error = $this->Ym_users->_error;
        $this->_return_data = array(
            'message'   => $error['message']
        );
        show_json_message($error['code'] , $this->_return_data );



    }



}

