<div class="modal fade" id="modal_detail_kinerja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title my-auto">Detail Kinerja</h5>
                <button class="btn btn-light btn-circle border-0" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="far fa-times"></i></span>
                </button>
            </div>
            <form id="form_tambah">
                <div class="modal-body">
                    <div class="form-group" hidden>
                        <input type="text" class="form-control" id="id_kinerja" name="id_kinerja">
                    </div>
                    <div class="row">
                        <div class="col-1 text-center">
                            <i class="fad fa-fw fa-code-branch"></i>
                        </div>
                        <div class="col-11 pl-0">
                            <strong>Kinerja</strong>
                            <br>
                            <p id="kinerja" style="word-wrap: break-word "></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1 text-center">
                            <i class="far fa-align-left"></i>
                        </div>
                        <div class="col-11 pl-0">
                            <strong>Keterangan</strong>
                            <br>
                            <p id="isi" style="word-wrap: break-word "></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button class="btn btn-light btn-circle border-0 text-warning tombol-ubah" title="Edit" type="button" data-id-kinerja="">
                        <i class="far fa-edit"></i>
                    </button>
                    <button class="btn btn-light btn-circle border-0 text-danger tombol-hapus" title="Hapus" type="button" data-id-kinerja="">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>