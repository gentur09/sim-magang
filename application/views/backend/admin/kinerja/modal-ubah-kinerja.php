<div class="modal fade" id="modal_ubah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light border-bottom-0">
                <h5 class="modal-title my-auto" id="exampleModalLabel">Edit Kinerja</h5>
                <button class="btn btn-light btn-circle border-0" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="far fa-times"></i></span>
                </button>
            </div>
            <form id="form_ubah">
                <div class="modal-body">
                    <div class="form-group" hidden>>
                        <label for="id_ubah" ID</label> <input type="text" class="form-control" id="id_ubah" name="id">
                    </div>
                    <div class="form-group">
                        <label for="projek_ubah">Project</label>
                        <select data-width="100%" class="form-control" id="projek_ubah" name="projek"></select>
                        <p id="projek_ubah_error"></p>
                    </div>
                    <div class="form-group">
                        <label for="judul_ubah">Kinerja</label>
                        <input type="text" class="form-control" id="judul_ubah" name="judul" autocomplete="off">
                        <p id="judul_ubah_error"></p>
                    </div>
                    <div class="form-group">
                        <label for="keterangan_ubah">Keterangan</label>
                        <textarea class="form-control" id="keterangan_ubah" name="keterangan" autocomplete="off" rows="3"></textarea>
                        <p id="keterangan_ubah_error"></p>
                    </div>
                    <div class="form-group">
                        <label for="verifikasi">Verifikasi Kinerja</label>
                        <select data-width="100%" class="form-control" id="verifikasi" name="verifikasi">
                            <option value="0">Refuse</option>
                            <option value="1">Accept</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning" id="button_ubah">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>