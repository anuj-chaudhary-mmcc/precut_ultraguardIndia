<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Brand Model Features Add</title>
   <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/features.css'); ?>">
   <?php include_once('layout/header.php'); ?>
</head>
<body>
   <?php include_once('layout/sidebar.php'); ?>
   <div class="content">
      <div class="project-url">
         <h3><i class="fa-solid fa-globe"></i> Brand Model Features Add</h3>
      </div>
      <div class="add-new"></div>

      <form action="<?php echo base_url('admin/feature/add'); ?>" method="post" enctype="multipart/form-data">
         <div class="row">
            <!-- Select Model -->
            <div class="col-md-6 form-item">
               <label>Select Car Model:</label>
               <select name="model_id" required>
                  <option value="">-- Select Model --</option>
                  <?php foreach ($models as $model): ?>
                     <option value="<?php echo $model->id; ?>"><?php echo $model->model_name; ?></option>
                  <?php endforeach; ?>
               </select>
            </div>

            <!-- Feature Type -->
            <div class="col-md-6 form-item">
               <label>Feature Type</label>
               <select name="type" required>
                  <option value="interior">Interior</option>
                  <option value="exterior">Exterior</option>
               </select>
            </div>

            <!-- Feature Fields -->
            <div class="col-md-6 form-item">
               <label>Features Title</label>
               <input type="text" name="feature_name" required placeholder="Features Title">
            </div>
            <div class="col-md-6 form-item">
               <label>Features Name</label>
               <input type="text" name="name" class="form-control" required placeholder="Features Name">
            </div>
            <div class="col-md-6 form-item">
               <label>Part Code / Number</label>
               <input type="text" name="part_code" class="form-control" required placeholder="Part Code / Number">
            </div>

            <!-- Image Upload Area -->
            <div class="col-md-12 form-item">
               <label>Select Images</label>
               <div id="drop-area" style="border: 2px dashed #ccc; padding: 20px; text-align: center;">
                  <p>Drag & drop images here or click to select</p>
                  <input type="file" id="fileElem" name="images[]" multiple accept="image/*" style="display:none;">
                  <button type="button" onclick="document.getElementById('fileElem').click()">Select Images</button>
                  <div id="gallery" style="margin-top: 15px; display: flex; flex-wrap: wrap;"></div>
               </div>
            </div>

            <div class="col-md-12 form-item">
               <button type="submit">Add Feature</button>
            </div>
         </div>
      </form>
   </div>
   <?php include_once('layout/footer.php'); ?>

   <!-- Image Upload Script -->
   <script>
      const dropArea = document.getElementById('drop-area');
      const fileInput = document.getElementById('fileElem');
      const gallery = document.getElementById('gallery');
      let filesList = [];

      function previewImages(files) {
         gallery.innerHTML = '';
         files.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function (e) {
               const div = document.createElement('div');
               div.style.position = 'relative';
               div.style.margin = '10px';

               const img = document.createElement('img');
               img.src = e.target.result;
               img.style.maxWidth = '100px';
               img.style.maxHeight = '100px';
               img.style.display = 'block';
               img.style.border = '1px solid #ccc';
               img.style.padding = '4px';
               img.style.borderRadius = '6px';

               const cross = document.createElement('span');
               cross.textContent = '✕';
               cross.style.position = 'absolute';
               cross.style.top = '-10px';
               cross.style.right = '-10px';
               cross.style.cursor = 'pointer';
               cross.style.background = 'red';
               cross.style.color = '#fff';
               cross.style.borderRadius = '50%';
               cross.style.padding = '4px 7px';
               cross.onclick = function () {
                  filesList.splice(index, 1);
                  updateFileInput();
                  previewImages(filesList);
               };

               div.appendChild(img);
               div.appendChild(cross);
               gallery.appendChild(div);
            };
            reader.readAsDataURL(file);
         });
      }

      function updateFileInput() {
         const dataTransfer = new DataTransfer();
         filesList.forEach(file => dataTransfer.items.add(file));
         fileInput.files = dataTransfer.files;
      }

      fileInput.addEventListener('change', function () {
         filesList = Array.from(fileInput.files);
         previewImages(filesList);
      });

      dropArea.addEventListener('dragover', function (e) {
         e.preventDefault();
         dropArea.style.background = '#f0f0f0';
      });

      dropArea.addEventListener('dragleave', function () {
         dropArea.style.background = 'transparent';
      });

      dropArea.addEventListener('drop', function (e) {
         e.preventDefault();
         dropArea.style.background = 'transparent';
         const droppedFiles = Array.from(e.dataTransfer.files).filter(f => f.type.startsWith('image/'));
         filesList = [...filesList, ...droppedFiles];
         updateFileInput();
         previewImages(filesList);
      });
   </script>
</body>
</html>
