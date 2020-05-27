<div class="modal fade" id="modal_ubah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light border-bottom-0">
                <h5 class="modal-title my-auto" id="exampleModalLabel">Edit Universitas</h5>
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
                        <label for="nama_ubah">Nama Universitas</label>
                        <input type="text" class="form-control" id="nama_ubah" name="nama" autocomplete="off">
                        <p id="nama_ubah_error"></p>
                    </div>
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
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning" id="button_ubah">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>