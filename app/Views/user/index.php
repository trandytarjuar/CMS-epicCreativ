<?= $this->include('template/header') ?>
<?= $this->include('template/sidebar') ?>
<!--end::Sidebar-->
<!--begin::App Main-->
<main class="app-main">
  <!--begin::App Content Header-->
  <div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">User</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">User</li>
          </ol>
        </div>
      </div>
      <!--end::Row-->
    </div>
    <!--end::Container-->
  </div>
  <!--end::App Content Header-->
  <!--begin::App Content-->
  <div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-12">
          <div class="card mb-10">
            <div class="card-header">
              <h3 class="card-title">List User</h3>
              <button class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modalAddUser">
                Add User
              </button>
              <!-- <a href="" class="btn btn-primary btn-sm"style="float: right;">
                Add User
              </a> -->
            </div>
            <!-- /.card-header -->
            <!-- <div class="card-body"> -->
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="userTable">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Last Login</th>
                    <th style="width: 40px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($users as $user): ?>
                    <tr>
                      <td><?= $user['name'] ?></td>
                      <td><?= $user['username'] ?></td>
                      <td><?= $user['role'] ?></td>
                      <td><?= $user['last_login']
                            ? date('d M Y H:i', strtotime($user['last_login']))
                            : 'Never' ?></td>
                      <td>
                        <a href="#" class="btn btn-sm btn-primary">Edit</a>
                        <a href="#" class="btn btn-sm btn-danger">Delete</a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <!-- </div> -->
            <!-- /.card-body -->

          </div>
          <!-- /.card -->

          <!-- /.card -->
        </div>
        <!-- /.col -->

        <!-- /.col -->
      </div>
      <!-- /.row (main row) -->
    </div>
    <!--end::Container-->
  </div>
  <!--end::App Content-->
</main>
<!--end::App Main-->
<!--begin::Footer-->
<div class="modal fade" id="modalAddUser" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Add User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <div id="alertUser" class="alert alert-danger d-none"></div>

        <form id="formAddUser">

          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" id="usernameInput" class="form-control" required>
            <div id="usernameError" class="text-danger small d-none">
              Username sudah digunakan
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" id="emailInput" class="form-control" required>
            <div id="emailError" class="text-danger small d-none">
              Email sudah digunakan
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-select" placeholder="Select Role" required>
              <option value="">Select Role</option>
              <option value="admin">Admin</option>
              <option value="superadmin">Superadmin</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Password</label>
            <div class="input-group">
              <input type="password" id="passwordField" name="password" class="form-control" required>
              <span class="input-group-text" id="togglePassword" style="cursor:pointer">
                <i class="bi bi-eye"></i>
              </span>
            </div>
          </div>

        </form>

      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

        <button id="btnSaveUser" class="btn btn-primary">
          <span id="saveText">Save</span>
          <span id="saveSpinner" class="spinner-border spinner-border-sm d-none"></span>
        </button>

      </div>

    </div>
  </div>
</div>

<?= $this->include('template/footer') ?>
<?= $this->include('js/user') ?>