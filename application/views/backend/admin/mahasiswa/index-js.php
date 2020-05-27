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
    var ubah_universitas;
    var ubah_kabupaten;
    var ubah_kecamatan;
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

    $('#semester').select2();
    $('#universitas').select2({
        placeholder: "Daftar universitas",
        allowClear: true
    });
    $('#universitas_ubah').select2({
        placeholder: "Daftar universitas",
        allowClear: true
    });
    $('#provinsi').select2({
        placeholder: "Daftar provinsi",
        allowClear: true
    });
    $('#kabupaten').select2({
        placeholder: "Daftar kabupaten / kota (Pilih provinsi terlebih dahulu!)",
        allowClear: true
    });
    $('#kecamatan').select2({
        placeholder: "Daftar kecamatan (Pilih kabupaten terlebih dahulu!)",
        allowClear: true
    });
    $('#provinsi_ubah').select2({
        placeholder: "Daftar provinsi",
        allowClear: true
    });
    $('#kabupaten_ubah').select2({
        placeholder: "Daftar kabupaten / kota (Pilih provinsi terlebih dahulu!)",
        allowClear: true
    });
    $('#kecamatan_ubah').select2({
        placeholder: "Daftar kecamatan (Pilih kabupaten terlebih dahulu!)",
        allowClear: true
    });

    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    function tampilData() {
        table = $('#table_mahasiswa').DataTable({
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('backend/admin/mahasiswa/getDataMahasiswa') ?>",
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
                },
                {
                    "className": "border-right",
                    "targets": 1
                },
                {
                    "className": "border-right",
                    "targets": 2
                },
                {
                    "className": "border-right",
                    "targets": 3
                },
            ]
        });
    };

    $.ajax({
        url: '<?= base_url('backend/admin/mahasiswa/select_universitas') ?>',
        type: 'POST',
        dataType: 'JSON',
        success: function(data) {
            var html = "<option></option>";

            for (var i = 0; i < data.length; i++) {
                var selected = '';
                html += "<option value='" + data[i].id + "'>" + data[i].nama + "</option>";
            }

            $('#universitas').html(html);
            $('#universitas_ubah').html(html);
            $('#universitas_ubah').val(ubah_universitas).trigger('change');
        }
    });

    $.ajax({
        url: '<?= base_url('backend/admin/mahasiswa/select_provinsi') ?>',
        type: 'POST',
        dataType: 'JSON',
        success: function(data) {
            var html = "<option></option>";

            for (var i = 0; i < data.length; i++) {
                var selected = '';
                html += "<option value='" + data[i].kode_wilayah + "'>" + data[i].nama + "</option>";
            }

            $('#provinsi').html(html);
            $('#provinsi_ubah').html(html);
        }
    });

    $('#provinsi').change(function() {
        var provinsi = $(this).val();

        $.ajax({
            url: '<?= base_url('backend/admin/mahasiswa/select_kabupaten') ?>',
            type: 'POST',
            dataType: 'JSON',
            data: {
                provinsi: provinsi
            },
            success: function(data) {
                var html = "<option></option>";

                for (var i = 0; i < data.length; i++) {
                    var selected = '';
                    html += "<option value='" + data[i].kode_wilayah + "'>" + data[i].nama + "</option>";
                }

                $('#kabupaten').html(html);
            }
        });
    });

    $('#provinsi_ubah').change(function() {
        var provinsi = $(this).val();

        $.ajax({
            url: '<?= base_url('backend/admin/mahasiswa/select_kabupaten') ?>',
            type: 'POST',
            dataType: 'JSON',
            data: {
                provinsi: provinsi
            },
            success: function(data) {
                var html = "<option></option>";

                for (var i = 0; i < data.length; i++) {
                    var selected = '';
                    html += "<option value='" + data[i].kode_wilayah + "'>" + data[i].nama + "</option>";
                }

                $('#kabupaten_ubah').html(html);
                $('#kabupaten_ubah').val(ubah_kabupaten).trigger('change');
            }
        });
    });

    $('#kabupaten').change(function() {
        var kabupaten = $(this).val();

        $.ajax({
            url: '<?= base_url('backend/admin/mahasiswa/select_kecamatan') ?>',
            type: 'POST',
            dataType: 'JSON',
            data: {
                kabupaten: kabupaten
            },
            success: function(data) {
                var html = "<option></option>";

                for (var i = 0; i < data.length; i++) {
                    var selected = '';
                    html += "<option value='" + data[i].kode_wilayah + "'>" + data[i].nama + "</option>";
                }

                $('#kecamatan').html(html);
            }
        });
    });

    $('#kabupaten_ubah').change(function() {
        var kabupaten = $(this).val();

        $.ajax({
            url: '<?= base_url('backend/admin/mahasiswa/select_kecamatan') ?>',
            type: 'POST',
            dataType: 'JSON',
            data: {
                kabupaten: kabupaten
            },
            success: function(data) {
                var html = "<option></option>";

                for (var i = 0; i < data.length; i++) {
                    var selected = '';
                    html += "<option value='" + data[i].kode_wilayah + "'>" + data[i].nama + "</option>";
                }

                $('#kecamatan_ubah').html(html);
                $('#kecamatan_ubah').val(ubah_kecamatan).trigger('change');
            }
        });
    });

    $('#tombol_tambah').click(function() {
        $('#modal_tambah').modal('show');
    });

    $('#form_tambah').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?= base_url('backend/admin/mahasiswa/aksiTambah') ?>',
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
                    toastr.success('Data mahasiswa berhasil ditambahkan', 'Berhasil', {
                        showEasing: "swing",
                        positionClass: "toast-top-right",
                        timeOut: 3000,
                        fadeOut: 3000
                    });

                    $('#modal_tambah').modal('hide');
                    $('#nama').val('');
                    $('#foto').val('');
                    $('#foto_label').html('Pilih Profile');
                    $('#universitas').val(null).trigger('change');
                    $('#semester').val('');
                    $('#email').val('');
                    $('#nomor_telpon').val('');
                    $('#username').val('');
                    $('#password').val('');
                    $('#alamat').val('');
                    $('#provinsi').val(null).trigger('change');
                    $('#kabupaten').val(null).trigger('change');
                    $('#kecamatan').val(null).trigger('change');

                    $('#nama_error').html('');
                    $('#universitas_error').html('');
                    $('#email_error').html('');
                    $('#nomor_telpon_error').html('');
                    $('#username_error').html('');
                    $('#password_error').html('');
                    $('#alamat_error').html('');
                    $('#provinsi_error').html('');
                    $('#kabupaten_error').html('');
                    $('#kecamatan_error').html('');
                    $('#button_tambah').text("Simpan");
                } else {
                    toastr.error('Periksa kembali data mahasiswa yang anda inputkan', 'Gagal', {
                        showEasing: "swing",
                        positionClass: "toast-top-right",
                        timeOut: 3000,
                        fadeOut: 3000
                    });

                    $('#nama_error').html(data.nama);
                    $('#universitas_error').html(data.universitas);
                    $('#email_error').html(data.email);
                    $('#nomor_telepon_error').html(data.nomor_telpon);
                    $('#username_error').html(data.username);
                    $('#password_error').html(data.password);
                    $('#alamat_error').html(data.alamat);
                    $('#provinsi_error').html(data.provinsi);
                    $('#kabupaten_error').html(data.kabupaten);
                    $('#kecamatan_error').html(data.kecamatan);
                    $('#button_tambah').text("Simpan");
                }
            }
        });
    });

    $('#table_mahasiswa').on('click', '.tombol-ubah', function() {
        var id = $(this).attr('data');
        Swal.fire({
            title: 'Tunggu beberapa saat lagi',
            text: 'Loading',
            onOpen: function() {
                swal.showLoading()
            }
        });

        $.ajax({
            url: '<?= base_url('backend/admin/mahasiswa/aksiDetail') ?>',
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
                        $('#universitas_ubah').val(data.id_universitas).trigger('change');
                        $('#semester_ubah').val(data.semester);
                        $('#email_ubah').val(data.email);
                        $('#nomor_telpon_ubah').val(data.nomor_telpon);
                        $('#username_ubah').val(data.username);
                        $('#alamat_ubah').val(data.alamat);
                        $('#provinsi_ubah').val(data.id_provinsi).trigger('change');
                        $('#kabupaten_ubah').val(data.id_kabupaten).trigger('change');
                        $('#kecamatan_ubah').val(data.id_kecamatan).trigger('change');
                        ubah_universitas = data.id_universitas;
                        ubah_kabupaten = data.id_kabupaten;
                        ubah_kecamatan = data.id_kecamatan;
                    }
                })
            }
        });
    });

    $('#form_ubah').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo base_url('backend/admin/mahasiswa/aksiUbah') ?>",
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
                    $('#universitas_ubah').val(null).trigger('change');
                    $('#semester_ubah').val('');
                    $('#email_ubah').val('');
                    $('#nomor_telpon_ubah').val('');
                    $('#username_ubah').val('');
                    $('#alamat_ubah').val('');
                    $('#provinsi_ubah').val(null).trigger('change');
                    $('#kabupaten_ubah').val(null).trigger('change');
                    $('#kecamatan_ubah').val(null).trigger('change');

                    toastr.success('Data mahasiswa berhasil diubah', 'Berhasil', {
                        showEasing: "swing",
                        positionClass: "toast-top-right",
                        timeOut: 3000,
                        fadeOut: 3000
                    });

                    $('#nama_ubah_error').html('');
                    $('#universitas_ubah_error').html('');
                    $('#email_ubah_error').html('');
                    $('#nomor_telpon_ubah_error').html('');
                    $('#username_ubah_error').html('');
                    $('#alamat_ubah_error').html('');
                    $('#provinsi_ubah_error').html('');
                    $('#kabupaten_ubah_error').html('');
                    $('#kecamatan_ubah_error').html('');
                    $('#button_ubah').text("Update");

                } else {
                    toastr.error('Periksa kembali data mahasiswa yang anda ubah', 'Gagal', {
                        showEasing: "swing",
                        positionClass: "toast-top-right",
                        timeOut: 3000,
                        fadeOut: 3000
                    });

                    $('#nama_ubah_error').html(data.nama);
                    $('#universitas_ubah_error').html(data.universitas);
                    $('#email_ubah_error').html(data.email);
                    $('#nomor_telpon_ubah_error').html(data.nomor_telpon);
                    $('#username_ubah_error').html(data.username);
                    $('#alamat_ubah_error').html(data.alamat);
                    $('#provinsi_ubah_error').html(data.provinsi);
                    $('#kabupaten_ubah_error').html(data.kabupaten);
                    $('#kecamatan_ubah_error').html(data.kecamatan);
                    $('#button_ubah').text("Update");
                }
            }
        });
    });

    $('#table_mahasiswa').on('click', '.tombol-hapus', function() {
        var id = $(this).attr('data');
        $('#modal_hapus').modal('show');
        $.ajax({
            url: '<?= base_url('backend/admin/mahasiswa/aksiDetail') ?>',
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
            url: "<?= base_url('backend/admin/mahasiswa/aksiHapus') ?>",
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
                toastr.success('Data mahasiswa berhasil dihapus', 'Berhasil', {
                    showEasing: "swing",
                    positionClass: "toast-top-right",
                    timeOut: 3000,
                    fadeOut: 3000
                });
            },
        });
    });
</script>