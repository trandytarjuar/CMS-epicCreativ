<div class="modal fade" id="modalClient">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 id="modalTitle">Add Client</h5>
            </div>

            <div class="modal-body">

                <form id="formClient" enctype="multipart/form-data">

                    <input type="hidden" id="clientId">

                    <div class="mb-2">
                        <label>Name</label>
                        <input name="name" id="clientName" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Logo (PNG only)</label>

                        <img id="previewLogo" width="80" class="mb-2 d-none">

                        <input type="file" name="logo" id="logoInput" class="form-control" required>
                    </div>

                </form>

                <div id="alertClient" class="alert alert-danger d-none"></div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" onclick="saveClient()">Save</button>
            </div>

        </div>
    </div>
</div>