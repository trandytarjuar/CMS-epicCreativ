<div
    class="modal fade"
    id="bannerModal">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 id="modalTitle">

                    Add Banner

                </h5>

            </div>

            <div class="modal-body">

                <form
                    id="formBanner"
                    enctype="multipart/form-data">

                    <input
                        type="hidden"
                        id="bannerId">

                    <div class="mb-3">

                        <label>

                            Image

                        </label>

                        <input
                            type="file"
                            name="image"
                            class="form-control">

                    </div>

                    <div class="mb-3">

                        <label>

                            Title

                        </label>

                        <input
                            type="text"
                            name="title"
                            class="form-control">

                    </div>

                    <div class="mb-3">

                        <label>

                            Subtitle

                        </label>

                        <textarea
                            name="subtitle"
                            class="form-control"></textarea>

                    </div>

                    <div class="mb-3">

                        <label>

                            Position

                        </label>

                        <select
                            name="position"
                            class="form-select">

                            <option value="home">
                                Home
                            </option>

                            <option value="about">
                                About
                            </option>

                            <option value="service">
                                Service
                            </option>

                            <option value="portfolio">
                                Portfolio
                            </option>

                            <option value="contact">
                                Contact
                            </option>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label>

                            Status

                        </label>

                        <select
                            name="is_active"
                            class="form-select">

                            <option value="1">
                                Active
                            </option>

                            <option value="0">
                                Non Active
                            </option>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label>

                            Sort Order

                        </label>

                        <input
                            type="number"
                            name="sort_order"
                            class="form-control"
                            value="1">

                    </div>

                </form>

            </div>

            <div class="modal-footer">

                <button
                    class="btn btn-primary"
                    onclick="saveBanner()">

                    Save

                </button>

            </div>

        </div>

    </div>

</div>