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

                    location.reload();

                } else {

                    alertBox.innerText = data.message;
                    alertBox.classList.remove("d-none");

                }

            });

    });
</script>