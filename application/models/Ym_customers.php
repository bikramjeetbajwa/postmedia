<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ym_customers extends MY_Model {
    public      $_table         = 'YM_CUSTOMERS_WV';
    public      $primary_key    = 'CUS_ID';
    protected   $active_flag    = TRUE;



    public function __construct(){
        parent::__construct();

    }




}
