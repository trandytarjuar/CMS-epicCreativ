<?php

/** @var array $user */

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
                    <h3 class="mb-0">Edit Profile</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="<?= session('image')
                                            ? base_url('image/user/' . session('image'))
                                            : base_url('image/user/default.png') ?>"
                                class="img-circle mb-3" width="120" alt="User Image">
                            <h4><?= $user['name'] ?></h4>
                            <p><?= $user['email'] ?></p>
                            <span class="badge bg-primary"><?= $user['role'] ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Profile</h3>
                        </div>
                        <div class="card-body">
                            <form id="formProfile" enctype="multipart/form-data">
                                <div class="text-center">
                                    <img id="previewAvatar" src="<?= session('image')
                                                                        ? base_url('image/user/' . session('image'))
                                                                        : base_url('image/user/default.png') ?>"
                                        class="img-circle mb-3" width="120" alt="User Image">
                                </div>

                                <input type="file"
                                    name="image"
                                    id="imageInput"
                                    class="form-control">

                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name"
                                        value="<?= $user['name'] ?>"
                                        class="form-control" readonly>
                                </div>

                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email"
                                        value="<?= $user['email'] ?>"
                                        class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label>Username</label>
                                    <input type="text" name="username"
                                        value="<?= $user['username'] ?>"
                                        class="form-control" readonly>
                                </div>

                                <button type="button"
                                    class="btn btn-primary"
                                    id="btnEditProfile">
                                    Edit Profile
                                </button>
                                <button type="button"
                                    class="btn btn-primary"
                                    id="btnUpdateProfile">
                                    Update Profile
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    id="btnCancelEdit">
                                    Cancel
                                </button>

                            </form>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Change Password</h3>
                        </div>
                        <div class="card-body">
                            <form id="formPassword">

                                <div class="mb-3">
                                    <label>New Password</label>

                                    <div class="input-group">
                                        <input type="password"
                                            id="passwordField"
                                            name="password"
                                            class="form-control" readonly>

                                        <span class="input-group-text"
                                            id="togglePassword">
                                            <i class="bi bi-eye"></i>
                                        </span>

                                    </div>

                                </div>
                                <button type="button"
                                    class="btn btn-primary"
                                    id="btnEditPassword">
                                    Edit Password
                                </button>

                                <button type="button"
                                    class="btn btn-warning"
                                    id="btnChangePassword">
                                    Change Password
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    id="btnCancelEditPassword">
                                    Cancel
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>
<!--end::App Main-->
<!--begin::Footer-->

<?= $this->include('template/footer') ?>
<?= $this->include('js/profile') ?>