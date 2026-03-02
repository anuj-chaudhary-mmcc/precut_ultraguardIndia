
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <!-- display favicon -->
      <link rel="shortcut icon" href="<?php echo base_url();?>assets/favicon.ico" type="image/x-icon">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Brands</title>
      <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/login.css'); ?>">
        <?php include_once('layout/header.php'); ?>
   </head>
   <body>


       <?php if ($this->session->flashdata('error')): ?>
        <p style="color:red;"><?php echo $this->session->flashdata('error'); ?></p>
    <?php endif; ?>

    <form class="login-form" action="<?php echo base_url('admin/login'); ?>" method="post">
          <h1>Precut Ultraguard  Login</h1>
          <div class="row">
    <div class="col-md-12 login-item">
        <label>Email:</label>
        <input type="email" name="email" required><br><br>
    </div>
    <div class="col-md-12 login-item">
      <label>Password:</label>
        <input type="password" name="password" required><br><br>
    </div>
    <div class="col-md-12 login-item">
   <button type="submit">Login</button>
    </div>
  </div>
      
    </form>

 <?php include_once('layout/footer.php'); ?>
   </body>
</html>