     <!-- Footer -->
     <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>2021 - NOOX Ordem de Serviço | By 
                        <a href="https://srtecno.com.br" target="blanck" title="SRtecno informática & Web Systems" ><i class="fas fa-building"></i></a>&nbspSRtecno Informática & Web Systems
                        </span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deseja realmente sair?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Clique em <strong>Sair</strong> para encessar a sessão.</div>
                <div class="modal-footer">
                    <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal"><i class="far fa-times-circle"></i>&nbsp;Não</button>
                    <a class="btn btn-primary btn-sm" href="<?php echo base_url('login/logout'); ?>"><i class="fas fa-sign-out-alt"></i>&nbsp;Sair</a>
                </div>
            </div>
        </div>
    </div>

   <!-- Bootstrap core JavaScript-->
   <script src="<?php echo base_url('public/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('public/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url('public/js/sb-admin-2.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/js/util.js'); ?>"></script>

    <?php if (isset($scripts)):?>
        <?php foreach ($scripts as $script): ?>
            <!-- Custom scripts for  this module-->
            <script src="<?php echo base_url('public/'.$script); ?>"> </script>

        <?php endforeach; ?>

    <?php endif; ?>

</body>

</html>