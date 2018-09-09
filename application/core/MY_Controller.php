<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
    protected $_pageTitle;
    protected $_viewName;
    protected $_subFolder               = '';
    protected $_showTopNavigation       = TRUE;
    protected $_topSubNavigation        = array();
    protected $_showTopSubNavigation    = TRUE;
    protected $_showSideNavigation      = TRUE;
    protected $_user;
    protected $_loginRequired           = TRUE;
    protected $_flashData;
    protected $_isMaintenancePage       = FALSE;

    function __construct(){
        parent::__construct();

        /* Set default timezone
           ---------------------- */
        date_default_timezone_set($this->config->item('time_reference'));
        /* ---------------------- */

        /* Maintenance Page
           ---------------------- */
        $under_maintenance              = $this->config->item('under_maintenance');
        $this->data['under_maintenance']= $under_maintenance;
        if($under_maintenance['flag'] && !$this->_isMaintenancePage){
            redirect(base_url('maintenance'));
        }
        if(!$under_maintenance['flag'] && $this->_isMaintenancePage){
            redirect(base_url('login'));
        }
        /* ---------------------- */


        /* User authentication
           ---------------------- */
        $isLogged                       = $this->session->userdata('isLogged');
        $this->data['isLogged']         = $isLogged;
        if($isLogged){
            $this->_user                = $this->session->userdata('user');
            if($this->_user){
                $this->data['user']     = $this->_user;
                date_default_timezone_set($this->_user->TIMEZONE);

                /* Force user to change password if CHANGE_PWD_FLAG is 'Y'
                   ---------------------- */
                if($this->_user->CHANGE_PWD_FLAG == 'Y' && $this->excludeRedirects('password')  && !$this->input->is_ajax_request()){
                    redirect(base_url('account/password'));
                }
                /* ---------------------- */
            }
        } else {
            if($this->_loginRequired && $this->excludeRedirects('login')){
                redirect(base_url('login'));
            }
        }
        /* ---------------------- */

        /* Set flash data for view
           ---------------------- */
        $this->_flashData = $this->session->flashdata();
        $this->data['flashData']        = str_replace('.', '', $this->_flashData );    //workaround to remove automatic .'s in string.
        //view($this->_flashData);
        /* ---------------------- */


        /* Default view name is same as controller name, can be overwritten in derived controllers.
           ---------------------- */
        $this->_pageTitle               = ucwords(humanize(get_called_class()));
        $this->_viewName                = strtolower(get_called_class());
        /* ---------------------- */

    }

    protected function render_page() {
        /* Parameters that can be overwritten in the derived controller class
           ---------------------- */
        $this->data['pageTitle']            = $this->_pageTitle;
        $this->data['subFolder']            = $this->_subFolder;
        /* ---------------------- */

        /* Navigation
           ---------------------- */
        $this->data['social']               = $this->config->item('social');
        if($this->_showSideNavigation){
            $this->data['sidebar']          = $this->navigation->getSideNavigation();
        }
        $this->data['showTopNavigation']    = $this->_showTopNavigation;
        $this->data['topSubNavigation'] = array();
        $this->data['showTopSubNavigation'] = $this->_showTopSubNavigation;
        if($this->_showTopSubNavigation){
            $calledClass = strtolower(get_called_class());
            $topSubNavigation = array();
            foreach ($this->_topSubNavigation as $item => $value){
                $topSubNavigation[$item]    = ($value=='')?$calledClass:$calledClass."/".$value;

            }
            $this->data['topSubNavigation'] = $topSubNavigation;
        }
        $this->data['showSideNavigation']   = $this->_showSideNavigation;
        /* ---------------------- */

        $this->data['view']     = $this->_subFolder != '' ? $this->_subFolder.'/'.$this->_viewName : $this->_viewName;
        $this->load->view('_main', $this->data);
    }

    protected function show_404(){
        /* Parameters that can be overwritten in the derived controller class
           ---------------------- */
        $this->data['pageTitle']            = '404 Page Not Found';
        $this->data['subFolder']            = 'errors';
        /* ---------------------- */

        /* Navigation
           ---------------------- */
        $this->data['social']               = $this->config->item('social');
        if($this->_showSideNavigation){
            $this->data['sidebar']          = $this->navigation->getSideNavigation();
        }
        $this->data['showTopNavigation']    = $this->_showTopNavigation;
        $this->data['topSubNavigation'] = array();
        $this->data['showTopSubNavigation'] = $this->_showTopSubNavigation;
        if($this->_showTopSubNavigation){
            $calledClass = strtolower(get_called_class());
            $topSubNavigation = array();
            foreach ($this->_topSubNavigation as $item => $value){
                $topSubNavigation[$item]    = ($value=='')?$calledClass:$calledClass."/".$value;

            }
            $this->data['topSubNavigation'] = $topSubNavigation;
        }
        $this->data['showSideNavigation']   = $this->_showSideNavigation;
        /* ---------------------- */

        $this->data['view']     = '';
        $this->load->view('_main', $this->data);

    }

    protected function excludeRedirects($type){
        $exclude = array(
            'password'  => array('account/password', 'account/logout'),
            'login'     => array('login'),
        );
        if(in_array(uri_string(), $exclude[$type])){
            return FALSE;
        }
        return TRUE;
    }

}