<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by André Luis Otto.
 * Company: Datainfo
 * Date: 01/11/2017
 * Time: 15:29
 */

/**
 * Class Send_mail
 */
class Send_mail extends CI_Email
{
    private $default_sc_reply_to;
    private $ci;

    public function __construct() {
        parent::__construct();
        $this->ci = & get_instance();
        $this->ci->config->load('email');
        $this->default_sc_reply_to = $this->ci->config->item('default_sc_reply_to');
    }

    function log_prepare_data($param = array(), $msg) {
        $retPar = array();
        $retPar['SERCAL_ID']    = $param['SERCAL_ID'];
        $retPar['TO_EMAIL']     = str_replace(' ', ';', $param['TO_EMAIL']);
        $retPar['MSG']          = $msg;
        return $retPar;
    }

    function email_log($param = array(), $msg) {
        $this->ci = & get_instance();
        $this->ci->load->model('sys_application_errors','',TRUE);
        $this->ci->load->model('rep_service_calls','',TRUE);

        
        $param = $this->log_prepare_data($param, $msg);

        if(count($param) > 0) {
            $params = array();
            $params['SERCAL_ID'] = $param['SERCAL_ID'];
            $params['MESSAGE'] = '';

            switch ($param['MSG']) {
                case 'SCAPPRVREQDNOTIFY':
                    $params['MESSAGE'] = 'PO Request sent to';
                    break;
                case 'SCDISPATCHEDNOTIFY':
                    $params['MESSAGE'] = 'Dispatch email sent to';
                    break;
                case 'SCETANOTIFY':
                    $params['MESSAGE'] = 'ETA Email sent to';
                    break;
                case 'SCARRIVEDNOTIFY':
                    $params['MESSAGE'] = 'Arrived Email sent to';
                    break;
                case 'SCCOMPLETEDNOTIFY':
                    $params['MESSAGE'] = 'Completed Email sent to';
                    break;
            }

            $params['MESSAGE'] .= ' ' . $param['TO_EMAIL'];

            $params['USER_ID'] = getUserId();    
            
            $this->ci->sys_application_errors->emailLog($params);
        }


    }

    

    /**
     * @param $sc_resp_data
     */
    function new_sc_response($sc_resp_data) {
        $data = $sc_resp_data;
        $arrUpdate = array();
        $arrUpdate['EMAIL_NOTIFICATION'] = str_replace(' ', ';', $data['EMAIL_NOTIFICATION']);
        $arrUpdate['RESPONSE_TEXT'] = $data['RESPONSE_TEXT'];
        $arrUpdate['CALL_NUMBER'] = $data['CALL_NUMBER'];
        $arrUpdate['PREFERRED_NUMBER'] = $data['PREFERRED_NUMBER'];
        $arrUpdate['UNIT_NUMBER'] = $data['UNIT_NUMBER'];
        $arrUpdate['SC_URL'] = base_url('sc/servicecall_main').'?code='.$data['CALL_NUMBER'].'&action=E';
        $arrUpdate['USE_RESPONSE'] = login_user_name();
        $to = explode(';', $arrUpdate['EMAIL_NOTIFICATION'][0]);
        foreach ($to as $key => $value) {
            $return = $this->email('SCRESPONSENOTIFY',$arrUpdate, $value, $this->default_sc_reply_to);
        }
    }

    /**
     * @param $dsp_data
     *
     */
    function dispatch_notify($dsp_data) {
        $data = $dsp_data;
        $data['SC_URL'] = base_url('sc/servicecall_main').'?code='.$data['CALL_NUMBER'].'&action=E';
        if(isset($data['TO_EMAIL']) && !empty($data['TO_EMAIL'])) {
            $to_email = str_replace(' ', ';', $data['TO_EMAIL']);
            $to_email = explode(';', $to_email);
            $this->email_log($data, 'SCDISPATCHEDNOTIFY');
            foreach ($to_email as $key => $value) {
                $value = trim($value);
                if(!empty($value)) {
                    $return = $this->email('SCDISPATCHEDNOTIFY', $data, $value, $this->default_sc_reply_to);
                }
            }
        }
    }

    /**
     * @param $dsp_data
     */
    function eta_notify($dsp_data) {
        $data = $dsp_data;
        $data['SC_URL'] = base_url('sc/servicecall_main').'?code='.$data['CALL_NUMBER'].'&action=E';
        $to_email = str_replace(' ', ';', $data['TO_EMAIL']);
        $to_email = explode(';', $to_email);
        $this->email_log($data, 'SCETANOTIFY');
        foreach ($to_email as $key => $value) {
            $return = $this->email('SCETANOTIFY', $data, $value, $this->default_sc_reply_to);
        }
    }

