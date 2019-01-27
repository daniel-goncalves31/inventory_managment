
<?php require_once 'includes/header.php'; ?>

<div class="col-md-10 float-right mt-2 mr-2 ">

  <div class="container p-0">
  
    <div class="card">
      
      <div class="card-header"><h4 class="d-4">Suppliers</h4></div>

      <div class="card-title ml-auto pr-4 pt-3">Suppliers Management</div>

      <div class="card-body">
      
        <button class="btn btn-secondary ml-auto mb-4" id="openAddModal" data-toggle="modal" data-target="#modal">
          <i class="fas fa-plus"></i> Add New Supplier
        </button>

        <table id="table" class="table table-bordered table-striped" style="width: 100%;">

          <thead>
            <th>Supplier Name</th>
            <th>CPF/CNPJ</th>
            <th>Email</th>
            <th>Status</th>
            <th>Options</th>
          </thead>

        </table>

        <!-- Modal -->
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="AddModal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add New Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <form id="form">
                <div class="form-group">
                  <label for="name">Supplier Name</label>
                  <input id="name" type="text" class="form-control" name="name" aria-describedby="name" placeholder="supplier name" required >
                </div>
                <div class="form-group">
                  <label for="cpf_cnpj">CPF/CNPJ</label>
                  <input id="cpf_cnpj" type="text" class="form-control" name="cpf_cnpj" aria-describedby="cpf_cnpj" placeholder="cpf or cnpj" data-parsley-minlength="14" required>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input id="email" type="email" class="form-control" name="email" aria-describedby="email" placeholder="email" required>
                </div>
                <div class="form-group">
                  <label for="status">Supplier Status</label>
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
      </div> <!-- /card-body -->

    </div> <!-- /card -->

  </div> <!-- /container -->

</div> <!-- /col-md -->


<?php require_once 'includes/footer.php'; ?>

<script src="js/suppliers.js"></script>

<?php require_once 'includes/end.php'; ?>