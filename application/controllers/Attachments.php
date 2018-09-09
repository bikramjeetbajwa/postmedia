<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attachments extends MY_Controller {
    private $_return_code       = '';
    private $_return_data       = '';
    private $_upload_config     = array();
    private $_upload_config_sc  = array();

    function __construct() {

        parent::__construct();

        $this->load->model('Rla_attachments');
        $this->load->library('upload');

        //Set default config values for
        $config_attachments                     = $this->config->item('attachments');
        $this->_upload_config['upload_path']    = $config_attachments['upload_path'];
        $this->_upload_config['allowed_types']  = $config_attachments['allowed_types'];
        $this->_upload_config['max_size']       = $this->get_upload_max_filesize_bytes();   //$config_attachments['max_filesize'];    //'0';
        $this->_upload_config['max_width']      = '';
        $this->_upload_config['max_height']     = '';

        if(!file_exists($this->_upload_config['upload_path'])) {
            mkdir($this->_upload_config['upload_path'] , 0777, true);
        }
    }

    public function index() {

    }

    public function save() {
        $data = $this->input->post();
        if(count($data) > 0){
            if($data['SOURCE_ORASEQ'] != ''){
                $this->_upload_config['upload_path'] .= $this->_upload_config['upload_path'].strtolower($data['SOURCE_TABLE']).'/'.$data['SOURCE_ORASEQ'];
                if(!file_exists($this->_upload_config['upload_path'])) {
                    mkdir($this->_upload_config['upload_path'] , 0777, true);
                }
                $this->upload->initialize( $this->_upload_config, $reset = TRUE );
                if( !$this->upload->do_upload('fileAttachment') ){
                    $this->_return_code = 'ERROR';
                    $this->_return_data = array(
                        'message'   => $this->upload->display_errors('','')
                    );
                }else{
                    $uploaded_file_data         = $this->upload->data();
                    $data['ATT_ID']             = $this->Rla_attachments->get_next_id();
                    $data['ATTACH_FILETYPE']    = $uploaded_file_data['file_type'];
                    $data['ATTACH_TYPE']        = 'ATTACHMENTS';
                    $data['ATTACH_NAME']        = $uploaded_file_data['file_name'];
                    $data['ATTACH_PATH']        = $uploaded_file_data['full_path'];
                    if($this->Rla_attachments->insert($data)){
                        $this->_return_code = 'SUCCESS';
                    }else{
                        $this->_return_code = 'ERROR';
                        $this->_return_data = array(
                            'message'   => 'Upload fail..'
                        );
                        //TODO: remove physical file
                    }
                }
            }
            else {

                // upload file in the temp folder - this temp number  should come from the database
                $config_attachments                            = $this->config->item('attachments');
                $this->_upload_config['upload_path']            = $config_attachments['temp_upload_path'].'/'.strtolower($data['SOURCE_TABLE']).'/'.getUserId().'/'.$data['RANDOM_SEQ'];

                if(!file_exists($this->_upload_config['upload_path'])) {
                    mkdir($this->_upload_config['upload_path'] , 0777, true);
                }
                $this->upload->initialize( $this->_upload_config, $reset = TRUE );

                if( !$this->upload->do_upload('fileAttachment') ){

                    $message = $this->upload->display_errors('','');
                    print_r($message);
                    header("HTTP/1.0 400 Bad Request");
                }
                header('Content-Type: text/plain;');
                $data = array('status' => 'ok');
                echo json_encode($data); die();
            }
        }
        else{

        }
    }

    public function get() {
        $data = $this->input->post();
        $resultAttachments = array();
        if(count($data) > 0){
            if($data['SOURCE_ORASEQ']) {
                if (isset($data)) {
                    $conditions = array(
                        'SOURCE_ORASEQ' => $data['SOURCE_ORASEQ'],
                        'SOURCE_TABLE' => $data['SOURCE_TABLE'],
                    );

                    $this->Rla_attachments->_database->select('ATT_ID, ATTACH_FILETYPE, ATTACH_TYPE, ATTACH_NAME, CREATE_DATE, SOURCE_ORASEQ, ATTACH_PATH ');
                    $resultAttachments = $this->Rla_attachments->get_many_by($conditions);
                    $local_timezone = new DateTimeZone(date_default_timezone_get());
                    foreach($resultAttachments as $key=>$val){

                        $resultAttachments[$key]->CREATE_DATE = convert_to_local($resultAttachments[$key]->CREATE_DATE, 'm/d/Y');
                    }
                }
            }else{
                //temp files get
                $config_attachments                 = $this->config->item('attachments');
                $temp_dir                           = $config_attachments['temp_upload_path'].'/'.strtolower($data['SOURCE_TABLE']).'/'.getUserId().'/'.$data['RANDOM_SEQ'];
                if(is_dir($temp_dir)){
                    $temp_files                     = scandir($temp_dir);
                    array_splice($temp_files,0,2);
                    foreach($temp_files as $key => $file){
                        $obj                        = new stdClass();
                        $path_parts                 = pathinfo($file);
                        $obj->ATT_ID                = 0 ; //$this->Rla_attachments->get_next_id(); // TODO: not sure if needed
                        $obj->ATTACH_FILETYPE       = $path_parts['extension'];
                        $obj->ATTACH_TYPE           = 'ATTACHMENTS';
                        $obj->ATTACH_NAME           = $path_parts['basename'];
                        $obj->ATTACH_PATH           = $temp_dir;
                        $obj->CREATE_DATE           = date ("F d Y H:i:s", filectime($temp_dir)); //TODO: fix this
                        $resultAttachments[$key]    = $obj;
                    }
                }
            }
        }
        show_json_result($resultAttachments, true);
    }

    public function show() {

    }



    protected function get_upload_max_filesize_bytes() {
        $val    = ini_get("upload_max_filesize");
        $val    = trim($val);
        $last   = strtolower($val[strlen($val)-1]);
        switch($last) {
            // The 'G' modifier is available since PHP 5.1.0
            case 'g':
                $val *= 1024;
            case 'm':
                $val *= 1024;
            case 'k':
                $val *= 1024;
        }
        return $val;
}







}

