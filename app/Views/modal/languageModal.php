<div class="modal fade" id="modalLanguage">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 id="modalTitle">Add Language</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <form id="formLanguage">

                    <input type="hidden" id="languageId">

                    <label>Code</label>
                    <input name="code" id="langCode" class="form-control mb-2" placeholder="ex: en">

                    <label>Name</label>
                    <input name="name" id="langName" class="form-control mb-2" placeholder="English">

                </form>

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" onclick="saveLanguage()">Save</button>
            </div>

        </div>
    </div>
</div>