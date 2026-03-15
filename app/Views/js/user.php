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
</script>