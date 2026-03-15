<script>
    // show password
    document.getElementById("togglePassword")
        .addEventListener("click", function() {

            let password = document.getElementById("passwordField");

            if (password.type === "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }

        });
    $("#imageInput").hide();
    $("#btnCancelEdit").hide();
    $("#btnCancelEditPassword").hide();

    document.getElementById("btnEditProfile")
        .addEventListener("click", function() {
            $("#imageInput").show();
            // buka readonly
            $("#formProfile input").prop("readonly", false);

            // show update button
            $("#btnUpdateProfile").show();

            // hide tombol edit
            $("#btnEditProfile").hide();

            $("#btnCancelEdit").show();
        });
    document.getElementById("btnEditPassword")
        .addEventListener("click", function() {
            // buka readonly
            $("#formPassword input").prop("readonly", false);

            // show change password button
            $("#btnChangePassword").show();

            // hide edit password button
            $("#btnEditPassword").hide();
            $("#btnCancelEditPassword").show();
        });

    $("#btnCancelEditPassword").click(function() {

        $("#formPassword input").prop("readonly", true);

        $("#btnChangePassword").hide();
        $("#btnCancelEditPassword").hide();
        $("#btnEditPassword").show();

    });
    $("#btnCancelEdit").click(function() {

        $("#formProfile input").prop("readonly", true);

        $("#btnUpdateProfile").hide();

        $("#btnEditProfile").show();
        $("#btnCancelEdit").hide();
        $("#imageInput").hide();

    });



    // update profile
    document.getElementById("btnUpdateProfile")
        .addEventListener("click", function() {

            let formData = new FormData(
                document.getElementById("formProfile")
            );

            fetch("<?= base_url('profile/update') ?>", {
                    method: "POST",
                    body: formData
                })
                .then(res => res.json())
                .then(data => {

                    if (data.status === "success") {

                        toastr.success(data.message);
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                        // $("#formProfile input").prop("readonly", true);
                        // $("#btnUpdateProfile").hide();
                        // $("#btnEditProfile").show();
                        // $("#btnCancelEdit").hide();

                    }

                });

        });


    // change password
    document.getElementById("btnChangePassword")
        .addEventListener("click", function() {

            let formData = new FormData(
                document.getElementById("formPassword")
            );

            fetch("<?= base_url('profile/password') ?>", {
                    method: "POST",
                    body: formData
                })
                .then(res => res.json())
                .then(data => {

                    if (data.status === "success") {

                        toastr.success(data.message);
                        setTimeout(() => {
                            location.reload();
                        }, 1500);

                    }

                });

        });
    document.getElementById("imageInput")
        .addEventListener("change", function(e) {

            const file = e.target.files[0];

            if (!file) return;

            const reader = new FileReader();

            reader.onload = function(event) {
                document.getElementById("previewAvatar").src = event.target.result;
            };

            reader.readAsDataURL(file);

        });

    $("#btnUpdateProfile").hide();
    $("#btnChangePassword").hide();
</script>