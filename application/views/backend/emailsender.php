<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class='content-header'>
        <h1>
            Konfigurasi Email Sender
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <!-- Message area -->
            <?
            extract($alert);
            if ($kode_alert != "") {
            ?>
            <div class="col-lg-12">
                <div class="alert <?= $jenisbox ?>">
                    <?= str_replace("-br-", "<br>", str_replace("-", " ", $isipesan)); ?>
                </div>
            </div>
            <? } ?>
            <div class="col-xs-6">
                <form class="form-horizontal" method="POST" action="<?= base_url(); ?>emailsender/proses">
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 align class="box-title">
                                Formulir Konfigurasi
                            </h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Email Server/Host</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="host" name="host" value="<?= $host; ?>" maxlength=100 placeholder="Email Server/Host" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" id="email" name="email" value="<?= $email; ?>" maxlength=100 placeholder="Email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Password Email</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="password" name="password" value="<?= $password; ?>" maxlength=100 placeholder="Password Email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Port Service</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control" id="port" name="port" value="<?= $port; ?>" placeholder="Port" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="ssl" id="ssl" value="0" <?= $checked; ?>>
                                            Menggunakan SSL
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer text-center">
                            <a href="<?= base_url(); ?>emailsender" class="btn btn-default pull-left">Reset</a>
                            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#testingemail">Testing Kirim Email</a>
                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="testingemail" tabindex="-1" role="dialog" aria-labelledby="testingemailLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="testingemailLabel">Testing Kirim Email</h5>
            </div>
            <form method="POST" action="<?= base_url(); ?>emailsender/teskirim">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Ketikkan Email Tujuan</label>
                        <input type="email" class="form-control" id="email_testing" name="email_testing" value="" maxlength=100 placeholder="Email" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-envelope"></i> Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal -->