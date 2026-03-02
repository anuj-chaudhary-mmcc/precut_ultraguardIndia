<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Brands</title>
      <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/brands.css'); ?>">
      <?php include_once('layout/header.php'); ?>
   </head>
   <body>
      <?php include_once('layout/sidebar.php'); ?>
      <div class="content">
         <div class="project-url">
            <h3><i class="fa-solid fa-globe"></i> Our Brands</h3>
         </div>
         <div class="add-new">
            <a href="<?php echo base_url('admin/Brand_add');?>" class="button">Add New</a>
         </div>
         <!-- Search input -->
         <div class="search-form">
            <form class="d-flex " role="search">
               <input type="text" id="searchInput" class="form-control" placeholder="Search Brand Name">
            </form>
         </div>
         <table class="table" id="brandTable">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Logo</th>
                  <th>Header Image</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
             <?php
                  // Sort brands alphabetically (A-Z) by name
                  usort($brands, function($a, $b) {
                     return strcmp(strtolower($a->name), strtolower($b->name));
                  });

                  $count = 1;
                  foreach ($brands as $brand):
               ?>
               <tr class="brand-row">
                  <!--<td><?php echo $brand->id; ?></td>-->
                      <td><?php echo $count++; ?></td> <!-- Sequential ID -->
                  <td class="brand-name"><?php echo $brand->name; ?></td>
                  <td>
                     <?php 
                        $image_path = 'assets/images/brands/' . $brand->image;
                        if (!empty($brand->image) && file_exists(FCPATH . $image_path)): ?>
                     <img src="<?php echo base_url($image_path); ?>" width="80">
                     <?php else: ?>
                     <span>No image</span>
                     <?php endif; ?>
                  </td>
                  <td>
                     <?php if (!empty($brand->top_image)): ?>
                     <img src="<?= base_url('assets/images/brands/' . $brand->top_image); ?>" width="80">
                     <?php else: ?>
                     N/A
                     <?php endif; ?>
                  </td>
                  <td>
                     <ul>
                        <a href="<?php echo base_url('brands-edit/' . $brand->id); ?>"><i class="fa-solid fa-pen-to-square green-edite"></i></a>
                        <li><a href="<?php echo base_url('admin/brand/delete/' . $brand->id); ?>" onclick="return confirm('Delete this brand?')"><i class="fa-solid fa-trash"></i></a></li>
                     </ul>
                  </td>
               </tr>
               <?php endforeach; ?>
            </tbody>
         </table>
      </div>
      <!-- JavaScript Search Logic -->
<script>
   document.getElementById("searchInput").addEventListener("keyup", function () {
         let filter = this.value.toLowerCase();
         let rows = document.querySelectorAll("#brandTable .brand-row");
      
         rows.forEach(function (row) {
            let brandName = row.querySelector(".brand-name").textContent.toLowerCase();
            if (brandName.includes(filter)) {
               row.style.display = "";
            } else {
               row.style.display = "none";
            }
         });
      });
</script>
      <?php include_once('layout/footer.php'); ?>
   </body>
</html>