<script>
    $("#userTable").DataTable({
        responsive: true,
        autoWidth: false,
    });
    document.getElementById("btnSaveUser").addEventListener("click", function() {

        let form = document.getElementById("formAddUser");
        let formData = new FormData(form);

        const spinner = document.getElementById("saveSpinner");
        const text = document.getElementById("saveText");
        const alertBox = document.getElementById("alertUser");

        alertBox.classList.add("d-none");

        spinner.classList.remove("d-none");
        text.innerText = "Saving...";

        fetch("<?= base_url('user') ?>", {
                method: "POST",
                body: formData
            })
            .then(res => res.json())
            .then(data => {

                spinner.classList.add("d-none");
                text.innerText = "Save";

                if (data.status === "success") {

                    toastr.success("User berhasil dibuat");
                    const modal = bootstrap.Modal.getInstance(document.getElementById('modalAddUser'));
                    modal.hide();


                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                    // location.reload();

                } else {

                    alertBox.innerText = data.message;
                    alertBox.classList.remove("d-none");

                }

            });

    });
    document.getElementById("togglePassword").addEventListener("click", function() {

        let passwordInput = document.getElementById("passwordField");
        let icon = this.querySelector("i");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.classList.remove("bi-eye");
            icon.classList.add("bi-eye-slash");
        } else {
            passwordInput.type = "password";
            icon.classList.remove("bi-eye-slash");
            icon.classList.add("bi-eye");
        }

    });
    const usernameInput = document.getElementById("usernameInput");
    const emailInput = document.getElementById("emailInput");

    usernameInput.addEventListener("keyup", checkUsername);
    emailInput.addEventListener("keyup", checkEmail);

    function checkUsername() {

        let username = usernameInput.value;

        if (username.length < 3) return;

        fetch("<?= base_url('user/check-username') ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    username: username
                })
            })
            .then(res => res.json())
            .then(data => {

                let error = document.getElementById("usernameError");

                if (data.exists) {
                    error.classList.remove("d-none");
                } else {
                    error.classList.add("d-none");
                }

            });

    }

    function checkEmail() {

        let email = emailInput.value;

        fetch("<?= base_url('user/check-email') ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    email: email
                })
            })
            .then(res => res.json())
            .then(data => {

                let error = document.getElementById("emailError");

                if (data.exists) {
                    error.classList.remove("d-none");
                } else {
                    error.classList.add("d-none");
                }

            });

    }
    document.getElementById('modalAddUser')
        .addEventListener('hidden.bs.modal', function() {

            document.getElementById("formAddUser").reset();

        });

    document.getElementById('modalAddUser')
        .addEventListener('hidden.bs.modal', function() {

            document.getElementById("formAddUser").reset();

        });
    document.getElementById('modalAddUser')
        .addEventListener('hidden.bs.modal', function() {

            document.getElementById("formAddUser").reset();

            document.getElementById("alertUser").classList.add("d-none");
            document.getElementById("usernameError").classList.add("d-none");
            document.getElementById("emailError").classList.add("d-none");

        });

    document.querySelectorAll(".btnDeleteUser").forEach(button => {

        button.addEventListener("click", function() {

            let id = this.dataset.id;

            Swal.fire({
                title: "Delete User?",
                text: "User ini akan dihapus permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel"
            }).then((result) => {

                if (result.isConfirmed) {

                    fetch("<?= base_url('user') ?>/" + id, {
                            method: "DELETE"
                        })
                        .then(res => res.json())
                        .then(data => {

                            if (data.status === "success") {

                                Swal.fire({
                                    icon: "success",
                                    title: "Deleted!",
                                    text: data.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                });

                                setTimeout(() => {
                                    location.reload();
                                }, 1500);

                            } else {

                                Swal.fire({
                                    icon: "error",
                                    title: "Error",
                                    text: data.message
                                });

                            }

                        });

                }

            });

        });

    });

    document.querySelectorAll(".btnEditUser").forEach(btn => {

        btn.addEventListener("click", function() {

            let id = this.dataset.id;

            fetch("<?= base_url('user') ?>/" + id)
                .then(res => res.json())
                .then(data => {

                    document.getElementById("editUserId").value = data.id;
                    document.getElementById("editName").value = data.name;
                    document.getElementById("editUsername").value = data.username;
                    document.getElementById("editEmail").value = data.email;
                    document.getElementById("editRole").value = data.role;

                    new bootstrap.Modal(document.getElementById("modalEditUser")).show();

                });

        });

    });

    document.getElementById("btnUpdateUser")
        .addEventListener("click", function() {

            let id = document.getElementById("editUserId").value;

            fetch("<?= base_url('user') ?>/" + id, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        name: document.getElementById("editName").value,
                        username: document.getElementById("editUsername").value,
                        email: document.getElementById("editEmail").value,
                        role: document.getElementById("editRole").value
                    })
                })
                .then(res => res.json())
                .then(data => {

                    if (data.status === "success") {

                        Swal.fire({
                            icon: "success",
                            title: "Updated",
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: false
                        });

                        setTimeout(() => {
                            location.reload();
                        }, 1500);

                    }

                });

        });
</script>