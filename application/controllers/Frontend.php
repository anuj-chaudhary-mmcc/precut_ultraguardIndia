<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['Brand_model', 'Model_model', 'Feature_model']);
    }

    // Homepage or Brand Listing Page
    public function brands() {
        $data['brands'] = $this->Brand_model->get_all();
        $this->load->view('frontend/brands', $data);
    }

    // Car Models by Brand
    public function brand_models($brand_id) {
        $data['models'] = $this->db
            ->get_where('models', ['brand_id' => $brand_id])
            ->result();
        $data['brand'] = $this->Brand_model->get($brand_id);
        $this->load->view('frontend/brand_models', $data);
    }

    // Unified Features Page (3-level drilldown)
public function model_features($model_id)
{
    $model = $this->Model_model->get($model_id);
    if (!$model) {
        show_404();
    }

    $features = $this->Feature_model->get_by_model($model_id);

    foreach ($features as &$feature) {
        $feature->images = $this->Feature_model->get_images_by_feature($feature->id);
    }

    $brand = $this->Brand_model->get_brand($model->brand_id); // ✅ Fetch brand before loading view

    $data['model']    = $model;
    $data['features'] = $features;
    $data['brand']    = $brand;

    $this->load->view('precut/features', $data); // ✅ Now all data is passed
}




}
