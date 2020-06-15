<div class="modal fade" id="modal_ubah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light border-bottom-0">
                <h5 class="modal-title my-auto" id="exampleModalLabel">Edit Project</h5>
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
                    <div class="form-group">
                        <label for="judul_ubah">Judul Project</label>
                        <input type="text" class="form-control" id="judul_ubah" name="judul" autocomplete="off">
                        <p id="judul_ubah_error"></p>
                    </div>
                    <div class="form-group">
                        <label for="dosbing_ubah">Dosen Pembimbing</label>
                        <select data-width="100%" class="form-control" id="dosbing_ubah" name="dosen_pembimbing"></select>
                        <p id="dosbing_ubah_error"></p>
                    </div>
                    <div class="form-group">
                        <label for="waktu">Waktu Pengerjaan</label>
                        <div class="input-group input-daterange">
                            <input type="text" class="form-control" id="waktu_mulai_ubah" name="waktu_mulai" autocomplete="off">
                            <div class="input-group-prepend">
                                <span class="input-group-text border-left-0">to</span>
                            </div>
                            <input type="text" class="form-control" id="waktu_selesai_ubah" name="waktu_selesai" autocomplete="off">
                        </div>
                        <p id="waktu_ubah_error"></p>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_ubah">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi_ubah" name="deskripsi" autocomplete="off" rows="3"></textarea>
                        <p id="deskripsi_ubah_error"></p>
                    </div>
                    <div class="form-group">
                        <label for="file_laporan_ubah">Softfile Laporan</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file_laporan_ubah" name="file_laporan">
                            <label class="custom-file-label" id="file_ubah_label" for="customFile">Pilih File</label>
                        </div>
                        <p id="file_ubah_error"></p>
                    </div>
                    <div class="form-group">
                        <label for="repositori_ubah">Link Repositori Project</label>
                        <input type="text" class="form-control" id="repositori_ubah" name="repositori" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning" id="button_ubah">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>