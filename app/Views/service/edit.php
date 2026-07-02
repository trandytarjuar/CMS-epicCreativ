<?php

/** @var string $lang */
/** @var array<int, array<string, mixed>> $data */



/** @var array $service */
/** @var int $service_id */


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
                        Edit Service (<?= strtoupper($lang) ?>)
                    </h3>

                </div>

            </div>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="app-content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-body">

                    <form action="<?= base_url(
                                        'service/update/' .
                                            $service_id .
                                            '/' .
                                            $lang
                                    ) ?>"
                        method="post"
                        enctype="multipart/form-data">

                        <!-- IMAGE -->

                        <div class="mb-3">

                            <label class="form-label">
                                Current Image
                            </label>

                            <div class="mb-2">

                                <?php if (!empty($service['image'])): ?>

                                    <img
                                        src="<?= base_url(
                                                    'image/service/' .
                                                        $service['image']
                                                ) ?>"
                                        class="img-fluid rounded border"
                                        style="max-height:200px;" id="preview-image">

                                <?php else: ?>

                                    <div class="text-muted">
                                        No image
                                    </div>

                                <?php endif; ?>

                            </div>

                        </div>

                        <!-- CHANGE IMAGE -->

                        <div class="mb-3">

                            <label class="form-label">
                                Change Image
                            </label>

                            <input
                                type="file"
                                name="image"
                                class="form-control preview-image"
                                accept="image/*">

                            <small class="text-muted">
                                Kosongkan jika tidak ingin mengganti gambar
                            </small>

                        </div>

                        <!-- TITLE -->

                        <div class="mb-3">

                            <label class="form-label">
                                Title
                            </label>

                            <input
                                type="text"
                                name="title"
                                value="<?= esc((string) $service['title']) ?>"
                                class="form-control"
                                required>

                        </div>

                        <!-- DESCRIPTION -->

                        <div class="mb-3">

                            <label class="form-label">
                                Description
                            </label>

                            <textarea
                                name="description"
                                id="editor"
                                class="form-control"
                                rows="5"><?= $service['description'] ?></textarea>

                        </div>

                        <!-- BUTTON -->

                        <button class="btn btn-success">

                            Update

                        </button>

                        <a href="<?= base_url(
                                        'service/' . $lang
                                    ) ?>"
                            class="btn btn-secondary">

                            Back

                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</main>
<?= $this->include('template/footer') ?>
<?= $this->include('js/service') ?>