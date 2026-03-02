<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Models</title>
   <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/model.css'); ?>">
   <?php include_once('layout/header.php'); ?>
</head>
<body>
<?php include_once('layout/sidebar.php'); ?>
<div class="content">
   <div class="project-url">
      <h3><i class="fa-solid fa-globe"></i> Our Model</h3>
   </div>

   <div class="add-new">
      <a href="<?php echo base_url('admin/models-add'); ?>" class="button">Add New</a>
   </div>

   <div class="search-form">
      <form class="d-flex" method="get">
         <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
      </form>
   </div>

   <table class="table">
      <thead>
         <tr>
            <th>ID</th>
            <th>Brand Name</th>
            <th>Model Name</th>
            <th>Image</th>
            <th>Action</th>
         </tr>
      </thead>
      <tbody>
         <?php if (!empty($models)) : ?>
            <?php foreach ($models as $model): ?>
               <tr>
                  <td><?php echo $model->id; ?></td>
                  <td><?php echo $model->brand_name; ?></td>
                  <td><?php echo $model->model_name; ?></td>
                  <td>
                     <?php if (!empty($model->image)): ?>
                        <img src="<?php echo base_url('assets/images/brand-model/' . $model->image); ?>" width="80">
                     <?php else: ?>
                        No image
                     <?php endif; ?>
                  </td>
                  <td>
                     <ul>
                        <li><a href="<?php echo base_url('admin/models-edit/' . $model->id); ?>"><i class="fa-solid fa-pen-to-square"></i></a></li>
                        <li><a href="<?php echo base_url('admin/models-delete/' . $model->id); ?>" onclick="return confirm('Delete this model?')"><i class="fa-solid fa-trash"></i></a></li>
                     </ul>
                  </td>
               </tr>
            <?php endforeach; ?>
         <?php else: ?>
            <tr><td colspan="5">No models found.</td></tr>
         <?php endif; ?>
      </tbody>
   </table>
</div>
<?php include_once('layout/footer.php'); ?>
</body>
</html>
