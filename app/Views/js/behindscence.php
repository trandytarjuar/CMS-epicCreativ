<script>
    function addBehindTheScenes() {
        $('#formBehindScene')[0]
            .reset();

        $('#behindSceneId')
            .val('');

        $('#is_active')
            .val('1');

        $('#modalTitle')
            .html(
                'Add Behind The Scene'
            );

        $('#modalBehindScene')
            .modal('show');
    }

    $('#media_type').change(function() {

        if (
            $(this).val() ==
            'youtube'
        ) {

            $('#youtubeWrapper')
                .show();

            $('#uploadWrapper')
                .hide();

        } else {

            $('#youtubeWrapper')
                .hide();

            $('#uploadWrapper')
                .show();
        }

    });

    function saveBehindScene() {
        let id =
            $('#behindSceneId').val();

        let formData =
            new FormData(
                document.getElementById(
                    'formBehindScene'
                )
            );

        let url =
            id ?
            `<?= base_url(
                    'portfolio-behind-scenes/update'
                ) ?>/${id}` :
            `<?= base_url(
                    'portfolio-behind-scenes/store'
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

                        text: data.message,

                        timer: 1500,

                        showConfirmButton: false

                    });

                    setTimeout(() => {

                        location.reload();

                    }, 1500);
                }
            });
    }

    function deleteBehindScene(id) {
        Swal.fire({

            title: 'Yakin hapus data?',

            text: 'Data tidak dapat dikembalikan',

            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#d33',

            cancelButtonColor: '#6c757d',

            confirmButtonText: 'Ya, Hapus',

            cancelButtonText: 'Batal'

        }).then((result) => {

            if (result.isConfirmed) {

                fetch(
                        `<?= base_url(
                                'portfolio-behind-scenes/delete'
                            ) ?>/${id}`, {
                            method: 'DELETE'
                        }
                    )
                    .then(res => res.json())
                    .then(data => {

                        if (
                            data.status === 'success'
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

                        } else {

                            Swal.fire({

                                icon: 'error',

                                title: 'Oops...',

                                text: data.message

                            });

                        }

                    });

            }

        });
    }

    function editBehindScene(id) {
        fetch(
                `<?= base_url(
                        'portfolio-behind-scenes/show'
                    ) ?>/${id}`
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

                    $('#behindSceneId')
                        .val(
                            data.data.id
                        );

                    $('input[name="youtube_embed"]')
                        .val(
                            data.data.youtube_embed
                        );

                    $('#is_active')
                        .val(
                            data.data.is_active
                        );

                    $('#modalTitle')
                        .html(
                            'Edit Behind The Scene'
                        );

                    $('#modalBehindScene')
                        .modal('show');
                }
            });
    }
</script>