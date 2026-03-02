<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Brands Add</title>
      <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/brands.css'); ?>">
      <?php include_once('layout/header.php'); ?>
   </head>
   <body>
      <?php include_once('layout/sidebar.php'); ?>
      <div class="content">
         <div class="project-url">
            <h3><i class="fa-solid fa-globe"></i> Brands Add</h3>
         </div>
         <div class="add-new">
            <!-- <a href="brands-add.php" class="button">Add New</a> -->
         </div>
         <form action="<?php echo base_url('admin/add_brand'); ?>" method="post" enctype="multipart/form-data">
            <div class="row">
               <div class="col-md-6 form-item">
                  <label>Brand Name</label>
                  <input type="text" name="name" required>
               </div>
               <!-- <div class="col-md-6 form-item">-->
               <!--   <label>Brand Slug</label>-->
               <!--   <input type="text" name="slug" required>-->
               <!--</div>-->
               <div class="col-md-6 form-item">
                  <label>Brand Header Image</label>
                  <input type="file" name="top_image" required placeholder="Brand Images"><br><br> 
               </div>
                  <div class="col-md-6 form-item">
                  <label>Brand Logo</label>
                  <input type="file" name="image" required placeholder="Brand Images"><br><br> 
               </div>
               <div class="col-md-12 form-item">
                  <button type="submit">Add Brand</button>
               </div>
            </div>
         </form>
      </div>
      <?php include_once('layout/footer.php'); ?>
   </body>
</html>
