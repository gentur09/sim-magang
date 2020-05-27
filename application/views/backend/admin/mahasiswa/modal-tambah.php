<div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light border-bottom-0">
                <h5 class="modal-title my-auto" id="exampleModalLabel">Tambah Mahasiswa</h5>
                <button class="btn btn-light btn-circle border-0" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="far fa-times"></i></span>
                </button>
            </div>
            <form id="form_tambah">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="nama" name="nama" autocomplete="off">
                        <p id="nama_error"></p>
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
                    <div class="form-row">
                        <div class="form-group col-md-9 mb-0">
                            <label for="universitas">Universitas</label>
                            <select id="universitas" data-width="100%" class="form-control" name="universitas"></select>
                            <p id="universitas_error"></p>
                        </div>
                        <div class="form-group col-md-3 mb-0">
                            <label for="semester">Semester</label>
                            <select id="semester" data-width="100%" class="form-control" name="semester">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                            <p id="semester_error"></p>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-7 mb-0">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" autocomplete="off">
                            <p id="email_error"></p>
                        </div>
                        <div class="form-group col-md-5 mb-0">
                            <label for="nomor_telpon">No. Telp / HP</label>
                            <input type="text" class="form-control" id="nomor_telpon" name="nomor_telpon" autocomplete="off">
                            <p id="nomor_telpon_error"></p>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 mb-0">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" autocomplete="off">
                            <p id="username_error"></p>
                        </div>
                        <div class="form-group col-md-6 mb-0">
                            <label for="pasword">Password</label>
                            <input type="password" class="form-control" id="password" name="password" autocomplete="off">
                            <p id="password_error"></p>
                        </div>
                    </div>
                    <hr class="my-3">
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" autocomplete="off"></textarea>
                        <p id="alamat_error"></p>
                    </div>
                    <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <select id="provinsi" data-width="100%" class="form-control" name="provinsi"></select>
                        <p id="provinsi_error"></p>
                    </div>
                    <div class="form-group">
                        <label for="kabupaten">Kabupaten / Kota</label>
                        <select id="kabupaten" data-width="100%" class="form-control" name="kabupaten"></select>
                        <p id="kabupaten_error"></p>
                    </div>
                    <div class="form-group">
                        <label for="kecamatan">Kecamatan</label>
                        <select id="kecamatan" data-width="100%" class="form-control" name="kecamatan"></select>
                        <p id="kecamatan_error"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="button_tambah">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>