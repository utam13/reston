<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class='content-header'>
        <h1>
            Laporan Perjalanan Dinas dan Permohonan Restitusi
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <form class="form-horizontal" method="POST" action="#">
                    <div id="step-1" class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Formulir SPPD
                            </h3>
                        </div>
                        <div class="box-body">
                            <div id="div_tripno" class="form-group">
                                <label class="col-sm-2 control-label">Nomor Trip</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="trip_no" name="trip_no" value="<?= $trip_no; ?>" maxlength=100 placeholder="Nomor Trip" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tempat Berangkat</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="dari" name="dari" value="<?= $dari; ?>" maxlength=150 placeholder="Tempat Berangkat" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tempat Tujuan</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="ke" name="ke" value="<?= $ke; ?>" maxlength=150 placeholder="Tempat Tujuan" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tanggal Berangkat</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" id="tgl_berangkat" name="tgl_berangkat" value="<?= $tgl_berangkat; ?>" max="<?= date('Y-m-d'); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tanggal Kembali</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" id="tgl_pulang" name="tgl_pulang" value="<?= $tgl_pulang; ?>" max="<?= date('Y-m-d'); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Maksud Perjalanan Dinas</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="maksud" name="maksud" rows="3" placeholder="Maksud perjalanan dinas ..." style="resize:none;" readonly><?= $maksud; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="#" class="btn btn-default pull-right" onclick="step('lanjut',2)">Selanjutnya</a>
                        </div>
                    </div>

                    <div id="step-2" class="box box-primary box-solid hide">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Berkas I - SPPD
                            </h3>
                        </div>
                        <div class="box-body text-center">
                            <input type="hidden" id="nama_berkas1" name="nama_berkas1" value="<?= $berkas1; ?>">
                            <img id="berkas1" src="<?= $file_berkas1; ?>" title="Gambar Berkas 1" style="width:50%;" onclick="previewberkas('<?= $file_berkas1; ?>',1)">
                        </div>
                        <div class="box-footer">
                            <a href="#" class="btn btn-default pull-left" onclick="step('balik',1)">Sebelumnya</a>
                            <a href="#" class="btn btn-default pull-right" onclick="step('lanjut',3)">Selanjutnya</a>
                        </div>
                    </div>

                    <div id="step-3" class="box box-primary box-solid hide">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Berkas II - SPPD
                            </h3>
                        </div>
                        <div class="box-body text-center">
                            <input type="hidden" id="nama_berkas2" name="nama_berkas2" value="<?= $berkas2; ?>">
                            <img id="berkas2" src="<?= $file_berkas2; ?>" title="Gambar Berkas 2" style="width:50%;" onclick="previewberkas('<?= $file_berkas2; ?>',2)">
                        </div>
                        <div class="box-footer">
                            <a href="#" class="btn btn-default pull-left" onclick="step('balik',2)">Sebelumnya</a>
                            <a href="#" class="btn btn-default pull-right" onclick="step('lanjut',4)">Selanjutnya</a>
                        </div>
                    </div>

                    <div id="step-4" class="box box-primary box-solid hide">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Berkas III - SPPD
                            </h3>
                        </div>
                        <div class="box-body text-center">
                            <input type="hidden" id="nama_berkas3" name="nama_berkas3" value="<?= $berkas3; ?>">
                            <img id="berkas3" src="<?= $file_berkas3; ?>" title="Gambar Berkas 3" style="width:50%;" onclick="previewberkas('<?= $file_berkas3; ?>',3)">
                        </div>
                        <div class="box-footer">
                            <a href="#" class="btn btn-default pull-left" onclick="step('balik',3)">Sebelumnya</a>
                            <a href="#" class="btn btn-default pull-right" onclick="step('lanjut',5)">Selanjutnya</a>
                        </div>
                    </div>

                    <div id="step-5" class="box box-primary box-solid hide">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Laporan Singkat Perjalanan Dinas
                            </h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="isilap" name="isilap" rows="6" placeholder="Isi laporan singkat perjalanan dinas ..." style="resize:none;" readonly><?= $isilap; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="#" class="btn btn-default pull-left" onclick="step('balik',4)">Sebelumnya</a>
                            <a href="#" class="btn btn-default pull-right" onclick="step('lanjut',6)">Selanjutnya</a>
                        </div>
                    </div>

                    <div id="step-6" class="box box-primary box-solid hide">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Berkas Laporan Perjalanan Dinas
                            </h3>
                        </div>
                        <div class="box-body text-center">
                            <input type="hidden" id="nama_berkas_lap" name="nama_berkas_lap" value="<?= $berkas_lap; ?>">
                            <img id="berkas_laporan" src="<?= $file_berkas_lap; ?>" style="width:50%;" onclick="previewberkas('<?= $file_berkas_lap; ?>',4)">
                        </div>
                        <div class="box-footer">
                            <a href="#" class="btn btn-default pull-left" onclick="step('balik',5)">Sebelumnya</a>
                            <a href="#" class="btn btn-default pull-right" onclick="step('lanjut',7)">Selanjutnya</a>
                        </div>
                    </div>

                    <div id="step-7" class="box box-primary box-solid hide">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Biaya Transpotasi
                            </h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-6 control-label">Nominal Tiket Pergi (Rp)</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control formatnumber" id="nominal_pergi" name="nominal_pergi" value="<?= number_format($nominal_pergi, 0, '.', ','); ?>" min=0 max=999999999 readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label">Nominal Tiket Pulang (Rp)</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control formatnumber" id="nominal_pulang" name="nominal_pulang" value="<?= number_format($nominal_pulang, 0, '.', ','); ?>" min=0 max=999999999 readonly>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="#" class="btn btn-default pull-left" onclick="step('balik',6)">Sebelumnya</a>
                            <a href="#" class="btn btn-default pull-right" onclick="step('lanjut',8)">Selanjutnya</a>
                        </div>
                    </div>

                    <div id="step-8" class="box box-primary box-solid hide">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Berkas Transportasi Pergi
                            </h3>
                        </div>
                        <div class="box-body text-center">
                            <input type="hidden" id="nama_berkas_pergi" name="nama_berkas_pergi" value="<?= $berkas_pergi; ?>">
                            <img id="berkas_pergi" src="<?= $file_berkas_pergi; ?>" style="width:50%;" onclick="previewberkas('<?= $file_berkas_pergi; ?>',5)">
                        </div>
                        <div class="box-footer">
                            <a href="#" class="btn btn-default pull-left" onclick="step('balik',7)">Sebelumnya</a>
                            <a href="#" class="btn btn-default pull-right" onclick="step('lanjut',9)">Selanjutnya</a>
                        </div>
                    </div>

                    <div id="step-9" class="box box-primary box-solid hide">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Berkas Transpotasi Pulang
                            </h3>
                        </div>
                        <div class="box-body text-center">
                            <input type="hidden" id="nama_berkas_pulang" name="nama_berkas_pulang" value="<?= $berkas_pulang; ?>">
                            <img id="berkas_pulang" src="<?= $file_berkas_pulang; ?>" style="width:50%;" onclick="previewberkas('<?= $file_berkas_pulang; ?>',6)">
                        </div>
                        <div class="box-footer">
                            <a href="#" class="btn btn-default pull-left" onclick="step('balik',8)">Sebelumnya</a>
                            <a href="#" class="btn btn-default pull-right" onclick="step('lanjut',10)">Selanjutnya</a>
                        </div>
                    </div>

                    <div id="step-10" class="box box-primary box-solid hide">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Biaya Penginapan
                            </h3>
                        </div>
                        <div class="box-body">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Nama Penginapan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nama_penginapan" name="nama_penginapan" value="<?= $nama_penginapan; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tanggal Check In</label>
                                    <div class="col-sm-3">
                                        <input type="date" class="form-control" id="tgl_check_in" name="tgl_check_in" value="<?= $tgl_check_in; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tanggal Check Out</label>
                                    <div class="col-sm-3">
                                        <input type="date" class="form-control" id="tgl_check_out" name="tgl_check_out" value="<?= $tgl_check_out; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Nominal (Rp)</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-con formatnumbertrol" id="nominal_penginapan" name="nominal_penginapan" value="<?= number_format($nominal_penginapan, 0, '.', ','); ?>" min=0 max=999999999 readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="#" class="btn btn-default pull-left" onclick="step('balik',9)">Sebelumnya</a>
                            <a href="#" class="btn btn-default pull-right" onclick="step('lanjut',11)">Selanjutnya</a>
                        </div>
                    </div>

                    <div id="step-11" class="box box-primary box-solid hide">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Berkas Penginapan (Invoice/Bill)
                            </h3>
                        </div>
                        <div class="box-body text-center">
                            <input type="hidden" id="nama_berkas_penginapan" name="nama_berkas_penginapan" value="<?= $berkas_penginapan; ?>">
                            <img id="berkas_penginapan" src="<?= $file_berkas_penginapan; ?>" style="width:50%;" onclick="previewberkas('<?= $file_berkas_penginapan; ?>',7)">
                        </div>
                        <div class="box-footer">
                            <a href="#" class="btn btn-default pull-left" onclick="step('balik',10)">Sebelumnya</a>
                            <a href="#" class="btn btn-default pull-right" onclick="step('lanjut',12)">Selanjutnya</a>
                        </div>
                    </div>

                    <div id="step-12" class="box box-primary box-solid hide">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Biaya Bagasi
                            </h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nominal (Rp)</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control formatnumber" id="nominal_bagasi" name="nominal_bagasi" value="<?= number_format($nominal_bagasi, 0, '.', ','); ?>" min=0 max=999999999 readonly>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="#" class="btn btn-default pull-left" onclick="step('balik',11)">Sebelumnya</a>
                            <a href="#" class="btn btn-default pull-right" onclick="step('lanjut',13)">Selanjutnya</a>
                        </div>
                    </div>

                    <div id="step-13" class="box box-primary box-solid hide">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Berkas Bagasi (Boarding Pass)
                            </h3>
                        </div>
                        <div class="box-body text-center">
                            <input type="hidden" id="nama_berkas_bagasi" name="nama_berkas_bagasi" value="<?= $berkas_bagasi; ?>">
                            <img id="berkas_bagasi" src="<?= $file_berkas_bagasi; ?>" style="width:50%;" onclick="previewberkas('<?= $file_berkas_bagasi; ?>',8)">
                        </div>
                        <div class="box-footer">
                            <a href="#" class="btn btn-default pull-left" onclick="step('balik',12)">Sebelumnya</a>
                            <a href="#" class="btn btn-default pull-right" onclick="step('lanjut',14)">Selanjutnya</a>
                        </div>
                    </div>

                    <div id="step-14" class="box box-primary box-solid hide">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Pakta Integritas
                            </h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-12" style="text-align:justify;font-weight:normal;">
                                    Segala hal yang kami sampaikan dan lampirkan dalam laporan ini adalah benar dan kami sepenuhnya memahami bahwa segala bentuk pemalsuan yang berakibat merugikan perusahaan adalah merupakan jenis pelanggaran berat sebagaimana dalam peraturan displin pegawai yang berlaku di PLN (Persero).
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label text-left">
                                    Catatan perubahan SPPD
                                    <code><i>(jika ada)</i></code>
                                </label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="catatan" name="catatan" rows="5" placeholder="Catatan perubahan SPPD (jika ada) ..." style="resize:none;" readonly><?= $catatan; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label text-left">
                                    Atasan
                                </label>
                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" id="kd_atasan" name="kd_atasan" value="<?= $kd_atasan; ?>">
                                    <input type="text" class="form-control" id="atasan" name="atasan" value="<?= $persno_atasan . " - " . $nama_atasan; ?>" maxlength=100 placeholder="Atasan" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer text-center">
                            <a href="#" class="btn btn-default pull-left" onclick="step('balik',13)">Sebelumnya</a>
                            <? if ($approve == 0 && $this->session->userdata('level') != "0" && $this->session->userdata('level') != "2") { ?>
                                <a href="#" class="btn bg-maroon" data-toggle="modal" data-target="#approval" onclick="approval('<?= $trip_no; ?>','<?= base_url(); ?>mobilesppd/approval/1/<?= $kd_sppd; ?>/<?= $trip_no; ?>','<?= base_url(); ?>sppd/approval/2/<?= $kd_sppd; ?>/<?= $trip_no; ?>')">Proses Approve</a>
                            <? } ?>
                            <a href="<?= base_url(); ?>mobilesppd/index/1/<?= $cari; ?>/<?= $kategori; ?>" class="btn btn-primary pull-right">Tutup</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="progress_div" class="progress progress-sm active" style="display:none;">
            <div id="progress_bar" class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 20%"></div>
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
                <iframe id="frame_daftar_pegawai" src="<?= base_url(); ?>mobilesppd/daftar_pegawai" frameborder="0" style="width:100%;height:300px;"></iframe>
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

<div class="modal fade" id="approval" tabindex="-1" role="dialog" aria-labelledby="approvalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approvalLabel">Approval</h5>
            </div>
            <div class="modal-body text-center">
                <p>Approval pelaporan SPPD Pegawai dengan nomor trip <b id="nomor_trip"></b> </p>
                <a id="btn-approved" href="" class="btn btn-success" onclick="return confirm('Menyetujui pelaporan tersebut ?')">Approved</a>
                <a id="btn-rejected" href="" class="btn btn-danger" onclick="return confirm('Menolak pelaporan tersebut ?')">Rejected</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->