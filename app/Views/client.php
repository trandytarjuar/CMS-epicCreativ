<?= $this->include('template/header') ?>
<?= $this->include('template/sidebar') ?>

<main class="app-main">
  <!--begin::App Content Header-->
  <div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Client</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Client</li>
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
              <h3 class="card-title">List Client</h3>
              <button class="btn btn-primary btn-sm float-end"  onclick="openAddModal()">
              <!-- <button class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modalAddClient" onclick="openAddModal()"> -->
                Add Client
              </button>
              <!-- <a href="" class="btn btn-primary btn-sm"style="float: right;">
                Add User
              </a> -->
            </div>
            <!-- /.card-header -->
            <!-- <div class="card-body"> -->
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="clientTable">
                <thead>
                  <tr>
                    <th>Client Name</th>
                    <th>Image</th>
                    <th style="width: 40px">Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <td><?= $client['name'] ?></td>
                            <td>
                                <?php if (!empty($client['logo'])): ?>
                                    <img src="<?= base_url('image/client/' . $client['logo']) ?>" alt="Client Logo" width="50">
                                <?php endif; ?>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary" onclick="openEditModal(<?= $client['id'] ?>)">
                                    Edit
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="deleteClient(<?= $client['id'] ?>)">
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
<?= $this->include('modal/clientModal') ?>
<?= $this->include('template/footer') ?>
<?= $this->include('js/client') ?>