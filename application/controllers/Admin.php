<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database(); 
        $this->load->model(['Brand_model', 'Model_model', 'Feature_model']);
        $this->load->library(['session', 'upload']);
        $this->load->helper(['url', 'form']);
    }
    
     private function is_logged_in() {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
    }

    // ===================== AUTH =====================
    public function login() {
    if ($this->input->post()) {
        $email    = $this->input->post('email');
        $password = md5($this->input->post('password')); // optional: use password_hash() later

        $admin = $this->db->get_where('admin_users', [
            'email'    => $email,
            'password' => $password
        ])->row();

        if ($admin) {
            // Set structured session data
            $this->session->set_userdata([
                'admin_logged_in' => true,
                'admin_id'        => $admin->id,
                'admin_email'     => $admin->email,
                'admin_name'      => $admin->name  // ✅ store name for display
            ]);

            redirect('admin/dashboard');
        } else {
            $this->session->set_flashdata('error', 'Invalid email or password');
            redirect('admin/login');
        }
    }

    $this->load->view('admin/login');
}


   public function logout() {
        $this->session->unset_userdata('admin_logged_in');
        $this->session->unset_userdata('admin_id');
        $this->session->unset_userdata('admin_email');
        $this->session->unset_userdata('admin_name');
        redirect('admin/login');
    }

  public function dashboard() {
        $this->is_logged_in();
        $this->load->view('admin/dashboard');
    }


    // ===================== BRANDS =====================
  // For list
         // ===================== BRANDS =====================
    public function brands() {
        $this->is_logged_in();
        $data['brands'] = $this->Brand_model->get_all();
        $data['show_form'] = false;
        $this->load->view('admin/brands', $data);
    }

        public function brands_add() {
        $this->is_logged_in();
        $data['show_form'] = true;
        $this->load->view('admin/brands', $data);
    }


    public function add_brand() {
         $this->is_logged_in();
    $data = $this->input->post();

    if (!empty($_FILES['image']['name'])) {
        $config['upload_path'] = './assets/images/brands/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
        $this->upload->initialize($config);

        if ($this->upload->do_upload('image')) {
            $upload_data = $this->upload->data();
            $data['image'] = $upload_data['file_name'];
        } else {
            echo $this->upload->display_errors();
            return;
        }
    }

    // ✅ Added for top_image
    if (!empty($_FILES['top_image']['name'])) {
        $config['upload_path'] = './assets/images/brands/';
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $this->upload->initialize($config);

        if ($this->upload->do_upload('top_image')) {
            $upload_data = $this->upload->data();
            $data['top_image'] = $upload_data['file_name'];
        } else {
            echo $this->upload->display_errors();
            return;
        }
    }

    $this->Brand_model->insert($data);
    redirect('admin/brands');
    }


    public function brands_edit($id) {
          $this->is_logged_in();
        $data['brand'] = $this->Brand_model->get($id);
        if (!$data['brand']) {
            show_404();
        }
        $this->load->view('admin/brands-edit', $data);
    }

    public function brands_update($id)
    
{
     $this->is_logged_in();
    $brand = $this->Brand_model->get($id);
    if (!$brand) show_404();

    $name = $this->input->post('name');
    $image = $brand->image; // old image
    $top_image = $brand->top_image; // ✅ Keep old top image

    if (!empty($_FILES['image']['name'])) {
        $config['upload_path']   = './assets/images/brands/';
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['file_name']     = time() . '_' . $_FILES['image']['name'];
        $config['overwrite']     = TRUE;
        $config['max_size']      = 2048;

        $this->upload->initialize($config);

        if ($this->upload->do_upload('image')) {
            if (!empty($brand->image) && file_exists($config['upload_path'] . $brand->image)) {
                unlink($config['upload_path'] . $brand->image);
            }

            $uploadData = $this->upload->data();
            $image = $uploadData['file_name'];
        } else {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('admin/brands-edit/' . $id);
            return;
        }
    }

    // ✅ Upload and replace top_image if provided
    if (!empty($_FILES['top_image']['name'])) {
        $config['upload_path']   = './assets/images/brands/';
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['file_name']     = time() . '_' . $_FILES['top_image']['name'];
        $config['overwrite']     = TRUE;
        $config['max_size']      = 2048;

        $this->upload->initialize($config);

        if ($this->upload->do_upload('top_image')) {
            if (!empty($brand->top_image) && file_exists($config['upload_path'] . $brand->top_image)) {
                unlink($config['upload_path'] . $brand->top_image);
            }

            $uploadData = $this->upload->data();
            $top_image = $uploadData['file_name'];
        } else {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('admin/brands-edit/' . $id);
            return;
        }
    }

    $data = [
        'name'      => $name,
        'image'     => $image,
        'top_image' => $top_image // ✅ include top image in update
    ];

    $this->Brand_model->update($id, $data);
    $this->session->set_flashdata('success', 'Brand updated successfully.');
    redirect('admin/brands');
}



    public function delete_brand($id) {
        $this->Brand_model->delete($id);
        redirect('admin/brands');
    }
