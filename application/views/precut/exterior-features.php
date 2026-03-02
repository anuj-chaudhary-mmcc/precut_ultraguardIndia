<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title><?= $model->model_name; ?></title>
      <link rel="stylesheet" href="<?= base_url(); ?>assets/css/brands-model.css">
      <?php include_once('layout/header-link.php'); ?>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />

   </head>
   <body>
      <section>
         <div class="brands-top">
            <?php if (!empty($model->top_image)): ?>
            <div class="model-top-image" style="text-align:center;">
               <img src="<?= base_url('assets/images/brand-model/' . $model->top_image) ?>">
            </div>
            <?php endif; ?>
         </div>
         <div class="container">
            <div class="Menu-line">
               <ul>
                  <li><a href="<?= base_url(); ?>">Home</a> -</li>
                  <li><a href="<?= base_url(); ?>exterior">Exterior</a> -</li>
                  <li><a href="<?= base_url('exterior/' . $brand->name); ?>"><?= $brand->name; ?></a> -</li>
                  <li><a href="#" class="activee"><?= $model->model_name; ?></a></li>
               </ul>
               <h2>Choose a <span>Feature</span></h2>
            </div>
            <div class="back-click" onclick="goBack()" style="margin: 10px;">
               <i class="fa-solid fa-left-long"></i>
            </div>
            <div class="tab-row row">
               <!-- Feature Buttons -->
               <div class="col-md-6 tab-item1">
                  <?php if (!empty($features)): ?>
                  <?php foreach ($features as $feature): ?>
                  <?php
                     $imagePaths = array_map(function ($img) {
                        return base_url('assets/images/brand-model/' . $img->image_path);
                     }, $feature->images ?? []);
                     $imagePathsJson = htmlspecialchars(json_encode($imagePaths), ENT_QUOTES, 'UTF-8');
                     ?>
                  <button onclick="changeFeatureImages(<?= $imagePathsJson ?>, '<?= $feature->part_code ?>', '<?= $feature->name ?>')">
                  <?= $feature->name ?>
                  </button>
                  <?php endforeach; ?>
                  <?php else: ?>
                  <p>No features available for this model.</p>
                  <?php endif; ?>
                  <div class="purchase-now">
                     <a href="tel:+917042040461">Purchase Now</a>
                  </div>
               </div>
               <!-- Swiper Slider -->
               <div class="col-md-6 tab-item2">
                  <?php if (!empty($features) && !empty($features[0]->images)): ?>
                  <div class="swiper swiper-container" id="featureSlider">
                     <div class="swiper-wrapper" id="swiperWrapper">
                        <?php foreach ($features[0]->images as $img): ?>
                        <div class="swiper-slide">
                           <img src="<?= base_url('assets/images/brand-model/' . $img->image_path); ?>" onclick="openZoom(this.src)">
                        </div>
                        <?php endforeach; ?>
                     </div>
                     <div class="swiper-pagination"></div>
                     <div class="swiper-button-next"></div>
                     <div class="swiper-button-prev"></div>
                  </div>
                  <p class="number d-none"><span id="imageNumber">Part Code: <?= $features[0]->part_code ?? 'N/A'; ?></span></p>
                  <p id="modelText"><?= $features[0]->name ?? 'Unnamed'; ?></p>
                  <?php else: ?>
                  <p>No image available.</p>
                  <?php endif; ?>
                  <button class="zoom-btn" onclick="openZoom(getCurrentImageSrc())">Click to Zoom</button>
               </div>
            </div>
         </div>
      </section>
      <!-- Zoom Modal -->
      <div class="zoom-modal" id="zoomModal" onclick="closeZoom()">
         <button class="zoom-close" onclick="closeZoom()">X</button>
         <img id="zoomedImage" src="" alt="Zoomed Image">
      </div>
      <?php include(APPPATH . 'views/modals/quotation-modal.php'); ?>
      <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
      <script>
         const swiper = new Swiper('.swiper-container', {
            loop: true,
            pagination: {
               el: '.swiper-pagination',
               clickable: true,
            },
            navigation: {
               nextEl: '.swiper-button-next',
               prevEl: '.swiper-button-prev',
            },
         });
         
         // Automatically select the first feature on page load
         window.onload = function() {
            const firstFeatureButton = document.querySelector('.tab-item1 button');
            if (firstFeatureButton) {
               firstFeatureButton.click();
            }
         };
         
         // Button click hone par active class apply karna
         document.querySelectorAll('.tab-item1 button').forEach(button => {
            button.addEventListener('click', function() {
               // Saare buttons se active class hata do
               document.querySelectorAll('.tab-item1 button').forEach(btn => btn.classList.remove('active'));
               // Jo button click ho, usme active class add kar do
               this.classList.add('active');
            });
         });
         
         function changeFeatureImages(images, partCode, featureName) {
            const wrapper = document.getElementById('swiperWrapper');
            wrapper.innerHTML = '';
         
            images.forEach(imageUrl => {
               const slide = document.createElement('div');
               slide.className = 'swiper-slide';
               slide.innerHTML = `<img src="${imageUrl}" onclick="openZoom('${imageUrl}')">`;
               wrapper.appendChild(slide);
            });
         
            swiper.update();
            swiper.slideTo(0);
            document.getElementById('imageNumber').innerText = 'Part Code: ' + partCode;
            document.getElementById('modelText').innerText = featureName;
         }
         
         function getCurrentImageSrc() {
            const currentSlide = swiper.slides[swiper.activeIndex];  // Get the active slide
            const imgElement = currentSlide.querySelector('img');  // Get the image in the active slide
            return imgElement ? imgElement.src : '';  // Return the image source
         }
         
         function openZoom(src) {
            if (src) {
               document.getElementById('zoomModal').style.display = 'flex';
               document.getElementById('zoomedImage').src = src;
            }
         }
         
         function closeZoom() {
            document.getElementById('zoomModal').style.display = 'none';
         }
         
         function goBack() {
            window.history.back();
         }
      </script>
      <?php include_once('layout/footer-link.php'); ?>
   </body>
</html>