<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Precut Brands - Interior</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/interior.css">
    <?php include_once('layout/header-link.php'); ?>
</head>
<body>

<section>
    <div class="container">
        <div class="brands-top">
            <img src="<?php echo base_url(); ?>assets/images/brands/brands-top.png" alt="">
        </div>

        <div class="Menu-line">
            <ul>
                <li><a href="<?php echo base_url(); ?>">Home</a> - </li>
                <li><a href="<?php echo base_url(); ?>exterior" class="active">Exterior</a></li>
            </ul>
            <h2>Choose your <span>Brand Model</span></h2>
            <div class="search-container">
                <input type="text" id="searchInputExterior" placeholder="Search Exterior Brands Or Models">
                <i class="fas fa-search"></i>
            </div>
        </div>

        <!-- 🔙 Back Button -->
        <div class="back-click" onclick="goBack()" style="margin: 10px;">
            <i class="fa-solid fa-left-long"></i>
        </div>

        <div class="row all-brands" id="defaultList">
            <?php 
            if (!empty($brands)) {
                // ✅ Sort brands alphabetically by name
                usort($brands, function ($a, $b) {
                    return strcmp(strtolower($a->name), strtolower($b->name));
                });
            ?>
                <?php foreach ($brands as $brand): ?>
                    <div class="col-md-2 col-4 brand-logo">
                        <a href="<?php echo base_url('exterior/' . strtolower(str_replace(' ', '-', $brand->name))); ?>">
                            <?php 
                                $image_path = 'assets/images/brands/' . $brand->image;
                                if (!empty($brand->image) && file_exists(FCPATH . $image_path)): ?>
                                    <img src="<?php echo base_url($image_path); ?>" width="100">
                                <?php else: ?>
                                    <span>No image</span>
                                <?php endif; ?>
                            <h3><?php echo $brand->name; ?></h3>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php } else { ?>
                <p class="text-center">No brands available in interior category.</p>
            <?php } ?>
        </div>
        <div class="row all-brands" id="searchResults" style="display:none;"></div>
    </div>
</section>

<?php include_once('layout/footer-link.php'); ?>


</body>
</html>
