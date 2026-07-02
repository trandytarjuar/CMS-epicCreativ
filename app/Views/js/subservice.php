<script>
    <?php if (session()->getFlashdata('success')): ?>

        toastr.success(
            '<?= session()->getFlashdata('success') ?>'
        );

    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>

        toastr.error(
            '<?= session()->getFlashdata('error') ?>'
        );

    <?php endif; ?>
</script>
<script>
    $(document).ready(function() {

        $('#subserviceTable').DataTable({
            responsive: true,
            autoWidth: false,
            language: {
                emptyTable: "No data available"
            }
        });

    });

    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });

    const imageInput =
        document.querySelector('.preview-image');

    if (imageInput) {

        imageInput.addEventListener('change', function(e) {

            const file = e.target.files[0];

            if (!file) return;

            const reader = new FileReader();

            reader.onload = function(event) {

                const preview =
                    document.getElementById(
                        'preview-image'
                    );

                preview.src = event.target.result;

                preview.style.display = 'block';
            };

            reader.readAsDataURL(file);

        });

    }

    function deleteSubservice(id) {

        Swal.fire({
            title: 'Yakin hapus data?',
            text: 'Data tidak bisa dikembalikan',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {

            if (result.isConfirmed) {

                fetch(
                        `<?= base_url('subservice/delete') ?>/${id}`, {
                            method: 'DELETE'
                        }
                    )
                    .then(res => res.json())
                    .then(data => {

                        if (data.status == 'success') {

                            toastr.success(
                                data.message
                            );

                            setTimeout(() => {

                                location.reload();

                            }, 1000);

                        } else {

                            toastr.error(
                                data.message
                            );
                        }

                    })
                    .catch(() => {

                        toastr.error(
                            'Server error'
                        );

                    });
            }
        });
    }
</script>