    /**
     * @param $dsp_data
     */
    function arrived_notify($dsp_data) {
        $data = $dsp_data;
        $data['SC_URL'] = base_url('sc/servicecall_main').'?code='.$data['CALL_NUMBER'].'&action=E';
        $to_email = str_replace(' ', ';', $data['TO_EMAIL']);
        $to_email = explode(';', $to_email);
        $this->email_log($data, 'SCARRIVEDNOTIFY');
        foreach ($to_email as $key => $value) {
            $return = $this->email('SCARRIVEDNOTIFY', $data, $value, $this->default_sc_reply_to);
        }
    }

    function po_request($dsp_data) {
        $data = $dsp_data;
        $data['SC_APPROVAL_URL'] = base_url('sc/servicecall_po_request/index')."/".base64_encode($data['SERCAL_ID']);
        $data['TO_EMAIL'] = $data['EMAIL'];
        $to_email = str_replace(' ', ';', $data['TO_EMAIL']);
        $to_email = explode(';', $to_email);
        $this->email_log($data, 'SCAPPRVREQDNOTIFY');
        foreach ($to_email as $key => $value) {
            $return = $this->email('SCAPPRVREQDNOTIFY', $data, $value, $this->default_sc_reply_to);
        }
    }

    /**
     * @param $dsp_data
     */
    function completed_notify($dsp_data) {
        // missing urgent flag and loaded flag
        $data = $dsp_data;
        $data['SC_URL'] = base_url('sc/servicecall_main').'?code='.$data['CALL_NUMBER'].'&action=E';
        $to_email = str_replace(' ', ';', $data['TO_EMAIL']);
        $to_email = explode(';', $to_email);
        $this->email_log($data, 'SCCOMPLETEDNOTIFY');
        foreach ($to_email as $key => $value) {
            $return = $this->email('SCCOMPLETEDNOTIFY', $data, $value, $this->default_sc_reply_to);
        }
    }

    /**
     * @param $approved_data
     */
    function approved_notify($approved_data) {
        $return = $this->email('SCAPPRVREQDNOTIFY',$approved_data);
    }

    /**
     * @param $approved_data
     */
    function assigned_notify($approved_data) {
        $return = $this->email('SCASSIGNNOTIFY',$arrUpdate);   
    }
    
    /**
     * @param $template
     * @param $replace_params
     * @return bool
     */
    public function email($template, $replace_params = array(), $to_email, $reply_to = null, $cc = null, $from = null) {
        $this->ci = & get_instance();
        $this->ci->load->model('sys_email_templates','',TRUE);
        if(!empty($template)) {
            $tpl = $this->ci->sys_email_templates->get_template_by_code($template);
            if(count($tpl) > 0){
                $tpl = $this->prepare($tpl, $replace_params);
            }
            return $this->do_send($tpl, $to_email, $reply_to, $cc, $from);
        } else {
            return false;
        }
    }

    /**
     * @param $tpl
     * @param $replace_params
     * @param string $text
     * @return bool|string|void
     */
    public function prepare($tpl, $replace_params, $text = '') {
        if(!empty($tpl) && count($replace_params) > 0) {
            $eml = $this->tpl_replace($tpl,$replace_params);
        } else if(!empty($tpl)) {
            $eml = $tpl;
        } else {
            if(!empty($text)) {
                $eml = $text;
            } else {
                $eml = false;
            }
        }

        return $eml;
    }

    /**
     * @param $tpl
     * @param $replace_params
     * @return mixed
     */
    public function tpl_replace($tpl, $replace_params) {
        foreach ($replace_params as $key => $val) {
            $tpl = str_replace('${' . $key . '}', $val, $tpl);
        }
        return $tpl;
    }

    /**
     * @return bool
     */
    public function do_send($tpl, $to_email, $reply_to = null, $cc = null, $from = null) {
        $this->ci = & get_instance();

        $from_mail = getEmail();    
        if ($from) {
            $from_mail = $from;
        }

        $cc_email = "";
        if ($cc) {
            $cc_email  = $cc;             
        }

        // Check debug mode Begin
        $this->ci->config->load('email');
        $debug_mode = $this->ci->config->item('debug_mode');
        $debug_email = $this->ci->config->item('debug_email');
        if($debug_mode) {
            $to_mail = $debug_email;
        } else {
            $to_mail = $to_email;
        }
        // Check debug mode End
        
        // Reply To Begin
        $default_reply_to = $this->ci->config->item('default_reply_to');
        if(!empty($reply_to)) {
            $rep_to = $reply_to;
        } else if(!empty($default_reply_to)) {
            $rep_to = $default_reply_to;
        } else {
            $rep_to = $from_mail;
        }
        // Reply To End
        
        $result = $this->ci->email
            ->from($from_mail)
            ->reply_to($rep_to)
            ->cc($cc_email)
            ->to($to_mail)
            ->subject($tpl['EMAIL_SUBJECT'])
            ->message($tpl['EMAIL_BODY'])
            ->send();


        return $result;
    }

}

/* End of file Send_mail.php */
/* Location: ./application/libraries/Send_mail.php */
