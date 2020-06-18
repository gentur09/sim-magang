<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>

<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/'); ?>js/demo/datatables-demo.js"></script>

<!-- Select2 JS -->
<script src="<?= base_url('assets/'); ?>vendor/select2/js/select2.full.min.js"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Sweetalert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<!-- Froala Text Editor -->
<script src="https://cdn.ckeditor.com/ckeditor5/19.1.1/classic/ckeditor.js"></script>

<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<script>
    var ubah_projek;
    $(document).ready(function() {
        var table;
        tampilData();
    });

    var elem = document.documentElement;

    function openFullscreen() {
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.mozRequestFullScreen) {
            /* Firefox */
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) {
            /* Chrome, Safari & Opera */
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) {
            /* IE/Edge */
            elem.msRequestFullscreen();
        }
    }

    ClassicEditor
        .create(document.querySelector('#keterangan'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', 'blockquote', '|', 'undo', 'redo'],
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    }
                ]
            }
        })
        .then(editor => {
            window.editor_add = editor;
        })
        .catch(error => {
            console.log(error);
        });

    ClassicEditor
        .create(document.querySelector('#keterangan_ubah'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', 'blockquote', '|', 'undo', 'redo'],
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    }
                ]
            }
        })
        .then(editor => {
            window.editor_ubah = editor;
        })
        .catch(error => {
            console.log(error);
        });

    $('#verifikasi').select2({
        placeholder: "Choose...",
        allowClear: true
    });

    $('#projek').select2({
        placeholder: "-- Pilih Project --",
        allowClear: true
    });

    $('#projek_ubah').select2({
        placeholder: "-- Pilih Project --",
        allowClear: true
    });

    function tampilData() {
        table = $('#table_mahasiswa_kinerja').DataTable({
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('backend/admin/kinerja/getDataMahasiswa') ?>",
                "type": "POST"
            },
            "columnDefs": [{
                    "className": "text-center border-left",
                    "orderable": false,
                    "width": "15%",
                    "targets": -1
                },
                {
                    "className": "text-center border-right",
                    "orderable": false,
                    "width": "7%",
                    "targets": 0
                }
            ]
        });
    };

    $.ajax({
        url: '<?= base_url('backend/admin/kinerja/select_project') ?>',
        type: 'POST',
        dataType: 'JSON',
        success: function(data) {
            var html = "<option></option>";

            for (var i = 0; i < data.length; i++) {
                var selected = '';
                html += "<option value='" + data[i].id + "'>" + data[i].judul + "</option>";
            }

            $('#projek').html(html);
            $('#projek_ubah').html(html);
            $('#projek_ubah').html(ubah_projek).trigger('change');
        }
    });

    $(document).on('click', '.tombol-detail', function() {
        var id_mahasiswa = $(this).attr('data');
        window.open("<?= base_url('backend/admin/kinerja/detail/'); ?>" + id_mahasiswa, "_blank");
        return false;
    });

    $(document).on('click', '#detail_kinerja', function() {
        var id = $(this).attr('data');
        $('#modal_detail_kinerja').modal('show');
        $.ajax({
            url: '<?= base_url('backend/admin/kinerja/aksiDetail') ?>',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id
            },
            success: function(data) {
                $('#id_kinerja').val(data.id);
                $('#kinerja').html(data.judul);
                $('#isi').html(data.keterangan);
                $('.tombol-hapus').data('id-kinerja', data.id);
                $('.tombol-ubah').data('id-kinerja', data.id);
            }
        });
    });

    $('#tombol_tambah_kinerja').click(function() {
        var id_mahasiswa = $(this).attr('data');
        $('#modal_tambah_kinerja').modal('show');
        $('#id_mahasiswa').val(id_mahasiswa);
    });

    $("#tombol_tambah_kinerja").click(function() {
        $(".rotate").toggleClass("down");
    })

    $('#form_tambah').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?= base_url('backend/admin/kinerja/aksiTambah') ?>',
            type: 'POST',
            data: new FormData(this),
            dataType: 'JSON',
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            beforeSend: function() {
                $('#button_tambah').text('proses...');
            },
            success: function(data) {
                if (data.status == true) {
                    location.reload();
                    toastr.success('Berhasil menambahkan kinerja mahasiswa', 'Berhasil', {
                        showEasing: "swing",
                        positionClass: "toast-top-right",
                        timeOut: 3000,
                        fadeOut: 3000
                    });

                    $('#modal_tambah_kinerja').modal('hide');
                    $('#id_mahasiswa').val('');
                    $('#projek').val(null).trigger('change');
                    $('#judul').val('');
                    window.editor_add.setData('');

                    $('#projek_error').html('');
                    $('#judul_error').html('');
                    $('#keterangan_error').html('');
                    $('#button_tambah').text("Simpan");
                } else {
                    toastr.error('Periksa kembali data kinerja yang anda inputkan', 'Gagal', {
                        showEasing: "swing",
                        positionClass: "toast-top-right",
                        timeOut: 3000,
                        fadeOut: 3000
                    });

                    $('#projek_error').html(data.projek);
                    $('#judul_error').html(data.judul);
                    $('#keterangan_error').html(data.keterangan);
                    $('#button_tambah').text("Simpan");
                }
            }
        });
    });

    $('.tombol-ubah').click(function() {
        var id_kinerja = $(this).data('id-kinerja');
        $('#modal_detail_kinerja').modal('hide');
        Swal.fire({
            title: 'Tunggu beberapa saat lagi',
            text: 'Loading',
            onOpen: function() {
                swal.showLoading()
            }
        });

        $.ajax({
            url: '<?= base_url('backend/admin/kinerja/aksiDetail') ?>',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id_kinerja
            },
            success: function(data) {
                Swal.fire({
                    title: 'Berhasil',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    $('#modal_ubah').modal('show');
                    $('#id_ubah').val(data.id);
                    $('#projek_ubah').val(data.id_projek_magang).trigger('change');
                    $('#judul_ubah').val(data.judul);
                    $('#verifikasi').val(data.verifikasi).trigger('change');
                    window.editor_ubah.setData(data.keterangan);
                    ubah_projek = data.id_projek_magang;
                })
            }
        });
    });

    $('#form_ubah').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo base_url('backend/admin/kinerja/aksiUbah') ?>",
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            dataType: 'JSON',
            cache: false,
            async: false,
            beforeSend: function() {
                $('#button_ubah').text('proses...');
            },
            success: function(data) {
                if (data.status == true) {
                    $('#modal_ubah').modal('hide');
                    $('#id_ubah').val('');
                    $('#projek_ubah').val(null).trigger('change');
                    $('#verifikasi').val(null).trigger('change');
                    $('#judul_ubah').val('');
                    window.editor_ubah.setData('');

                    toastr.success('Data kinerja berhasil diubah', 'Berhasil', {
                        showEasing: "swing",
                        positionClass: "toast-top-right",
                        timeOut: 3000,
                        fadeOut: 3000
                    });

                    $('#projek_ubah_error').html('');
                    $('#judul_ubah_error').html('');
                    $('#keterangan_ubah_error').html('');
                    $('#button_ubah').text("Update");
                    location.reload();
                } else {
                    toastr.error('Periksa kembali data kinerja yang anda ubah', 'Gagal', {
                        showEasing: "swing",
                        positionClass: "toast-top-right",
                        timeOut: 3000,
                        fadeOut: 3000
                    });

                    $('#projek_ubah_error').html(data.projek);
                    $('#judul_ubah_error').html(data.judul);
                    $('#keterangan_ubah_error').html(data.keterangan);
                    $('#button_ubah').text("Update");
                }
            }
        });
    });

    $('.tombol-hapus').click(function() {
        var id_kinerja = $(this).data('id-kinerja');
        $('#modal_detail_kinerja').modal('hide');
        $('#modal_hapus').modal('show');
        $.ajax({
            url: '<?= base_url('backend/admin/kinerja/aksiDetail') ?>',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id_kinerja
            },
            success: function(data) {
                $('#hapus_id').val(data.id);
            }
        });
    });

    $('#form_hapus').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= base_url('backend/admin/kinerja/aksiHapus') ?>",
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(data) {
                $('#modal_hapus').modal('hide');
                $('#hapus_id').val('');
                toastr.success('Kinerja mahasiswa berhasil dihapus', 'Berhasil', {
                    showEasing: "swing",
                    positionClass: "toast-top-right",
                    timeOut: 3000,
                    fadeOut: 3000
                });
                location.reload();
            }
        });
    });
</script>