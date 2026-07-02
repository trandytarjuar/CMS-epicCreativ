<?php

/** @var array<int, array<string, mixed>> $data */

?>

<?= $this->include('template/header') ?>
<?= $this->include('template/sidebar') ?>

<main class="app-main">

    <div class="container-fluid">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">
                    Banner
                </h3>

                <button
                    class="btn btn-primary btn-sm float-end"
                    onclick="addBanner()">

                    + Add Banner

                </button>

            </div>

            <div class="card-body">

                <table class="table table-bordered" id="tableBanner">

                    <thead>

                        <tr>

                            <th>Image</th>
                            <th>Title</th>
                            <th>Position</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach (($data ?? []) as $row): ?>

                            <tr>

                                <td>

                                    <?php if (!empty($row['image'])): ?>

                                        <img
                                            src="<?= base_url(
                                                        'image/banner/' .
                                                            $row['image']
                                                    ) ?>"
                                            width="120"
                                            class="img-thumbnail">

                                    <?php else: ?>

                                        <span class="text-danger">

                                            No Image

                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <?= esc(
                                        (string) (
                                            $row['title'] ?? ''
                                        )
                                    ) ?>

                                </td>

                                <td>

                                    <?= esc(
                                        (string) (
                                            $row['position'] ?? ''
                                        )
                                    ) ?>

                                </td>

                                <td>

                                    <span class="badge <?= !empty($row['is_active'])
                                                            ? 'bg-success'
                                                            : 'bg-danger' ?>">

                                        <?= !empty($row['is_active'])
                                            ? 'Active'
                                            : 'Non Active' ?>

                                    </span>

                                </td>

                                <td>

                                    <button
                                        class="btn btn-warning btn-sm"
                                        onclick="
                                            editBanner(
                                                <?= $row['id'] ?>
                                            )
                                        ">

                                        Edit

                                    </button>

                                    <button
                                        class="btn btn-danger btn-sm"
                                        onclick="
                                            deleteBanner(
                                                <?= $row['id'] ?>
                                            )
                                        ">

                                        Delete

                                    </button>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</main>

<?= $this->include('template/footer') ?>
<?= $this->include('modal/bannerModal') ?>
<?= $this->include('js/bannerJs') ?>