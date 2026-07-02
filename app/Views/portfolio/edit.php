<?php

/** @var string $lang */
/** @var array $portfolio */
/** @var array $translation */
/** @var bool $isMaster */
/** @var array $categories */

$isMaster = $isMaster ?? false;

?>

<?= $this->include('template/header') ?>
<?= $this->include('template/sidebar') ?>

<main class="app-main">

    <div class="app-content-header">

        <div class="container-fluid">

            <h3>

                Edit Portfolio
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
                                    'portfolio/update/' .
                                        $portfolio['id'] .
                                        '/' .
                                        $lang
                                ) ?>"
                        method="post"
                        enctype="multipart/form-data">

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
                                            (string)(string)
                                            $translation['title']
                                        ) ?>"
                                required>

                        </div>

                        <!-- DESCRIPTION -->

                        <!-- <div class="mb-3">

                            <label class="form-label">

                                Description

                            </label>

                            <textarea
                                name="description"
                                id="editor"
                                class="form-control"><?= esc(
                                                            (string)
                                                            $translation['description']
                                                        ) ?></textarea>

                        </div> -->

                        <?php if ($isMaster): ?>

                            <!-- CLIENT -->

                            <div class="mb-3">

                                <label>

                                    Client Name

                                </label>

                                <input
                                    type="text"
                                    name="client_name"
                                    class="form-control"
                                    value="<?= esc(
                                                (string)
                                                $portfolio['client_name']
                                            ) ?>">

                            </div>

                            <!-- LOCATION -->

                            <div class="mb-3">

                                <label>

                                    Location

                                </label>

                                <input
                                    type="text"
                                    name="location"
                                    class="form-control"
                                    value="<?= esc(
                                                (string)
                                                $portfolio['location']
                                            ) ?>">

                            </div>

                            <!-- THUMBNAIL -->

                            <div class="mb-3">

                                <label>

                                    Current Thumbnail

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
                                        width="250"
                                        class="img-thumbnail">

                                <?php endif; ?>

                            </div>

                            <div class="mb-3">

                                <label>

                                    Replace Thumbnail

                                </label>

                                <input
                                    type="file"
                                    name="thumbnail"
                                    class="form-control">

                            </div>

                            <!-- MEDIA TYPE -->
                            <input type="text" name="media_type" value="<?= esc((string) $portfolio['media_type']) ?>" hidden>

                            <!-- <div class="mb-3">

                                <label>

                                    Media Type

                                </label>

                                <select
                                    name="media_type"
                                    id="media_type"
                                    class="form-select">

                                    <option
                                        value="youtube"
                                        <?= $portfolio['media_type']
                                            == 'youtube'
                                            ? 'selected'
                                            : '' ?>>

                                        Youtube

                                    </option>

                                    <option
                                        value="upload"
                                        <?= $portfolio['media_type']
                                            == 'upload'
                                            ? 'selected'
                                            : '' ?>>

                                        Upload Video

                                    </option>

                                </select>

                            </div> -->

                            <!-- YOUTUBE -->

                            <div
                                id="youtubeWrapper"
                                class="mb-3">

                                <label>

                                    Youtube URL

                                </label>

                                <input
                                    type="text"
                                    name="youtube_url"
                                    class="form-control"
                                    value="<?= esc(
                                                (string)
                                                $portfolio['youtube_url']
                                            ) ?>">

                            </div>

                            <!-- VIDEO -->

                            <!-- <div
                                id="videoWrapper"
                                class="mb-3">

                                <?php if (
                                    !empty($portfolio['video'])
                                ): ?>

                                    <div
                                        class="mb-2">

                                        Current Video:

                                        <br>

                                        <video
                                            width="300"
                                            controls>

                                            <source
                                                src="<?= base_url(
                                                            'portfolio/video/' .
                                                                $portfolio['video']
                                                        ) ?>">

                                        </video>

                                    </div>

                                <?php endif; ?>

                                <label>

                                    Replace Video

                                </label>

                                <input
                                    type="file"
                                    name="video_file"
                                    class="form-control">

                            </div> -->





                        <?php else: ?>

                            <!-- READ ONLY -->

                            <div class="mb-3">

                                <label>

                                    Client Name

                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    readonly
                                    value="<?= esc(
                                                (string)
                                                $portfolio['client_name']
                                            ) ?>">

                            </div>

                            <div class="mb-3">

                                <label>

                                    Location

                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    readonly
                                    value="<?= esc(
                                                (string)
                                                $portfolio['location']
                                            ) ?>">

                            </div>

                            <?php if (
                                !empty($portfolio['thumbnail'])
                            ): ?>

                                <div class="mb-3">

                                    <label>

                                        Thumbnail

                                    </label>

                                    <br>

                                    <img
                                        src="<?= base_url(
                                                    'portfolio/thumbnail/' .
                                                        $portfolio['thumbnail']
                                                ) ?>"
                                        width="250"
                                        class="img-thumbnail">

                                </div>

                            <?php endif; ?>

                        <?php endif; ?>
                        <div class="mb-3">

                            <label class="form-label">

                                Description

                            </label>

                            <textarea
                                name="description"
                                id="editor"
                                class="form-control"><?= esc(
                                                            (string)
                                                            $translation['description']
                                                        ) ?></textarea>

                        </div>
                        <div class="mb-3">

                            <label>

                                Category

                            </label>

                            <select
                                name="portfolio_category_id"
                                class="form-select"
                                required>

                                <?php foreach (
                                    $categories as $category
                                ): ?>

                                    <option
                                        value="<?= $category['id'] ?>"

                                        <?= $portfolio['portfolio_category_id'] == $category['id']

                                            ? 'selected'
                                            : '' ?>>

                                        <?= esc(
                                            (string) $category['name']
                                        ) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-success">

                            Update

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
<script>
    ClassicEditor
        .create(
            document.querySelector(
                '#editor'
            )
        );

    function toggleMediaType() {
        let type =
            $('#media_type').val();

        if (type === 'youtube') {
            $('#youtubeWrapper').show();
            $('#videoWrapper').hide();
        } else {
            $('#youtubeWrapper').hide();
            $('#videoWrapper').show();
        }
    }

    $(document).ready(function() {

        if ($('#media_type').length) {
            toggleMediaType();

            $('#media_type').change(function() {

                toggleMediaType();

            });
        }

    });
</script>