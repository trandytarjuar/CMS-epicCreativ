<?php

/** @var string $lang */
/** @var array $services */

?>
<?= $this->include('template/header') ?>
<?= $this->include('template/sidebar') ?>
<main class="app-main">

    <div class="app-content-header">

        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-6">

                    <h3 class="mb-0">
                        Create Sub Service
                        (<?= strtoupper($lang) ?>)
                    </h3>

                </div>

            </div>

        </div>

    </div>

    <div class="app-content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-body">

                    <form
                        action="<?= base_url('subservice/store') ?>"
                        method="post"
                        enctype="multipart/form-data">

                        <input
                            type="hidden"
                            name="lang"
                            value="<?= $lang ?>">

                        <!-- SERVICE -->

                        <div class="mb-3">

                            <label class="form-label">
                                Service
                            </label>

                            <select
                                name="service_id"
                                class="form-select"
                                required>

                                <option value="">
                                    -- Select Service --
                                </option>

                                <?php foreach ($services as $service): ?>

                                    <option
                                        value="<?= $service['service_id'] ?>">

                                        <?= esc(
                                            (string) $service['title']
                                        ) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <!-- IMAGE -->

                        <div class="mb-3">

                            <label class="form-label">
                                Image
                            </label>

                            <div class="mb-2">

                                <img
                                    id="preview-image"
                                    style="
                                        max-height:200px;
                                        display:none;
                                    "
                                    class="img-fluid rounded border">

                            </div>

                            <input
                                type="file"
                                name="image"
                                class="form-control preview-image"
                                accept="image/*">

                        </div>

                        <!-- TITLE -->

                        <div class="mb-3">

                            <label class="form-label">
                                Title
                            </label>

                            <input
                                type="text"
                                name="title"
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
                                rows="5"></textarea>

                        </div>

                        <!-- BUTTON -->

                        <button class="btn btn-success">

                            Save

                        </button>

                        <a href="<?= base_url(
                                        'subservice/' . $lang
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
<?= $this->include('js/subservice') ?>