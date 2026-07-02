<div
    class="modal fade"
    id="modalBehindScene">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 id="modalTitle">

                    Add Behind The Scene

                </h5>

            </div>

            <div class="modal-body">

                <form
                    id="formBehindScene"
                    enctype="multipart/form-data">

                    <input
                        type="hidden"
                        id="behindSceneId">

                    <input type="text" name="media_type" id="media_type" class="form-control" value="youtube" hidden>

                    <!-- <div class="mb-3">

                        <label>

                            Media Type

                        </label>

                        <select
                            id="media_type"
                            name="media_type"
                            class="form-select">

                            <option value="upload">

                                Upload Video

                            </option>

                            <option value="youtube">

                                Youtube Embed

                            </option>

                        </select>

                    </div> -->

                    <!-- <div
                        id="uploadWrapper"
                        class="mb-3">

                        <label>

                            Video

                        </label>

                        <input
                            type="file"
                            name="video"
                            class="form-control"
                            accept="video/*">

                    </div> -->

                    <div
                        id="youtubeWrapper"
                        class="mb-3">

                        <label>

                            Youtube Embed URL

                        </label>

                        <input
                            type="text"
                            name="youtube_embed"
                            class="form-control">

                    </div>
                    <div class="mb-3">

                        <label class="form-label">

                            Status

                        </label>

                        <select
                            name="is_active"
                            id="is_active"
                            class="form-select">

                            <option value="1" selected>

                                Active

                            </option>

                            <option value="0">

                                Inactive

                            </option>

                        </select>

                    </div>

                </form>

            </div>

            <div class="modal-footer">

                <button
                    class="btn btn-primary"
                    onclick="saveBehindScene()">

                    Save

                </button>

            </div>

        </div>

    </div>

</div>