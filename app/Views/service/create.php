<?php

/** @var string $lang */

?>
<?= $this->include('template/header') ?>
<?= $this->include('template/sidebar') ?>

<main class="app-main">

    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Create Service (<?= strtoupper($lang) ?>)</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            <div class="card">

                <div class="card-body">



                    <form action="<?= base_url('service/store') ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="lang" value="<?= $lang ?>">
                        
                        <div class="row">

                            <!-- 🇮🇩 INDONESIA -->
                            <div class="col-md-12">
                                <div class="card border">
                                    <div class="card-header bg-light">
                                        <strong><?= strtoupper($lang) ?></strong>
                                    </div>
                                    <div class="card-body">

                                        <div class="mb-3">
                                            <label>Title</label>
                                            <input type="text" name="title" class="form-control" required>
                                        </div>


                                        <div class="mb-3">
                                            <label>Image (Card)</label>
                                            <div class="mt-2">
                                                <img id="preview-image"
                                                    style="max-width:120px; display:none;"
                                                    class="border rounded p-1">
                                            </div>
                                            <input type="file" name="image" class="form-control preview-image" accept="image/*">
                                        </div>


                                        <div class="mb-3">
                                            <label>Description</label>
                                            <textarea id="editor" name="desc_<?= $lang ?>" class="form-control" rows="4"></textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>


                        </div>

                        <!-- BUTTON -->
                        <div class="mt-3">
                            <button type="submit" class="btn btn-success">
                                Save
                            </button>

                            <!-- <a href="<?= base_url('service/id') ?>" class="btn btn-secondary">
                                Back
                            </a> -->
                            <!-- <a href="<?= base_url('service/' . current_lang()) ?>" class="btn btn-secondary">
                                Back
                            </a> -->


                            <a href="<?= base_url('service/' . $lang) ?>"
                                class="btn btn-secondary">
                                Back
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</main>

<?= $this->include('template/footer') ?>
<?= $this->include('js/service') ?>