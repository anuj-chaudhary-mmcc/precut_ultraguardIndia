<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Brand Model Edit</title>
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/model.css'); ?>">
      <?php include_once('layout/header.php'); ?>
   </head>
   <body>
      <?php include_once('layout/sidebar.php'); ?>
      <div class="content">
         <div class="project-url">
            <h3><i class="fa-solid fa-globe"></i>Brand Model Edit</h3>
         </div>

      
         <form method="post" action="<?php echo base_url('admin/models-update/' . $model['id']); ?>" enctype="multipart/form-data">
            <div class="row">
               <div class="col-md-6 form-item">
                  <label>Select Brand:</label>
                  <select name="brand_id" required>
                     <?php foreach ($brands as $brand): ?>
                     <option value="<?php echo $brand->id; ?>" <?php echo $brand->id == $model['brand_id'] ? 'selected' : ''; ?>>
                        <?php echo $brand->name; ?>
                     </option>
                     <?php endforeach; ?>
                  </select>
               </div>
               <div class="col-md-6 form-item">
                  <label>Model Name:</label>
                  <input type="text" name="model_name" value="<?php echo $model['model_name']; ?>" required>
               </div>
               <div class="col-md-6 form-item">
                  <label>Change Model Image:</label>
                  <input type="file" name="image">
                </div>
               <div class="col-md-6 form-item">
                  <label>Current Model Image:</label>
                  <?php if (!empty($model['image'])): ?>
                  <img src="<?php echo base_url('assets/images/brand-model/' . $model['image']); ?>" width="100">
                  <?php endif; ?>
               </div>
               
<div class="col-md-6 form-item">
                  <label>Change Header Top Image:</label>
                  <input type="file" name="top_image">
                  </div>
               <div class="col-md-6 form-item top-header">
                  <label>Current Header Top Image:</label>
                  <?php if (!empty($model['top_image'])): ?>
                  <img src="<?php echo base_url('assets/images/brand-model/' . $model['top_image']); ?>" width="100">
                  <?php endif; ?>
               </div>
               
               <div class="col-md-12 form-item">
                  <button type="submit">Update Model</button>
               </div>
            </div>
         </form>
      </div>
      <?php include_once('layout/footer.php'); ?>
   </body>
</html>