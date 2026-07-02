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
                        Category Portfolio (<?= strtoupper($lang) ?>)
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
                            Category Portfolios
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
                        List Category Portfolio
                    </h3>

                    <?php if ($lang == 'id'): ?>

                        <a
                            href="<?= base_url(
                                        'portfolio-category/create/id'
                                    ) ?>"
                            class="btn btn-primary btn-sm float-end">

                            Add Category Portfolio

                        </a>

                    <?php endif; ?>

                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table
                            class="table table-bordered table-striped"
                            id="categoryTable">

                            <thead>

                                <tr>

                                    



                                    <th>
                                        Name
                                    </th>

                                    
                                    <th>
                                        status
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
                                            


                                            <!-- NAME -->
                                            <td>

                                                <?= esc(
                                                    (string) $row['name']
                                                ) ?>

                                            </td>

                                            <!-- DESCRIPTION -->
                                            
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
                                                                'portfolio-category/edit/' .
                                                                    $row['category_id'] .
                                                                    '/' .
                                                                    $lang
                                                            ) ?>"
                                                    class="btn btn-warning btn-sm">

                                                    Edit

                                                </a>

                                                <!-- DELETE -->
                                                <button
                                                    onclick="deleteCategory(
                                                        <?= $row['translation_id'] ?>,
                                                        '<?= $lang ?>'
                                                    )"
                                                    class="btn btn-danger btn-sm">

                                                    Delete

                                                </button>


                                                <!-- ADD EN -->
                                                <?php if ($lang == 'id'): ?>

                                                    <?php if (!$row['translation_exists']): ?>

                                                        <a href="<?= base_url(
                                                                        'portfolio-category/translation/' .
                                                                            $row['category_id'] .
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
<?= $this->include('js/category') ?>