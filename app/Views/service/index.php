<?php

/** @var string $lang */
/** @var array<int, array<string, mixed>> $data */

?>
<?php helper('text'); ?>
<?= $this->include('template/header') ?>
<?= $this->include('template/sidebar') ?>
<main class="app-main">

    <!-- HEADER -->
    <div class="app-content-header">
        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-6">
                    <h3 class="mb-0">
                        Service (<?= strtoupper($lang) ?>)
                    </h3>
                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('/') ?>">
                                Home
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            Service
                        </li>
                    </ol>

                </div>

            </div>

        </div>
    </div>

    <!-- CONTENT -->
    <div class="app-content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-header">

                    <h3 class="card-title">
                        List Services
                    </h3>

                    <?php if ($lang == 'id'): ?>

                        <a href="<?= base_url('service/create/' . $lang) ?>"
                            class="btn btn-primary btn-sm float-end">

                            + Add Service

                        </a>

                    <?php endif; ?>

                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table
                            class="table table-bordered table-striped"
                            id="serviceTable">

                            <thead>

                                <tr>
                                    <th width="120">Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th width="350">Action</th>
                                </tr>

                            </thead>

                            <tbody>

                                <?php if (!empty($data)): ?>

                                    <?php foreach ($data as $row): ?>

                                        <tr>

                                            <!-- IMAGE -->
                                            <td class="text-center">

                                                <?php if (!empty($row['image'])): ?>

                                                    <img
                                                        src="<?= base_url('image/service/' . $row['image']) ?>"
                                                        class="img-thumbnail"
                                                        style="width:100px; height:70px; object-fit:cover;">

                                                <?php else: ?>

                                                    <span class="text-muted">
                                                        No Image
                                                    </span>

                                                <?php endif; ?>

                                            </td>

                                            <!-- TITLE -->
                                            <td>
                                                <?= esc((string)($row['title'] ?? '')) ?>
                                            </td>

                                            <!-- DESCRIPTION -->
                                            <td>

                                                <?= character_limiter(
                                                    strip_tags($row['description']),
                                                    100
                                                ) ?>

                                            </td>

                                            <!-- ACTION -->
                                            <td>

                                                <!-- DETAIL -->
                                                <button
                                                    onclick="detailService(<?= $row['service_id'] ?>)"
                                                    class="btn btn-info btn-sm">

                                                    Detail

                                                </button>

                                                <!-- EDIT -->
                                                <a href="<?= base_url(
                                                                'service/edit/' .
                                                                    $row['service_id'] .
                                                                    '/' .
                                                                    $lang
                                                            ) ?>"
                                                    class="btn btn-warning btn-sm">

                                                    Edit

                                                </a>

                                                <!-- ADD EN -->
                                                <?php if ($lang == 'id' && empty($row['has_en'])): ?>

                                                    <a href="<?= base_url(
                                                                    'service/translation/' .
                                                                        $row['service_id'] .
                                                                        '/en'
                                                                ) ?>"
                                                        class="btn btn-success btn-sm">

                                                        Add EN

                                                    </a>

                                                <?php endif; ?>

                                                

                                                <!-- DELETE -->
                                                <button
                                                    onclick="deleteService(<?= $row['service_id'] ?>)"
                                                    class="btn btn-danger btn-sm">

                                                    Delete

                                                </button>

                                            </td>

                                        </tr>

                                    <?php endforeach; ?>

                                <?php endif; ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>
<?= $this->include('modal/serviceModal') ?>
<?= $this->include('template/footer') ?>
<script>
    const currentLang =
        "<?= strtolower($lang) ?>";
        
</script>
<?= $this->include('js/service') ?>