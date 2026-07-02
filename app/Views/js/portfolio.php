<script>
    ClassicEditor
        .create(
            document.querySelector('#editor')
        )
        .catch(error => {
            console.error(error);
        });

    // function toggleMediaType()
    // {
    //     let type =
    //         $('#media_type').val();

    //     if (type == 'youtube') {

    //         $('#youtubeWrapper').show();

    //         $('#videoWrapper').hide();

    //     } else {

    //         $('#youtubeWrapper').hide();

    //         $('#videoWrapper').show();
    //     }
    // }

    // $(document).ready(function() {

    //     toggleMediaType();

    //     $('#media_type').change(function() {

    //         toggleMediaType();

    //     });

    // });

    function deletePortfolio(id, lang) {
        Swal.fire({
            title: 'Yakin hapus data?',
            text: 'Data tidak bisa dikembalikan',
            icon: 'warning',
            showCancelButton: true
        }).then((result) => {

            if (result.isConfirmed) {
                fetch(
                        `<?= base_url('portfolio/delete') ?>/${id}/${lang}`, {
                            method: 'DELETE'
                        }
                    )
                    .then(res => res.json())
                    .then(data => {

                        toastr.success(data.message);

                        setTimeout(() => {

                            location.reload();

                        }, 1000);

                    });
            }
        });
    }
</script>