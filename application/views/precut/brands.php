<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>
         <?php echo isset($brand) && $brand ? $brand->name : 'All'; ?> Models
      </title>
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/brands.css">
      <?php include_once('layout/header-link.php'); ?>
   </head>
   <body>
      <section>
         <div class="brands-top">
            <?php if (!empty($brand->top_image)): ?>
            <div class="brand-header text-center">
               <img src="<?= base_url('assets/images/brands/' . $brand->top_image) ?>" 
                  alt="<?= $brand->name ?>" 
                  class="img-fluid" />
            </div>
            <?php endif; ?>
         </div>
         <div class="container">
            <div class="Menu-line">
               <ul>
                  <li><a href="<?php echo base_url(); ?>">Home</a> - </li>
                  <li><a href="<?php echo base_url(); ?>interior">Interior</a> - </li>
                  <li>
                     <a href="#" class="active">
                     <?php echo isset($brand) && $brand ? $brand->name . ' Models' : 'All Car Models'; ?>
                     </a>
                  </li>
               </ul>
               <h2>Select Your <span>Car Model</span></h2>
               <div class="search-container">
                  <input type="text" id="searchInput" placeholder="Search Model">
                  <i class="fas fa-search"></i>
               </div>
            </div>

            <!-- 🔙 Back Button -->
            <div class="back-click" onclick="goBack()" style="margin: 10px;">
               <i class="fa-solid fa-left-long"></i>
            </div>

            <div class="row all-brands">
               <?php
                  // ✅ Sort models alphabetically
                  if (!empty($models)) {
                      usort($models, function ($a, $b) {
                          return strcmp(strtolower($a->model_name), strtolower($b->model_name));
                      });
                  }

                  // ✅ Convert string to slug
                  function slugify($string) {
                      return strtolower(str_replace(' ', '-', $string));
                  }
               ?>

               <?php if (!empty($models)) : ?>
                  <?php foreach ($models as $model): ?>
                     <?php
                        $brand_slug = slugify($brand->name);
                        $model_slug = slugify($model->model_name);
                        $url = base_url('interior/' . $brand_slug . '/' . $model_slug);
                     ?>
                     <div class="col-md-3 col-4 brand-logo">
                        <a href="<?= $url ?>">
                           <img src="<?= base_url('assets/images/brand-model/' . $model->image); ?>" alt="<?= $model->model_name; ?>">
                           <h3><?= $model->model_name; ?></h3>
                        </a>
                     </div>
                  <?php endforeach; ?>
               <?php else: ?>
                  <p>No models found under this brand.</p>
               <?php endif; ?>
            </div>
         </div>
      </section>
      <?php include_once('layout/footer-link.php'); ?>
   </body>
</html>
