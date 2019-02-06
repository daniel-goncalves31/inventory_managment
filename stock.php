
<?php require_once 'includes/header.php'; ?>

<div class="col-md-10 float-right mt-2 mr-2 ">

  <div class="container p-0">
  
    <div class="card">
      
      <div class="card-header"><h4 class="d-4">Stock</h4></div>

      <div class="card-body">
      
        <button class="btn btn-secondary ml-auto mb-4" id="openAddModal">
          <i class="fas fa-plus" ></i> Add New Product
        </button>

        <table id="table" class="table table-bordered table-striped" style="width: 100%;">

          <thead>
            <th>Product</th>
            <th>Supplier Name</th>
            <th>Category</th>
            <th>Last Purchase</th>
            <th>Sale Price</th>
            <th>Amount</th>
            <th>Min. Amount</th>
            <th>Status</th>
            <th>Options</th> <!-- on select row -->
          </thead>

        </table>

        <!-- Modal -->
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="Modal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add New Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <div class="alert alert-info" role="alert"> <strong>The other fields only can be edited in the Purchases section! </strong> </div>
              <form id="form">
                <div class="form-group m-0">
                  <label for="image">Product Image</label>
                  <img src="images/noimage.png" id="product_image">
                </div>
                <div style="width: 100%;" class="d-flex">
                  <input type="file" accept="image/*" id="image_picker">
                  <label class="custom-image-label ml-auto" for="image_picker"><i class="fas fa-camera"></i></label>
                </div>
                <hr class="mt-2">
                <div class="form-group">
                  <label for="supplier">Supplier Name</label>
                  <select id="supplier" type="text" class="form-control" name="supplier" aria-describedby="supplier" placeholder="supplier name"  required>
                  </select>
                </div>
                <div class="form-group">
                  <label for="product">Product</label>
                  <input id="product" type="text" class="form-control" name="product" aria-describedby="product" placeholder="product" required>
                </div>
                <div class="form-group">
                  <label for="category">Category</label>
                  <input id="category" type="text" class="form-control" name="category" aria-describedby="category" placeholder="category" required>
                </div>
                <div class="form-row">
                  <div class="col">                  
                    <div class="form-group">
                      <label for="sale_price">Sale Price</label>
                      <input id="sale_price" class="form-control" name="sale_price" aria-describedby="sale_price" placeholder="sale price" required>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="unit">Unit</label>
                      <input id="unit" class="form-control" name="unit" aria-describedby="unit" placeholder="unit" required>
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col show_hide">
                    <div class="form-group">
                      <label for="amount">Amount</label>
                      <input id="amount" type="number" class="form-control" name="amount" aria-describedby="amount" placeholder="amount">
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="min_amount">Minimum Amount</label>
                      <input id="min_amount" type="number" class="form-control" name="min_amount" aria-describedby="min_amount" placeholder="minimum amount" required>
                    </div>
                  </div>
                </div>
                <div class="form-group show_hide">
                  <label for="date">Date</label>
                  <input id="date" type="date" class="form-control" name="date" aria-describedby="date" placeholder="date">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button id="btn_add" type="submit" class="btn btn-primary">Save changes</button>
                </div>
              </form>
              </div>
            </div>
          </div>
        </div> <!-- /modal -->

      </div> <!-- /card-body -->

    </div> <!-- /card -->

  </div> <!-- /container -->

</div> <!-- /col-md -->


<?php require_once 'includes/footer.php'; ?>

<script src="plugins/croppie/croppie.min.js"></script>
<script src="js/stock.js"></script>

<?php require_once 'includes/end.php'; ?>