<?= $this->include('template/header') ?>
<?= $this->include('template/sidebar') ?>
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-6">
                    <h3 class="mb-0">
                        Behind The Scenes
                    </h3>
                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('/') ?>">
                                Home
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            Behind The Scenes
                        </li>
                    </ol>

                </div>

            </div>

        </div>
    </div>

    <div class="app-content">

        <div class="container-fluid">

            <div class="card">
                <div class="card-header">

                    <h3 class="card-title">
                        List Behind The Scenes
                    </h3>

                    <button
                        class="btn btn-primary btn-sm float-end"
                        onclick="addBehindTheScenes()">
                        + Add Behind The Scenes
                    </button>




                </div>

                <div class="card-body">
                    <div class="row">

                        <?php if (!empty($behindScenes)): ?>

                            <?php foreach ($behindScenes as $row): ?>

                                <?php

                                $youtubeId = '';

                                preg_match(
                                    '/(?:v=|youtu\.be\/)([^&]+)/',
                                    $row['youtube_embed'],
                                    $matches
                                );

                                if (!empty($matches[1])) {

                                    $youtubeId =
                                        $matches[1];
                                }

                                ?>

                                <div class="col-md-6">

                                    <div class="card mb-4">

                                        <div class="card-body">

                                            <iframe
                                                width="100%"
                                                height="315"
                                                src="https://www.youtube.com/embed/<?= $youtubeId ?>"
                                                frameborder="0"
                                                allowfullscreen>
                                            </iframe>
                                            <div class="mt-3">

                                                <?php if ($row['is_active'] == 1): ?>

                                                    <span class="badge bg-success">

                                                        Active

                                                    </span>

                                                <?php else: ?>

                                                    <span class="badge bg-secondary">

                                                        Non Active

                                                    </span>

                                                <?php endif; ?>

                                            </div>

                                            <div class="mt-3">

                                                <button
                                                    class="btn btn-warning btn-sm"
                                                    onclick="
                                                        editBehindScene(
                                                            <?= $row['id'] ?>
                                                        )
                                                    ">

                                                    Edit

                                                </button>

                                                <button
                                                    class="btn btn-danger btn-sm"
                                                    onclick="
                                                deleteBehindScene(
                                                    <?= $row['id'] ?>
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

                                    Belum ada video.

                                </div>

                            </div>

                        <?php endif; ?>

                    </div>
                </div>

            </div>

        </div>

    </div>
</main>
<?= $this->include('template/footer') ?>
<?= $this->include('modal/behindscenceModal') ?>
<?= $this->include('js/behindscence') ?>