<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Precut extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(['form', 'url']);
        $this->load->model(['Brand_model', 'Model_model', 'Feature_model']);
    }

    public function index()
    {
        $this->load->view('precut/home');
    }

    public function how_to_apply()
    {
        $this->load->view('precut/how-to-apply');
    }

    // INTERIOR FLOW
    // public function interior() {
    //     $data['brands'] = $this->Brand_model->get_by_category('interior');
    //     $this->load->view('precut/interior', $data);
    // }

    public function interior()
    {


        $this->load->model('Brand_model');

        $this->db->select('brands.*');
        $this->db->from('brands');
        $this->db->join('models', 'models.brand_id = brands.id');
        $this->db->join('features', 'features.model_id = models.id');
        $this->db->where('features.type', 'interior'); // Filter only exterior type
        $this->db->group_by('brands.id'); // Avoid duplicate brands

        $data['brands'] = $this->db->get()->result();

        $this->load->view('precut/interior', $data);
    }

    public function interior_models($brand_slug)
    {
        $brand = $this->Brand_model->get_by_slug($brand_slug);
        if (!$brand) show_404();

        $data['models'] = $this->Model_model->get_by_brand($brand->id);
        $data['brand'] = $brand;
        $this->load->view('precut/interior-models', $data);
    }

    public function interior_features($brand_slug, $model_slug)
    {
        $brand = $this->Brand_model->get_by_slug($brand_slug);
        if (!$brand) show_404();

        $model = $this->Model_model->get_by_slug_and_brand($model_slug, $brand->id);
        if (!$model) show_404();

        $features = $this->Feature_model->get_features_by_model_and_type($model->id, 'interior');
        foreach ($features as &$feature) {
            $feature->images = $this->Feature_model->get_images($feature->id);
        }

        $data = [
            'brand'    => $brand,
            'model'    => $model,
            'features' => $features,
            'type'     => 'interior'
        ];

        $this->load->view('precut/features', $data);
    }

    // EXTERIOR FLOW
    // public function exterior() {
    //     $data['brands'] = $this->Brand_model->all();  // ✅ fetch all brands



    //     $this->load->view('precut/brand_exterior', $data); // ✅ load the correct view
    // }


    public function exterior()
    {
        $this->load->model('Brand_model');

        $this->db->select('brands.*');
        $this->db->from('brands');
        $this->db->join('models', 'models.brand_id = brands.id');
        $this->db->join('features', 'features.model_id = models.id');
        $this->db->where('features.type', 'exterior'); // Filter only exterior type
        $this->db->group_by('brands.id'); // Avoid duplicate brands

        $data['brands'] = $this->db->get()->result();

        $this->load->view('precut/brand_exterior', $data);
    }


    // Step 1: Show all exterior brands
    public function exterior_brands()
    {
        $this->load->model('Brand_model');
        $data['brands'] = $this->Brand_model->get_all();
        $this->load->view('frontend/exterior-brands', $data);
    }

    // Step 2: Show models under selected brand



    // Step 3: Show exterior features with Swiper image slider


    public function exterior_features_by_id($model_id)
    {

        
        $model = $this->Model_model->get($model_id);
        if (!$model) show_404();

        $brand = $this->Brand_model->get($model->brand_id);
        if (!$brand) show_404();

        // Use same logic
        $features = $this->Feature_model->get_features_by_model_and_type($model->id, 'exterior');

        foreach ($features as &$feature) {
            $feature->images = $this->Feature_model->get_images($feature->id);
        }

        $data = [
            'brand'    => $brand,
            'model'    => $model,
            'features' => $features,
            'type'     => 'exterior'
        ];

        $this->load->view('precut/exterior-features', $data);
    }


    // LEGACY / FALLBACK
    public function all_models($brand_id = null)
    {
        if ($brand_id) {
            $data['models'] = $this->Model_model->get_by_brand($brand_id);
            $data['brand']  = $this->Brand_model->get($brand_id);
        } else {
            $data['models'] = $this->Model_model->get_all();
            $data['brand']  = null;
        }
        $this->load->view('precut/brands', $data);
    }

    public function model_features($brand_slug, $model_slug)
    {
        $type_slug = 'interior';
        // print_r($model_slug); exit;

        $brand_name = ucwords(str_replace('-', ' ', $brand_slug));
        $model_name = ucwords(str_replace('-', ' ', $model_slug));

        $brand = $this->Brand_model->get_by_name($brand_name);
        if (!$brand) show_404();

        $model = $this->Model_model->get_by_name_and_brand($model_name, $brand->id);
        if (!$model) show_404();
        //print_R($type_slug); exit;
        $features = $this->Feature_model->get_features_by_model_and_type($model->id, $type_slug);
        foreach ($features as &$feature) {
            $feature->images = $this->Feature_model->get_images($feature->id);
        }

        $data = [
            'brand'    => $brand,
            'model'    => $model,
            'features' => $features,
            'type'     => $type_slug
        ];

        $this->load->view('precut/features', $data);
    }

    public function exterior_features($brand_name, $model_name)
    {


        $brand_name = str_replace('-', ' ', $brand_name);
         $model_name = str_replace('-', ' ', $model_name);
   
        $brand = $this->Brand_model->get_by_name(ucfirst($brand_name));
        if (!$brand) show_404();
        //print_R($brand->id); exit;
        $model = $this->Model_model->get_by_name_and_brand(ucfirst($model_name), $brand->id);
        if (!$model) show_404();
        //print_R($model->id); exit;
        //print_R($model->id); exit;

        $features = $this->Feature_model->get_features_by_model_and_type($model->id, 'exterior');

        foreach ($features as &$feature) {
            $feature->images = $this->Feature_model->get_images($feature->id);
        }

        $data = [
            'brand'    => $brand,
            'model'    => $model,
            'features' => $features,
            'type'     => 'exterior'
        ];

        $this->load->view('precut/exterior-features', $data);
    }



    public function all_models_by_brand_name($brand_slug)
    {

        //print_r($brand_slug); exit;
        $brand_name = str_replace('-', ' ', $brand_slug);
        $brand = $this->db->get_where('brands', ['name' => ucfirst($brand_name)])->row();

        if (!$brand) show_404();

        $data['models'] = $this->Model_model->get_by_brand2($brand->id);

        // echo"<pre>";print_R( $data['models']); exit;
        $data['brand'] = $brand;

        $this->load->view('precut/brands', $data);
    }


    public function exterior_models($brand_name)
    {

             $brand_name = str_replace('-', ' ', $brand_name);
    

        $brand = $this->Brand_model->get_by_name(ucfirst($brand_name));

        // print_r( $brand_name); exit;

        //echo"<pre>"; print_R($brand ); exit;
        if (!$brand) show_404();
        //print_R($brand->id); exit;
        $models = $this->Model_model->get_by_brand3($brand->id);  // no category filtering

        //print_R($models); exit;

        // echo"<pre>"; print_R($models ); exit;
        //echo"<pre>"; print_R($brand->id ); exit;

        $data = [
            'brand'  => $brand,
            'models' => $models,
            'type'   => 'exterior'
        ];

        $this->load->view('precut/exterior-models', $data);
    }
}
