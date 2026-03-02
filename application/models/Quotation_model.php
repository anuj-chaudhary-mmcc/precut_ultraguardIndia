<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quotation_model extends CI_Model {

    public function insert($data) {
        return $this->db->insert('quotation_requests', $data);
    }
}
