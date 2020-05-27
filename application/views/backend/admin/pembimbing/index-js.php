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

<script>
    var ubah_jabatan;
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

    $('#jabatan').select2({
        placeholder: "Daftar jabatan",
        allowClear: true
    });
    $('#jabatan_ubah').select2({
        placeholder: "Daftar jabatan",
        allowClear: true
    });

    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    $.ajax({
        url: '<?= base_url('backend/admin/pembimbing/select_jabatan') ?>',
        type: 'POST',
        dataType: 'JSON',
        success: function(data) {
            var html = "<option></option>";

            for (var i = 0; i < data.length; i++) {
                var selected = '';
                html += "<option value='" + data[i].id + "'>" + data[i].nama + "</option>";
            }

            $('#jabatan').html(html);
            $('#jabatan_ubah').html(html);
            $('#jabatan_ubah').val(ubah_jabatan).trigger('change');
        }
    });

    function tampilData() {
        table = $('#table_pembimbing').DataTable({
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('backend/admin/pembimbing/getDataPembimbing') ?>",
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

    $('#tombol_tambah').click(function() {
        $('#modal_tambah').modal('show');
    });

    $('#form_tambah').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?= base_url('backend/admin/pembimbing/aksiTambah') ?>',
            type: "POST",
            data: new FormData(this),
            dataType: "JSON",
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
                    toastr.success('Data pembimbing berhasil ditambahkan', 'Berhasil', {
                        showEasing: "swing",
                        positionClass: "toast-top-right",
                        timeOut: 3000,
                        fadeOut: 3000
                    });

                    $('#modal_tambah').modal('hide');
                    $('#nama').val('');
                    $('#foto').val('');
                    $('#foto_label').html('Pilih Profile');
                    $('#jabatan').val(null).trigger('change');
                    $('#username').val('');
                    $('#password').val('');
                    $('#nama_error').html('');
                    $('#jabatan_error').html('');
                    $('#username_error').html('');
                    $('#password_error').html('');
                    $('#button_tambah').text("Simpan");
                } else {
                    toastr.error('Periksa kembali data pembimbing yang anda inputkan', 'Gagal', {
                        showEasing: "swing",
                        positionClass: "toast-top-right",
                        timeOut: 3000,
                        fadeOut: 3000
                    });

                    $('#nama_error').html(data.nama);
                    $('#jabatan_error').html(data.jabatan);
                    $('#username_error').html(data.username);
                    $('#password_error').html(data.password);
                    $('#button_tambah').text("Simpan");
                }
            }
        });
    });

    $('#table_pembimbing').on('click', '.tombol-ubah', function() {
        var id = $(this).attr('data');
        Swal.fire({
            title: 'Tunggu beberapa saat lagi',
            text: 'Loading',
            onOpen: function() {
                swal.showLoading()
            }
        });

        $.ajax({
            url: '<?= base_url('backend/admin/pembimbing/aksiDetail') ?>',
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
                    if (result.value) {
                        $('#modal_ubah').modal('show');
                        $('#id_ubah').val(data.id);
                        $('#foto_profile').attr('src', '<?= base_url('assets/image/profile/') ?>' + data.foto + '');
                        $('#nama_ubah').val(data.nama);
                        $('#jabatan_ubah').val(data.id_jabatan).trigger('change');
                        $('#username_ubah').val(data.username);
                        ubah_jabatan = data.id_jabatan;
                    }
                })
            }
        });
    });

    $('#form_ubah').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo base_url('backend/admin/pembimbing/aksiUbah') ?>",
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
                    $('#nama_ubah').val('');
                    $('#foto_ubah').val('');
                    $('#foto_ubah_label').html('Pilih Profile');
                    $('#jabatan_ubah').val('');
                    $('#username_ubah').val('');
                    toastr.success('Data pembimbing berhasil diubah', 'Berhasil', {
                        showEasing: "swing",
                        positionClass: "toast-top-right",
                        timeOut: 3000,
                        fadeOut: 3000
                    });
                    $('#nama_ubah_error').html('');
                    $('#jabatan_ubah_error').html('');
                    $('#username_ubah_error').html();
                    $('#button_ubah').text('Update');
                } else {
                    toastr.error('Periksa kembali data pembimbing yang anda ubah', 'Gagal', {
                        showEasing: "swing",
                        positionClass: "toast-top-right",
                        timeOut: 3000,
                        fadeOut: 3000
                    });

                    $('#nama_ubah_error').html(data.nama);
                    $('#jabatan_ubah_error').html(data.jabatan);
                    $('#username_ubah_error').html(data.username);
                    $('#button_ubah').text("Update");
                }
            }
        });
    });

    $('#table_pembimbing').on('click', '.tombol-hapus', function() {
        var id = $(this).attr('data');
        $('#modal_hapus').modal('show');
        $.ajax({
            url: '<?= base_url('backend/admin/pembimbing/aksiDetail') ?>',
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
            url: "<?= base_url('backend/admin/pembimbing/aksiHapus') ?>",
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
                toastr.success('Data pembimbing berhasil dihapus', 'Berhasil', {
                    showEasing: "swing",
                    positionClass: "toast-top-right",
                    timeOut: 3000,
                    fadeOut: 3000
                });
            },
        });
    });
</script>