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
                    <h3 class="mb-0">Language</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Language</li>
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
                            <h3 class="card-title">List Language</h3>
                            <button class="btn btn-primary btn-sm float-end" onclick="openAddModal()">
                                <!-- <button class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modalAddClient" onclick="openAddModal()"> -->
                                Add Language
                            </button>
                            <!-- <a href="" class="btn btn-primary btn-sm"style="float: right;">
                Add User
              </a> -->
                        </div>
                        <!-- /.card-header -->
                        <!-- <div class="card-body"> -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="languageTable">
                                <thead>
                                    <tr>
                                        <th>Language Code</th>
                                        <th>Language Name</th>
                                        <th style="width: 40px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($languages as $l): ?>
                                        <tr>
                                            <td><?= $l['code'] ?></td>
                                            <td><?= $l['name'] ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" onclick="openEditModal(<?= $l['id'] ?>, '<?= $l['code'] ?>', '<?= $l['name'] ?>')">
                                                    Edit
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="deleteLanguage(<?= $l['id'] ?>)">
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
<?= $this->include('modal/languageModal') ?>
<?= $this->include('template/footer') ?>
<?= $this->include('js/language') ?>