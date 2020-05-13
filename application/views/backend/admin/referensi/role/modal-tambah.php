<div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title my-auto" id="exampleModalLabel">Tambah Role</h5>
                <button class="btn btn-light btn-circle border-0" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="far fa-times"></i></span>
                </button>
            </div>
            <form id="form_tambah">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Role</label>
                        <input type="text" class="form-control" id="nama" name="nama" autocomplete="off">
                        <p id="nama_error"></p>
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