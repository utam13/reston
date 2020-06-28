<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class='content-header'>
        <h1>
            Profil Anda
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
            <div class="col-xs-12">
                <div id="divformulir" class="box box-primary">
                    <div class="box-body">
                        <form class="form-horizontal" method="POST" action="<?= base_url(); ?>mobileprofil/proses">
                            <input type="hidden" id="kode" name="kode" value="<?= $kd_pegawai; ?>">
                            <input type="hidden" id="persno_lama" name="persno_lama" value="<?= $pers_no; ?>">
                            <input type="hidden" id="email_lama" name="email_lama" value="<?= $email; ?>">
                            <input type="hidden" id="nama_file_foto" name="nama_file_foto" value="<?= $foto; ?>">
                            <input type="hidden" id="nama_file_ttd" name="nama_file_ttd" value="<?= $ttd; ?>">
                            <input type="hidden" id="lokasi" name="lokasi" value="<?= base_url(); ?>">
                            <input type="hidden" id="folder_lokasi" name="folder_lokasi" value="pegawai">
                            <input type="file" id="pilih_foto" name="pilih_foto" accept=".jpg,.png,.bmp,.gif" style="display:none;">
                            <input type="file" id="pilih_ttd" name="pilih_ttd" accept=".jpg,.png,.bmp,.gif" style="display:none;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box box-primary box-solid">
                                        <div class="box-header with-border">
                                            <h3 align class="box-title">
                                                Formulir
                                            </h3>
                                        </div>
                                        <!-- /.box-header -->

                                        <div class="box-body pre-scrollable">
                                            <div id="div_persno" class="form-group">
                                                <label class="col-sm-2 control-label">Pers. No</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="persno" name="persno" value="<?= $pers_no; ?>" autocomplete="off" maxlength=100 placeholder="Pers. No" required>
                                                    <span id="persno_error" class="help-block" style="display:none;">Pers. No sudah terdaftar</span>
                                                </div>
                                            </div>
                                            <div id="div_email" class="form-group">
                                                <label class="col-sm-2 control-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="email" name="email" value="<?= $email; ?>" autocomplete="off" maxlength=150 placeholder="Email" required>
                                                    <span id="email_error" class="help-block" style="display:none;">Email sudah terdaftar</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Nama</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $nama; ?>" autocomplete="off" maxlength=150 placeholder="Nama" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Jabatan</label>
                                                <div class="col-sm-5">
                                                    <select class="form-control" id="jabatan" name="jabatan" style="width: 100%;" required>
                                                        <option value="">Pilih...</option>
                                                        <?
                                                        foreach ($jabatan as $j) {
                                                            if ($data_jabatan == $j->nama) {
                                                                $pilih_jabatan = "selected='selected'";
                                                            } else {
                                                                $pilih_jabatan = "";
                                                            }
                                                            echo "<option value='" . $j->nama . "' $pilih_jabatan>" . $j->nama . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Unit Organisasi</label>
                                                <div class="col-sm-5">
                                                    <select class="form-control" id="unit" name="unit" style="width: 100%;" required>
                                                        <option value="">Pilih...</option>
                                                        <?
                                                        foreach ($unit as $u) {
                                                            if ($data_unit == $u->nama) {
                                                                $pilih_unit = "selected='selected'";
                                                            } else {
                                                                $pilih_unit = "";
                                                            }
                                                            echo "<option value='" . $u->nama . "' $pilih_unit>" . $u->nama . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Bidang</label>
                                                <div class="col-sm-5">
                                                    <select class="form-control" id="bidang" name="bidang" style="width: 100%;" required>
                                                        <option value="">Pilih...</option>
                                                        <?
                                                        foreach ($bidang as $b) {
                                                            if ($data_bidang == $b->nama) {
                                                                $pilih_bidang = "selected='selected'";
                                                            } else {
                                                                $pilih_bidang = "";
                                                            }
                                                            echo "<option value='" . $b->nama . "' $pilih_bidang>" . $b->nama . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Business Area</label>
                                                <div class="col-sm-3">
                                                    <select class="form-control" id="area" name="area" style="width: 100%;" required>
                                                        <option value="">Pilih...</option>
                                                        <?
                                                        foreach ($area as $a) {
                                                            if ($data_area == $a->nomor) {
                                                                $pilih_area = "selected='selected'";
                                                            } else {
                                                                $pilih_area = "";
                                                            }
                                                            echo "<option value='" . $a->nomor . "' $pilih_area>" . $a->nomor . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Password</label>
                                                <div class="col-sm-3">
                                                    <div class="input-group">
                                                        <input type="password" id="password" name="password" class="form-control" value="<?= $password; ?>" autocomplete="new-password" placeholder="Password" required>
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-default" onclick="lihatpassword()"><span id="iconlihat" class="fa fa-eye"></span></button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="button" class="btn bg-navy" id="uploadfoto"><i class="fa fa-user"></i> Foto</button>
                                <button type="button" class="btn bg-navy" id="uploadttd"><i class="fa fa-hand-paper-o"></i> Tanda Tangan</button>
                                <button id="savebtn" type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="divfoto" class="box box-primary" style="display:none;">
                    <div class="box-header">
                        <h3 align class="box-title">
                            Foto Anda
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <img id="foto" src="<?= $file_foto; ?>" title="Foto Pegawai" style="width:50%;cursor:pointer;" onclick="upload_foto()">
                                <div id="progress_div_foto" class="progress progress-sm active" style="display:none;">
                                    <div id="progress_bar_foto" class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 20%"></div>
                                </div>
                                <br>
                                <code>Klik untuk meng-upload foto</code>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button class="btn btn-default pull-left" id="closefoto"><i class="fa fa-reply"></i> Kembali</button>
                        </div>
                    </div>
                </div>

                <div id="divttd" class="box box-primary" style="display:none;">
                    <div class="box-header">
                        <h3 align class="box-title">
                            Tanda Tangan Anda
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div id="ttdpic" class="col-xs-12 text-center">
                                <img id="ttd" src="<?= $file_ttd; ?>" title="Tanda Tangan Pegawai" style="width:50%;cursor:pointer;" onclick="upload_ttd()">
                                <div id="progress_div_ttd" class="progress progress-sm active" style="display:none;">
                                    <div id="progress_bar_ttd" class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 20%"></div>
                                </div>
                                <br>
                                <code>Klik untuk meng-upload tanda tangan</code>
                            </div>

                            <div id="signature" class="col-xs-12 text-center" style="display:none;">
                                <canvas id="signature-pad" class="signature-pad" width="350px" height="300px" style="background-color:darkgrey;"></canvas>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button class="btn btn-default" id="closettd"><i class="fa fa-reply"></i></button>
                            <button type="button" id="ttddigital_clear" class="btn btn-secondary" style="display:none;"><i class="fa fa-refresh"></i></button>
                            <button type="button" id="ttddigital" class="btn btn-primary pull-right">Digital</button>
                            <button type="button" id="capturettd" class="btn btn-primary" style="display:none;">Capture</button>
                            <button type="button" id="ttdupload" class="btn btn-primary pull-right" style="display:none;">Gambar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->