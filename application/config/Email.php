<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emails extends CI_Controller {

    public function index() {
        // Load required libraries and helpers
        $this->load->library('email');
        $this->load->helper('url');
        $this->load->helper('form');

        // Email configuration
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.thedetailingmafia.com', 
            'smtp_port' => 25,
            'smtp_user' => 'info@manmachinecarcare.com',
            'smtp_pass' => 'DetailingT@2022',
            'smtp_crypto' => 'ssl',
            'mailtype' => 'html',
            'smtp_timeout' => '4',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE,
            'newline' => "\r\n"
        );

        // Initialize email library with the above config
        $this->email->initialize($config);

        // Set the email parameters
        $this->email->from('info@manmachinecarcare.com', 'Gopal');
        $this->email->to('info@ultrashieldx.com');
        $this->email->subject('Contact Us Form Submission');
        $this->email->message("Message: " . $this->input->post('message'));

        // Send email and check for success
        if ($this->email->send()) {
            echo "Email sent successfully!";
        } else {
            // Print email debug information in case of failure
            show_error($this->email->print_debugger());
        }
    }
}
