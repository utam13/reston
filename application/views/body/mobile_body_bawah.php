<img id="fotoOriginal" style="display:none;">
<img id="fotoCompress" style="display:none;">

<footer class="main-footer">
    <strong>REST-ON <br><a href="#" style="font-style:italic;">Created for PLN UP2D Balikpapan</a></strong>&nbsp;<i style="color:white;font-size:9pt;">Rustam &amp; Setio Budi</i>
</footer>

<div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.4 -->
<script src="<?= base_url(); ?>assets/js/plugins/jQuery/jQuery-2.1.4.min.js"></script>

<!-- Bootstrap 3.3.2 JS -->
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>

<!-- Select Plugin Js -->
<script src="<?= base_url(); ?>assets/js/bootstrap-select.js"></script>

<!-- DATA TABLES SCRIPT -->
<script src="<?= base_url(); ?>assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/js/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="<?= base_url(); ?>assets/js/datatables.custom.js"></script>

<!-- SlimScroll -->
<script src="<?= base_url(); ?>assets/js/plugins/slimScroll/jquery.slimscroll.min.js"></script>

<!-- AdminLTE App -->
<script src="<?= base_url(); ?>assets/js/AdminLTE/app.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?= base_url(); ?>assets/js/AdminLTE/demo.js"></script>

<!-- date-range-picker -->
<script src="<?= base_url(); ?>assets/js/plugins/moment/min/moment.min.js"></script>
<script src="<?= base_url(); ?>assets/js/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Select2 -->
<script src="<?= base_url(); ?>assets/js/plugins/select2/dist/js/select2.full.min.js"></script>

<!-- treeview -->
<script src="<?= base_url(); ?>assets/js/plugins/tree-view/jquery.cookie.js"></script>
<script src="<?= base_url(); ?>assets/js/plugins/tree-view/jquery.treeview.js"></script>
<script src="<?= base_url(); ?>assets/js/plugins/tree-view/demo.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/bootstrap-combobox.js"></script>

<!-- iCheck -->
<script src="<?= base_url(); ?>assets/iCheck/icheck.min.js"></script>

<!-- signature Pad -->
<script src="<?= base_url(); ?>assets/signaturepad/js/signature_pad.umd.js"></script>

<!-- Wizard -->
<script src="<?= base_url(); ?>assets/js/jquery.smartWizard.js"></script>

<!-- number format -->
<script src="<?= base_url(); ?>assets/js/plugins/number-format/jquery.masknumber.js"></script>

<script>
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    })
</script>

<!-- Compress Image -->
<script src="<?= base_url(); ?>assets/js/JIC.min.js"></script>

<!-- JS Tambahan -->
<script src="<?= base_url(); ?>assets/js/aksimobile.js"></script>

<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2();

        //Date range picker
        $('#reservasi').daterangepicker();

        //initialize formatnumber elements
        $('.formatnumber').maskNumber({
            integer: true,
        });
    })
</script>

</body>

</html>