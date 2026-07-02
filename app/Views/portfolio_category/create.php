<?php

/** @var string $lang */
/** @var bool $isTranslation */
/** @var array|null $category */

$isTranslation =
    $isTranslation ?? false;

$category =
    $category ?? null;

?>

<?= $this->include('template/header') ?>
<?= $this->include('template/sidebar') ?>

<main class="app-main">

    <div class="app-content-header">

        <div class="container-fluid">

            <h3>

                <?= $isTranslation
                    ? 'Add Translation'
                    : 'Create Portfolio Category'
                ?>

                (<?= strtoupper($lang) ?>)

            </h3>

        </div>

    </div>

    <div class="app-content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-body">

                    <?php if ($isTranslation): ?>

                        <div class="alert alert-info">

                            Translation Mode

                        </div>

                    <?php endif; ?>

                    <form
                        action="<?= base_url(
                            'portfolio-category/store'
                        ) ?>"
                        method="post">

                        <input
                            type="hidden"
                            name="lang"
                            value="<?= $lang ?>">

                        <?php if ($isTranslation): ?>

                            <input
                                type="hidden"
                                name="portfolio_category_id"
                                value="<?= $category['id'] ?>">

                        <?php endif; ?>

                        <div class="mb-3">

                            <label class="form-label">

                                Category Name

                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                required>

                        </div>

                        <?php if (!$isTranslation): ?>

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

                        <?php endif; ?>

                        <button
                            type="submit"
                            class="btn btn-success">

                            Save

                        </button>

                        <a
                            href="<?= base_url(
                                'portfolio-category/' . $lang
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