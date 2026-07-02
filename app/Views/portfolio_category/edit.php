<?php

/** @var string $lang */
/** @var array $category */
/** @var array $translation */

$lang =
    $lang ?? 'id';

$category =
    $category ?? [];

$translation =
    $translation ?? [];

?>
<?= $this->include('template/header') ?>
<?= $this->include('template/sidebar') ?>

<main class="app-main">

    <div class="app-content-header">

        <div class="container-fluid">

            <h3>

                Edit Category
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
                                    'portfolio-category/update/' .
                                        $category['id'] .
                                        '/' .
                                        $lang
                                ) ?>"
                        method="post">

                        <div class="mb-3">

                            <label>

                                Category Name

                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="<?= esc(
                                            (string)$translation['name']
                                        ) ?>"
                                required>

                        </div>

                        <?php if ($lang == 'id'): ?>

                            <div class="mb-3">

                                <label>

                                    Status

                                </label>

                                <select
                                    name="is_active"
                                    class="form-select">

                                    <option
                                        value="1"
                                        <?= $category['is_active'] == 1
                                            ? 'selected'
                                            : '' ?>>

                                        Active

                                    </option>

                                    <option
                                        value="0"
                                        <?= $category['is_active'] == 0
                                            ? 'selected'
                                            : '' ?>>

                                        Non Active

                                    </option>

                                </select>

                            </div>

                        <?php endif; ?>

                        <button
                            type="submit"
                            class="btn btn-success">

                            Update

                        </button>

                        <a
                            href="<?= base_url(
                                        'portfolio-category/' .
                                            $lang
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