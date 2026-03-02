<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_model extends CI_Model {

    // Get all models
    public function get_all() {
        return $this->db->get('models')->result();
    }

    // Get models by specific brand ID
public function get_by_brand($brand_id) {

    return $this->db->get_where('models', ['brand_id' => $brand_id])->result();
}

public function get_by_brand2($brand_id) {
    $this->db->distinct(); // ensures unique models
    $this->db->select('models.*');
    $this->db->from('features');
    $this->db->join('models', 'models.id = features.model_id');
    $this->db->where('features.type', 'interior');
    $this->db->where('models.brand_id', $brand_id);
    $this->db->where('features.model_id !=', null);

    return $this->db->get()->result();
}
public function get_by_brand3($brand_id) {
       $this->db->distinct(); // ensures unique models
    $this->db->select('models.*');
    $this->db->from('features');
    $this->db->join('models', 'models.id = features.model_id'); // correct join condition
    $this->db->where('features.type', 'exterior');
    $this->db->where('models.brand_id', $brand_id);
    $this->db->where('features.model_id !=', null); // safe null check

    return $this->db->get()->result();
}




public function get_by_slug_and_brand($slug, $brand_id) {
    return $this->db->get_where('models', ['slug' => $slug, 'brand_id' => $brand_id])->row();
}

public function get_by_model($model_id, $type = 'exterior') {
    return $this->db->get_where('features', ['model_id' => $model_id, 'type' => $type])->result();
}


    // Get a single model by ID
public function get($id)
{
    return $this->db->get_where('models', ['id' => $id])->row_array();
}


    // Get all models with their associated brand name
    public function get_all_with_brand() {
        $this->db->select('models.*, brands.name as brand_name');
        $this->db->from('models');
        $this->db->join('brands', 'brands.id = models.brand_id', 'left');
        return $this->db->get()->result();
    }

    // Insert a new model
    public function insert($data) {
        return $this->db->insert('models', $data);
    }
    public function get_brand_id_by_model($model_id)
{
    $this->db->select('brand_id');
    $this->db->from('models');
    $this->db->where('id', $model_id);
    $query = $this->db->get();
    $result = $query->row();
    return $result ? $result->brand_id : null;
}

    // Delete a model by ID
    public function delete($id) {
        return $this->db->delete('models', ['id' => $id]);
    }

    // Update a model by ID (optional: add if needed in future)
        public function update($id, $data)
        {
            $this->db->where('id', $id);
            $this->db->update('models', $data);
        }

public function get_by_name_and_brand($model_name, $brand_id)
{
    return $this->db
        ->where('LOWER(model_name)', strtolower($model_name))
        ->where('brand_id', $brand_id)
        ->get('models')
        ->row();
}


public function get_models_by_brand($brand_id)
{
    return $this->db->get_where('models', ['brand_id' => $brand_id])->result_array();
}

public function get_model_by_slug_and_brand($model_slug, $brand_id)
{
    $this->db->where('slug', $model_slug);
    $this->db->where('brand_id', $brand_id);
    $query = $this->db->get('models');  // replace with your actual table name
    return $query->row_array();
}

    
}
