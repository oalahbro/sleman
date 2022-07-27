<!-- SweetAlert2 -->
<script src="<?= base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<!-- jQuery -->
<script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<!-- Showing Sweet Alert -->
<script src="<?= base_url(); ?>assets/dist/js/alert.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#pesan").fadeTo(2000, 500).slideUp(500, function() {
            $("#pesan").slideUp(500);
        });
    })
</script>
</body>

</html>