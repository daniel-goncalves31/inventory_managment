
<?php require_once 'includes/header.php'; ?>

<div class="col-md-10 float-right mt-2 mr-2 ">

  <div class="container p-0">
  
    <div class="card">
      
      <div class="card-header"><h4 class="d-4">Add Sale</h4></div>

      <div class="card-body">
      
        <div class="row">

          <div class="col-md-8" style="padding: 10px;">

            <div class="input-group">

              <select class="selectpicker form-control" multiple data-live-search="true" title="Select the products">
              </select>
              <div class="input-group-append">
                <button id="btnAddToCart" class="btn btn-success" type="button"><i class="fas fa-cart-plus"></i> </button>
              </div>

            </div> <!-- /input-group -->

            <div style="margin: 15px 0;">

              <table id="table" class="table table-bordered table-hover" style="width: 100%;">
              
                <thead>
                  <th width="45%">Product</th>
                  <th width="15%">Price</th>
                  <th width="15%">Quantity</th>
                  <th width="15%">Total</th>
                  <th width="10%"></th>
                </thead>

                <tbody></tbody>                

              </table>

            </div> <!-- /row (col 1) -->

          </div> <!-- /col 1 -->

          <div class="col-md-4">

            <label for="clientName">Select a Client:</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-user-plus"></i></button>
              </div>
              <select class="custom-select" id="clientName">
              </select>
            </div>

            <div class="row">
              <div class="col-md-9">Products Number</div>
              <div class="col-md-3 pl-auto pr-0">1000</div>
            </div>
            <div class="row mt-3">
              <div class="col-md-9">Items Number</div>
              <div class="col-md-3 pl-auto pr-0">1000</div>
            </div>
            <div class="row mt-3">
              <div class="col-md-8">Discount</div>
              <div class="col-md-4">
                <input type="number" max="100" min="0" class="d-inline w-75 h-100 form-control">
                <div class="d-inline">%</div>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-5 pt-1">Sale Date</div>
              <div class="col-md-7">
                <input type="date" class="w-100 form-control" style="width: 80%;">
              </div>
            </div>


          </div> <!-- /col 2 -->

        </div> <!-- /main row -->

      </div> <!-- /card-body -->

    </div> <!-- /card -->

  </div> <!-- /container -->

</div> <!-- /col-md -->


<?php require_once 'includes/footer.php'; ?>

<script src="plugins/boostrap_select/bootstrap_select.min.js"></script>
<script src="js/add_sale.js"></script>

<?php require_once 'includes/end.php'; ?>