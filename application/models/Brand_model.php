<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand_model extends CI_Model {

    public function get_all() {
        return $this->db->get('brands')->result();
    }

    public function get($id) {
        return $this->db->get_where('brands', ['id' => $id])->row();
    }

public function update($id, $data)
{
    $this->db->where('id', $id);
    return $this->db->update('brands', $data);
}

    public function get_by_category($category)
{
    return $this->db->get_where('brands', ['category' => $category])->result();
}

public function delete($id)
{
    return $this->db->delete('brands', ['id' => $id]);
}

public function insert($data) {
    return $this->db->insert('brands', $data);
}
public function get_brand($id)
{
    return $this->db->get_where('brands', ['id' => $id])->row();
}


public function get_by_name($name)
{
    return $this->db
        ->where('LOWER(name)', strtolower($name))
        ->get('brands')
        ->row();
}

public function all() {
    return $this->db->get('brands')->result(); // ✅ fetch all brands from table
}

public function get_by_slug($slug) {
    return $this->db->get_where('brands', ['slug' => $slug])->row();
}

public function get_brand_by_slug($slug)
{
    $this->db->where('slug', $slug);
    $query = $this->db->get('brands');  // replace with your actual table name
    return $query->row_array();
}


}