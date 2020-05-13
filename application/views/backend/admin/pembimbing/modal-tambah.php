<div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title my-auto" id="exampleModalLabel">Tambah Pembimbing</h5>
                <button class="btn btn-light btn-circle border-0" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="far fa-times"></i></span>
                </button>
            </div>
            <form id="form_tambah">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Pembimbing</label>
                        <input type="text" class="form-control" id="nama" name="nama" autocomplete="off">
                        <p id="nama_error"></p>
                    </div>
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <select id="jabatan" data-width="100%" class="form-control" name="jabatan"></select>
                        <p id="jabatan_error"></p>
                    </div>
                    <div class="form-group">
                        <label for="foto">Profile</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="foto" name="foto">
                            <label class="custom-file-label" id="foto_label" for="customFile">Pilih Profile</label>
                        </div>
                        <small class="form-text text-muted">
                            *Jika tidak memilih, maka akan menggunakan profile default.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" autocomplete="off">
                        <p id="username_error"></p>
                    </div>
                    <div class="form-group">
                        <label for="pasword">Password</label>
                        <input type="password" class="form-control" id="password" name="password" autocomplete="off">
                        <p id="password_error"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-danger text-decoration-none" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="button_tambah">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>