public function brand_add() {
    $this->is_logged_in();
    $this->load->view('admin/brands-add');
}


    // ===================== MODELS =====================
    public function models($brand_id = null) {
        $this->is_logged_in();
        $data['brands'] = $this->Brand_model->get_all();

        if ($brand_id) {
            $data['selected_brand'] = $this->Brand_model->get($brand_id);
            $data['models'] = $this->Model_model->get_by_brand($brand_id);
        } else {
            $data['selected_brand'] = null;
            $data['models'] = [];
        }

        $this->load->view('admin/models-list', $data);
    }

public function models_view($id)
{
    $this->is_logged_in(); // optional login check
    $data['model'] = $this->Model_model->get($id);

    if (!$data['model']) {
        show_404(); // if model not found
    }

    $this->load->view('admin/models-edit', $data);
}


// Load model add form with brand list, optionally preselect a brand
    public function models_add($brand_id = null) {
        $this->is_logged_in();
        $data['brands'] = $this->Brand_model->get_all();
        $data['selected_brand_id'] = $brand_id;
        $this->load->view('admin/models-add', $data);
    }


    public function models_edit($id) {
        $data['model']  = $this->Model_model->get($id);
        $data['brands'] = $this->Brand_model->get_all();
        $this->load->view('admin/models-edit', $data);
    }
public function models_delete($id) {
        $this->is_logged_in(); // Optional
         if ($id === null) {
        show_404(); // or handle the error gracefully
        return;
    }
        if ($this->Model_model->delete($id)) {
            $this->session->set_flashdata('success', 'Model deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Delete failed.');
        }
        redirect('admin/models');
    }






    public function models_insert()
{
     $this->is_logged_in();
    $data = [
        'brand_id'    => $this->input->post('brand_id'),
        'model_name'  => $this->input->post('model_name')
    ];

    $upload_path = './assets/images/brand-model/';
    $config = [
        'upload_path'   => $upload_path,
        'allowed_types' => 'jpg|jpeg|png|webp',
        'max_size'      => 2048,
        'encrypt_name'  => TRUE
    ];

    $this->load->library('upload');

    // === Upload thumbnail image ===
    if (!empty($_FILES['image']['name'])) {
        $this->upload->initialize($config);
        if ($this->upload->do_upload('image')) {
            $uploadData = $this->upload->data();
            $data['image'] = $uploadData['file_name']; //  Save to database
        } else {
            $this->session->set_flashdata('error', 'Image Upload Error: ' . $this->upload->display_errors());
            redirect('admin/models-add');
            return;
        }
    }

    // === Upload top_image ===
    if (!empty($_FILES['top_image']['name'])) {
        $this->upload->initialize($config); // reinitialize for second file
        if ($this->upload->do_upload('top_image')) {
            $uploadData = $this->upload->data();
            $data['top_image'] = $uploadData['file_name']; //Save to database
        } else {
            $this->session->set_flashdata('error', 'Top Image Upload Error: ' . $this->upload->display_errors());
            redirect('admin/models-add');
            return;
        }
    }

    //Save all data including top_image and image
    $this->db->insert('models', $data);

    $this->session->set_flashdata('success', 'Model added successfully.');
    redirect('admin/models/' . $data['brand_id']);
}



