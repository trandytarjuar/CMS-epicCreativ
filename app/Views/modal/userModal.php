<div class="modal fade" id="modalAddUser" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div id="alertUser" class="alert alert-danger d-none"></div>

                <form id="formAddUser">

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" id="usernameInput" class="form-control" required>
                        <div id="usernameError" class="text-danger small d-none">
                            Username sudah digunakan
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" id="emailInput" class="form-control" required>
                        <div id="emailError" class="text-danger small d-none">
                            Email sudah digunakan
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select" placeholder="Select Role" required>
                            <option value="">Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="superadmin">Superadmin</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" id="passwordField" name="password" class="form-control" required>
                            <span class="input-group-text" id="togglePassword" style="cursor:pointer">
                                <i class="bi bi-eye"></i>
                            </span>
                        </div>
                    </div>

                </form>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                <button id="btnSaveUser" class="btn btn-primary">
                    <span id="saveText">Save</span>
                    <span id="saveSpinner" class="spinner-border spinner-border-sm d-none"></span>
                </button>

            </div>

        </div>
    </div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="modalEditUser" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <form id="formEditUser">

                    <input type="hidden" id="editUserId">

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" id="editName" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" id="editUsername" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" id="editEmail" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select id="editRole" class="form-select">
                            <option value="admin">Admin</option>
                            <option value="superadmin">Superadmin</option>
                        </select>
                    </div>

                </form>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="btnUpdateUser" class="btn btn-primary">Update</button>
            </div>

        </div>
    </div>
</div>