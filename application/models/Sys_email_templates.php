<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sys_email_templates extends MY_Model
{
    private     $_table      = "SYS_EMAIL_TEMPLATES_WV";
    public      $primary_key    = 'EMATEM_ID';
    protected   $active_flag    = FALSE;

    public function __construct(){
        parent::__construct();
    }

    function get_template_by_code($code) {
        $row = array();

        if(!empty($code)) {
            $query = $this->db->get_where($this->table(), array('CODE' => $code));
            $result = $query->row();
            if(count($result) > 0) {
                $row['EMAIL_SUBJECT'] = $result->EMAIL_SUBJECT;
                $row['EMAIL_BODY'] = $result->EMAIL_BODY;

                return $row;
            } else {
                return false;
            }
        }
    }


}