public function models_update($id) 
{
    $this->is_logged_in();
    $brand_id   = $this->input->post('brand_id');
    $model_name = $this->input->post('model_name');

    if (!$brand_id || !$model_name) {
        $this->session->set_flashdata('error', 'Brand and Model name are required.');
        redirect('admin/models-edit/' . $id);
        return;
    }

    // Fetch existing model for old image deletion
    $model = $this->db->get_where('models', ['id' => $id])->row();

    $data = [
        'brand_id'   => $brand_id,
        'model_name' => $model_name
    ];

    $upload_path = './assets/images/brand-model/';
    $config = [
        'upload_path'   => $upload_path,
        'allowed_types' => 'jpg|jpeg|png|webp',
        'max_size'      => 2048,
        'encrypt_name'  => TRUE
    ];

    $this->load->library('upload');

    // === Upload and replace thumbnail image ===
    if (!empty($_FILES['image']['name'])) {
        $this->upload->initialize($config);
        if ($this->upload->do_upload('image')) {
            // Delete old thumbnail image
            if (!empty($model->image) && file_exists($upload_path . $model->image)) {
                unlink($upload_path . $model->image);
            }

            $upload_data = $this->upload->data();
            $data['image'] = $upload_data['file_name'];
        } else {
            $this->session->set_flashdata('error', 'Image Upload Error: ' . $this->upload->display_errors());
            redirect('admin/models-edit/' . $id);
            return;
        }
    }

    // === Upload and replace top image ===
    if (!empty($_FILES['top_image']['name'])) {
        $this->upload->initialize($config);
        if ($this->upload->do_upload('top_image')) {
            // Delete old top image
            if (!empty($model->top_image) && file_exists($upload_path . $model->top_image)) {
                unlink($upload_path . $model->top_image);
            }

            $upload_data = $this->upload->data();
            $data['top_image'] = $upload_data['file_name'];
        } else {
            $this->session->set_flashdata('error', 'Top Image Upload Error: ' . $this->upload->display_errors());
            redirect('admin/models-edit/' . $id);
            return;
        }
    }

    // === Final update ===
    $this->db->where('id', $id);
    $this->db->update('models', $data);

    $this->session->set_flashdata('success', 'Model updated successfully.');
    redirect('admin/models/' . $brand_id);
}

    // ===================== FEATURES =====================
public function features($brand_id = null, $model_id = null)
{
     $this->is_logged_in();
    $this->load->model(['Brand_model', 'Model_model', 'Feature_model']);

    $data['brands'] = $this->Brand_model->get_all();

    if ($brand_id && !$model_id) {
        $data['selected_brand'] = $this->Brand_model->get($brand_id);
        $data['models'] = $this->Model_model->get_by_brand($brand_id);
    } elseif ($brand_id && $model_id) {
        $data['selected_brand'] = $this->Brand_model->get($brand_id);
        $data['selected_model'] = $this->Model_model->get($model_id);
        $data['features'] = $this->Feature_model->get_all_with_images();
        $features = $this->Feature_model->get_by_model($model_id);

        foreach ($features as &$feature) {
            $feature->images = $this->Feature_model->get_images($feature->id);
            $feature->price = number_format($feature->price, 0, ',', '.');
        }

        $data['features'] = $features;
    }

    $this->load->view('admin/features', $data);
}




public function features_add() {
    $this->is_logged_in();

    // If form is submitted
    if ($this->input->post()) {
        // Save basic feature data
        $data = [
            'model_id'     => $this->input->post('model_id'),
            'name'         => $this->input->post('name'),
            'feature_name' => $this->input->post('feature_name'),
            'part_code'    => $this->input->post('part_code'),
            'type'         => $this->input->post('type')  // interior / exterior
        ];

        // Insert feature record
        $this->db->insert('features', $data);
        $feature_id = $this->db->insert_id();

        // Handle multiple image uploads
        if (!empty($_FILES['images']['name'][0])) {
            $filesCount = count($_FILES['images']['name']);
            for ($i = 0; $i < $filesCount; $i++) {
                $_FILES['file']['name']     = $_FILES['images']['name'][$i];
                $_FILES['file']['type']     = $_FILES['images']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['images']['error'][$i];
                $_FILES['file']['size']     = $_FILES['images']['size'][$i];

                $uploadPath = './assets/images/brand-model/';
                $config['upload_path']   = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
                $config['encrypt_name']  = TRUE;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {
                    $fileData = $this->upload->data();
                    $uploadData = [
                        'feature_id' => $feature_id,
                        'image_path' => 'assets/images/brand-model/' . $fileData['file_name']
                    ];
                    $this->db->insert('feature_images', $uploadData);
                }
            }
        }

        $this->session->set_flashdata('success', 'Feature added successfully.');
        redirect('admin/features');
    }

    // Load form view if not submitted
    $data['models'] = $this->Model_model->get_all();
    $this->load->view('admin/features-add', $data);
}


    public function add_feature() {
        $this->is_logged_in();
        $feature_id = $this->Feature_model->insert($this->input->post());

        $files = $_FILES;
        $count = count($_FILES['images']['name']);

        for ($i = 0; $i < $count; $i++) {
            $_FILES['image']['name']     = $files['images']['name'][$i];
            $_FILES['image']['type']     = $files['images']['type'][$i];
            $_FILES['image']['tmp_name'] = $files['images']['tmp_name'][$i];
            $_FILES['image']['error']    = $files['images']['error'][$i];
            $_FILES['image']['size']     = $files['images']['size'][$i];

            $config['upload_path']   = './assets/images/brand-model/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
            
            $this->upload->initialize($config);

            if ($this->upload->do_upload('image')) {
                $data = [
                    'feature_id' => $feature_id,
                    'image_path' => $this->upload->data('file_name')
                ];
                $this->Feature_model->insert_image($data);
            }
        }

        redirect('admin/features');
    }

