<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Feature</title>
   <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/features.css'); ?>">
   <style>
      .uploaded-image {
         position: relative;
         display: inline-block;
         margin: 5px;
      }
      .uploaded-image img {
         height: 100px;
         width: auto;
         border: 1px solid #ccc;
         border-radius: 5px;
      }
      .delete-image {
         position: absolute;
         top: -8px;
         right: -8px;
         background: red;
         color: #fff;
         border-radius: 50%;
         padding: 2px 6px;
         cursor: pointer;
         font-size: 12px;
         text-decoration: none;
      }
   </style>
   <?php include_once('layout/header.php'); ?>
</head>
<body>
   <?php include_once('layout/sidebar.php'); ?>
   <div class="content">
      <div class="project-url">
         <h3><i class="fa-solid fa-globe"></i> Edit Brand Model Feature</h3>
      </div>

      <form action="<?php echo base_url('admin/features-update/' . $feature->id); ?>" method="post" enctype="multipart/form-data">
         <div class="row">
            <div class="col-md-6 form-item">
               <label>Select Car Model:</label>
               <select name="model_id" required>
                  <option value="">-- Select Model --</option>
                  <?php foreach ($models as $model): ?>
                     <option value="<?php echo $model->id; ?>" <?php echo ($model->id == $feature->model_id) ? 'selected' : ''; ?>>
                        <?php echo $model->model_name; ?>
                     </option>
                  <?php endforeach; ?>
               </select>
            </div>

            <div class="col-md-6 form-item">
               <label>Feature Type</label>
               <select name="type" required>
                  <option value="interior" <?php echo ($feature->type == 'interior') ? 'selected' : ''; ?>>Interior</option>
                  <option value="exterior" <?php echo ($feature->type == 'exterior') ? 'selected' : ''; ?>>Exterior</option>
               </select>
            </div>

            <div class="col-md-6 form-item">
               <label>Features Title</label>
               <input type="text" name="feature_name" required value="<?php echo $feature->feature_name; ?>" placeholder="Features Title">
            </div>

            <div class="col-md-6 form-item">
               <label>Features Name</label>
               <input type="text" name="name" class="form-control" required value="<?php echo $feature->name; ?>" placeholder="Features Name">
            </div>

            <div class="col-md-6 form-item">
               <label>Part Code / Number</label>
               <input type="text" name="part_code" class="form-control" required value="<?php echo $feature->part_code; ?>" placeholder="Part Code / Number">
            </div>

            <div class="col-md-6 form-item">
               <label>Upload New Images (if any)</label>
               <input type="file" name="images[]" multiple accept="image/*">
            </div>
             <div class="col-md-6 form-item">
               <label>Price:</label>
               <input type="text" name="price" value="<?php echo isset($feature->price) ? $feature->price : ''; ?>">
            </div>
            <div class="col-md-6 form-item">
               <label>Uploaded Images:</label><br>
               <?php if (!empty($feature->images)): ?>
                  <?php foreach ($feature->images as $img): ?>
                     <div class="uploaded-image">
                        <img src="<?= base_url('assets/images/brand-model/' . htmlspecialchars($img->image_path)) ?>" alt="Feature Image">

                        <a class="delete-image" href="<?php echo base_url('admin/feature-image-delete/' . $img->id . '/' . $feature->id); ?>" onclick="return confirm('Delete this image?')">&times;</a>
                     </div>
                  <?php endforeach; ?>
               <?php else: ?>
                  <p>No images uploaded yet.</p>
               <?php endif; ?>
            </div>

            <div class="col-md-12 form-item">
               <button type="submit">Update Feature</button>
            </div>
         </div>
      </form>
   </div>
   <?php include_once('layout/footer.php'); ?>
</body>
</html>
