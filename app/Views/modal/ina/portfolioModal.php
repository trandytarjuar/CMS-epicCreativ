<div class="modal fade" id="modalPortfolio">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5>Portfolio</h5>
            </div>

            <div class="modal-body">

                <form id="formPortfolio" enctype="multipart/form-data">

                    <input type="hidden" id="portfolioId">

                    <label for="client_name">Client Name</label>
                    <input name="client_name" class="form-control mb-2" placeholder="Client Name">

                    <label for="youtube_embed">Youtube Link</label>
                    <input name="youtube_embed" class="form-control mb-2" placeholder="Youtube Link">
                    <label for="thumbnail">Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control mb-2">
                    <label for="banner">Banner</label>
                    <input type="file" name="banner" class="form-control mb-2">

                </form>

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" onclick="savePortfolio()">Save</button>
            </div>

        </div>
    </div>
</div>