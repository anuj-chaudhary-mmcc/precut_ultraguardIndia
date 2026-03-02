<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feature_model extends CI_Model {

    public function get_all_with_model() {
        $this->db->select('features.*, models.model_name');
        $this->db->from('features');
        $this->db->join('models', 'models.id = features.model_id');
        return $this->db->get()->result();
    }

    public function insert($data) {
        $this->db->insert('features', $data);
        return $this->db->insert_id();
    }

    public function delete($id) {
        return $this->db->delete('features', ['id' => $id]);
    }

    public function insert_image($data) {
        return $this->db->insert('feature_images', $data);
    }

    public function get_images_by_feature($feature_id) {
        return $this->db->get_where('feature_images', ['feature_id' => $feature_id])->result();
    }

    // ✅ Add this method to fix your error
    public function get_images($feature_id) {
        return $this->db->get_where('feature_images', ['feature_id' => $feature_id])->result();
    }

public function get_all_with_images()
{
    $this->db->select('features.*, models.brand_id, brands.name as brand_name, 
                      (SELECT image FROM feature_images WHERE feature_id = features.id LIMIT 1) as image');
    $this->db->from('features');
    $this->db->join('models', 'features.model_id = models.id');
    $this->db->join('brands', 'models.brand_id = brands.id');
    return $this->db->get()->result();
}



public function get($id)
{
    $this->db->select('features.*, models.brand_id, brands.name as brand_name');
    $this->db->from('features');
    $this->db->join('models', 'features.model_id = models.id');
    $this->db->join('brands', 'models.brand_id = brands.id');
    $this->db->where('features.id', $id);
    return $this->db->get()->row();
}


public function update($id, $data)
{
    return $this->db->where('id', $id)->update('features', $data);
}
public function get_by_model($model_id)
{
    return $this->db->get_where('features', ['model_id' => $model_id])->result();
}

public function delete_images_by_feature($feature_id)
{
    $this->db->where('feature_id', $feature_id);
    $this->db->delete('feature_images');
}

public function get_by_model_and_type($model_id, $type) {
    $this->db->where('model_id', $model_id);
    $this->db->where('type', $type);
    $query = $this->db->get('features');
    $features = $query->result();

    foreach ($features as &$feature) {
        $feature->images = $this->get_images($feature->id);
    }

    return $features;
}
public function add_image($data) {
    return $this->db->insert('feature_images', $data);
}

public function get_features_by_model($model_id, $type = null)
{
    $this->db->select('*');
    $this->db->from('features');
    $this->db->where('model_id', $model_id);
    
    if ($type !== null) {
        $this->db->where('type', $type); // Only if you have a 'type' column like 'interior' / 'exterior'
    }

    $query = $this->db->get();
    return $query->result();
}

// Feature_model.php
public function get_features_by_model_and_type($model_id, $type) {
    $this->db->where('model_id', $model_id);
    $this->db->where('type', $type); // 'interior' or 'exterior'
    $query = $this->db->get('features');
    return $query->result();
}

public function delete_image($id)
{
    $this->db->where('id', $id)->delete('feature_images');
}

public function get_image_by_id($id)
{
    return $this->db->get_where('feature_images', ['id' => $id])->row();
}


}
