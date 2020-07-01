<div class="modal fade" id="modal_ubah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light border-bottom-0">
                <h5 class="modal-title my-auto" id="exampleModalLabel">Edit Mahasiswa</h5>
                <button class="btn btn-light btn-circle border-0" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="far fa-times"></i></span>
                </button>
            </div>
            <form id="form_ubah">
                <div class="modal-body">
                    <div class="form-group" hidden>
                        <label for="id_ubah">ID</label>
                        <input type="text" class="form-control" id="id_ubah" name="id">
                    </div>
                    <div class="row">
                        <div class="col-md-4 pr-0">
                            <img src="" id="foto_profile" class="img-fluid">
                        </div>
                        <div class="col-md-8 ">
                            <div class="form-group">
                                <label for="foto_ubah">Profile Baru</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto_ubah" name="foto_ubah">
                                    <label class="custom-file-label" id="foto_ubah_label" for="customFile">Pilih Profile</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama_ubah">Nama Mahasiswa</label>
                                <input type="text" class="form-control" id="nama_ubah" name="nama" autocomplete="off">
                                <p id="nama_ubah_error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-9 mb-0">
                            <label for="universitas_ubah">Universitas</label>
                            <select id="universitas_ubah" data-width="100%" class="form-control" name="universitas"></select>
                            <p id="universitas_ubah_error"></p>
                        </div>
                        <div class="form-group col-md-3 mb-0">
                            <label for="semester_ubah">Semester</label>
                            <select id="semester_ubah" data-width="100%" class="form-control" name="semester">
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
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-7 mb-0">
                            <label for="email_ubah">Email</label>
                            <input type="text" class="form-control" id="email_ubah" name="email" autocomplete="off">
                            <p id="email_ubah_error"></p>
                        </div>
                        <div class="form-group col-md-5 mb-0">
                            <label for="nomor_telpon_ubah">No. Telp / HP</label>
                            <input type="text" class="form-control" id="nomor_telpon_ubah" name="nomor_telpon" autocomplete="off">
                            <p id="nomor_telpon_ubah_error"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username_ubah">Username</label>
                        <input type="text" class="form-control" id="username_ubah" name="username" autocomplete="off">
                        <p id="username_ubah_error"></p>
                    </div>
                    <hr class="my-3">
                    <div class="form-group">
                        <label for="alamat_ubah">Alamat</label>
                        <textarea class="form-control" id="alamat_ubah" name="alamat" autocomplete="off"></textarea>
                        <p id="alamat_ubah_error"></p>
                    </div>
                    <div class="form-group">
                        <label for="provinsi_ubah">Provinsi</label>
                        <select id="provinsi_ubah" data-width="100%" class="form-control" name="provinsi"></select>
                        <p id="provinsi_ubah_error"></p>
                    </div>
                    <div class="form-group">
                        <label for="kabupaten_ubah">Kabupaten / Kota</label>
                        <select id="kabupaten_ubah" data-width="100%" class="form-control" name="kabupaten"></select>
                        <p id="kabupaten_ubah_error"></p>
                    </div>
                    <div class="form-group">
                        <label for="kecamatan_ubah">Kecamatan</label>
                        <select id="kecamatan_ubah" data-width="100%" class="form-control" name="kecamatan"></select>
                        <p id="kecamatan_ubah_error"></p>
                    </div>
                    <div class="form-group">
                        <label for="kelurahan_ubah">Kelurahan</label>
                        <select id="kelurahan_ubah" data-width="100%" class="form-control" name="kelurahan"></select>
                        <p id="kelurahan_ubah_error"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning" id="button_ubah">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>