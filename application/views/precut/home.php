<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Precut Ultraguard India</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/precut-home.css">
   
<?php include_once('layout/header-link.php'); ?>
</head>
<body>

     <div class="background"></div>

    
        <div class="container">
             <div class="logo">
           <a href="<?php echo base_url();?>"> <img src="<?php echo base_url();?>assets/images/logo/UG-logo-white.png" alt=""></a>
        </div>
     </div>

   <div class="container">
     <div class="content-box">
        <div class="row precut-row">
            <div class="col-md-6 precut-col1">
                <h1>Choose you <span>Pre-cut</span> Type</h1>
                <div class="row precut-item-row">
                    <div class="col-md-6 precut-item">
                        <a href="<?= base_url('interior') ?>"><img src="<?php echo base_url();?>assets/images/precut-home/interior.png" alt=""></a>
                        <a href="<?php echo base_url();?>interior"><h2>Interior</h2></a>
                       
                    </div>
                    <div class="col-md-6 precut-item">
                        <a href="<?php echo base_url();?>exterior"><img src="<?php echo base_url();?>assets/images/precut-home/exterior.png" alt=""></a>
                        <a href="<?php echo base_url();?>exterior"><h2>Exterior</h2></a>
                    </div>
                </div>
                
            </div>
            <div class="col-md-6 precut-col1"></div>
        </div>
        <div class="how-to-apply"><a href="<?php echo base_url();?>how-to-apply">How to apply</a></div>

    </div>
   </div>




<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1> -->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
     <img src="<?php echo base_url();?>assets/images/precut-home/coming-soon.jpg" alt="">
    
      </div>
      
    </div>
  </div>
</div>

   


<?php include_once('layout/footer-link.php'); ?>
</body>
</html>
   