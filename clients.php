
<?php require_once 'includes/header.php'; ?>

<div class="col-md-10 float-right mt-2 mr-2 ">

  <div class="container p-0">
  
    <div class="card">
      
      <div class="card-header"><h4 class="d-4">Clients</h4></div>

      <div class="card-title ml-auto pr-4 pt-3">Clients Management</div>

      <div class="card-body">
      
        <button class="btn btn-secondary ml-auto mb-4" data-toggle="modal" data-target="#modal">
          <i class="fas fa-plus"></i> Add New Client
        </button>
        <button class="btn btn-secondary ml-auto mb-4" data-toggle="modal" data-target="#file-modal">
        <i class="fas fa-file-csv"></i> Import CSV file
        </button>

        <table id="table" class="table table-bordered table-striped" style="width: 100%;">

          <thead>
            <th>Client Name</th>
            <th>CPF/CNPJ</th>
            <th>Reg. Date</th>
            <th>Email</th>
            <th>Status</th>
            <th>Options</th>
          </thead>

        </table>

        <!-- Modal -->
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="Modal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add New Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <form id="form">
                <div class="form-group">
                  <label for="name">Client Name</label>
                  <input id="name" type="text" class="form-control" name="name" aria-describedby="name" placeholder="client name" required >
                </div>
                <div class="form-group">
                  <label for="cpf_cnpj">CPF/CNPJ</label>
                  <input id="cpf_cnpj" type="text" class="form-control" name="cpf_cnpj" aria-describedby="cpf_cnpj" placeholder="cpf or cnpj" data-parsley-minlength="14" required>
                </div>
                <div class="form-group">
                  <label for="reg_date">Registration Date</label>
                  <input id="reg_date" type="date" class="form-control" name="reg_date" aria-describedby="reg_date" placeholder="registration date" required>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input id="email" type="email" class="form-control" name="email" aria-describedby="email" placeholder="email" required>
                </div>
                <div class="form-group">
                  <label for="status">Client Status</label>
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

<script src="js/clients.js"></script>

<?php require_once 'includes/end.php'; ?>