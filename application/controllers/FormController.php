<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emails extends CI_Controller {

    public function index() {
        // Load required libraries and helpers
        $this->load->library('email');
        $this->load->helper('url');
        $this->load->helper('form');
        
        // Check if form is submitted
        if ($this->input->post()) {
            // Get form data
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $message = $this->input->post('message');

            // Email configuration
            $config = array(
                'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
                'smtp_host' => 'mail.thedetailingmafia.com', 
                'smtp_port' => 25,
                'smtp_user' => 'info@manmachinecarcare.com',
                'smtp_pass' => 'DetailingT@2022',
                'smtp_crypto' => 'ssl', // 'ssl' or 'tls'
                'mailtype' => 'html', // 'text' or 'html'
                'smtp_timeout' => '4', // Timeout in seconds
                'charset' => 'iso-8859-1',
                'wordwrap' => TRUE,
                'newline' => "\r\n"
            );

            // Initialize email library with the above config
            $this->email->initialize($config);

            // Set the email parameters
            $this->email->from($email, $name); // From user email and name
            $this->email->to('info@ultrashieldx.com'); // To your desired recipient email
            $this->email->subject('Contact Us Form Submission');
            $this->email->message("Message: " . $message); // The content of the form message

            // Send email and check for success
            if ($this->email->send()) {
                echo "Email sent successfully!";
            } else {
                // Print email debug information in case of failure
                show_error($this->email->print_debugger());
            }
        } else {
            // Load the contact us view if form is not submitted
            $this->load->view('manmachineautomotive/contact-us');
        }
    }
}
?>
