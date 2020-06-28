<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class='content-header'>
        <h1>
            <a href="<?= base_url(); ?>sppd"><i class="fa fa-reply"></i></a>
            Pelaporan Perjalanan Dinas dan Permohonan Restitusi
            <small><b>Formulir</b></small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Formulir Laporan Perjalanan Dinas dan Permohonan Restitusi
                        </h3>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <form class="form-horizontal">
                            <div id="smartwizard2">
                                <ul>
                                    <li><a href="#step-1" style="font-size:12pt;">Step 1<br /><small>Pegawai</small></a></li>
                                    <li><a href="#step-2" style="font-size:12pt;">Step 2<br /><small>SPPD</small></a></li>
                                    <li><a href="#step-3" style="font-size:12pt;">Step 3<br /><small>Laporan Singkat</small></a></li>
                                    <li><a href="#step-4" style="font-size:12pt;">Step 4<br /><small>Biaya</small></a></li>
                                    <li><a href="#step-5" style="font-size:12pt;">Step 5<br /><small>Pakta Integritas</small></a></li>
                                    <li><a href="#step-6" style="font-size:12pt;">Step 6<br /><small>Preview</small></a></li>
                                </ul>

                                <div>
                                    <div id="step-1">
                                        <div class="box box-primary box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">
                                                    <i class="fa fa-user"></i>&nbsp;&nbsp;Pegawai
                                                </h3>
                                            </div>
                                            <div class="box-body" style="background-color:silver;">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <div class="box box-primary">
                                                                    <div class="box-header with-border">
                                                                        <h3 class="box-title">
                                                                            Foto Pegawai
                                                                        </h3>
                                                                    </div>
                                                                    <!-- /.box-header -->

                                                                    <div class="box-body text-center">
                                                                        <img id="foto" src="<?= $file_foto; ?>" title="Foto Pegawai" style="width:50%;">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12">
                                                                <div class="box box-primary">
                                                                    <div class="box-header with-border">
                                                                        <h3 class="box-title">
                                                                            Tanda Tangan Pegawai
                                                                        </h3>
                                                                    </div>
                                                                    <!-- /.box-header -->

                                                                    <div class="box-body text-center">
                                                                        <img id="ttd" src="<?= $file_ttd; ?>" title="Tanda Tangan Pegawai" style="width:50%;">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-9">
                                                        <div class="box box-primary">
                                                            <div class="box-header with-border">
                                                                <h3 class="box-title">
                                                                    Formulir Pegawai
                                                                </h3>
                                                            </div>
                                                            <!-- /.box-header -->
                                                            <input type="hidden" id="kd_pegawai" name="kd_pegawai" value="<?= $kd_pegawai; ?>">
                                                            <div class="box-body">
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">Pers. No</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" id="persno" name="persno" value="<?= $pers_no; ?>" maxlength=100 placeholder="Pers. No" required readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">Email</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="email" class="form-control" id="email" name="email" value="<?= $email; ?>" maxlength=150 placeholder="Email" required readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">Nama</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $nama; ?>" maxlength=150 placeholder="Nama" required readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">Jabatan</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= $jabatan; ?>" maxlength=150 placeholder="Jabatan" required readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">Unit Organisasi</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" id="unit" name="unit" value="<?= $unit; ?>" maxlength=150 placeholder="Unit Organisasi" required readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">Bidang</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" id="bidang" name="bidang" value="<?= $bidang; ?>" maxlength=150 placeholder="Bidang" required readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">Business Area</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" id="area" name="area" value="<?= $area; ?>" maxlength=150 placeholder="Business Area" required readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="step-2">
                                        <div class="box box-primary box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">
                                                    <i class="fa fa-file-text"></i>&nbsp;&nbsp;SPPD
                                                </h3>
                                            </div>
                                            <div class="box-body" style="background-color:silver;">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="box box-primary">
                                                            <div class="box-header with-border">
                                                                <h3 class="box-title">
                                                                    Formulir SPPD
                                                                </h3>
                                                            </div>
                                                            <!-- /.box-header -->

                                                            <div class="box-body">
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">Nomor Trip</label>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" class="form-control" id="trip_no" name="trip_no" value="<?= $trip_no; ?>" maxlength=100 placeholder="Nomor Trip" required readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">Tempat Berangkat</label>
                                                                    <div class="col-sm-7">
                                                                        <input type="text" class="form-control" id="dari" name="dari" value="<?= $dari; ?>" maxlength=150 placeholder="Tempat Berangkat" required readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">Tempat Tujuan</label>
                                                                    <div class="col-sm-7">
                                                                        <input type="text" class="form-control" id="ke" name="ke" value="<?= $ke; ?>" maxlength=150 placeholder="Tempat Tujuan" required readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">Tanggal Berangkat</label>
                                                                    <div class="col-sm-3">
                                                                        <input type="date" class="form-control" id="tgl_berangkat" name="tgl_berangkat" value="<?= $tgl_berangkat; ?>" max="<?= date('Y-m-d'); ?>" required readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">Tanggal Kembali</label>
                                                                    <div class="col-sm-3">
                                                                        <input type="date" class="form-control" id="tgl_pulang" name="tgl_pulang" value="<?= $tgl_pulang; ?>" max="<?= date('Y-m-d'); ?>" required readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">Maksud Perjalanan Dinas</label>
                                                                    <div class="col-sm-10">
                                                                        <textarea class="form-control" id="maksud" name="maksud" rows="3" placeholder="Maksud perjalanan dinas ..." style="resize:none;" readonly><?= $maksud; ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12">
                                                        <div class="box box-primary">
                                                            <div class="box-header with-border">
                                                                <h3 class="box-title">
                                                                    Berkas SPPD
                                                                </h3>
                                                            </div>
                                                            <!-- /.box-header -->

                                                            <div class="box-body text-center">
                                                                <div class="row">
                                                                    <div class="col-xs-4">
                                                                        <input type="hidden" id="nama_berkas1" name="nama_berkas1" value="<?= $berkas1; ?>">
                                                                        <img id="berkas1" src="<?= $file_berkas1; ?>" title="Gambar Berkas 1" style="width:50%;" onclick="previewberkas('<?= $file_berkas1; ?>',1)">
                                                                    </div>
                                                                    <div class="col-xs-4">
                                                                        <input type="hidden" id="nama_berkas2" name="nama_berkas2" value="<?= $berkas2; ?>">
                                                                        <img id="berkas2" src="<?= $file_berkas2; ?>" title="Gambar Berkas 2" style="width:50%;" onclick="previewberkas('<?= $file_berkas2; ?>',2)">
                                                                    </div>
                                                                    <div class="col-xs-4">
                                                                        <input type="hidden" id="nama_berkas3" name="nama_berkas3" value="<?= $berkas3; ?>">
                                                                        <img id="berkas3" src="<?= $file_berkas3; ?>" title="Gambar Berkas 3" style="width:50%;" onclick="previewberkas('<?= $file_berkas3; ?>',3)">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="step-3">
                                        <div class="box box-primary box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">
                                                    <i class="fa fa-pencil"></i>&nbsp;&nbsp;Laporan Singkat
                                                </h3>
                                            </div>
                                            <div class="box-body" style="background-color:silver;">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <div class="box box-primary">
                                                            <div class="box-header with-border">
                                                                <h3 class="box-title">
                                                                    Berkas Laporan
                                                                </h3>
                                                            </div>
                                                            <!-- /.box-header -->

                                                            <div class="box-body text-center">
                                                                <input type="hidden" id="nama_berkas_lap" name="nama_berkas_lap" value="<?= $berkas_lap; ?>">
                                                                <img id="berkas_laporan" src="<?= $file_berkas_lap; ?>" title="Gambar Berkas laporan Pelaksanaan Perjalanan Dinas" style="width:50%;" onclick="previewberkas('<?= $file_berkas_lap; ?>',4)">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <div class="box box-primary">
                                                            <div class="box-header with-border">
                                                                <h3 class="box-title">
                                                                    Isi Laporan Singkat Pelaksanaan Perjalanan Dinas
                                                                </h3>
                                                            </div>
                                                            <!-- /.box-header -->

                                                            <div class="box-body">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <textarea class="form-control" id="isilap" name="isilap" rows="6" placeholder="Isi laporan singkat perjalanan dinas ..." style="resize:none;" readonly><?= $isilap; ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="step-4">
                                        <div class="box box-primary box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">
                                                    <i class="fa fa-money"></i>&nbsp;&nbsp;Biaya
                                                </h3>
                                            </div>
                                            <div class="box-body" style="background-color:silver;">
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <div class="box">
                                                            <div class="box-header">
                                                                <h3 class="box-title">
                                                                    Biaya Transportasi
                                                                </h3>
                                                            </div>
                                                            <div class="box-body">
                                                                <div class="form-group">
                                                                    <label class="col-sm-6 control-label">Nominal Tiket Pergi (Rp)</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" class="form-control formatnumber" id="nominal_pergi" name="nominal_pergi" value="<?= number_format($nominal_pergi, 0, '.', ','); ?>" min=0 max=999999999 required readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-6 control-label">Nominal Tiket Pulang (Rp)</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" class="form-control formatnumber" id="nominal_pulang" name="nominal_pulang" value="<?= number_format($nominal_pulang, 0, '.', ','); ?>" min=0 max=999999999 required readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-3">
                                                        <div class="box">
                                                            <div class="box-header">
                                                                <h3 class="box-title">
                                                                    Tiket Pergi
                                                                </h3>
                                                            </div>
                                                            <div class="box-body text-center">
                                                                <input type="hidden" id="nama_berkas_pergi" name="nama_berkas_pergi" value="<?= $berkas_pergi; ?>">
                                                                <img id="berkas_pergi" src="<?= $file_berkas_pergi; ?>" style="width:50%;" onclick="previewberkas('<?= $file_berkas_pergi; ?>',5)">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-3">
                                                        <div class="box">
                                                            <div class="box-header">
                                                                <h3 class="box-title">
                                                                    Tiket Pulang
                                                                </h3>
                                                            </div>
                                                            <div class="box-body text-center">
                                                                <input type="hidden" id="nama_berkas_pulang" name="nama_berkas_pulang" value="<?= $berkas_pulang; ?>">
                                                                <img id="berkas_pulang" src="<?= $file_berkas_pulang; ?>" style="width:50%;" onclick="previewberkas('<?= $file_berkas_pulang; ?>',6)">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-xs-9">
                                                        <div class="box">
                                                            <div class="box-header">
                                                                <h3 class="box-title">
                                                                    Biaya Penginapan
                                                                </h3>
                                                            </div>
                                                            <div class="box-body">
                                                                <div class="col-xs-12">
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label">Nama Penginapan</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control" id="nama_penginapan" name="nama_penginapan" value="<?= $nama_penginapan; ?>" required readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12">
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label">Tanggal Menginap</label>
                                                                        <div class="col-sm-3">
                                                                            <input type="date" class="form-control" id="tgl_check_in" name="tgl_check_in" value="<?= $tgl_check_in; ?>" readonly>
                                                                        </div>
                                                                        <label class="col-sm-1 control-label">sampai</label>
                                                                        <div class="col-sm-3">
                                                                            <input type="date" class="form-control" id="tgl_check_out" name="tgl_check_out" value="<?= $tgl_check_out; ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12">
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label">Nominal (Rp)</label>
                                                                        <div class="col-sm-4">
                                                                            <input type="text" class="form-control formatnumber" id="nominal_penginapan" name="nominal_penginapan" value="<?= number_format($nominal_penginapan, 0, '.', ','); ?>" min=0 max=999999999 required readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-3">
                                                        <div class="box">
                                                            <div class="box-header">
                                                                <h3 class="box-title">
                                                                    Invoice/Bill Penginapan
                                                                </h3>
                                                            </div>
                                                            <div class="box-body text-center">
                                                                <input type="hidden" id="nama_berkas_penginapan" name="nama_berkas_penginapan" value="<?= $berkas_penginapan; ?>">
                                                                <img id="berkas_penginapan" src="<?= $file_berkas_penginapan; ?>" style="width:50%;" onclick="previewberkas('<?= $file_berkas_penginapan; ?>',7)">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-xs-9">
                                                        <div class="box">
                                                            <div class="box-header">
                                                                <h3 class="box-title">
                                                                    Biaya Bagasi
                                                                </h3>
                                                            </div>
                                                            <div class="box-body">
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">Nominal (Rp)</label>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" class="form-control formatnumber" id="nominal_bagasi" name="nominal_bagasi" value="<?= number_format($nominal_bagasi, 0, '.', ','); ?>" min=0 max=999999999 required readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-3">
                                                        <div class="box">
                                                            <div class="box-header">
                                                                <h3 class="box-title">
                                                                    Boarding Pass
                                                                </h3>
                                                            </div>
                                                            <div class="box-body text-center">
                                                                <input type="hidden" id="nama_berkas_bagasi" name="nama_berkas_bagasi" value="<?= $berkas_bagasi; ?>" readonly>
                                                                <img id="berkas_bagasi" src="<?= $file_berkas_bagasi; ?>" style="width:50%;" onclick="previewberkas('<?= $file_berkas_bagasi; ?>',8)">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="box">
                                                            <div class="box-body">
                                                                <div class="form-group">
                                                                    <label class="col-sm-10 control-label">Total Biaya (Rp)</label>
                                                                    <div class="col-sm-2">
                                                                        <input type="text" class="form-control formatnumber" id="total_biaya" name="total_biaya" value="<?= $total_biaya; ?>" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="step-5">
                                        <div class="box box-primary box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">
                                                    <i class="fa fa-chain"></i>&nbsp;&nbsp;Pakta Integritas
                                                </h3>
                                            </div>
                                            <div class="box-body">
                                                <div class="checkbox">
                                                    <label class="col-sm-12">
                                                        Segala hal yang kami sampaikan dan lampirkan dalam laporan ini adalah benar dan kami sepenuhnya memahami bahwa segala bentuk pemalsuan yang berakibat merugikan perusahaan adalah merupakan jenis pelanggaran berat sebagaimana dalam peraturan displin pegawai yang berlaku di PLN (Persero).
                                                    </label>
                                                </div>
                                                <br><br>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label text-left">
                                                        Catatan perubahan SPPD
                                                        <br>
                                                        <code><i>(jika ada)</i></code>
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="Catatan perubahan SPPD (jika ada) ..." style="resize:none;" readonly><?= $catatan; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label text-left">
                                                        Atasan
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="hidden" class="form-control" id="kd_atasan" name="kd_atasan" value="<?= $kd_atasan; ?>">
                                                        <input type="text" class="form-control" id="atasan" name="atasan" value="<?= $persno_atasan . " - " . $nama_atasan; ?>" maxlength=100 placeholder="Atasan" required readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="step-6">
                                        <div class="box box-primary box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">
                                                    <i class="fa fa-file"></i> Preview
                                                </h3>
                                            </div>
                                            <div class="box-body">
                                                <table>
                                                    <tr>
                                                        <td colspan=5>
                                                            PT. PLN (PERSERO)
                                                            <br>
                                                            WILAYAH KALIMANTAN TIMUR DAN KALIMANTAN UTARA
                                                            <br><br>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan=5 align="center">
                                                            <h4 style="font-weight:bold;">LAPORAN PERJALANAN DINAS DAN PERMOHONAN RESTITUSI</h4>
                                                            <br>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:20px;">I.</th>
                                                        <th colspan=5>Data Pegawai</th>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td style="width:20px;">a.</td>
                                                        <td style="width:180px;">Nama</td>
                                                        <td>:</td>
                                                        <td id="table_nama"><?= $nama; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>b.</td>
                                                        <td>Nomor Induk</td>
                                                        <td>:</td>
                                                        <td id="table_persno"><?= $nama; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>c.</td>
                                                        <td>Jabatan</td>
                                                        <td>:</td>
                                                        <td id="table_jabatan"><?= $jabatan; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>d.</td>
                                                        <td>Unit Organisasi</td>
                                                        <td>:</td>
                                                        <td id="table_unit"><?= $unit; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan=5>&nbsp;</tdc>
                                                    </tr>
                                                    <tr>
                                                        <th>II.</th>
                                                        <th colspan=5>Surat Perintah Perjalanan Dinas</th>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>a.</td>
                                                        <td>Nomor Trip</td>
                                                        <td>:</td>
                                                        <td id="table_trip_no"><?= $trip_no; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>b.</td>
                                                        <td>Tempat Berangkat</td>
                                                        <td>:</td>
                                                        <td id="table_dari"><?= $dari; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>c.</td>
                                                        <td>Tempat Tujuan</td>
                                                        <td>:</td>
                                                        <td id="table_ke"><?= $ke; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>d.</td>
                                                        <td>Tanggal Berangkat</td>
                                                        <td>:</td>
                                                        <td id="table_tgl_berangkat"><?= date('d-m-Y', strtotime($tgl_berangkat)); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>e.</td>
                                                        <td>Tanggal Kembali</td>
                                                        <td>:</td>
                                                        <td id="table_tgl_pulang"><?= date('d-m-Y', strtotime($tgl_pulang)); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>f.</td>
                                                        <td>Maksud Perjalanan Dinas</td>
                                                        <td>:</td>
                                                        <td id="table_maksud"><?= $maksud; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan=5>&nbsp;</tdc>
                                                    </tr>
                                                    <tr>
                                                        <th>III.</th>
                                                        <th colspan=5>Laporan Singkat Pelaksanaan Perjalanan Dinas</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td colspan=5 id="table_lap_singkat"><?= $isilap; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan=5>&nbsp;</tdc>
                                                    </tr>
                                                    <tr>
                                                        <th>IV.</th>
                                                        <th colspan=5>Biaya</th>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td colspan=5>
                                                            <table style="border-collapse:collapse;">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="border:1px solid #000000;text-align:center;width:30px;">No.</th>
                                                                        <th style="border:1px solid #000000;text-align:center;width:120px;">Uraian</th>
                                                                        <th style="border:1px solid #000000;text-align:center;width:100px;">Jumlah (Rp)</th>
                                                                        <th style="border:1px solid #000000;text-align:center;width:150px;">Keterangan</th>
                                                                        <th style="border:1px solid #000000;text-align:center;">Lampiran</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td valign="top" align="center" style="border:1px solid #000000;">1</td>
                                                                        <td valign="top" style="border:1px solid #000000;">Transportasi</td>
                                                                        <td align="right" style="border:1px solid #000000;" id="table_nominal_transport">
                                                                            <?= number_format($nominal_pergi, 0, ',', ','); ?>&nbsp;
                                                                            <br>
                                                                            <?= number_format($nominal_pulang, 0, ',', ','); ?>&nbsp;
                                                                        </td>
                                                                        <td style="border:1px solid #000000;">
                                                                            Tiket Pergi
                                                                            <br>
                                                                            Tiket Pulang
                                                                        </td>
                                                                        <td rowspan=4 style="border:1px solid #000000;">
                                                                            <ul>
                                                                                <li>Formulir SPPD yang telah disetujui oleh Pejabat berwenang di Unit Penerima</li>
                                                                                <li>Invoice Pembelian Tiket Pesawat</li>
                                                                                <li>Boarding Pass</li>
                                                                                <li>Invoice/Bill Penginapan</li>
                                                                            </ul>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="center" style="border:1px solid #000000;">2</td>
                                                                        <td style="border:1px solid #000000;">Penginapan</td>
                                                                        <td align="right" style="border:1px solid #000000;" id="table_nominal_penginapan"><?= number_format($nominal_penginapan, 0, ',', ','); ?>&nbsp;</td>
                                                                        <td style="border:1px solid #000000;" id="table_nama_penginapan"><?= $nama_penginapan; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="center" style="border:1px solid #000000;">3</td>
                                                                        <td style="border:1px solid #000000;">Bagasi</td>
                                                                        <td align="right" style="border:1px solid #000000;" id="table_nominal_bagasi"><?= number_format($nominal_bagasi, 0, ',', ','); ?>&nbsp;</td>
                                                                        <td style="border:1px solid #000000;">&nbsp;</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th colspan=2 style="border:1px solid #000000;text-align:right;">Total Jumlah&nbsp;</th>
                                                                        <th align="right" style="border:1px solid #000000;text-align:right;" id="table_total_biaya"><?= number_format($total_biaya, 0, ',', ','); ?>&nbsp;</th>
                                                                        <td style="border:1px solid #000000;">&nbsp;</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan=5>&nbsp;</tdc>
                                                    </tr>
                                                    <tr>
                                                        <th>IV.</th>
                                                        <th colspan=5>PAKTA INTEGRITAS</th>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td colspan=4>
                                                            <p>
                                                                Segala hal yang kami sampaikan dan lampirkan dalam laporan ini adalah benar dan kami sepenuhnya memahami bahwa segala bentuk pemalsuan yang berakibat merugikan perusahaan adalah merupakan jenis pelanggaran berat sebagaimana dalam peraturan displin pegawai yang berlaku di PLN (Persero).
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td colspan=2>Catatan perubahan SPPD<br>(jika ada)</td>
                                                        <td valign="top">:</td>
                                                        <td id="table_catatan" valign="top"><?= $catatan; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan=5>&nbsp;</tdc>
                                                    </tr>
                                                    <tr>
                                                        <td colspan=5>&nbsp;</tdc>
                                                    </tr>
                                                    <tr>
                                                        <td colspan=5>&nbsp;</tdc>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td align="center" colspan=2>
                                                            Mengetahui,
                                                            <br>
                                                            Atasan
                                                            <br>
                                                            <img id="ttd_atasan" src="<?= $ttd_atasan; ?>" style="width:100px;">
                                                            <br>
                                                            <b id="ttd_nama_atasan"><?= $nama_atasan; ?></b>
                                                        </td>
                                                        <td>&nbsp;</td>
                                                        <td align="center" colspan=2>
                                                            Balikpapan, <?= date('d-m-Y'); ?>
                                                            <br>
                                                            Pelaksanaan Perjalanan Dinas
                                                            <br>
                                                            <img id="ttd_pegawai" src="<?= $ttd_pegawai; ?>" style="width:100px;">
                                                            <br>
                                                            <b id="ttd_nama_pegawai"><?= $nama; ?></b>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->

<!-- Modal -->
<div class="modal fade" id="daftar-pegawai" tabindex="-1" role="dialog" aria-labelledby="daftar-pegawaiLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="daftar-pegawaiLabel">Daftar Pegawai</h4>
            </div>
            <div class="modal-body">
                <iframe id="frame_daftar_pegawai" src="<?= base_url(); ?>sppd/daftar_pegawai" frameborder="0" style="width:100%;height:300px;"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="preview-gambar" tabindex="-1" role="dialog" aria-labelledby="preview-gambarLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="preview-gambarLabel">Berkas</h5>
            </div>
            <div class="modal-body">
                <img src="" id="preview" width="100%">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
                <a id="preview_newtab" href="" target="_blank" rule="button" class="btn btn-warning btn-sm">Tampilkan lebih besar</a>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->