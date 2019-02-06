
<?php require_once 'includes/header.php'; ?>

<div class="col-md-10 float-right mt-2 mr-2 ">

  <div class="container p-0">
  
    <div class="card">
      
      <div class="card-header"><h4 class="d-4">Purchases</h4></div>

      <div class="card-body">
      
        <button class="btn btn-secondary ml-auto mb-4" id="openAddModal">
          <i class="fas fa-plus"></i> Add New Purchase
        </button>
        
        <table id="table" class="table table-bordered table-striped" style="width: 100%;">

          <thead>
            <th>Product</th>
            <th>Supplier</th>
            <th>Date</th>
            <th>Price</th>
            <th>Amount</th>
            <th>Total</th>
            <th>Options</th>
          </thead>

        </table>

        <!-- Modal -->
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="Modal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add New Purchase</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <form id="form">
                <div class="form-group">
                  <label for="product">Product</label>
                  <select id="product" class="form-control" name="product" aria-describedby="product" required></select>
                </div>
                <div class="form-group">
                  <label for="date">Date</label>
                  <input id="date" type="date" class="form-control" name="date" aria-describedby="date" placeholder="sale price" required>
                </div>
                <div class="form-row">
                  <div class="col">
                    <div class="form-group">
                      <label for="amount">Amount</label>
                      <input id="amount" type="number" class="form-control" name="amount" aria-describedby="amount" placeholder="amount" required>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="price">Price</label>
                      <input id="price" type="text" class="form-control" name="price" aria-describedby="price" placeholder="minimum amount" required>
                    </div>
                  </div>
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

<script src="js/purchases.js"></script>

<?php require_once 'includes/end.php'; ?>