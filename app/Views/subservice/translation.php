<?php

/** @var string $lang */
/** @var int|string $sub_service_id */
/** @var array<string, mixed> $service */

?>
<?= $this->include('template/header') ?>
<?= $this->include('template/sidebar') ?>

<main class="app-main">

    <div class="app-content-header">

        <div class="container-fluid">

            <h3>
                Add Translation
                (<?= strtoupper($lang) ?>)
            </h3>

        </div>

    </div>

    <div class="app-content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-body">
                    <div class="mb-3">

                        <label class="form-label">
                            Service
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="<?= esc((string)($service['title'] ?? '')) ?>"
                            readonly>

                    </div>

                    <form
                        action="<?= base_url(
                                    'subservice/store-translation'
                                ) ?>"
                        method="post">

                        <input
                            type="hidden"
                            name="lang"
                            value="<?= $lang ?>">

                        <input
                            type="hidden"
                            name="sub_service_id"
                            value="<?= $sub_service_id ?>">

                        <!-- TITLE -->

                        <div class="mb-3">

                            <label>
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

                            <label>
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

<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>