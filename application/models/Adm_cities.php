<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adm_cities extends MY_Model {
    public      $_table         = 'ADM_CITIES_WV';
    public      $primary_key    = 'CIT_ID';
    protected   $active_flag    = TRUE;

    function __construct() {
        parent::__construct();
        $this->load->model('Adm_province_states');
    }


}