<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailConfig {

    public $config = array(
        'protocol' => 'smtp',
        'smtp_host' => 'mail.thedetailingmafia.com',
        'smtp_port' => 587,
        'smtp_user' => 'info@manmachinecarcare.com',
        'smtp_pass' => 'DetailingT@2022',
        'smtp_crypto' => 'tls',
        'mailtype' => 'html',
        'smtp_timeout' => '4',
        'charset' => 'iso-8859-1',
        'wordwrap' => TRUE,
        'newline' => "\r\n",
        'smtp_keepalive' => TRUE,
        'ssl_verify_peer' => FALSE,
    );
}
