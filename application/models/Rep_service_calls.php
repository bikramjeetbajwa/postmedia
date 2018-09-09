<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_service_calls extends MY_Model {

    public      $_table         = 'REP_SERVICE_CALLS_WV';
    public      $primary_key    = 'SERCAL_ID';
    protected   $active_flag    = TRUE;

    public function __construct(){
        parent::__construct();

    }



}