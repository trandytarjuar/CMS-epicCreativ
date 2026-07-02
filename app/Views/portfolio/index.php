<?php

/** @var string $lang */
/** @var array<int, array<string, mixed>> $data */

?>

<?= $this->include('template/header') ?>
<?= $this->include('template/sidebar') ?>

<main class="app-main">

    <div class="app-content-header">
        <div class="container-fluid">

            <div class="d-flex justify-content-between">

                <h3>
                    Portfolio (<?= strtoupper($lang) ?>)
                </h3>

                <?php if ($lang == 'id'): ?>

                    <a
                        href="<?= base_url(
                                    'portfolio/create/id'
                                ) ?>"
                        class="btn btn-primary">

                        Add Portfolio

                    </a>

                <?php endif; ?>

            </div>

        </div>
    </div>

    <div class="app-content">

        <div class="container-fluid">

            <div class="row">

                <?php if (!empty($data)): ?>

                    <?php foreach ($data as $row): ?>

                        <div class="col-md-4">

                            <div class="card shadow-sm mb-4">

                                <?php if (!empty($row['thumbnail'])): ?>

                                    <img
                                        src="<?= base_url(
                                                    'portfolio/thumbnail/' .
                                                        $row['thumbnail']
                                                ) ?>"
                                        class="card-img-top"
                                        style="
                                            height:220px;
                                            object-fit:cover;
                                        ">

                                <?php endif; ?>

                                <div class="card-body">

                                    <h5>

                                        <?= esc((string) $row['title']) ?>

                                    </h5>

                                    <p class="mb-1">

                                        Client :
                                        <?= esc((string) $row['client_name']) ?>

                                    </p>

                                    <p>

                                        Location :
                                        <?= esc((string) $row['location']) ?>

                                    </p>
                                    <p>

                                        Category :
                                        <?= esc((string) $row['category_name']) ?>

                                    </p>
                                    <?php

                                    $youtubeId = '';

                                    if (!empty($row['youtube_url'])) {

                                        parse_str(
                                            parse_url($row['youtube_url'], PHP_URL_QUERY),
                                            $query
                                        );

                                        $youtubeId = $query['v'] ?? '';
                                    }

                                    ?>

                                    <?php if (!empty($youtubeId)): ?>

                                        <iframe
                                            width="100%"
                                            height="220"
                                            src="https://www.youtube.com/embed/<?= esc((string) $youtubeId) ?>"
                                            frameborder="0"
                                            allowfullscreen>
                                        </iframe>

                                    <?php endif; ?>

                                    <div class="mt-3">

                                        <a
                                            href="<?= base_url(
                                                        'portfolio/edit/' .
                                                            $row['portfolio_id'] .
                                                            '/' .
                                                            $lang
                                                    ) ?>"
                                            class="btn btn-warning btn-sm">

                                            Edit

                                        </a>
                                        <?php if (
                                            $lang == 'id' &&
                                            empty($row['has_en'])
                                        ): ?>

                                            <a
                                                href="<?= base_url(
                                                            'portfolio/translation/' .
                                                                $row['portfolio_id'] .
                                                                '/en'
                                                        ) ?>"
                                                class="btn btn-success btn-sm">

                                                Add EN

                                            </a>

                                        <?php endif; ?>


                                        <button
                                            class="btn btn-danger btn-sm"
                                            onclick="
                                                deletePortfolio(
                                                    <?= $row['portfolio_id'] ?>,
                                                    '<?= $lang ?>'
                                                )
                                            ">
                                            Delete
                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>

                <?php else: ?>

                    <div class="col-12">

                        <div class="alert alert-info">

                            <?= $lang == 'en'
                                ? 'No portfolio available'
                                : 'Belum ada portfolio'
                            ?>

                        </div>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>

</main>

<?= $this->include('template/footer') ?>
<?= $this->include('js/portfolio') ?>