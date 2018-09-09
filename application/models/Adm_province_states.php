<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ADM_province_states extends MY_Model{
    public      $_table         = "ADM_PROVINCE_STATES_WV";
    public      $primary_key    = 'PROSTA_ID';
    protected   $active_flag    = TRUE;

    function __construct() {
        parent::__construct();
    }


}