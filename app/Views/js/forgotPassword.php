<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000"
    };
    document.addEventListener("DOMContentLoaded", function() {

        const btnReset = document.getElementById("btnReset");

        if (!btnReset) return;

        btnReset.addEventListener("click", function() {

            let email = document.getElementById("email").value;

            if (!email) {
                toastr.error("Email wajib diisi");
                return;
            }

            let formData = new FormData();
            formData.append("email", email);

            fetch("<?= base_url('forgot-password') ?>", {
                    method: "POST",
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    toastr.success(data.message);
                })
                .catch(err => {
                    toastr.error("Terjadi kesalahan server");
                    console.error(err);
                });

        });

    });


    document.getElementById("btnChangePassword")
        .addEventListener("click", function() {

            let password = document.getElementById("password").value;
            let token = document.getElementById("token").value;

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
                        }, 1500)

                    }

                });

        });
</script>