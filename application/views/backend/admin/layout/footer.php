</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; SIM Magang <?= date("Y"); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded-circle bg-light text-dark" href="#page-top">
    <i class="far fa-chevron-up"></i>
</a>

<!-- Logout Modal-->
<!-- Logout Modal-->
<div class="modal fade" id="logout_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button class="btn btn-light btn-circle" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="far fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Apakah anda yakin?</h4>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-link text-danger text-decoration-none" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('login/logout'); ?>">Sign Out</a>
            </div>
        </div>
    </div>
</div>

</body>

</html>