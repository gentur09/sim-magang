<div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title my-auto" id="exampleModalLabel">Tambah Universitas</h5>
                <button class="btn btn-light btn-circle border-0" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="far fa-times"></i></span>
                </button>
            </div>
            <form id="form_tambah">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Universitas</label>
                        <input type="text" class="form-control" id="nama" name="nama" autocomplete="off">
                        <p id="nama_error"></p>
                    </div>
                    <hr>
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
                    <button type="button" class="btn btn-link text-danger text-decoration-none" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="button_tambah">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>