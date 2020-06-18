<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $mahasiswa['nama']; ?></h1>
        <button class="btn btn-light btn-circle border-0 text-primary" title="Tambah Kinerja" data="<?= $mahasiswa['id']; ?>" id="tombol_tambah_kinerja">
            <i class="far fa-plus rotate"></i>
        </button>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Kinerja Mahasiwa</h6>
        </div>
        <div class="card-body">
            <?php if ($rows > 0) : ?>
                <div class="row">
                    <?php foreach ($kinerja as $k) : ?>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <?php if ($k['verifikasi'] == '') : ?>
                                <div class="card shadow-sm border-0" data="<?= $k['id']; ?>" id="detail_kinerja">
                                <?php elseif ($k['verifikasi'] == '1') : ?>
                                    <div class="card shadow-sm bg-success border-0" data="<?= $k['id']; ?>" id="detail_kinerja">
                                    <?php elseif ($k['verifikasi'] == '0') : ?>
                                        <div class="card shadow-sm bg-danger border-0" data="<?= $k['id']; ?>" id="detail_kinerja">
                                        <?php endif; ?>
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-dark"><?= $k['judul']; ?></div>
                                                </div>
                                                <div class="col-auto">
                                                    <?php if ($k['verifikasi'] == '') : ?>
                                                        <i class="fal fa-square fa-2x text-gray-300"></i>
                                                    <?php elseif ($k['verifikasi'] == '1') : ?>
                                                        <i class="fal fa-check-square fa-2x text-gray-300"></i>
                                                    <?php elseif ($k['verifikasi'] == '0') : ?>
                                                        <i class="fal fa-times-square fa-2x text-gray-300"></i>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                            <?php else : ?>
                                <div class="row h-100 justify-content-center align-items-center">
                                    <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_45movo.json" mode="bounce" background="#FFFFFF" speed="0.9" style="width: 370px; height: 370px;" loop autoplay></lottie-player>
                                </div>
                            <?php endif; ?>
                        </div>
                </div>
        </div>
        <!-- /.container-fluid -->