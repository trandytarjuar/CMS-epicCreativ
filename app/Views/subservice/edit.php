<?php

/** @var string $lang */
/** @var array<string, mixed> $subservice */
/** @var array<string, mixed> $service */

?>

<?= $this->include('template/header') ?>
<?= $this->include('template/sidebar') ?>

<main class="app-main">

    <div class="app-content-header">

        <div class="container-fluid">

            <h3>

                Edit Sub Service
                (<?= strtoupper($lang) ?>)

            </h3>

        </div>

    </div>

    <div class="app-content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-body">

                    <form
                        action="<?= base_url(
                                    'subservice/update/' .
                                        $subservice['sub_service_id']
                                ) ?>"
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

                            <input
                                type="text"
                                class="form-control"
                                value="<?= esc(
                                            (string)(
                                                $service['title']
                                                ?? ''
                                            )
                                        ) ?>"
                                readonly>

                        </div>

                        <!-- IMAGE -->

                        <div class="mb-3">

                            <label class="form-label">

                                Image

                            </label>

                            <div class="mb-2">

                                <?php if (
                                    !empty($subservice['image'])
                                ): ?>

                                    <img
                                        id="preview-image"
                                        src="<?= base_url(
                                                    'image/subservice/' .
                                                        $subservice['image']
                                                ) ?>"
                                        class="img-fluid rounded border"
                                        style="max-height:200px;">

                                <?php endif; ?>

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
                                value="<?= esc(
                                            (string)(
                                                $subservice['title']
                                            )
                                        ) ?>"
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
                                rows="5"><?= esc(
                                                (string)(
                                                    $subservice['description']
                                                )
                                            ) ?></textarea>

                        </div>

                        <!-- BUTTON -->

                        <button
                            type="submit"
                            class="btn btn-success">

                            Update

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
        .create(
            document.querySelector(
                '#editor'
            )
        )
        .catch(error => {

            console.error(error);

        });

    const imageInput =
        document.querySelector(
            '.preview-image'
        );

    if (imageInput) {

        imageInput.addEventListener(
            'change',
            function(e) {

                const file =
                    e.target.files[0];

                if (!file) return;

                const reader =
                    new FileReader();

                reader.onload =
                    function(event) {

                        let preview =
                            document.getElementById(
                                'preview-image'
                            );

                        if (!preview) {

                            preview =
                                document.createElement(
                                    'img'
                                );

                            preview.id =
                                'preview-image';

                            preview.className =
                                'img-fluid rounded border';

                            preview.style.maxHeight =
                                '200px';

                            imageInput
                                .previousElementSibling
                                .appendChild(
                                    preview
                                );
                        }

                        preview.src =
                            event.target.result;
                    };

                reader.readAsDataURL(
                    file
                );
            }
        );
    }
</script>