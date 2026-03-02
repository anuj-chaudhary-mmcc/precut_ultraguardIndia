<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function details($slug = NULL) {
        if (!$slug) {
            show_404();
        }

        $data['slug'] = $slug;
        $view_path = 'manmachineautomotive/' . $slug;

        if (file_exists(APPPATH . 'views/' . $view_path . '.php')) {
            $this->load->view($view_path, $data);
        } else {
            show_404();
        }
    }
}
