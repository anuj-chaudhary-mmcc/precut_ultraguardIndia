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
               <li><a href="<?= base_url(); ?>interior">Interior</a> -</li>
               <li><a href="<?= base_url('interior/' . $brand->name); ?>"><?= $brand->name; ?></a> -</li>
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
                     <button onclick="changeFeatureImages(<?= $imagePathsJson ?>, '<?= $feature->part_code ?>', '<?= $feature->name ?>', '<?= $feature->price ?>')">
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
               <!--<p id="modelPrice">-->
               <!--   <span class="d-flex fw-bold align-items-center gap-2" style="font-size: 18px; color: #d32f2f;">-->
               <!--      <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 640 640" style="fill: #d32f2f;">-->
               <!--         <path d="M160 128C160 110.3 174.3 96 192 96L456 96C469.3 96 480 106.7 480 120C480 133.3 469.3 144 456 144L379.3 144C397 163.8 409.4 188.6 414 216L456 216C469.3 216 480 226.7 480 240C480 253.3 469.3 264 456 264L414 264C403.6 326.2 353.2 374.9 290.2 382.9L434.6 486C449 496.3 452.3 516.3 442 530.6C431.7 544.9 411.7 548.3 397.4 538L173.4 378C162.1 370 157.3 355.5 161.5 342.2C165.7 328.9 178.1 320 192 320L272 320C307.8 320 338.1 296.5 348.3 264L184 264C170.7 264 160 253.3 160 240C160 226.7 170.7 216 184 216L348.3 216C338.1 183.5 307.8 160 272 160L192 160C174.3 160 160 145.7 160 128z" />-->
               <!--      </svg>-->
               <!--      <span><= !empty($features[0]->price) ? $features[0]->price : 'N/A'; ?></span>-->
               <!--   </span>-->
               <!--</p>-->
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

      function changeFeatureImages(images, partCode, featureName, price) {
         console.log('Changing images to:', price);
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
         document.querySelector('#modelPrice span span').innerText = price || 'N/A';
      }

      function getCurrentImageSrc() {
         const currentSlide = swiper.slides[swiper.activeIndex]; // Get the active slide
         const imgElement = currentSlide.querySelector('img'); // Get the image in the active slide
         return imgElement ? imgElement.src : ''; // Return the image source
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