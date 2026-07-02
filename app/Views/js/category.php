<script>
    $(document).ready(function() {

        $('#categoryTable').DataTable({
            responsive: true,
            autoWidth: false,
            language: {
                emptyTable: "No data available"
            }
        });

    });

    function deleteCategory(
        translationId
    ) {
        Swal.fire({

            title: 'Yakin hapus data?',

            text: 'Data tidak dapat dikembalikan',

            icon: 'warning',

            showCancelButton: true,

            confirmButtonText: 'Ya, Hapus',

            cancelButtonText: 'Batal'

        }).then((result) => {

            if (
                result.isConfirmed
            ) {

                fetch(
                        `<?= base_url(
                                'portfolio-category/delete'
                            ) ?>/${translationId}`, {
                            method: 'DELETE'
                        }
                    )

                    .then(
                        response =>
                        response.json()
                    )

                    .then(data => {

                        if (
                            data.status ===
                            'success'
                        ) {

                            Swal.fire({

                                icon: 'success',

                                title: 'Berhasil',

                                text: data.message,

                                timer: 1500,

                                showConfirmButton: false

                            });

                            setTimeout(() => {

                                location.reload();

                            }, 1500);

                        } else {

                            Swal.fire({

                                icon: 'error',

                                title: 'Gagal',

                                text: data.message

                            });

                        }

                    });

            }

        });
    }
</script>