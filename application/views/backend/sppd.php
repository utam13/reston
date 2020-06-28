<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class='content-header'>
        <h1>Pelaporan Perjalanan Dinas dan Permohonan Restitusi</h1>
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
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <!--
                        <h3 align class="box-title">
                            <a href="<? //= base_url(); 
                                        ?>sppd/formulir/1" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Pelaporan Baru</a>
                        </h3>
                        -->

                        <div style="float:right;margin-top:-10px;">
                            <form class="form-inline" method="post" action="<?= base_url(); ?>sppd" method="post" style="float:right;" onsubmit="showloading()">
                                <div class="form-group">
                                    <label>Pencarian dengan:</label>
                                    <div class="input-group margin">
                                        <div class="input-group-btn">
                                            <a href="<?= base_url(); ?>sppd" class="btn btn-info btn-sm" onclick="showloading()"><i class="fa fa-refresh"></i></a>
                                        </div>
                                        <select class="form-control input-sm" name="kategori" id="kategori_lap_sppd">
                                            <option value="b.pers_no">Pers. No</option>
                                            <option value="b.nama">Nama</option>
                                            <option value="a.dari">Tempat Berangkat</option>
                                            <option value="a.ke">Tempat Tujuan</option>
                                            <option value="a.tgl_berangkat">Tanggal Berangkat</option>
                                            <option value="a.tgl_pulang">Tanggal Pulang</option>
                                            <option value="a.maksud">Maksud Perjalanan Dinas</option>
                                            <option value="a.approve">Status Approval</option>
                                            <option value="a.selesai">Status Proses</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group margin">
                                        <input type="text" class="form-control input-sm" name="cari" id="cari" required autocomplete="off" value="" />
                                        <select class="form-control input-sm" name="cari_approval" id="cari_approval" style="display:none;">
                                            <option value="0">Baru</option>
                                            <option value="1">Approved</option>
                                            <option value="2">Rejected</option>
                                        </select>
                                        <select class="form-control input-sm" name="cari_proses" id="cari_proses" style="display:none;">
                                            <option value="0">Belum Selesai</option>
                                            <option value="1">Sudah Selesai</option>
                                        </select>
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn bg-olive btn-sm"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped" id="mytable">
                            <thead>
                                <tr>
                                    <th width="10px">No</th>
                                    <th nowrap>Tgl. Pelaporan</th>
                                    <th nowrap>Trip Number</th>
                                    <th nowrap>Pers. No</th>
                                    <th nowrap>Nama</th>
                                    <th nowrap>Tempat Berangkat</th>
                                    <th nowrap>Tempat Tujuan</th>
                                    <th nowrap>Tgl. Berangkat</th>
                                    <th nowrap>Tgl. Pulang</th>
                                    <th nowrap>Durasi</th>
                                    <th nowrap>Maksud Perjalanan Dinas</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?
                                $hasil = json_decode($sppd);
                                foreach ($hasil as $s) {
                                ?>
                                <tr>
                                    <td align="center"><?= $no; ?></td>
                                    <td nowrap align="center"><?= date('d-m-Y', strtotime($s->tgl_pelaporan)); ?></td>
                                    <td nowrap align="center"><?= $s->trip_no; ?></td>
                                    <td nowrap><?= $s->pers_no; ?></td>
                                    <td nowrap><?= $s->nama; ?></td>
                                    <td nowrap><?= $s->dari; ?></td>
                                    <td nowrap><?= $s->ke; ?></td>
                                    <td nowrap align="center"><?= date('d-m-Y', strtotime($s->tgl_berangkat)); ?></td>
                                    <td nowrap align="center"><?= date('d-m-Y', strtotime($s->tgl_pulang)); ?></td>
                                    <td nowrap><?= $s->durasi; ?> hari</td>
                                    <td nowrap><?= $s->maksud; ?></td>
                                    <td nowrap>
                                        <a href="<?= base_url(); ?>sppd/cetak/<?= $s->kd_sppd; ?>" target="_blank" class="btn btn-default btn-xs"><i class="fa fa-print"></i></a>
                                        <a href="<?= base_url(); ?>sppd/detail/<?= $s->kd_sppd; ?>" class="btn btn-info btn-xs">Detail</a>
                                        <? if ($s->selesai == "Proses") { ?>
                                        <? if ($s->approve == 0) { ?>
                                        <? if ($this->session->userdata('level') != "0" && $this->session->userdata('level') != "2") { ?>
                                        <a href="#" class="btn <?= $s->btn_approve; ?> btn-xs" data-toggle="modal" data-target="#approval" onclick="approval('<?= $s->trip_no; ?>','<?= base_url(); ?>sppd/approval/1/<?= $s->kd_sppd; ?>/<?= $s->trip_no; ?>/<?= $s->kd_pegawai; ?>/<?= $s->email; ?>','<?= base_url(); ?>sppd/approval/2/<?= $s->kd_sppd; ?>/<?= $s->trip_no; ?>/<?= $s->kd_pegawai; ?>/<?= $s->email; ?>')">Menunggu...</a>
                                        <? } else { ?>
                                        <a href="#" class="btn <?= $s->btn_approve; ?> btn-xs">Menunggu...</a>
                                        <? } ?>

                                        <a href="<?= base_url(); ?>sppd/formulir/2/<?= $s->kd_sppd; ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                        <a href="<?= base_url(); ?>sppd/proses/3/<?= $s->kd_sppd; ?>/<?= $s->trip_no; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Menghapus data pelaporan SPPD dengan nomor trip <?= $s->trip_no; ?> beserta seluruh informasi di dalamnya ?')"><i class="fa fa-trash"></i></a>
                                        <? } else { ?>
                                        <? if ($this->session->userdata('level') != "0" && $this->session->userdata('level') != "2") { ?>
                                        <a href="<?= base_url(); ?>sppd/approval/0/<?= $s->kd_sppd; ?>/<?= $s->trip_no; ?>/<?= $s->kd_pegawai; ?>/<?= $s->email; ?>" class="btn <?= $s->btn_approve; ?> btn-xs" onclick="return confirm('Reset approval untuk nomor trip <?= $s->trip_no; ?> ?')"><?= $s->status_approve; ?></a>
                                        <? } else { ?>
                                        <a href="#" class="btn <?= $s->btn_approve; ?> btn-xs"><?= $s->status_approve; ?></a>
                                        <? } ?>

                                        <? if ($this->session->userdata('level') != "0" && $s->approve != "2") { ?>
                                        <a href="<?= base_url(); ?>sppd/selesai/1/<?= $s->kd_sppd; ?>/<?= $s->trip_no; ?>/<?= $s->kd_pegawai; ?>/<?= $s->email; ?>" class="btn <?= $s->btn_selesai; ?> btn-xs" onclick="return confirm('Pelaporan SPPD dengan nomor trip <?= $s->trip_no; ?> selesai di proses ?')"><?= $s->selesai; ?></a>
                                        <? } else { ?>
                                        <a href="#" class="btn <?= $s->btn_selesai; ?> btn-xs">
                                            <?
                                                            if ($s->selesai == "Selesai") {
                                                                echo "Proses";
                                                            } else {
                                                                echo $s->selesai;
                                                            }
                                                            ?>
                                        </a>
                                        <? } ?>
                                        <? } ?>
                                        <? } else { ?>
                                        <a href="<?= base_url(); ?>sppd/selesai/<?= $s->status_proses; ?>/<?= $s->kd_sppd; ?>/<?= $s->trip_no; ?>/<?= $s->kd_pegawai; ?>/<?= $s->email; ?>" class="btn <?= $s->btn_selesai; ?> btn-xs" onclick="return confirm('Pelaporan SPPD dengan nomor trip <?= $s->trip_no; ?> batal proses ?')"><?= $s->selesai; ?></a>
                                        <? } ?>
                                    </td>
                                </tr>
                                <? $no++;
                                } ?>
                            </tbody>

                        </table>
                    </div>
                    <div class="box-footer with-border">
                        <? if ($jumlah_page > 0) { ?>
                        <ul class="pagination" style="float:right;">
                            <? if ($page == 1) { ?>
                            <li class="disabled"><a href="#"><span class="fa fa-fast-backward"></a></li>
                            <li class="disabled"><a href="#"><span class="fa fa-step-backward"></a></li>
                            <? } else {
                                    $link_prev = ($page > 1) ? $page - 1 : 1; ?>
                            <li><a href="<?= base_url(); ?>sppd/index/1/<?= $cari; ?>/<?= $kategori; ?>"><span class="fa fa-fast-backward"></a></li>
                            <li><a href="<?= base_url(); ?>sppd/index/<?= $link_prev; ?>/<?= $cari; ?>/<?= $kategori; ?>"><span class="fa fa-step-backward"></a></li>
                            <?
                                }

                                for ($i = $start_number; $i <= $end_number; $i++) {
                                    if ($page == $i) {
                                        $link_active = "";
                                        $link_color = "class='disabled'";
                                    } else {
                                        $link_active = base_url() . "sppd/index/$i/$cari/$kategori";
                                        $link_color = "";
                                    }
                                ?>
                            <li <?= $link_color; ?>><a href="<?= $link_active; ?>"><?= $i; ?></a></li>
                            <? }

                                if ($page == $jumlah_page) {
                                ?>
                            <li class="disabled"><a href="#"><span class="fa fa-step-forward"></a></li>
                            <li class="disabled"><a href="#"><span class="fa fa-fast-forward"></a></li>
                            <? } else {
                                    $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page; ?>
                            <li><a href="<?= base_url(); ?>sppd/index/<?= $link_next; ?>/<?= $cari; ?>/<?= $kategori; ?>"><span class="fa fa-step-forward"></a></li>
                            <li><a href="<?= base_url(); ?>sppd/index/<?= $jumlah_page; ?>/<?= $cari; ?>/<?= $kategori; ?>"><span class="fa fa-fast-forward"></a></li>
                            <? } ?>
                        </ul>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->

<!-- Modal -->
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