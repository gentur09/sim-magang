<div class="modal fade" id="modal_tambah_kinerja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light border-bottom-0">
                <h5 class="modal-title my-auto" id="exampleModalLabel">Tambah Kinerja</h5>
                <button class="btn btn-light btn-circle border-0" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="far fa-times"></i></span>
                </button>
            </div>
            <form id="form_tambah">
                <div class="modal-body">
                    <div class="form-group" hidden>
                        <label for="id_mahasiswa">ID Mahasiswa</label>
                        <input type="text" class="form-control" id="id_mahasiswa" name="id_mahasiswa">
                    </div>
                    <div class="form-group">
                        <label for="projek">Project</label>
                        <select data-width="100%" class="form-control" id="projek" name="projek"></select>
                        <p id="projek_error"></p>
                    </div>
                    <div class="form-group">
                        <label for="judul">Kinerja</label>
                        <input type="text" class="form-control" id="judul" name="judul" autocomplete="off">
                        <p id="judul_error"></p>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" autocomplete="off" rows="3"></textarea>
                        <p id="keterangan_error"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="button_tambah">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>