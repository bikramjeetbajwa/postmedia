<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ym_users extends MY_Model {
    public      $_table         = 'YM_USERS_WV';
    public      $primary_key    = 'USE_ID';
    protected   $active_flag    = TRUE;

    private static $validation = array(
        array(
            'field' => 'EMAIL',
            'label' => 'EMAIL',
            'rules' => 'trim|required|max_length[225]',
            'error' => array(
                'required' => 'You must provide a %s.',
                'max_length' => 'Over Length',
                'alpha_numeric' => 'Spaces are not allowed.',
            ),
        ),
        array(
            'field' => 'PASSWORD',
            'label' => 'PASSWORD',
            'rules' => 'trim|required|max_length[25]',
            'error' => array(
                'required' => 'You must provide a %s.',
                'max_length' => 'Over Length',
                'alpha_numeric' => 'Spaces are not allowed.',
            ),
        ),
    );

    public function __construct(){
        parent::__construct();
        
    }

    public function authenticate($data){
        $email      = $data['EMAIL'];
        $passwd     = $data['PASSWORD'];
        $_POST      = $data;

        $this->form_validation->set_rules(self::$validation);
        if ($this->form_validation->run() === FALSE) {
            $this->_error = array(
                'code'      => 'ERROR',
                'message'   => validation_errors()
            );
            return FALSE;
        }
        $this->_database->select('USE_ID, CUS_ID, NAME, USERNAME, PHONE, EMAIL, TIMZON_ID, LOC_ID_DEFAULT, CHANGE_PWD_FLAG, SALT, ENCRYPTED_PWD, EXTERNAL_USER_FLAG ');
        $user = $this->get_by('LOWER(EMAIL)',strtolower($email));
        if($user){
            if($user->EXTERNAL_USER_FLAG != 'Y'){
                $this->_error = array(
                    'code'      => 'ERROR',
                    'message'   => 'You do not have access, Please contact administrator !'
                );
                return FALSE;
            }
            if($this->validateEncryptedPassword($passwd, $user->SALT, $user->ENCRYPTED_PWD)){
                return $user;
            }
            else{
                $this->_error = array(
                    'code'      => 'ERROR',
                    'message'   => 'Incorrect password, Please try again !'
                );
            }
        }
        else{
            $this->_error = array(
                'code'      => 'ERROR',
                'message'   => 'Incorrect email, Please try again !'
            );
        }
        return FALSE;
    }


    private function validateEncryptedPassword($password, $salt, $encrypt){
        if($this->getEncryptedPassword($password, $salt) == $encrypt){
            return TRUE;
        }
        return FALSE;
    }

    public function getEncryptedPassword($password, $salt){
        $qry = "select lower(sys.dbms_crypto.hash(src => utl_raw.cast_to_raw('".$password."' || '{' || '".$salt."' || '}'),typ => 3)) as db_pass from dual";
        $query = $this->db->query($qry);
        $result = $query->result();
        $result = array_shift($result);
        if($result->DB_PASS){
            return $result->DB_PASS;
        }
        return NULL;
    }


}
