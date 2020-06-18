<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" id="page-title">Profile</h1>
    </div>

    <form id="form_ubah">
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <a href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Selamat Datang
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['nama']; ?></span>
                    </a>
        </div>
        <div class="form-group" hidden>
                <label for="id_ubah">ID</label>
                <input type="text" class="form-control" id="id_ubah" name="id">
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <div class="col-md-4 pr-0">
                   <img src="" id="foto_profile" class="img-fluid">
                </div>
            </div>
            <div class="col-md-6 pr-0">
            <div class="form-group">
                <label for="foto_ubah">Profile Baru</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="foto_ubah" name="foto_ubah">
                            <label class="custom-file-label" id="foto_ubah_label" for="customFile">Pilih Profile</label>
                    </div>
                </div>
            </div>
            <br>
            <hr class="my-3">
            <div class="form-group row">
                <label for="nama_ubah" class="col-sm-3 control-label text-right">Nama Mahasiswa <span class="text-danger">*</span>
                </label>
                    <div class="col-sm-9">
    				    <input type="text" class="form-control" id="nama_ubah" name="nama" autocomplete="off">
                            <p id="nama_ubah_error"></p>
			        </div>
            </div>

            <div class="form-group row">
                <label for="universitas_ubah" class="col-sm-3  control-label text-right">Universitas <span class="text-danger">*</span>
                </label>
                    <div class="col-sm-9">
                            <input type="text" class="form-control" id="universitas_ubah" name="universitas" autocomplete="off" readonly>
                                <p id="universitas_ubah_error"></p>
                    </div>
             </div>
            <div class="form-group row">
                            <label for="semester_ubah" class="col-sm-3 control-label text-right">Semester</label>
                            <div class="col-sm-2">
                                <input type="text"  id="semester_ubah" data-width="100%" class="form-control" name="semester" readonly>

             </div></div>
            <div class="form-group row">
                <label for="email_ubah" class="col-sm-3  control-label text-right">Email <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9">
    				<input type="text" class="form-control" id="email_ubah" name="email" autocomplete="off">
                        <p id="email_ubah_error"></p>
                </div>
             </div>
             <div class="form-group row">
                <label for="nomor_telpon_ubah" class="col-sm-3  control-label text-right">No Telepon / HP <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9">
    				<input type="text" class="form-control" id="nomor_telpon_ubah" name="nomor_telpon" autocomplete="off">
                        <p id="nomor_telpon_ubah_error"></p>
			     </div>
             </div>
            <div class="form-group row">
                <label for="alamat_ubah" class="col-sm-3  control-label text-right">Alamat <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9">
    				<input type="text" class="form-control" id="alamat_ubah" name="alamat" autocomplete="off">
                        <p id="alamat_ubah_error"></p>
                </div>
             </div>
             <div class="modal-footer">
                    <button type="submit" class="btn btn-warning" id="button_ubah">Update</button>
             </div>
    </div>
</div>
    </form>
</div>

<!-- /.container-fluid -->
