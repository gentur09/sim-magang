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
    var ubah_kabupaten;
    var ubah_kecamatan;
    var ubah_kelurahan;
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
    $('#kelurahan').select2({
        placeholder: "Daftar kelurahan (Pilih kecamatan terlebih dahulu!)",
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
    $('#kelurahan_ubah').select2({
        placeholder: "Daftar kelurahan (Pilih kecamatan terlebih dahulu!)",
        allowClear: true
    });

    $.ajax({
        url: '<?= base_url('backend/admin/referensi/universitas/select_provinsi') ?>',
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
            url: '<?= base_url('backend/admin/referensi/universitas/select_kabupaten') ?>',
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
            url: '<?= base_url('backend/admin/referensi/universitas/select_kabupaten') ?>',
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
            url: '<?= base_url('backend/admin/referensi/universitas/select_kecamatan') ?>',
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
            url: '<?= base_url('backend/admin/referensi/universitas/select_kecamatan') ?>',
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

    $('#kecamatan').change(function() {
        var kecamatan = $(this).val();

        $.ajax({
            url: '<?= base_url('backend/admin/referensi/universitas/select_kelurahan') ?>',
            type: 'POST',
            dataType: 'JSON',
            data: {
                kecamatan: kecamatan
            },
            success: function(data) {
                var html = "<option></option>";

                for (var i = 0; i < data.length; i++) {
                    var selected = '';
                    html += "<option value='" + data[i].kode_wilayah + "'>" + data[i].nama + "</option>";
                }

                $('#kelurahan').html(html);
            }
        });
    });

    $('#kecamatan_ubah').change(function() {
        var kecamatan = $(this).val();

        $.ajax({
            url: '<?= base_url('backend/admin/referensi/universitas/select_kelurahan') ?>',
            type: 'POST',
            dataType: 'JSON',
            data: {
                kecamatan: kecamatan
            },
            success: function(data) {
                var html = "<option></option>";

                for (var i = 0; i < data.length; i++) {
                    var selected = '';
                    html += "<option value='" + data[i].kode_wilayah + "'>" + data[i].nama + "</option>";
                }

                $('#kelurahan_ubah').html(html);
                $('#kelurahan_ubah').val(ubah_kelurahan).trigger('change');
            }
        });
    });

    function tampilData() {
        table = $('#table_universitas').DataTable({
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('backend/admin/referensi/universitas/getDataUniversitas') ?>",
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
                    "targets": 1,
                }
            ]
        });
    };

    // menampilkan modal tambah
    $('#tombol_tambah').click(function() {
        $('#modal_tambah').modal('show');
    });

    $("#tombol_tambah").click(function() {
        $(".rotate").toggleClass("down");
    })

    // proses tambah
    $('#form_tambah').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?= base_url('backend/admin/referensi/universitas/aksiTambah') ?>',
            type: "POST",
            data: new FormData(this),
            dataType: "JSON",
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            beforeSend: function() {
                $('#button_tambah').text("proses...");
            },
            success: function(data) {
                if (data.status == true) {
                    tampilData();
                    toastr.success('Data universitas berhasil ditambahkan', 'Berhasil', {
                        showEasing: "swing",
                        positionClass: "toast-top-right",
                        timeOut: 3000,
                        fadeOut: 3000
                    });

                    $('#modal_tambah').modal('hide');
                    $('#nama').val('');
                    $('#alamat').val('');
                    $('#provinsi').val(null).trigger('change');
                    $('#kabupaten').val(null).trigger('change');
                    $('#kecamatan').val(null).trigger('change');
                    $('#kelurahan').val(null).trigger('change');
                    $('#nama_error').html('');
                    $('#alamat_error').html('');
                    $('#provinsi_error').html('');
                    $('#kabupaten_error').html('');
                    $('#kecamatan_error').html('');
                    $('#kelurahan_error').html('');
                    $('#button_tambah').text("Simpan");

                } else {
                    toastr.error('Periksa kembali data universitas yang anda inputkan', 'Gagal', {
                        showEasing: "swing",
                        positionClass: "toast-top-right",
                        timeOut: 3000,
                        fadeOut: 3000
                    });

                    $('#nama_error').html(data.nama);
                    $('#alamat_error').html(data.alamat);
                    $('#provinsi_error').html(data.provinsi);
                    $('#kabupaten_error').html(data.kabupaten);
                    $('#kecamatan_error').html(data.kecamatan);
                    $('#kelurahan_error').html(data.kelurahan);
                    $('#button_tambah').text("Simpan");
                }
            }
        });
    });

    $('#table_universitas').on('click', '.tombol-ubah', function() {
        var id = $(this).attr('data');
        Swal.fire({
            title: 'Tunggu beberapa saat lagi',
            text: 'Loading',
            onOpen: function() {
                swal.showLoading()
            }
        });

        $.ajax({
            url: '<?= base_url('backend/admin/referensi/universitas/aksiDetail') ?>',
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
                        $('#nama_ubah').val(data.nama);
                        $('#alamat_ubah').val(data.alamat);
                        $('#provinsi_ubah').val(data.provinsi).trigger('change');
                        $('#kabupaten_ubah').val(data.kabupaten).trigger('change');
                        $('#kecamatan_ubah').val(data.kecamatan).trigger('change');
                        $('#kelurahan_ubah').val(data.kelurahan).trigger('change');
                        ubah_kabupaten = data.kabupaten;
                        ubah_kecamatan = data.kecamatan;
                        ubah_kelurahan = data.kelurahan;
                    }
                })
            }
        });
    });

    $('#form_ubah').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo base_url('backend/admin/referensi/universitas/aksiUbah') ?>",
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            dataType: "JSON",
            cache: false,
            async: false,
            beforeSend: function() {
                $('#button_ubah').text("proses...");
            },
            success: function(data) {
                if (data.status == true) {
                    tampilData();
                    $('#modal_ubah').modal('hide');
                    $('#id_ubah').val('');
                    $('#nama_ubah').val('');
                    $('#alamat_ubah').val('');
                    $('#provinsi_ubah').val(null).trigger('change');
                    $('#kabupaten_ubah').val(null).trigger('change');
                    $('#kecamatan_ubah').val(null).trigger('change');
                    $('#kelurahan_ubah').val(null).trigger('change');
                    toastr.success('Data universitas berhasil diubah', 'Berhasil', {
                        showEasing: "swing",
                        positionClass: "toast-top-right",
                        timeOut: 3000,
                        fadeOut: 3000
                    });
                    $('#nama_ubah_error').html('');
                    $('#alamat_ubah_error').html('');
                    $('#provinsi_ubah_error').html('');
                    $('#kabupaten_ubah_error').html('');
                    $('#kecamatan_ubah_error').html('');
                    $('#kelurahan_ubah_error').html('');
                    $('#button_ubah').text("Update");
                } else {
                    toastr.error('Periksa kembali data universitas yang anda diubah', 'Gagal', {
                        showEasing: "swing",
                        positionClass: "toast-top-right",
                        timeOut: 3000,
                        fadeOut: 3000
                    });

                    $('#nama_ubah_error').html(data.nama);
                    $('#alamat_ubah_error').html(data.alamat);
                    $('#provinsi_ubah_error').html(data.provinsi);
                    $('#kabupaten_ubah_error').html(data.kabupaten);
                    $('#kecamatan_ubah_error').html(data.kecamatan);
                    $('#kelurahan_ubah_error').html(data.kelurahan);
                    $('#button_ubah').text("Update");
                }
            }
        });
    });

    $('#table_universitas').on('click', '.tombol-hapus', function() {
        var id = $(this).attr('data');
        $('#modal_hapus').modal('show');
        $.ajax({
            url: '<?= base_url('backend/admin/referensi/universitas/aksiDetail') ?>',
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
            url: "<?= base_url('backend/admin/referensi/universitas/aksiHapus') ?>",
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
                toastr.success('Data universitas berhasil dihapus', 'Berhasil', {
                    showEasing: "swing",
                    positionClass: "toast-top-right",
                    timeOut: 3000,
                    fadeOut: 3000
                });
            },
        });
    });
</script>