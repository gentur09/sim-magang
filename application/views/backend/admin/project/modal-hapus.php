<div class="modal fade" id="modal_hapus" tabindex="-1" role="dialog" aria-labelledby="modal_hapus" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button class="btn btn-light btn-circle border-0" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="far fa-times"></i></span>
                </button>
            </div>
            <form id="form_hapus">
                <div class="modal-body">
                    <h4>Apakah anda yakin menghapus data ini?</h4>
                    <div class="form-group" hidden>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>ID</label>
                                <input type="text" class="form-control" name="id" id="hapus_id">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-link text-danger text-decoration-none" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>