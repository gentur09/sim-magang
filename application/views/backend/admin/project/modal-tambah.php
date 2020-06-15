<div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light border-bottom-0">
                <h5 class="modal-title my-auto" id="exampleModalLabel">Tambah Project</h5>
                <button class="btn btn-light btn-circle border-0" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="far fa-times"></i></span>
                </button>
            </div>
            <form id="form_tambah">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Judul Project</label>
                        <input type="text" class="form-control" id="judul" name="judul" autocomplete="off">
                        <p id="judul_error"></p>
                    </div>
                    <div class="form-group">
                        <label for="dosen_pembimbing">Dosen Pembimbing</label>
                        <select data-width="100%" class="form-control" id="dosen_pembimbing" name="dosen_pembimbing"></select>
                        <p id="dosen_pembimbing_error"></p>
                    </div>
                    <div class="form-group">
                        <label for="waktu">Waktu Pengerjaan</label>
                        <div class="input-group input-daterange">
                            <input type="text" class="form-control" id="waktu_mulai" name="waktu_mulai" autocomplete="off">
                            <div class="input-group-prepend">
                                <span class="input-group-text border-left-0">to</span>
                            </div>
                            <input type="text" class="form-control" id="waktu_selesai" name="waktu_selesai" autocomplete="off">
                        </div>
                        <p id="waktu_error"></p>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" autocomplete="off" rows="3"></textarea>
                        <p id="deskripsi_error"></p>
                    </div>
                    <div class="form-group">
                        <label for="file_laporan">Softfile Laporan</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file_laporan" name="file_laporan">
                            <label class="custom-file-label" id="file_label" for="customFile">Pilih File</label>
                        </div>
                        <p id="file_error"></p>
                    </div>
                    <div class="form-group">
                        <label for="nama">Link Repositori Project</label>
                        <input type="text" class="form-control" id="repositori" name="repositori" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="button_tambah">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>