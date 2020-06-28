<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class='content-header'>
        <h1>
            Pegawai
            <small>Formulir Data Pegawai</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <form class="form-horizontal" method="POST" action="<?= base_url(); ?>pegawai/proses/<?= $proses; ?>">
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
                                <div class="col-xs-3">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="box box-primary box-solid">
                                                <div class="box-header with-border">
                                                    <h3 align class="box-title">
                                                        Foto Pegawai
                                                    </h3>
                                                </div>
                                                <!-- /.box-header -->

                                                <div class="box-body text-center">
                                                    <img id="foto" src="<?= $file_foto; ?>" title="Foto Pegawai" style="width:50%;cursor:pointer;" onclick="upload_foto()">
                                                    <div id="progress_div_foto" class="progress progress-sm active" style="display:none;">
                                                        <div id="progress_bar_foto" class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 20%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <div class="box box-primary box-solid">
                                                <div class="box-header with-border">
                                                    <h3 align class="box-title">
                                                        Tanda Tangan Pegawai
                                                    </h3>
                                                </div>
                                                <!-- /.box-header -->

                                                <div class="box-body text-center">
                                                    <img id="ttd" src="<?= $file_ttd; ?>" title="Tanda Tangan Pegawai" style="width:50%;cursor:pointer;" onclick="upload_ttd()">
                                                    <div id="progress_div_ttd" class="progress progress-sm active" style="display:none;">
                                                        <div id="progress_bar_ttd" class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 20%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <code>Klik gambar untuk meng-upload (maks. 6 Mb)</code>
                                </div>
                                <div class="col-xs-9">
                                    <div class="box box-primary box-solid">
                                        <div class="box-header with-border">
                                            <h3 align class="box-title">
                                                Formulir Pegawai
                                            </h3>
                                        </div>
                                        <!-- /.box-header -->

                                        <div class="box-body">
                                            <div id="div_persno" class="form-group">
                                                <label class="col-sm-2 control-label">Pers. No</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="persno" name="persno" value="<?= $pers_no; ?>" maxlength=100 placeholder="Pers. No" required>
                                                    <span id="persno_error" class="help-block" style="display:none;">Pers. No sudah terdaftar</span>
                                                </div>
                                            </div>
                                            <div id="div_email" class="form-group">
                                                <label class="col-sm-2 control-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="email" name="email" value="<?= $email; ?>" maxlength=150 placeholder="Email" required>
                                                    <span id="email_error" class="help-block" style="display:none;">Email sudah terdaftar</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Nama</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $nama; ?>" maxlength=150 placeholder="Nama" required>
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
                                                        <!--<option value="">Pilih...</option>-->
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
                                                        <!--<option value="">Pilih...</option>-->
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
                                                <label class="col-sm-2 control-label">Level Akses</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" id="level" name="level" style="width: 100%;" required>
                                                        <option value="0" <? if ($level==0) { echo "selected" ; } ?>>Pegawai</option>
                                                        <option value="1" <? if ($level==1) { echo "selected" ; } ?>>Admin SPPD 1 (Admin Aplikasi)</option>
                                                        <option value="2" <? if ($level==2) { echo "selected" ; } ?>>Admin SPPD 2 (Pengelola Data SPPD)</option>
                                                        <option value="3" <? if ($level==3) { echo "selected" ; } ?>>Approval (Approval Pelaporan SPPD)</option>
                                                        <option value="4" <? if ($level==4) { echo "selected" ; } ?>>Pimpinan/Pengawas (Laporan dan Monitoring)</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <a href="<?= base_url(); ?>pegawai" class="btn btn-default pull-left">Batal</a>
                                <button id="savebtn" type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->