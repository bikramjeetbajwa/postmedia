<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance extends MY_Controller {

    function __construct() {
        $this->_isMaintenancePage   = TRUE;
        /* Set _loginRequired to FALSE for all pre login pages,
         * before calling the parent controller, by default it is TRUE.
           ---------------------- */
        $this->_loginRequired       = FALSE;
        /* ---------------------- */

        parent::__construct();

        /* Special case for Login to hide the navigation even if the user is logged in
           ---------------------- */
        //$this->data['isLogged']       = FALSE;
        $this->_showTopNavigation       = FALSE;
        $this->_showTopSubNavigation    = FALSE;
        $this->_showSideNavigation      = FALSE;
        /* ---------------------- */
    }

    public function index() {

        $this->render_page();
    }
}

