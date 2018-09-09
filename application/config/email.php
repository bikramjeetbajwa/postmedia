<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


$config['useragent'] 		 = 'PHPMailer';
$config['charset'] 			 = 'utf-8';
$config['newline'] 			 = "\r\n";
$config['mailtype'] 		 = 'html';
$config['smtp_crypto'] 		 = 'ssl';
$config['protocol'] 		 = 'smtp';
$config['smtp_host'] 		 = 'mail.smtp2go.com';
$config['smtp_port'] 		 = '465';
$config['smtp_user'] 		 = 'nomail@nomail.com';
$config['smtp_pass'] 		 = '123456789';
$config['smtp_timeout']      = 120;
$config['smtp_debug']        = 0;
$config['smtp_auto_tls']     = true;
$config['smtp_conn_options'] = array();
$config['wordwrap']          = true;
$config['wrapchars']         = 76;
$config['validate']          = true;
$config['priority']          = 3;
$config['crlf']              = "\n";
$config['bcc_batch_mode']    = false;
$config['bcc_batch_size']    = 200;
$config['encoding']          = '8bit';

