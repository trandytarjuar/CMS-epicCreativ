<script>
    $(document).ready(function() {

        $('#clientTable').DataTable({
            responsive: true,
            autoWidth: false,
        });

    });

    function openAddModal() {

        document.getElementById("modalTitle").innerText = "Add Client";

        document.getElementById("formClient").reset();
        document.getElementById("clientId").value = "";

        const preview = document.getElementById("previewLogo");
        preview.src = "";
        preview.classList.add("d-none");

        document.getElementById("alertClient").classList.add("d-none");

        new bootstrap.Modal(document.getElementById('modalClient')).show();
    }


    function openEditModal(id) {

        fetch("<?= base_url('client/show') ?>/" + id)
            .then(res => res.json())
            .then(data => {

                document.getElementById("modalTitle").innerText = "Edit Client";

                document.getElementById("clientId").value = data.id;
                document.getElementById("clientName").value = data.name;

                if (data.logo) {
                    const preview = document.getElementById("previewLogo");
                    preview.src = "<?= base_url('image/client/') ?>/" + data.logo;
                    preview.classList.remove("d-none");
                }

                new bootstrap.Modal(document.getElementById('modalClient')).show();

            });
    }


    function saveClient() {

        let id = document.getElementById("clientId").value;

        let form = document.getElementById("formClient");
        let formData = new FormData(form);

        let url = id ?
            "<?= base_url('client/update') ?>/" + id :
            "<?= base_url('client') ?>";

        fetch(url, {
                method: "POST",
                body: formData
            })
            .then(res => res.json())
            .then(data => {

                if (data.status === "success") {
                    toastr.success(data.message);
                    setTimeout(() => location.reload(), 1000);
                } else {
                    document.getElementById("alertClient").innerText = data.message;
                    document.getElementById("alertClient").classList.remove("d-none");
                }

            });

    }


    function deleteClient(id) {

        Swal.fire({
            title: 'Hapus?',
            text: "Data tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes'
        }).then((result) => {

            if (result.isConfirmed) {

                fetch("<?= base_url('client') ?>/" + id, {
                        method: "DELETE"
                    })
                    .then(res => res.json())
                    .then(data => {
                        toastr.success("Deleted");
                        setTimeout(() => location.reload(), 1000);
                    });

            }

        });
    }


    // preview + validasi PNG
    document.getElementById("logoInput")
        .addEventListener("change", function(e) {

            const file = e.target.files[0];

            if (!file) return;

            if (file.type !== "image/png") {
                toastr.error("Logo harus PNG");
                this.value = "";
                return;
            }

            const reader = new FileReader();

            reader.onload = function(event) {
                const preview = document.getElementById("previewLogo");
                preview.src = event.target.result;
                preview.classList.remove("d-none");
            };

            reader.readAsDataURL(file);

        });
</script>