
    <!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Brand Model Add</title>
             <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/model.css'); ?>">
      <?php include_once('layout/header.php'); ?>
   </head>
   <body>
      <?php include_once('layout/sidebar.php'); ?>
      <div class="content">
         <div class="project-url">
            <h3><i class="fa-solid fa-globe"></i> Brand Model Add</h3>
         </div>
         <form action="<?php echo base_url('admin/models-insert'); ?>" method="post" enctype="multipart/form-data">
            <div class="row">
               <div class="col-md-6 form-item">
                  <label>Select Brands</label>
                  <select name="brand_id" required>
                     <option value="">Select Brand</option>
                     <?php foreach ($brands as $brand): ?>
                     <option value="<?php echo $brand->id; ?>"><?php echo $brand->name; ?></option>
                     <?php endforeach; ?>
                  </select>
               </div>
                <div class="col-md-6 form-item">
                  <label>Model Name:</label>
                  <input type="text" name="model_name" required>
               </div>
               <div class="col-md-6 form-item">
                    <label for="top_image">Header Top Image</label>
                     <input type="file" name="top_image" class="form-control">
                     <?php if (!empty($model->top_image)): ?>
                        <div style="margin-top: 10px;">
                           <img src="<?= base_url('assets/images/brand-model/' . $model->top_image) ?>" 
                              alt="Top Image" 
                              style="max-height: 120px; border-radius: 8px; border: 1px solid #ccc;">
                        </div>
                     <?php endif; ?>

               </div>
              
               <div class="col-md-6 form-item">
                  <label>Model Image:</label>
                  <input type="file" name="image">
               </div>
               <div class="col-md-12 form-item">
                  <button type="submit">Add Model</button>
               </div>
            </div>
         </form>
      </div>
      <?php include_once('layout/footer.php'); ?>
   </body>
</html>