<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Our Features</title>
   <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/features.css'); ?>">
   <?php include_once('layout/header.php'); ?>
  
</head>
<body>
<?php include_once('layout/sidebar.php'); ?>
<div class="content">
   <div class="project-url">
      <h3><i class="fa-solid fa-globe"></i> Our Features</h3>
   </div>
 <!-- Search input only when brand list is shown -->
        
         <div class="search-form">
            <form class="d-flex " role="search">
               <input type="text" id="searchInput" class="form-control" placeholder="Search Brand Name">
            </form>
         </div>
       
         <!-- Brand List -->
   <?php if (!isset($selected_brand) && !isset($selected_model)): ?>
     
      <div class="select-brad-all">
      <div class="row">
            <?php
               // ✅ Sort brands alphabetically A-Z
               usort($brands, function($a, $b) {
                  return strcmp(strtolower($a->name), strtolower($b->name));
               });
            ?>
         <?php foreach ($brands as $brand): ?>
         <div class="col-md-3 brand-card-team">
            <div class="brand-card">
               <a href="<?= base_url('admin/features-by-model/' . $brand->id) ?>">
                  <img src="<?= base_url('assets/images/brands/' . $brand->image) ?>" alt="<?= $brand->name ?>">
                  <div class="brand-name"><strong><?= $brand->name ?></strong></div>
               </a>
            </div>
         </div>
         <?php endforeach; ?>
      </div>
      </div>

   <?php elseif (isset($selected_brand) && !isset($selected_model)): ?>
        <div class="project-url">
            <h4>Select a Model under <strong><?= $selected_brand->name ?></strong></h4>
         </div>
      <a href="<?= base_url('admin/features') ?>" class="btn btn-secondary mb-3">← Back to Brands</a>
     
      <div class="row features-row-top">
          
         <?php
   // ✅ Sort models alphabetically by model_name
   usort($models, function($a, $b) {
      return strcmp(strtolower($a->model_name), strtolower($b->model_name));
   });
   foreach ($models as $model):
?>
         <div class="col-md-3 brand-card-team">
            <div class="brand-card">
               <a href="<?= base_url('admin/features-by-model/' . $selected_brand->id . '/' . $model->id) ?>">
                  <img src="<?= base_url('assets/images/brand-model/' . $model->image) ?>" alt="<?= $model->model_name ?>">
                  <div class="brand-name"><strong><?= $model->model_name ?></strong></div>
               </a>
            </div>
         </div>
         <?php endforeach; ?>
      </div>

   <?php elseif (isset($selected_model)): ?>
      <a href="<?= base_url('admin/features-by-model/' . $selected_brand->id) ?>" class="btn btn-secondary mb-3">← Back to Models</a>
      <div class="add-new">
         <a href="<?= base_url('admin/features-add/') ?>" class="button">+ Add New Features</a>
      </div>
       <div class="project-url">
         </div>
      
      <table class="table">
         <thead>
            <tr>
               <th>ID</th>
               <th>Feature Title</th>
               <th>Part Name</th>
               <th>Part Code</th>
               <th>Category</th>
               <th>Images</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
             
             <?php $count = 1; foreach ($features as $feature): ?>
            <tr>
               <!--<td><?= $feature->id ?></td>-->
               <td><?= $count++; ?></td> <!-- Sequential ID -->
               <td><?= $feature->feature_name ?></td>
               <td><?= $feature->name ?></td>
               <td><?= $feature->part_code ?></td>
               <td><?= $feature->type ?></td>
                  <td>
                  <?php foreach ($feature->images as $img): ?>
                     <img src="<?= base_url('assets/images/brand-model/' . $img->image_path) ?>" alt="">
                  <?php endforeach; ?>
               </td>

               <td>
                  <ul>
                     <li><a href="<?= base_url('admin/features-edit/' . $feature->id) ?>"><i class="fa-solid fa-pen-to-square green-edite"></i></a></li>
                     <li><a href="<?= base_url('admin/feature/delete/' . $feature->id) ?>" onclick="return confirm('Delete this feature?')"><i class="fa-solid fa-trash red-delete"></i></a></li>
                  </ul>
               </td>
            </tr>
            <?php endforeach; ?>
         </tbody>
      </table>
   <?php endif; ?>
</div>
<?php include_once('layout/footer.php'); ?>
<script>
         document.getElementById("searchInput").addEventListener("keyup", function () {
             let filter = this.value.toLowerCase();
             let brandCards = document.querySelectorAll(".brand-card-team");
         
             brandCards.forEach(function (card) {
                 let name = card.querySelector(".brand-name").textContent.toLowerCase();
                 card.style.display = name.includes(filter) ? "block" : "none";
             });
         });
      </script>
</body>
</html>
