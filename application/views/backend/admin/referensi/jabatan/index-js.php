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

    function tampilData() {
        table = $('#table_jabatan').DataTable({
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?= base_url('backend/admin/referensi/jabatan/getDataJabatan') ?>",
                "type": "POST"
            },
            "columnDefs": [{
                    "className": "text-center",
                    "orderable": false,
                    "width": "15%",
                    "targets": -1
                },
                {
                    "className": "text-center",
                    "orderable": false,
                    "width": "7%",
                    "targets": 0
                }
            ]
        });
    }

    $('#tombol_tambah').click(function() {
        $('#modal_tambah').modal('show');
    });

    $('#form_tambah').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= base_url('backend/admin/referensi/jabatan/aksiTambah') ?>",
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
                    toastr.success('Jabatan berhasil ditambahkan', 'Berhasil', {
                        showEasing: "swing",
                        positionClass: "toast-top-right",
                        timeOut: 3000,
                        fadeOut: 3000
                    });

                    $('#modal_tambah').modal('hide');
                    $('#nama').val('');
                    $('#nama_error').html('');
                    $('#button_tambah').text("Simpan");
                } else {
                    toastr.error('Periksa kembali data jabatan yang anda inputkan', 'Gagal', {
                        showEasing: "swing",
                        positionClass: "toast-top-right",
                        timeOut: 3000,
                        fadeOut: 3000
                    });

                    $('#nama_error').html(data.nama);
                    $('#button_tambah').text("Simpan");
                }
            }
        });
    });

    $('#table_jabatan').on('click', '.tombol-ubah', function() {
        var id = $(this).attr('data');
        Swal.fire({
            title: 'Tunggu beberapa saat lagi',
            text: 'Loading',
            onOpen: function() {
                swal.showLoading()
            }
        });

        $.ajax({
            url: '<?= base_url('backend/admin/referensi/jabatan/aksiDetail') ?>',
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
                    comfirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        $('#modal_ubah').modal('show');
                        $('#id_ubah').val(data.id);
                        $('#nama_ubah').val(data.nama);
                    }
                })
            }
        });
    });

    $('#form_ubah').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?= base_url('backend/admin/referensi/jabatan/aksiUbah') ?>',
            type: 'POST',
            data: new FormData(this),
            dataType: 'JSON',
            processData: false,
            contentType: false,
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
                    toastr.success('Data jabatan berhasil diubah', 'Berhasil', {
                        showEasing: "swing",
                        positionClass: "toast-top-right",
                        timeOut: 3000,
                        fadeOut: 3000
                    });
                    $('#nama_ubah_error').html('');
                    $('#button_ubah').text("Update");
                } else {
                    toastr.error('Periksa kembali data jabatan yang anda ubah', 'Gagal', {
                        showEasing: "swing",
                        positionClass: "toast-top-right",
                        timeOut: 3000,
                        fadeOut: 3000
                    });

                    $('#nama_ubah_error').html(data.nama);
                    $('#button_ubah').text("Update");
                }
            }
        });
    });

    $('#table_jabatan').on('click', '.tombol-hapus', function() {
        var id = $(this).attr('data');
        $('#modal_hapus').modal('show');
        $.ajax({
            url: '<?= base_url('backend/admin/referensi/jabatan/aksiDetail') ?>',
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
            url: "<?= base_url('backend/admin/referensi/jabatan/aksiHapus') ?>",
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
                toastr.success('Data jabatan berhasil dihapus', 'Berhasil', {
                    showEasing: "swing",
                    positionClass: "toast-top-right",
                    timeOut: 3000,
                    fadeOut: 3000
                });
            },
        });
    });
</script>