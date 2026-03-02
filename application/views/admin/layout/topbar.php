  <div class="main-content">
    <div class="header">
         <form class="d-flex topbar-form" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
        
      </form>
      <div class="profile" id="profile">
              <?php if ($this->session->userdata('admin_logged_in')): ?>
        <span>Welcome, <?= $this->session->userdata('admin_name') ?></span>  
      <?php endif; ?>

        <img  class="profile-icon" src="<?php echo base_url('assets/admin/images/user.jpg'); ?>" alt="Profile" />
        <div class="profile-dropdown" id="profileDropdown">
          <a class="logout" href="<?php echo base_url('admin/logout'); ?>" id="logout">Logout</a>
        </div>
      </div>
    </div>


     <script>
   document.getElementById('profile').addEventListener('click', function() {
  var dropdown = document.getElementById('profileDropdown');
  dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
});

document.getElementById('logout').addEventListener('click', function() {
  alert('You have logged out');
  // Add your logout logic here (e.g., redirect to login page)
});
  </script>
