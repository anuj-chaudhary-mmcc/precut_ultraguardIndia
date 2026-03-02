<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Brand Edit</title>
      <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/brands.css'); ?>">
      <?php include_once('layout/header.php'); ?>
   </head>
   <body>
      <?php include_once('layout/sidebar.php'); ?>
      <div class="content">
         <div class="project-url">
            <h3><i class="fa-solid fa-globe"></i>Brand Edit</h3>
         </div>
         <form action="<?php echo base_url('admin/brands-update/' . $brand->id); ?>" method="post" enctype="multipart/form-data">
            <div class="row">
               <!-- Brand Name -->
               <div class="col-md-6 form-item">
                  <label>Brand Name:</label>
                  <input type="text" name="name" value="<?php echo $brand->name; ?>" required>
               </div>
<!--              <div class="col-md-6 form-item">-->
<!--   <label>Brand Slug:</label>-->
<!--   <input type="text" name="slug" value="<?php echo $brand->slug; ?>" required>-->
<!--</div>-->
               
               <!-- Brand Logo -->
               <div class="col-md-6 form-item">
                  <label>Change Brand Logo:</label>
                  <input type="file" name="image"><br>
                
               </div>
               <div class="col-md-6 form-item">
                    <label>Current Logo:</label>
                    <?php if (!empty($brand->image)): ?>
                     <img src="<?php echo base_url('assets/images/brands/' . $brand->image); ?>" width="100"><br>
                  <?php endif; ?>
               </div>

               <!-- Top Image Upload -->
               <div class="col-md-6 form-item">
                  <label>Change Header Top Image:</label>
                  <input type="file" name="top_image"><br>
                  
               </div>
                <div class="col-md-6 form-item top-header">
                  <label>Header Current Image:</label>
                  <?php if (!empty($brand->top_image)): ?>
                     <img src="<?php echo base_url('assets/images/brands/' . $brand->top_image); ?>" width="100"><br>
                  <?php endif; ?>
               </div>

               <!-- Submit -->
               <div class="col-md-12 form-item">
                  <button type="submit">Update Brand</button>
               </div>
            </div>
         </form>
      </div>
      <?php include_once('layout/footer.php'); ?>
   </body>
</html>
