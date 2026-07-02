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

        $('#serviceTable').DataTable({
            responsive: true,
            autoWidth: false,
            language: {
                emptyTable: "No data available"
            }
        });

    });
    const editor = document.querySelector('#editor');

    if (editor) {

        ClassicEditor
            .create(editor, {
                toolbar: [
                    'heading', '|',
                    'bold',
                    'italic',
                    'underline',
                    'link',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'undo',
                    'redo'
                ]
            })
            .catch(error => {
                console.error(error);
            });
    }

    function previewImage(inputClass, previewId) {
        document.querySelector(inputClass).addEventListener('change', function(e) {

            const file = e.target.files[0];
            if (!file) return;

            if (!file.type.startsWith('image/')) {
                alert('File harus gambar');
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById(previewId);
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(file);
        });
    }

    // 🔥 panggil
    previewImage('.preview-image', 'preview-image');

    function deleteService(id) {

        Swal.fire({
            title: 'Yakin hapus data?',
            text: "Data yang dihapus tidak bisa dikembalikan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
        }).then((result) => {

            if (result.isConfirmed) {

                fetch(`<?= base_url('service/delete') ?>/${id}`, {
                        method: 'DELETE'
                    })
                    .then(res => res.json())
                    .then(data => {

                        if (data.status === 'success') {

                            toastr.success(data.message);

                            setTimeout(() => {
                                location.reload();
                            }, 1000);

                        } else {
                            toastr.error(data.message);
                        }

                    })
                    .catch(() => {
                        toastr.error('Server error');
                    });
            }
        });
    }

    function detailService(id) {

        fetch(`<?= base_url('service/detail') ?>/${id}/<?= strtolower(current_lang()) ?>`)
            .then(res => res.json())
            .then(data => {

                if (data.status === 'success') {

                    const service = data.data;
                    console.log(service.image);

                    const image =
                        document.getElementById('detail-image');

                    if (service.image) {
                        image.src =
                            `<?= base_url('image/service') ?>/${service.image}`;

                        image.style.display =
                            'block';
                    } else {
                        image.style.display =
                            'none';
                    }



                    // TITLE
                    document.getElementById('detail-title')
                        .innerText = service.title;

                    // DESCRIPTION
                    document.getElementById('detail-description')
                        .innerHTML = service.description;

                    // SHOW MODAL
                    const modal = new bootstrap.Modal(
                        document.getElementById('detailModal')
                    );

                    modal.show();

                } else {

                    toastr.error(data.message);
                }

            })
            .catch(() => {

                toastr.error('Server error');

            });
    }

    const imageInput =
        document.querySelector('input[name="image"]');

    if (imageInput) {

        imageInput.addEventListener('change', function(e) {

            const file = e.target.files[0];

            if (!file) return;

            // validasi image
            if (!file.type.startsWith('image/')) {

                toastr.error('File harus gambar');
                return;
            }

            const reader = new FileReader();

            reader.onload = function(event) {

                document.getElementById(
                    'preview-image'
                ).src = event.target.result;
            };

            reader.readAsDataURL(file);
        });
    }
</script>