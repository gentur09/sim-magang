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

<!-- Bootstrap Datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<!-- Froala Text Editor -->
<script src="https://cdn.ckeditor.com/ckeditor5/19.1.1/classic/ckeditor.js"></script>
<script>
    var ubah_dosbing;
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
        .create(document.querySelector('#deskripsi'), {
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
        .create(document.querySelector('#deskripsi_ubah'), {
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

    $('#dosen_pembimbing').select2({
        placeholder: "Daftar Pembimbing",
        allowClear: true
    });
    $('#dosbing_ubah').select2({
        placeholder: "Daftar Pembimbing",
        allowClear: true
    });

    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    function tampilData() {
        table = $('#table_project').DataTable({
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('backend/admin/project/getDataProject') ?>",
                "type": "POST"
            },
            "columnDefs": [{
                    "className": "text-center border-left",
                    "orderable": false,
                    "width": "20%",
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

    $('.input-daterange').datepicker({
        clearBtn: true,
        autoclose: true,
        todayHighlight: true,
        orientation: "bottom left",
        startDate: '-3d'
    });

    $.ajax({
        url: '<?= base_url('backend/admin/project/select_pembimbing') ?>',
        type: 'POST',
        dataType: 'JSON',
        success: function(data) {
            var html = "<option></option>";

            for (var i = 0; i < data.length; i++) {
                var selected = '';
                html += "<option value='" + data[i].id + "'>" + data[i].nama + "</option>";
            }

            $('#dosen_pembimbing').html(html);
            $('#dosbing_ubah').html(html);
            $('#dosbing_ubah').html(ubah_dosbing).trigger('change');
        }
    });

    $('#tombol_tambah').click(function() {
        $('#modal_tambah').modal('show');
    });

    $("#tombol_tambah").click(function() {
        $(".rotate").toggleClass("down");
    });

    $('#form_tambah').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?= base_url('backend/admin/project/aksiTambah') ?>',
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
                    tampilData();
                    toastr.success('Data project berhasil ditambahkan', 'Berhasil', {
                        showEasing: "swing",
                        positionClass: "toast-top-right",
                        timeOut: 3000,
                        fadeOut: 3000
                    });

                    $('#modal_tambah').modal('hide');
                    $('#judul').val('');
                    $('#dosen_pembimbing').val(null).trigger('change');
                    $('#waktu_mulai').val('');
                    $('#waktu_selesai').val('');
                    $('.input-daterange').datepicker('clearDates');
                    $('#repositori').val('');
                    window.editor_add.setData('');
                    $('#file_laporan').val('');
                    $('#file_label').html('Pilih File');

                    $('#judul_error').html('');
                    $('#dosen_pembimbing_error').html('');
                    $('#waktu_error').html('');
                    $('#deskripsi_error').html('');
                    $('#file_error').html('');
                    $('#button_tambah').text("Simpan");
                } else {
                    toastr.error('Periksa kembali data project yang anda inputkan', 'Gagal', {
                        showEasing: "swing",
                        positionClass: "toast-top-right",
                        timeOut: 3000,
                        fadeOut: 3000
                    });

                    $('#judul_error').html(data.judul);
                    $('#dosen_pembimbing_error').html(data.dosen_pembimbing);
                    $('#waktu_error').html(data.waktu_pengerjaan);
                    $('#deskripsi_error').html(data.deskripsi);
                    $('#file_error').html(data.file_laporan);
                    $('#button_tambah').text("Simpan");
                }
            }
        });
    });

    $('#table_project').on('click', '.tombol-ubah', function() {
        var id = $(this).attr('data');
        Swal.fire({
            title: 'Tunggu beberapa saat lagi',
            text: 'Loading',
            onOpen: function() {
                swal.showLoading()
            }
        });

        $.ajax({
            url: '<?= base_url('backend/admin/project/aksiDetail') ?>',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id
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
                    $('#judul_ubah').val(data.judul);
                    $('#dosbing_ubah').val(data.id_pembimbing).trigger('change');
                    $('#waktu_mulai_ubah').val(data.waktu_mulai);
                    $('#waktu_selesai_ubah').val(data.waktu_selesai);
                    // $('#deskripsi_ubah').val(data.deskripsi);
                    window.editor_ubah.setData(data.deskripsi);
                    $('#repositori_ubah').val(data.repositori);
                    ubah_dosbing = data.id_pembimbing;
                })
            }
        });
    });

    $('#form_ubah').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo base_url('backend/admin/project/aksiUbah') ?>",
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
                    tampilData();
                    $('#modal_ubah').modal('hide');
                    $('#id_ubah').val('');
                    $('#judul_ubah').val('');
                    $('#dosbing_ubah').val(null).trigger('change');
                    $('#waktu_mulai_ubah').val('');
                    $('#waktu_selesai_ubah').val('');
                    $('#deskripsi_ubah').val('');
                    $('#file_laporan_ubah').val('');
                    $('#file_ubah_label').val('');
                    $('#repositori_ubah').val('');

                    toastr.success('Data project berhasil diubah', 'Berhasil', {
                        showEasing: "swing",
                        positionClass: "toast-top-right",
                        timeOut: 3000,
                        fadeOut: 3000
                    });

                    $('#judul_ubah_error').html('');
                    $('#dosbing_ubah_error').html('');
                    $('#waktu_ubah_error').html('');
                    $('#deskripsi_ubah_error').html('');
                    $('#file_ubah_error').html('');
                    $('#button_ubah').text("Update");
                } else {
                    toastr.error('Periksa kembali data project yang anda ubah', 'Gagal', {
                        showEasing: "swing",
                        positionClass: "toast-top-right",
                        timeOut: 3000,
                        fadeOut: 3000
                    });

                    $('#judul_ubah_error').html(data.judul);
                    $('#dosbing_ubah_error').html(data.dosen_pembimbing);
                    $('#waktu_ubah_error').html(data.waktu_pengerjaan);
                    $('#deskripsi_ubah_error').html(data.deskripsi);
                    $('#file_ubah_error').html(data.file_laporan);
                    $('#button_ubah').text("Update");
                }
            }
        });
    });

    $('#table_project').on('click', '.tombol-hapus', function() {
        var id = $(this).attr('data');
        $('#modal_hapus').modal('show');
        $.ajax({
            url: '<?= base_url('backend/admin/project/aksiDetail') ?>',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id
            },
            success: function(data) {
                $('#hapus_id').val(data.id);
            }
        });
    });

    $('#form_hapus').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?= base_url('backend/admin/project/aksiHapus') ?>',
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(data) {
                tampilData();
                $('#modal_hapus').modal('hide');
                $('#hapus_id').val('');
                toastr.success('Data project magang berhasil dihapus', 'Berhasil', {
                    showEasing: "swing",
                    positionClass: "toast-top-right",
                    timeOut: 3000,
                    fadeOut: 3000
                });
            }
        });
    });
</script>