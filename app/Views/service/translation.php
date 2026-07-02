<?php

/** @var string $lang */
/** @var int|string $service_id */
/** @var array<string, mixed> $service */

?>
<?= $this->include('template/header') ?>
<?= $this->include('template/sidebar') ?>
<main class="app-main">

    <div class="app-content-header">

        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-6">

                    <h3 class="mb-0">
                        Add Translation (<?= strtoupper($lang) ?>)
                    </h3>

                </div>

            </div>

        </div>

    </div>

    <div class="app-content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-body">

                    <form action="<?= base_url(
                                        'service/add-translation/' .
                                            $service_id
                                    ) ?>"
                        method="post">

                        <input type="hidden"
                            name="lang"
                            value="<?= $lang ?>">

                        <!-- IMAGE -->

                        <div class="mb-3 text-center">

                            <img
                                src="<?= base_url(
                                            'image/service/' .
                                                $service['image']
                                        ) ?>"
                                class="img-fluid rounded"
                                style="max-height:250px;">

                        </div>

                        <!-- TITLE -->

                        <div class="mb-3">

                            <label class="form-label">
                                Title
                            </label>

                            <input type="text"
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

                        <button class="btn btn-success">

                            Save Translation

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
<?= $this->include('modal/serviceModal') ?>
<?= $this->include('template/footer') ?>
<?= $this->include('js/service') ?>