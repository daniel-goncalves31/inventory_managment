
<?php require_once 'includes/header.php'; ?>

<div class="col-md-10 float-right mt-2 mr-2 ">

  <div class="container p-0">
  
    <div class="card">
      
      <div class="card-header"><h4 class="d-4">Sellers</h4></div>

      <div class="card-title ml-auto pr-4 pt-3">Sellers Management</div>

      <div class="card-body">
      
        <button class="btn btn-secondary ml-auto mb-4" data-toggle="modal" data-target="#modal">
          <i class="fas fa-plus"></i> Add New Seller
        </button>
        <button class="btn btn-secondary ml-auto mb-4" data-toggle="modal" data-target="#file-modal">
        <i class="fas fa-file-csv"></i> Import CSV file
        </button>

        <table id="table" class="table table-bordered table-striped" style="width: 100%;">

          <thead>
            <th>Seller Name</th>
            <th>CPF</th>
            <th>Salary</th>
            <th>Hir. Date</th>
            <th>Status</th>
            <th>Options</th>
          </thead>

        </table>

        <!-- Modal -->
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="Modal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add New Seller</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <form id="form">
                <div class="form-group">
                  <label for="name">Seller Name</label>
                  <input id="name" type="text" class="form-control" name="name" aria-describedby="name" placeholder="seller name" required >
                </div>
                <div class="form-group">
                  <label for="cpf">CPF</label>
                  <input id="cpf" type="text" class="form-control" name="cpf" aria-describedby="cpf" placeholder="cpf" data-parsley-minlength="14"  data-parsley-maxlength="14" required>
                </div>
                <div class="form-group">
                  <label for="salary">Salary</label>
                  <input id="salary" type="salary" class="form-control" name="salary" aria-describedby="salary" placeholder="salary" required>
                </div>
                <div class="form-group">
                  <label for="hir_date">Hiring Date</label>
                  <input id="hir_date" type="date" class="form-control" name="hir_date" aria-describedby="hir_date" placeholder="hiring date" required>
                </div>
                <div class="form-group">
                  <label for="status">Seller Status</label>
                  <select id="status" class="form-control" name="status" id="status" required>
                    <option value="">~~~Select a Status~~~</option>
                    <option value=1>Active</option>
                    <option value=0>Inactive</option>
                  </select>
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

        <div class="modal fade" id="file-modal" tabindex="-1" role="dialog" aria-labelledby="FileModal" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Select a valid CSV file</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <form id="csv_form" enctype="multipart/form-data">
                <div class="custom-file">
                    <input name="file" type="file" class="custom-file-input" id="csv_file" accept='.csv'>
                    <label class="custom-file-label" for="csv_file">Choose file</label>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button id="btn_csv" type="submit" class="btn btn-primary">Done</button>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div> <!-- /card-body -->

    </div> <!-- /card -->

  </div> <!-- /container -->

</div> <!-- /col-md -->


<?php require_once 'includes/footer.php'; ?>

<script src="js/sellers.js"></script>

<?php require_once 'includes/end.php'; ?>