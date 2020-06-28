<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control" content="max-age=1" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="1" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1900 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />

    <title>LAPORAN PERJALANAN DINAS DAN PERMOHONAN RESTITUSI</title>

    <link href="<?= base_url(); ?>assets/images/pln.png" rel="shortcut icon" type="image/x-icon" />

    <style>
        .rekaman {
            border-collapse: collapse;
            font-family: time;
            font-size: 10pt;
            width: 100%
        }

        .rekaman th,
        .rekaman td {
            border: 1px solid #000000;
        }
    </style>
</head>

<body onload="window.print()">
    <table style="width:800px;">
        <tr>
            <td colspan=5>
                PT. PLN (PERSERO)
                <br>
                WILAYAH KALIMANTAN TIMUR DAN KALIMANTAN UTARA
            </td>
        </tr>
        <tr>
            <td colspan=5>&nbsp;</td>
        </tr>
        <tr>
            <td colspan=5 align="center">
                <h4 style="font-weight:bold;">LAPORAN PERJALANAN DINAS DAN PERMOHONAN RESTITUSI</h4>
            </td>
        </tr>
        <tr>
            <td colspan=5>&nbsp;</td>
        </tr>
        <tr>
            <th align="left" style="width:20px;">I.</th>
            <th align="left" colspan=5>Data Pegawai</th>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td style="width:20px;">a.</td>
            <td style="width:180px;">Nama</td>
            <td style="width:5px;">:</td>
            <td id="table_nama"><?= $nama; ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>b.</td>
            <td>Nomor Induk</td>
            <td>:</td>
            <td align="left" id="table_persno"><?= $nama; ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>c.</td>
            <td>Jabatan</td>
            <td>:</td>
            <td align="left" id="table_jabatan"><?= $jabatan; ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>d.</td>
            <td>Unit Organisasi</td>
            <td>:</td>
            <td align="left" id="table_unit"><?= $unit; ?></td>
        </tr>
        <tr>
            <td colspan=5>&nbsp;</tdc>
        </tr>
        <tr>
            <th align="left">II.</th>
            <th align="left" colspan=5>Surat Perintah Perjalanan Dinas</th>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>a.</td>
            <td>Nomor Trip</td>
            <td>:</td>
            <td align="left" id="table_trip_no"><?= $trip_no; ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>b.</td>
            <td>Tempat Berangkat</td>
            <td>:</td>
            <td align="left" id="table_dari"><?= $dari; ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>c.</td>
            <td>Tempat Tujuan</td>
            <td>:</td>
            <td align="left" id="table_ke"><?= $ke; ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>d.</td>
            <td>Tanggal Berangkat</td>
            <td>:</td>
            <td align="left" id="table_tgl_berangkat"><?= date('d-m-Y', strtotime($tgl_berangkat)); ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>e.</td>
            <td>Tanggal Kembali</td>
            <td>:</td>
            <td align="left" id="table_tgl_pulang"><?= date('d-m-Y', strtotime($tgl_pulang)); ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>f.</td>
            <td>Maksud Perjalanan Dinas</td>
            <td>:</td>
            <td align="left" id="table_maksud"><?= $maksud; ?></td>
        </tr>
        <tr>
            <td colspan=5>&nbsp;</tdc>
        </tr>
        <tr>
            <th align="left">III.</th>
            <th align="left" colspan=5>Laporan Singkat Pelaksanaan Perjalanan Dinas</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td align="left" colspan=5 id="table_lap_singkat"><?= $isilap; ?></td>
        </tr>
        <tr>
            <td colspan=5>&nbsp;</tdc>
        </tr>
        <tr>
            <th align="left">IV.</th>
            <th align="left" colspan=5>Biaya</th>
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
                            <td rowspan=4 valign="top" style="border:1px solid #000000;">
                                <ul>
                                    <? if ($berkas_sppd == 1) { ?>
                                        <li>Formulir SPPD yang telah disetujui oleh Pejabat berwenang di Unit Penerima&nbsp;</li>
                                    <? } ?>

                                    <? if ($berkas_tiket == 1) { ?>
                                        <li>Invoice Pembelian Tiket Pesawat&nbsp;</li>
                                    <? } ?>

                                    <? if ($berkas_bagasi == 1) { ?>
                                        <li>Boarding Pass&nbsp;</li>
                                    <? } ?>

                                    <? if ($berkas_penginapan == 1) { ?>
                                        <li>Invoice/Bill Penginapan&nbsp;</li>
                                    <? } ?>
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
            <th align="left">IV.</th>
            <th align="left" colspan=5>PAKTA INTEGRITAS</th>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td colspan=4>
                Segala hal yang kami sampaikan dan lampirkan dalam laporan ini adalah benar dan kami sepenuhnya memahami bahwa segala bentuk pemalsuan yang berakibat merugikan perusahaan adalah merupakan jenis pelanggaran berat sebagaimana dalam peraturan displin pegawai yang berlaku di PLN (Persero).
            </td>
        </tr>
        <tr>
            <td colspan=5>&nbsp;</tdc>
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
            <? if ($kd_atasan != 0) { ?>
                <td align="center" colspan=2>
                    Mengetahui,
                    <br>
                    Atasan
                    <br>
                    <img id="ttd_atasan" src="<?= $ttd_atasan; ?>" style="width:100px;">
                    <br>
                    <b id="ttd_nama_atasan"><?= $nama_atasan; ?></b>
                </td>
            <? } else { ?>
                <td colspan=2>&nbsp;</td>
            <? } ?>
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
</body>

</html>