<script>
    $(document).ready(function() {
        $('#languageTable').DataTable();
    });

    function openAddModal() {

        document.getElementById("modalTitle").innerText = "Add Language";

        document.getElementById("formLanguage").reset();
        document.getElementById("languageId").value = "";

        new bootstrap.Modal(document.getElementById('modalLanguage')).show();
    }


    function openEditModal(id, code, name) {

        document.getElementById("modalTitle").innerText = "Edit Language";

        document.getElementById("languageId").value = id;
        document.getElementById("langCode").value = code;
        document.getElementById("langName").value = name;

        new bootstrap.Modal(document.getElementById('modalLanguage')).show();
    }


    function saveLanguage() {

        let id = document.getElementById("languageId").value;

        let form = document.getElementById("formLanguage");
        let formData = new FormData(form);

        let url = id ?
            "<?= base_url('language/update') ?>/" + id :
            "<?= base_url('language') ?>";

        fetch(url, {
                method: "POST",
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                toastr.success(data.message);
                setTimeout(() => location.reload(), 800);
            });

    }


    function deleteLanguage(id) {

        Swal.fire({
            title: 'Hapus?',
            showCancelButton: true
        }).then(res => {

            if (res.isConfirmed) {

                fetch("<?= base_url('language') ?>/" + id, {
                        method: "DELETE"
                    })
                    .then(() => {
                        toastr.success("Deleted");
                        location.reload();
                    });

            }

        });

    }
</script>