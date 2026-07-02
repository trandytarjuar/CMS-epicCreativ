<script>
    $(document).ready(function() {

        $('#aboutTable').DataTable({
            responsive: true,
            autoWidth: false,
            language: {
                emptyTable: "No data available"
            }
        });

    });

    function deleteAbout(
        id,
        lang
    ) {
        Swal.fire({

            title: 'Yakin hapus data?',

            text: 'Data tidak dapat dikembalikan',

            icon: 'warning',

            showCancelButton: true,

            confirmButtonText: 'Ya, Hapus'

        }).then((result) => {

            if (
                result.isConfirmed
            ) {

                fetch(

                        `<?= base_url(
                                'about/delete'
                            ) ?>/${id}/${lang}`,

                        {
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

                            toastr.success(
                                data.message
                            );

                            setTimeout(
                                () =>
                                location.reload(),
                                1000
                            );

                        } else {

                            toastr.error(
                                data.message
                            );
                        }

                    });

            }

        });
    }
</script>