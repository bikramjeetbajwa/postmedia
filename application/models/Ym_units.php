<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ym_units extends MY_Model {

    public      $_table         =  "YM_UNITS_WV";
    public      $primary_key    = 'UNI_ID';
    protected   $active_flag    = TRUE;

    public function __construct(){
        parent::__construct();
    }


}
