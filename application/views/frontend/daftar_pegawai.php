<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control" content="max-age=1" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="1" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1900 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />

    <title>Daftar Pegawai</title>
    <link href="<?= base_url(); ?>assets/img/icon.png" rel="shortcut icon" type="image/x-icon" />

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- bootstrap 3.3.2 -->
    <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- font Awesome -->
    <link href="<?= base_url(); ?>assets/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- DATA TABLES -->
    <link href="<?= base_url(); ?>assets/js/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Theme style -->
    <link href="<?= base_url(); ?>assets/css/AdminLTE.min.css" rel="stylesheet">

    <!-- AdminLTE Skins. Choose a skin from the css/skins -->
    <link href="<?= base_url(); ?>assets/css/skins/skin-blue.min.css" rel="stylesheet">

    <style>
        table {
            font-size: 9pt;
        }
    </style>
</head>

<body class="hold-transition skin-blue layout-top-nav">
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <form class="form-horizontal" method="post" action="<?= base_url(); ?>sppd/daftar_pegawai" method="post" onsubmit="showloading()">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="input-group input-group-sm">
                                            <input type="hidden" id="kelompok" id="kelompok" value="<?= $kelompok; ?>" />
                                            <input type="text" class="form-control" name="cari" required autocomplete="off" value="" placeholder="Pers. No atau Nama Pegawai" />
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-success btn-sm">Cari</button>
                                                <a href="<?= base_url(); ?>sppd/daftar_pegawai" class="btn btn-info btn-sm" onclick="showloading()">Segarkan</a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="box-body table-responsive">
                            <table class="table table-bordered table-striped" id="mytable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Unit Organisasi</th>
                                        <th>Bidang</th>
                                        <th>Business Area</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                    $data_pegawai = json_decode($pegawai);
                                    foreach ($data_pegawai as $dp) {
                                    ?>
                                        <tr onclick="pilih('<?= $dp->kd_pegawai; ?>','<?= $dp->pers_no; ?>','<?= $dp->email; ?>','<?= $dp->nama; ?>','<?= $dp->jabatan; ?>','<?= $dp->unit; ?>','<?= $dp->bidang; ?>','<?= $dp->area; ?>','<?= $dp->file_foto; ?>','<?= $dp->file_ttd; ?>')">
                                            <td><?= $no; ?></td>
                                            <td><?= $dp->pers_no; ?></td>
                                            <td><?= $dp->nama; ?></td>
                                            <td><?= $dp->jabatan; ?></td>
                                            <td><?= $dp->unit; ?></td>
                                            <td><?= $dp->bidang; ?></td>
                                            <td><?= $dp->area; ?></td>
                                        </tr>
                                    <? $no++;
                                    } ?>
                                </tbody>
                            </table>
                            <? if ($jumlah_page > 0) { ?>
                                <ul class="pagination" style="float:right;">
                                    <? if ($page == 1) { ?>
                                        <li class="disabled"><a href="#"><span class="fa fa-fast-backward"></a></li>
                                        <li class="disabled"><a href="#"><span class="fa fa-step-backward"></a></li>
                                    <? } else {
                                        $link_prev = ($page > 1) ? $page - 1 : 1; ?>
                                        <li><a href="<?= base_url(); ?>sppd/daftar_pegawai/1/<?= $cari; ?>"><span class="fa fa-fast-backward"></a></li>
                                        <li><a href="<?= base_url(); ?>sppd/daftar_pegawai/<?= $link_prev; ?>/<?= $cari; ?>"><span class="fa fa-step-backward"></a></li>
                                    <?
                                    }

                                    for ($i = $start_number; $i <= $end_number; $i++) {
                                        if ($page == $i) {
                                            $link_active = "";
                                            $link_color = "class='disabled'";
                                        } else {
                                            $link_active = base_url() . "sppd/daftar_pegawai/" . $i . "/" . $cari;
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
                                        <li><a href="<?= base_url(); ?>sppd/daftar_pegawai/<?= $link_next; ?>/<?= $cari; ?>"><span class="fa fa-step-forward"></a></li>
                                        <li><a href="<?= base_url(); ?>sppd/daftar_pegawai/<?= $jumlah_page; ?>/<?= $cari; ?>"><span class="fa fa-fast-forward"></a></li>
                                    <? } ?>
                                </ul>
                            <? } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- jQuery 2.1.4 -->
    <script src="<?= base_url(); ?>assets/js/plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>

    <!-- DATA TABLES SCRIPT -->
    <script src="<?= base_url(); ?>assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/datatables/dataTables.bootstrap.js"></script>
    <script src="<?= base_url(); ?>assets/js/datatables.custom.js"></script>

    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>assets/js/AdminLTE/app.min.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url(); ?>assets/js/AdminLTE/demo.js"></script>


    <!-- Call modal window parent -->
    <script>
        function pilih(kode, pers_no, email, nama, jabatan, unit, bidang, area, foto, ttd) {
            var kelompok = $("#kelompok").val();

            window.parent.$('#kd_atasan').val(kode);
            window.parent.$('#atasan').val(pers_no + " - " + nama);

            window.parent.$('#ttd_atasan').attr("src", ttd);
            window.parent.$('#ttd_nama_atasan').html(nama);

            window.parent.$("#daftar-pegawai").modal("hide");
        }
    </script>
</body>

</html>