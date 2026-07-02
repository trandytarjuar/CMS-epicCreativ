<?php

/** @var string $lang */
/** @var array $data */

helper('text');

?>
<?= $this->include('template/header') ?>
<?= $this->include('template/sidebar') ?>
<main class="app-main">

    <!-- HEADER -->
    <div class="app-content-header">

        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-6">

                    <h3 class="mb-0">
                        Sub Service (<?= strtoupper($lang) ?>)
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
                            Sub Service
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
                        List Sub Services
                    </h3>

                    <?php if ($lang == 'id'): ?>

                        <a href="<?= base_url(
                                        'subservice/create/id'
                                    ) ?>"
                            class="btn btn-primary btn-sm float-end">

                            + Add Sub Service

                        </a>

                    <?php endif; ?>

                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table
                            class="table table-bordered table-striped"
                            id="subserviceTable">

                            <thead>

                                <tr>

                                    <th width="120">
                                        Image
                                    </th>



                                    <th>
                                        Title
                                    </th>

                                    <th>
                                        Description
                                    </th>

                                    <th width="300">
                                        Action
                                    </th>

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
                                                        src="<?= base_url(
                                                                    'image/subservice/' .
                                                                        $row['image']
                                                                ) ?>"
                                                        class="img-thumbnail"
                                                        style="
                                                            width:100px;
                                                            height:70px;
                                                            object-fit:cover;
                                                        ">

                                                <?php else: ?>

                                                    <span class="text-muted">
                                                        No Image
                                                    </span>

                                                <?php endif; ?>

                                            </td>


                                            <!-- TITLE -->
                                            <td>

                                                <?= esc(
                                                    (string) $row['title']
                                                ) ?>

                                            </td>

                                            <!-- DESCRIPTION -->
                                            <td>

                                                <?= character_limiter(
                                                    strip_tags(
                                                        (string) $row['description']
                                                    ),
                                                    100
                                                ) ?>

                                            </td>

                                            <!-- ACTION -->
                                            <td>

                                               

                                                <!-- EDIT -->
                                                <a href="<?= base_url(
                                                                'subservice/edit/' .
                                                                    $row['sub_service_id'] .
                                                                    '/' .
                                                                    $lang
                                                            ) ?>"
                                                    class="btn btn-warning btn-sm">

                                                    Edit

                                                </a>

                                                <!-- DELETE -->
                                                <button
                                                    onclick="deleteSubservice(
            <?= $row['sub_service_id'] ?>
        )"
                                                    class="btn btn-danger btn-sm">

                                                    Delete

                                                </button>


                                                <!-- ADD EN -->
                                                <?php if ($lang == 'id'): ?>

                                                    <?php if (!$row['translation_exists']): ?>

                                                        <a href="<?= base_url(
                                                                        'subservice/translation/' .
                                                                            $row['sub_service_id'] .
                                                                            '/en'
                                                                    ) ?>"
                                                            class="btn btn-success btn-sm">

                                                            Add EN

                                                        </a>

                                                    

                                                <?php endif; ?>


                                                <!-- ADD ID -->
                                                <?php if ($lang == 'en'): ?>

                                                    <?php if (!$row['translation_exists']): ?>

                                                        <a href="<?= base_url(
                                                                        'subservice/translation/' .
                                                                            $row['sub_service_id'] .
                                                                            '/id'
                                                                    ) ?>"
                                                            class="btn btn-success btn-sm">

                                                            Add ID

                                                        </a>

                                                    <?php else: ?>

                                                        <a href="<?= base_url(
                                                                        'subservice/edit/' .
                                                                            $row['sub_service_id'] .
                                                                            '/id'
                                                                    ) ?>"
                                                            class="btn btn-secondary btn-sm">

                                                            Edit ID

                                                        </a>

                                                    <?php endif; ?>

                                                <?php endif; ?>

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
<?= $this->include('template/footer') ?>
<?= $this->include('js/subservice') ?>