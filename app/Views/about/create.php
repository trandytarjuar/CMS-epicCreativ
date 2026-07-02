<?php

/** @var string $lang */
/** @var bool $isTranslation */
/** @var array|null $about */

$isTranslation = $isTranslation ?? false;
$about = $about ?? null;

?>

<?= $this->include('template/header') ?>
<?= $this->include('template/sidebar') ?>

<main class="app-main">

    <div class="app-content-header">

        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-6">

                    <h3>

                        <?= $isTranslation
                            ? 'Add Translation'
                            : 'Create About'
                        ?>

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

                    <?php if ($isTranslation): ?>

                        <div class="alert alert-info">

                            Translation Mode

                            <br>

                            Image, Slug, Sort dan Status
                            mengikuti data utama.

                        </div>

                    <?php endif; ?>

                    <form
                        action="<?= base_url('about/store') ?>"
                        method="post"
                        enctype="multipart/form-data">

                        <input
                            type="hidden"
                            name="lang"
                            value="<?= $lang ?>">

                        <?php if ($isTranslation): ?>

                            <input
                                type="hidden"
                                name="about_section_id"
                                value="<?= $about['id'] ?>">

                        <?php endif; ?>

                        <div class="row">

                            <div class="col-md-8">

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

                            </div>

                        </div>

                        <?php if (!$isTranslation): ?>

                            <div class="row">

                                <!-- <div class="col-md-6"> -->
                                    <!-- <div class="mb-3">

                                        <label class="form-label">

                                            Slug

                                        </label>

                                        <input
                                            type="text"
                                            name="slug"
                                            class="form-control"
                                            placeholder="company-profile"
                                            required>

                                    </div> -->

                                <!-- </div> -->

                                <!-- <div class="col-md-3">

                                    <div class="mb-3">

                                        <label class="form-label">

                                            Sort

                                        </label>

                                        <input
                                            type="number"
                                            name="sort"
                                            value="1"
                                            class="form-control">

                                    </div>

                                </div> -->

                                <div class="col-md-6">

                                    <div class="mb-3">

                                        <label class="form-label">

                                            Status

                                        </label>

                                        <select
                                            name="is_active"
                                            class="form-select">

                                            <option value="1">

                                                Active

                                            </option>

                                            <option value="0">

                                                Inactive

                                            </option>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">

                                    Image

                                </label>

                                <input
                                    type="file"
                                    name="image"
                                    class="form-control"
                                    accept="image/*">

                            </div>

                        <?php else: ?>

                            <div class="row">

                                <div class="col-md-6">

                                    <!-- <div class="mb-3">

                                        <label class="form-label">

                                            Slug

                                        </label>

                                        <input
                                            type="text"
                                            class="form-control"
                                            value="<?= esc((string) $about['slug']) ?>"
                                            readonly>

                                    </div> -->

                                </div>

                            </div>

                            <?php if (!empty($about['image'])): ?>

                                <div class="mb-3">

                                    <label class="form-label">

                                        Current Image

                                    </label>

                                    <br>

                                    <img
                                        src="<?= base_url(
                                            'image/about/' .
                                            $about['image']
                                        ) ?>"
                                        width="200"
                                        class="img-thumbnail">

                                </div>

                            <?php endif; ?>

                        <?php endif; ?>

                        <div class="mb-3">

                            <label class="form-label">

                                Content

                            </label>

                            <textarea
                                id="editor"
                                name="content"
                                class="form-control"
                                rows="8"></textarea>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-success">

                            Save

                        </button>

                        <a
                            href="<?= base_url(
                                'about/' . $lang
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

</script>