public function features_edit($id)
{
    $this->is_logged_in();
    $this->load->model(['Brand_model', 'Model_model', 'Feature_model']);

    $feature = $this->Feature_model->get($id);
    if (!$feature) {
        show_404();
    }

    // Attach brand_id if not present
    if (!isset($feature->brand_id)) {
        $model = $this->Model_model->get($feature->model_id);
        $feature->brand_id = $model ? $model->brand_id : null;
    }

    // Get images
    $feature->images = $this->Feature_model->get_images($id);

    $data['feature'] = $feature;
    $data['brands'] = $this->Brand_model->get_all();
    $data['models'] = $this->Model_model->get_by_brand($feature->brand_id);

    $this->load->view('admin/features-edit', $data);
}



public function features_update($id)
{
    $this->is_logged_in();

    if ($this->input->post()) {
        $data = [
            'model_id'     => $this->input->post('model_id'),
            'name'         => $this->input->post('name'),
            'feature_name' => $this->input->post('feature_name'),
            'part_code'    => $this->input->post('part_code'),
            'type'         => $this->input->post('type'),
            'price'        => $this->input->post('price')
        ];

        // Update feature in DB
        $this->Feature_model->update($id, $data);

        // If new images uploaded
        if (!empty($_FILES['images']['name'][0])) {
            // Fetch old images (assumes get_images returns array of objects)
            $old_images = $this->Feature_model->get_images($id);
            foreach ($old_images as $img) {
                $path = FCPATH . $img->image_path; // use -> instead of ['']
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            // Delete image records
            $this->Feature_model->delete_images_by_feature($id);

            // Setup file uploads
            $files = $_FILES;
            $count = count($files['images']['name']);
            
            $config['upload_path']   = './assets/images/brand-model/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
            $config['max_size']      = 2048;
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload');

            for ($i = 0; $i < $count; $i++) {
                $_FILES['image']['name']     = $files['images']['name'][$i];
                $_FILES['image']['type']     = $files['images']['type'][$i];
                $_FILES['image']['tmp_name'] = $files['images']['tmp_name'][$i];
                $_FILES['image']['error']    = $files['images']['error'][$i];
                $_FILES['image']['size']     = $files['images']['size'][$i];

                $this->upload->initialize($config);

                if ($this->upload->do_upload('image')) {
                    $uploadData = $this->upload->data();
                    $imageData = [
                        'feature_id' => $id,
                        'image_path' => $uploadData['file_name']
                    ];
                    $this->Feature_model->insert_image($imageData);
                } else {
                    // Optionally show error or flash message
                    log_message('error', 'Image upload error: ' . $this->upload->display_errors());
                }
            }

            $this->session->set_flashdata('success', 'Feature updated and images replaced.');
        } else {
            $this->session->set_flashdata('success', 'Feature updated without changing images.');
        }

        redirect('admin/features');
    } else {
        show_404();
    }
}


    public function delete_feature($id) {
        $this->is_logged_in();
        $this->Feature_model->delete($id);
        redirect('admin/features');
    }

    public function features_by_model($brand_id = null, $model_id = null)
{
    $this->is_logged_in();
    $this->load->model(['Brand_model', 'Model_model', 'Feature_model']);
    
    $data['brands'] = $this->Brand_model->get_all();

    if ($brand_id && !$model_id) {
        $data['selected_brand'] = $this->Brand_model->get($brand_id);
        $data['models'] = $this->Model_model->get_by_brand($brand_id);
        $this->load->view('admin/features', $data);
    } elseif ($brand_id && $model_id) {
        $data['selected_brand'] = $this->Brand_model->get($brand_id);
        $data['selected_model'] = $this->Model_model->get($model_id);
        $features = $this->Feature_model->get_by_model($model_id);
        
        foreach ($features as &$feature) {
            $feature->images = $this->Feature_model->get_images($feature->id);
            $feature->price = number_format($feature->price, 2, '. ', ',');
        }

        $data['features'] = $features;
        $this->load->view('admin/features', $data);
    } else {
        redirect('admin/features'); // fallback
    }
}
public function features_save()
{
    $this->is_logged_in();

    // Sanitize and fetch input
    $model_id     = $this->input->post('model_id', true);
    $type         = $this->input->post('type', true); // interior or exterior
    $feature_name = $this->input->post('feature_name', true);
    $name         = $this->input->post('name', true);
    $part_code    = $this->input->post('part_code', true);

    // Validate required inputs
    if (!$model_id || !$type || !$feature_name || !$name || !$part_code) {
        $this->session->set_flashdata('error', 'All fields are required!');
        redirect('admin/features-add');
    }

    // Save feature data
    $feature_id = $this->Feature_model->insert([
        'model_id'     => $model_id,
        'type'         => $type,
        'feature_name' => $feature_name,
        'name'         => $name,
        'part_code'    => $part_code,
    ]);

    // Upload and save multiple images
    if (!empty($_FILES['images']['name'][0])) {
        $this->load->library('upload');

        $filesCount = count($_FILES['images']['name']);
        for ($i = 0; $i < $filesCount; $i++) {
            $_FILES['file']['name']     = $_FILES['images']['name'][$i];
            $_FILES['file']['type']     = $_FILES['images']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
            $_FILES['file']['error']    = $_FILES['images']['error'][$i];
            $_FILES['file']['size']     = $_FILES['images']['size'][$i];

            $config['upload_path']   = './assets/images/brand-model/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['max_size']      = 2048;
            $config['file_name']     = time() . '_' . rand(1000, 9999);

            $this->upload->initialize($config);

            if ($this->upload->do_upload('file')) {
                $uploadData = $this->upload->data();
                $imagePath = 'assets/images/brand-model/' . $uploadData['file_name'];

                $this->Feature_model->insert_image([
                    'feature_id' => $feature_id,
                    'image_path' => $imagePath,
                    'type'       => $type // Optional: in case your feature_images table has a `type` column
                ]);
            }
        }
    }

    $this->session->set_flashdata('success', 'Feature added successfully!');
    redirect('admin/features');
}

public function delete_feature_image($id)
{
    $this->is_logged_in();
    $this->load->model('Feature_model');
    $this->Feature_model->delete_image($id);
    redirect($this->agent->referrer());
}

public function delete_image($id)
{
    $image = $this->db->get_where('feature_images', ['id' => $id])->row();
    if ($image) {
        @unlink(FCPATH . 'assets/images/brand-model/' . $image->image_path);
        $this->db->delete('feature_images', ['id' => $id]);
    }
}

public function get_images($feature_id)
{
    return $this->db
        ->where('feature_id', $feature_id)
        ->get('feature_images')
        ->result();
}

public function feature_image_delete($image_id, $feature_id)
{
    $this->is_logged_in();

    // Load model
    $this->load->model('Feature_model');

    // Get image info
    $image = $this->Feature_model->get_image_by_id($image_id);

    if ($image) {
        // Delete image file from disk
        $image_path = FCPATH . 'assets/images/brand-model/' . $image->image_path;
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        // Delete record from DB
        $this->Feature_model->delete_image($image_id);
    }

    // Redirect back to edit page
    redirect('admin/features-edit/' . $feature_id);
}

public function test_model_add($brand_id = null)
{
    $this->is_logged_in(); // Ensure login

    $data = [
        'brand_id' => $brand_id
    ];

    $this->load->view('admin/test-models-add', $data);
}


}