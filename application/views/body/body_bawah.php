<!-- Modal -->
<div class="modal fade" id="laporan-data" tabindex="-1" role="dialog" aria-labelledby="laporan-dataLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="laporan-dataLabel">Laporan Restitusi</h3>
            </div>
            <form id="frm_laporan" name="frm_laporan" action="<?= base_url(); ?>laporan" method="post" target="_blank">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="form-group">
                                <label class="form-control-label">Kelompok Laporan</label>
                                <select class="form-control" name="kelompok_laporan" id="kelompok_laporan" required>
                                    <option value="">Pilih</option>
                                    <option value="2">Lampiran 1 (Daftar Pengeluaran)</option>
                                    <option value="1">Lampiran 2 (Daftar Check List Lampiran)</option>
                                    <option value="3">File Lampiran</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Status</label>
                                <select class="form-control" name="status" id="status" style="width:60%;" required>
                                    <option value="">Pilih</option>
                                    <option value="0">Belum Selesai</option>
                                    <option value="1">Selesai</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Approval</label>
                                <select class="form-control" name="approval" id="approval" style="width:70%;">
                                    <option value="">Semua</option>
                                    <option value="0">Belum Di Approve</option>
                                    <option value="1">Approved</option>
                                    <option value="2">Rejected</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-5">
                            <div class="form-group">
                                <label id="cap_dari" class="form-control-label">Tgl. Pelaporan/Selesai</label>
                                <input type="date" id="dari" name="dari" class="form-control" max="<?= date('Y-m-d'); ?>" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label id="cap_sampai" class="form-control-label">Tgl. Pelaporan/Selesai</label>
                                <input type="date" id="sampai" name="sampai" class="form-control" max="<?= date('Y-m-d'); ?>" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Hasil Laporan</label>
                                <select class="form-control" name="hasil" id="hasil" required>
                                    <option value="1">Web Cetak</option>
                                    <option value="2">Excel</option>
                                </select>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" id="savebtn" class="btn btn-primary">Proses</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal-content -->

<footer class="main-footer">
    <div class="pull-right hidden-xs" style="text-align:right;">
        <i style="font-size:10pt;color:red;">Gunakan Chrome atau Opera untuk tampilan lebih baik</i><br><b>[Ver. 1 Rev. 1 | Thn. 2020]</b>
    </div>
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

<!-- JS Tambahan -->
<script src="<?= base_url(); ?>assets/js/aksi.js"></script>

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