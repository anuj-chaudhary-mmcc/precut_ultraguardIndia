<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|	example.com/class/method/id/
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
*/

$route['default_controller'] = 'Precut';  // Default controller
$route['404_override'] = '';  // No override route
$route['translate_uri_dashes'] = FALSE;  // This option allows the use of dashes in URIs

// How To Apply
$route['how-to-apply'] = 'Precut/how_to_apply';

// Custom routes
$route['interior'] = 'Precut/interior';
$route['brands'] = 'Precut/brands';
$route['brands-model'] = 'Precut/brands_model';


$route['admin/login']       = 'admin/login';
$route['admin/logout']      = 'admin/logout';
$route['admin/dashboard']   = 'admin/dashboard';

$route['admin/brands']      = 'admin/brands';
// $route['admin/brand/add']   = 'admin/add_brand';
$route['admin/brand/delete/(:num)'] = 'admin/delete_brand/$1';

// $route['admin/model/add']   = 'admin/add_model';
// $route['admin/model/delete/(:num)'] = 'admin/delete_model/$1';

$route['admin/features']      = 'admin/features';
$route['admin/feature/add']   = 'admin/add_feature';
$route['admin/feature/delete/(:num)'] = 'admin/delete_feature/$1';

$route['brand-models/(:num)'] = 'precut/brands_model/$1';


$route['brands'] = 'precut/all_models';

$route['model-features/(:num)'] = 'precut/model_features/$1';




$route['admin'] = 'admin/index';  // Admin panel 
$route['brand'] = 'admin/Brand';   // Admin panel 
$route['brand-add'] = 'admin/Brand_add';  // Admin panel 
$route['brand-edit'] = 'admin/Brand_edit';  // Admin panel 
$route['model'] = 'admin/Model';  // Admin panel 
$route['model-add'] = 'admin/Model_add';  // Admin panel 
$route['model-edit'] = 'admin/Model_edit';  // Admin panel 
$route['features'] = 'admin/Features';  // Admin panel 
$route['features-add'] = 'admin/Features_add';  // Admin panel 
$route['features-edit'] = 'admin/features_edit';  // Admin panel 

// $route['brands-add'] = 'admin/brands_add';
$route['brands-edit/(:num)'] = 'admin/brands_edit/$1';
$route['brands-update/(:num)'] = 'admin/brands_update/$1';
$route['admin/brands-update/(:num)'] = 'admin/brands_update/$1';


$route['admin/models/(:num)'] = 'Admin/models/$1'; // Brand ID for model list
$route['admin/models-insert'] = 'admin/models_insert';
$route['admin/models-update/(:num)'] = 'admin/models_update/$1';


$route['features-add'] = 'admin/features_add';
$route['admin/features-edit/(:num)'] = 'admin/features_edit/$1';
$route['admin/features-update/(:num)'] = 'admin/features_update/$1';


$route['precut/submit_quotation'] = 'precut/submit_quotation';

// $route['admin/brands-add'] = 'admin/brands_add';
$route['admin/brand/delete/(:num)'] = 'admin/delete_brand/$1';

// $route['admin/brand/add'] = 'admin/brands_add';

$route['admin/features-add'] = 'admin/features_add';

$route['model-features'] = 'frontend/model_features';
$route['model-features/(:num)'] = 'frontend/model_features/$1';
$route['model-features/(:num)/(:num)'] = 'frontend/model_features/$1/$2';

$route['admin/features-by-model'] = 'admin/features_by_model';
$route['admin/features-by-model/(:num)'] = 'admin/features_by_model/$1';
$route['admin/features-by-model/(:num)/(:num)'] = 'admin/features_by_model/$1/$2';


$route['admin/features-add/(:num)'] = 'admin/features_add/$1';


$route['admin/brands-update/(:num)'] = 'admin/brands_update/$1';

$route['admin/brands-edit/(:num)'] = 'admin/brands_edit/$1';


$route['admin/Brand_add'] = 'admin/brand_add';
$route['admin/brand-insert'] = 'admin/brand_insert';
$route['model-features/(:num)'] = 'frontend/model_features/$1';


$route['admin/features_save'] = 'admin/features_save';

$route['admin/feature-image-delete/(:num)/(:num)'] = 'admin/feature_image_delete/$1/$2';
$route['interior/(:any)'] = 'precut/all_models_by_brand_name/$1';
$route['interior/(:any)/(:any)'] = 'precut/model_features/$1/$2';


$route['exterior'] = 'precut/exterior';
$route['exterior/(:any)/(:any)'] = 'precut/exterior_features/$1/$2';
$route['exterior/(:any)'] = 'precut/exterior_models/$1';
$route['exterior-features/(:num)'] = 'precut/exterior_features_by_id/$1';


$route['admin/models']      = 'admin/models';
$route['admin/model/add']   = 'admin/add_model';
// $route['admin/models-edit/(:num)'] = 'admin/models_edit/$1';


$route['admin/models-delete/(:num)'] = 'admin/models_delete/$1';
$route['admin/models_delete/(:num)'] = 'admin/models_delete/$1';

$route['admin/models-add'] = 'admin/models_add';
$route['admin/models-update/(:num)'] = 'admin/models_update/$1';
$route['admin/models-insert'] = 'admin/models_insert';



// Custom admin routes

// $route['admin/models_edit/(:num)'] = 'Admin/models_edit/$1';
// $route['admin/models_delete/(:num)'] = 'Admin/models_delete/$1';


$route['admin/models-edit/(:num)'] = 'admin/models_edit/$1';
$route['admin/models-update/(:num)'] = 'admin/models_update/$1';


// $route['(:any)/(:any)/(:any)'] = 'precut/model_features/$1/$2/$3';

$route['test-delete'] = 'admin/models_delete/118';
