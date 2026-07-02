<script>
     $(document).ready(function() {

        $('#tableBanner').DataTable({
            responsive: true,
            autoWidth: false,
            language: {
                emptyTable: "No data available"
            }
        });

    });
    function addBanner() {
        $('#formBanner')[0].reset();

        $('#bannerId').val('');

        $('#modalTitle')
            .html(
                'Add Banner'
            );

        $('#bannerModal')
            .modal('show');
    }

    function editBanner(id) {
        fetch(
                `<?= base_url(
                        'banner/show'
                    ) ?>/${id}`
            )
            .then(
                response =>
                response.json()
            )
            .then(data => {

                $('#bannerId')
                    .val(
                        data.id
                    );

                $('input[name="title"]')
                    .val(
                        data.title
                    );

                $('textarea[name="subtitle"]')
                    .val(
                        data.subtitle
                    );

                $('select[name="position"]')
                    .val(
                        data.position
                    );

                $('select[name="is_active"]')
                    .val(
                        data.is_active
                    );

                $('input[name="sort_order"]')
                    .val(
                        data.sort_order
                    );

                $('#modalTitle')
                    .html(
                        'Edit Banner'
                    );

                $('#bannerModal')
                    .modal('show');
            });
    }

    function saveBanner() {
        let id =
            $('#bannerId').val();

        let formData =
            new FormData(
                document.getElementById(
                    'formBanner'
                )
            );

        let url =
            id ?
            `<?= base_url(
                    'banner/update'
                ) ?>/${id}` :
            `<?= base_url(
                    'banner/store'
                ) ?>`;

        fetch(
                url, {
                    method: 'POST',
                    body: formData
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

                        text: 'Data berhasil disimpan',

                        timer: 1500,

                        showConfirmButton: false

                    });

                    setTimeout(() => {

                        location.reload();

                    }, 1500);

                } else {

                    Swal.fire({

                        icon: 'error',

                        title: 'Error',

                        text: data.message

                    });

                }
            });
    }

    function deleteBanner(id) {
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
                                'banner/delete'
                            ) ?>/${id}`, {
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

                                text: 'Data berhasil dihapus',

                                timer: 1500,

                                showConfirmButton: false

                            });

                            setTimeout(() => {

                                location.reload();

                            }, 1500);

                        }

                    });

            }

        });
    }
</script>