<?php

/** @var string $lang */
/** @var array<int, array<string, mixed>> $data */
helper('text');

?>

<?= $this->include('template/header') ?>
<?= $this->include('template/sidebar') ?>

<main class="app-main">
    <div class="app-content-header">

        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-6">

                    <h3 class="mb-0">
                        About Us (<?= strtoupper($lang) ?>)
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
                            About Us
                        </li>


                    </ol>


                </div>


            </div>

        </div>

    </div>
    <div class="app-content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-header">

                    <h3 class="card-title">
                        List About Us
                    </h3>

                    <?php if ($lang == 'id'): ?>

                        <a
                            href="<?= base_url(
                                        'about/create/id'
                                    ) ?>"
                            class="btn btn-primary btn-sm float-end">

                            Add About Us

                        </a>

                    <?php endif; ?>

                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table
                            class="table table-bordered table-striped"
                            id="aboutTable">

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
                                    <th>
                                        Is Active
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
                                                                    'image/about/' .
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
                                                        (string) $row['content']
                                                    ),
                                                    100
                                                ) ?>

                                            </td>
                                            <td class="text-center">

                                                <?php if ($row['is_active']): ?>

                                                    <span class="badge bg-success">
                                                        Active
                                                    </span>

                                                <?php else: ?>

                                                    <span class="badge bg-secondary">
                                                        Inactive
                                                    </span>

                                                <?php endif; ?>
                                            </td>

                                            <!-- ACTION -->
                                            <td>



                                                <!-- EDIT -->
                                                <a
                                                    href="<?= base_url(
                                                                'about/edit/' .
                                                                    $row['about_id'] .
                                                                    '/' .
                                                                    $lang
                                                            ) ?>"
                                                    class="btn btn-warning btn-sm">

                                                    Edit

                                                </a>

                                                <!-- DELETE -->
                                                <button
                                                    onclick="deleteAbout(
                                                        <?= $row['about_id'] ?>,
                                                        '<?= $lang ?>'
                                                    )"
                                                    class="btn btn-danger btn-sm">

                                                    Delete

                                                </button>


                                                <!-- ADD EN -->
                                                <?php if ($lang == 'id'): ?>

                                                    <?php if (!$row['has_en']): ?>

                                                        <a href="<?= base_url(
                                                                        'about/translation/' .
                                                                            $row['about_id'] .
                                                                            '/en'
                                                                    ) ?>"
                                                            class="btn btn-success btn-sm">

                                                            Add EN

                                                        </a>



                                                    <?php endif; ?>

                                                <?php endif; ?>


                                                <!-- ADD ID -->


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
<?= $this->include('js/about') ?>