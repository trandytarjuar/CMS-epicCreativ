<script>
    document.getElementById("btnChangePassword")
        .addEventListener("click", function() {

            let password = document.getElementById("password").value;
            let token = document.getElementById("token").value;

            if (!password) {
                toastr.error("Password wajib diisi");
                return;
            }

            let formData = new FormData();
            formData.append("password", password);
            formData.append("token", token);

            fetch("<?= base_url('/reset-password') ?>", {
                    method: "POST",
                    body: formData
                })
                .then(res => res.json())
                .then(data => {

                    if (data.status === "success") {
                        toastr.success(data.message);

                        setTimeout(() => {
                            window.location.href = "<?= base_url('login') ?>";
                        }, 1500);
                    } else {
                        toastr.error(data.message);
                    }

                })
                .catch(() => {
                    toastr.error("Server error");
                });
        });
</script>