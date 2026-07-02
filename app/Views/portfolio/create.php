<?php

/** @var string $lang */
/** @var bool $isTranslation */
/** @var array|null $portfolio */
/** @var array $categories */

?>


<?= $this->include('template/header') ?>
<?= $this->include('template/sidebar') ?>

<main class="app-main">

    <div class="app-content-header">

        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-6">

                    <h3>
                        Create Portfolio
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

                            Thumbnail, Client,
                            Location dan Media
                            mengikuti data utama.

                        </div>

                    <?php endif; ?>

                    <form
                        action="<?= base_url('portfolio/store') ?>"
                        method="post"
                        enctype="multipart/form-data">

                        <input
                            type="hidden"
                            name="lang"
                            value="<?= $lang ?>">

                        <?php if ($isTranslation): ?>

                            <input
                                type="hidden"
                                name="portfolio_id"
                                value="<?= $portfolio['id'] ?>">

                        <?php endif; ?>

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



                        <!-- CLIENT -->

                        <?php if (!$isTranslation): ?>

                            <div class="mb-3">

                                <label class="form-label">

                                    Client Name

                                </label>

                                <input
                                    type="text"
                                    name="client_name"
                                    class="form-control">

                            </div>

                        <?php else: ?>

                            <div class="mb-3">

                                <label class="form-label">

                                    Client Name

                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    value="<?= esc(
                                                (string)
                                                $portfolio['client_name']
                                            ) ?>"
                                    readonly>

                            </div>

                        <?php endif; ?>

                        <!-- LOCATION -->

                        <?php if (!$isTranslation): ?>

                            <div class="mb-3">

                                <label class="form-label">

                                    Location

                                </label>

                                <input
                                    type="text"
                                    name="location"
                                    class="form-control">

                            </div>

                        <?php else: ?>

                            <div class="mb-3">

                                <label class="form-label">

                                    Location

                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    value="<?= esc(
                                                (string)
                                                $portfolio['location']
                                            ) ?>"
                                    readonly>

                            </div>

                        <?php endif; ?>

                        <!-- THUMBNAIL -->

                        <?php if (!$isTranslation): ?>

                            <div class="mb-3">

                                <label class="form-label">

                                    Thumbnail

                                </label>

                                <input
                                    type="file"
                                    name="thumbnail"
                                    class="form-control">

                            </div>

                        <?php else: ?>

                            <div class="mb-3">

                                <label class="form-label">

                                    Thumbnail

                                </label>

                                <br>

                                <?php if (
                                    !empty($portfolio['thumbnail'])
                                ): ?>

                                    <img
                                        src="<?= base_url(
                                                    'portfolio/thumbnail/' .
                                                        $portfolio['thumbnail']
                                                ) ?>"
                                        class="img-thumbnail"
                                        width="250">

                                <?php endif; ?>

                            </div>

                        <?php endif; ?>

                        <!-- MEDIA TYPE -->

                        <div class="mb-3">

                            <!-- <label class="form-label">
                                Media Type
                            </label> -->

                            <!-- <select
                                name="media_type"
                                id="media_type"
                                class="form-select">

                                <option value="youtube">
                                    Youtube
                                </option>

                                <option value="upload">
                                    Upload Video
                                </option>

                            </select> -->

                            <input type="text" value="youtube" name="media_type" hidden>

                        </div>

                        <!-- YOUTUBE -->

                        <?php if (!$isTranslation): ?>

                            <div class="mb-3">

                                <label class="form-label">

                                    Youtube URL

                                </label>

                                <input
                                    type="text"
                                    name="youtube_url"
                                    class="form-control"
                                    placeholder="https://youtube.com/...">

                            </div>

                        <?php else: ?>

                            <div class="mb-3">

                                <label class="form-label">

                                    Youtube URL

                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    value="<?= esc(
                                                (string)
                                                $portfolio['youtube_url']
                                            ) ?>"
                                    readonly>

                            </div>

                        <?php endif; ?>

                        <!-- <div
                            class="mb-3"
                            id="youtubeWrapper">

                            <label class="form-label">
                                Youtube URL
                            </label>

                            <input
                                type="text"
                                name="youtube_url"
                                class="form-control"
                                placeholder="https://youtube.com/...">

                        </div> -->

                        <!-- VIDEO -->

                        <!-- <div
                            class="mb-3"
                            id="videoWrapper"
                            style="display:none;">

                            <label class="form-label">
                                Upload Video
                            </label>

                            <input
                                type="file"
                                name="video_file"
                                class="form-control"
                                accept="video/mp4,video/webm">

                        </div> -->

                        <!-- SORT -->



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
                        <?php if (!$isTranslation): ?>
                            <div class="mb-3">

                                <label>

                                    Category

                                </label>

                                <select
                                    name="portfolio_category_id"
                                    class="form-select"
                                    required>

                                    <option value="">

                                        Choose Category

                                    </option>

                                    <?php foreach (
                                        $categories as $category
                                    ): ?>

                                        <option
                                            value="<?= $category['id'] ?>">

                                            <?= esc(
                                                (string)$category['name']
                                            ) ?>

                                        </option>

                                    <?php endforeach; ?>

                                </select>

                            </div>
                        <?php else: ?>
                            <div class="mb-3">

                                <label>

                                    Category

                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    value="<?= esc(
                                                (string)$categories[0]['name']
                                            ) ?>"
                                    readonly>

                                <input
                                    type="hidden"
                                    name="portfolio_category_id"
                                    value="<?= $portfolio['portfolio_category_id'] ?? '' ?>">

                            </div>
                        <?php endif; ?>

                        <!-- BUTTON -->

                        <button class="btn btn-success">

                            Save

                        </button>

                        <a
                            href="<?= base_url(
                                        'portfolio/' . $lang
                                    ) ?>"
                            class="btn btn-secondary">

                            Cancel

                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</main>

<?= $this->include('template/footer') ?>
<?= $this->include('js/portfolio') ?>