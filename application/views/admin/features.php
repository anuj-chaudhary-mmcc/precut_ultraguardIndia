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
               <!--<th style="width: 8%">Price</th>-->
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
               <!--<td class="m-0 p-0 fw-bold">-->
               <!--   <span class="d-flex m-0">-->
               <!--      <svg xmlns="http://www.w3.org/2000/svg" class="mt-1 fw-bold" height="14" width="14" viewBox="0 0 640 640">-->
               <!--         <path fill="rgb(255, 0, 0)" d="M160 128C160 110.3 174.3 96 192 96L456 96C469.3 96 480 106.7 480 120C480 133.3 469.3 144 456 144L379.3 144C397 163.8 409.4 188.6 414 216L456 216C469.3 216 480 226.7 480 240C480 253.3 469.3 264 456 264L414 264C403.6 326.2 353.2 374.9 290.2 382.9L434.6 486C449 496.3 452.3 516.3 442 530.6C431.7 544.9 411.7 548.3 397.4 538L173.4 378C162.1 370 157.3 355.5 161.5 342.2C165.7 328.9 178.1 320 192 320L272 320C307.8 320 338.1 296.5 348.3 264L184 264C170.7 264 160 253.3 160 240C160 226.7 170.7 216 184 216L348.3 216C338.1 183.5 307.8 160 272 160L192 160C174.3 160 160 145.7 160 128z"/>-->
               <!--      </svg>-->
                     <!--<span><= $feature->price ?></span>-->
               <!--   </span>-->
               <!--</td>-->
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
