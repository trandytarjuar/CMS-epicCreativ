<?php

/** @var array<int, array<string, mixed>> $users */

?>
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
                        <button
                          class="btn btn-sm btn-primary btnEditUser"
                          data-id="<?= $user['id'] ?>">
                          Edit
                        </button>
                        <button
                          class="btn btn-sm btn-danger btnDeleteUser"
                          data-id="<?= $user['id'] ?>">
                          Delete
                        </button>
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


<?= $this->include('modal/userModal') ?>
<?= $this->include('template/footer') ?>
<?= $this->include('js/user') ?>