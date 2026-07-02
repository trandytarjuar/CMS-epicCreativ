<?php

/** @var string $lang */
/** @var array $about */
/** @var array $translation */

?>

<?= $this->include('template/header') ?>
<?= $this->include('template/sidebar') ?>

<main class="app-main">

    <div class="app-content-header">

        <div class="container-fluid">

            <h3>

                Edit About
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
                                    'about/update/' .
                                        $about['id'] .
                                        '/' .
                                        $lang
                                ) ?>"
                        method="post"
                        enctype="multipart/form-data">

                        <input
                            type="text"
                            class="form-control"
                            value="<?= $about['sort'] ?>" name="sort"
                            hidden>

                        <input
                            type="hidden"
                            name="lang"
                            value="<?= $lang ?>">

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
                                        value="<?= esc(
                                                    (string)$translation['title']
                                                ) ?>"
                                        required>

                                </div>

                            </div>

                        </div>

                        <?php if ($lang === 'id'): ?>

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="mb-3">

                                        <label class="form-label">

                                            Status

                                        </label>

                                        <select
                                            name="is_active"
                                            class="form-select">

                                            <option
                                                value="1"
                                                <?= $about['is_active'] == 1
                                                    ? 'selected'
                                                    : '' ?>>

                                                Active

                                            </option>

                                            <option
                                                value="0"
                                                <?= $about['is_active'] == 0
                                                    ? 'selected'
                                                    : '' ?>>

                                                Inactive

                                            </option>

                                        </select>

                                    </div>

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
                                        class="img-thumbnail"
                                        width="250">

                                </div>

                            <?php endif; ?>

                            <div class="mb-3">

                                <label class="form-label">

                                    Change Image

                                </label>

                                <input
                                    type="file"
                                    name="image"
                                    class="form-control"
                                    accept="image/*">

                            </div>

                        <?php endif; ?>

                        <div class="mb-3">

                            <label class="form-label">

                                Content

                            </label>

                            <textarea
                                id="editor"
                                name="content"
                                class="form-control"
                                rows="8"><?= esc(
                                                (string)$translation['content']
                                            ) ?></textarea>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-success">

                            Update

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
            document.querySelector('#editor')
        )
        .catch(error => {

            console.error(error);

        });
</script>