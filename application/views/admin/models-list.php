<!DOCTYPE html>
<html>
<head>
   <title>Brands</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="<?= base_url('assets/admin/css/model.css'); ?>">
   <?php include_once('layout/header.php'); ?>
</head>
<body>
   <?php include_once('layout/sidebar.php'); ?>
   
   <div class="content">
      <div class="project-url">
         <h3><i class="fa-solid fa-globe"></i>
            <?= $selected_brand ? 'Brand: ' . $selected_brand->name : 'Select a Brand' ?>
         </h3>
      </div>

      <!-- ✅ Single Search Input -->
      <div class="search-form mb-3">
         <form class="d-flex" role="search">
            <input type="text" id="universalSearchInput" class="form-control" placeholder="Search...">
         </form>
      </div>

      <!-- ✅ Brand List -->
      <?php if (!$selected_brand): ?>
         <div class="select-brad-all">
            <div class="row" id="brandList">
               <?php
                  // ✅ Sort brands alphabetically A-Z
                  usort($brands, function($a, $b) {
                     return strcmp(strtolower($a->name), strtolower($b->name));
                  });
               ?>
               <?php foreach ($brands as $brand): ?>
                  <div class="col-md-3 brand-card-team">
                     <div class="brand-card">
                        <a href="<?= base_url('admin/models/' . $brand->id) ?>">
                           <?php
                              $image_path = 'assets/images/brands/' . $brand->image;
                              $image_full_path = FCPATH . $image_path;
                           ?>
                           <img src="<?= file_exists($image_full_path) && !empty($brand->image) ? base_url($image_path) : base_url('assets/images/no-image.png') ?>" class="brand-logo" alt="<?= $brand->name ?>">
                           <div class="brand-name"><?= $brand->name ?></div>
                        </a>
                     </div>
                  </div>
               <?php endforeach; ?>
            </div>
         </div>
      <?php endif; ?>

      <!-- ✅ Model List -->
      <?php if ($selected_brand): ?>
         <div class="add-new mb-3">
            <a href="<?= base_url('admin/models_add/' . $selected_brand->id) ?>" class="button">+ Add New Model</a>
         </div>
         <div class="project-url">
            <h4>Models for Brand: <span><?= $selected_brand->name ?></span></h4>
         </div>

         <?php if (!empty($models)): ?>
            <div id="modelList">
               <table class="table table-bordered text-center">
                  <thead class="table-danger text-white">
                     <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Model Logo</th>
                        <th>Model Top Image</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                        usort($models, function($a, $b) {
                           return strcmp(strtolower($a->model_name), strtolower($b->model_name));
                        });
                        $count = 1;
                        foreach ($models as $model):
                     ?>
                        <tr>
                           <td><?= $count++; ?></td>
                           <td><?= $model->model_name ?></td>
                           <td>
                              <?php if ($model->image): ?>
                                 <img src="<?= base_url('assets/images/brand-model/' . $model->image) ?>" width="60" alt="Model Image">
                              <?php else: ?>
                                 No Image
                              <?php endif; ?>
                           </td>
                           <td>
                              <?php if (!empty($model->top_image)): ?>
                                 <img src="<?= base_url('assets/images/brand-model/' . $model->top_image); ?>" width="60">
                              <?php else: ?>
                                 N/A
                              <?php endif; ?>
                           </td>
                           <td>
                              <a href="<?= base_url('admin/models_edit/' . $model->id) ?>" class="btn btn-sm btn-primary">
                                 <i class="fas fa-edit"></i>
                              </a>
                              <a href="<?= base_url('admin/models_delete/' . $model->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this model?')">
                                 <i class="fas fa-trash-alt"></i>
                              </a>
                           </td>
                        </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         <?php else: ?>
            <p>No models found for this brand.</p>
         <?php endif; ?>
      <?php endif; ?>
   </div>

   <?php include_once('layout/footer.php'); ?>

   <!-- ✅ Universal Search Script -->
   <script>
      document.getElementById("universalSearchInput").addEventListener("keyup", function () {
         const filter = this.value.toLowerCase();

         document.querySelectorAll(".brand-card-team").forEach(function (card) {
            const name = card.querySelector(".brand-name")?.textContent.toLowerCase();
            if (name) {
               card.style.display = name.includes(filter) ? "block" : "none";
            }
         });

         document.querySelectorAll("#modelList table tbody tr").forEach(function (row) {
            const modelName = row.cells[1]?.textContent.toLowerCase();
            if (modelName) {
               row.style.display = modelName.includes(filter) ? "table-row" : "none";
            }
         });
      });
   </script>
</body>
</html>
