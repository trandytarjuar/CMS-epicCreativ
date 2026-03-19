<?= $this->include('template/header') ?>
<?= $this->include('template/sidebar') ?>

<main class="app-main">
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Portfolio</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Portfolio</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-10">
                        <div class="card-header">
                            <h3 class="card-title">List Portfolio</h3>
                            <button class="btn btn-primary btn-sm float-end" onclick="openAddModal()">
                                <!-- <button class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modalAddClient" onclick="openAddModal()"> -->
                                Add Portfolio
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="card shadow-sm">
                                    <div class="ratio ratio-16x9">
                                        <iframe src="" frameborder="0"></iframe>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-title">Portfolio Item</h5>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->include('modal/ina/portfolioModal') ?>
<?= $this->include('template/footer') ?>
<?= $this->include('js/ina/portfolio') ?>