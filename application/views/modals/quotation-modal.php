<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $model->name; ?> Features</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/brands-model.css">
</head>
<body>
  
<!-- Modal: Request Quotation -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Request Quotation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form action="#" method="post">
          <div class="row">

            <div class="col-md-6 mb-3">
              <label>Full Name</label>
              <input type="text" class="form-control" name="full_name" required>
            </div>

            <div class="col-md-6 mb-3">
              <label>Mobile No</label>
              <input type="text" class="form-control" name="mobile" required>
            </div>

            <div class="col-md-6 mb-3">
              <label>Pre-Cut Type</label>
              <select class="form-control" name="precut_type">
                <option value="Interior">Interior</option>
                <option value="Exterior">Exterior</option>
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label>Brand</label>
              <input type="text" class="form-control" name="brand">
            </div>

            <div class="col-md-6 mb-3">
              <label>Car Model</label>
              <input type="text" class="form-control" name="model">
            </div>

            <div class="col-md-6 mb-3">
              <label>PPF Type</label>
              <select class="form-control" name="ppf_type">
                <option value="Glossy">Glossy 5 Year Warranty</option>
                <option value="Matte">Matte 3 Year Warranty</option>
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label>Email ID</label>
              <input type="email" class="form-control" name="email">
            </div>

            <div class="col-md-6 mb-3">
              <label>Alternate Mobile No</label>
              <input type="text" class="form-control" name="alternate_mobile">
            </div>

            <div class="col-md-12 mb-3">
              <label>Full Address</label>
              <input type="text" class="form-control" name="address">
            </div>

            <div class="col-md-6 mb-3">
              <label>Locality</label>
              <input type="text" class="form-control" name="locality">
            </div>

            <div class="col-md-6 mb-3">
              <label>State</label>
              <input type="text" class="form-control" name="state">
            </div>

            <div class="col-md-12 mb-3">
              <label>Message</label>
              <textarea class="form-control" name="message" rows="3"></textarea>
            </div>

            <div class="col-md-12 text-end">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>