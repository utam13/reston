<?
if ($format_laporan == "2") {
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=$file_laporan.xls");
}
?>

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

    <title><?= $judul; ?></title>

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

<body <? if ($format_laporan=="1" ) { ?> onload="window.print()"
    <? } ?>>
    <table>
        <tr>
            <? if ($format_laporan == "1") { ?>
            <td valign="top" style="width:60px;">
                <img src="<?= base_url(); ?>assets/img/icon3.png" style="width:70%;">
            </td>
            <? } ?>
            <td nowrap valign="top" align="left">
                <table style="width:100%;">
                    <tr>
                        <td nowrap style="font-family:times;font-size:10pt;">PT PLN (PERSERO)</td>
                    </tr>
                    <tr>
                        <td nowrap style="font-family:arial;font-size:10pt;">UNIT INDUK WAILAYAH KALTIMRA</td>
                    </tr>
                    <tr>
                        <td nowrap style="font-family:times;font-size:10pt;">UNIT PELAKSANA PENGATUR DISTRIBUSI</td>
                    </tr>
                    <tr>
                        <td nowrap align="center" colspan=3>&nbsp;</td>
                    </tr>
                </table>
            </td>
            <td nowrap valign="top" align="right">
                <table>
                    <tr>
                        <td nowrap colspan=3 style="font-family:times;font-size:10pt;width:20px;"><?= $lampiran; ?></td>
                    </tr>
                    <tr>
                        <td nowrap style="font-family:times;font-size:10pt;width:60px;">Surat No.</td>
                        <td nowrap style="font-family:times;font-size:10pt;width:2px;">:</td>
                        <td nowrap style="font-family:times;font-size:10pt;width:200px;border-bottom:1px solid #000000;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td nowrap style="font-family:times;font-size:10pt;width:60px;">Tanggal</td>
                        <td nowrap style="font-family:times;font-size:10pt;width:2px;">:</td>
                        <td nowrap style="font-family:times;font-size:10pt;width:200px;border-bottom:1px solid #000000;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td nowrap style="font-family:times;font-size:10pt;width:60px;">No. SPP</td>
                        <td nowrap style="font-family:times;font-size:10pt;width:2px;">:</td>
                        <td nowrap style="font-family:times;font-size:10pt;width:200px;border-bottom:1px solid #000000;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan=3>
                <?
                switch ($kelompok) {
                    case 1:
                ?>
                <table class="rekaman">
                    <tr>
                        <th rowspan=2 style="width:20px;">No.</th>
                        <th rowspan=2 style="width:80px">Pers. No</th>
                        <th rowspan=2 style="width:100px">Nama</th>
                        <th rowspan=2 style="width:80px">Trip Number</th>
                        <th colspan=2 nowrap>Tanggal Tiket</th>
                        <th colspan=2 nowrap>Tanggal Penginapan</th>
                        <th rowspan=2 style="width:80px">Struk Pembayaran<br>(Kerdit/Debit)</th>
                        <th rowspan=2 style="width:60px">Bill/Invoice<br>Hotel</th>
                        <th rowspan=2 style="width:60px">Tiket Pesawat/Invoice</th>
                        <th rowspan=2 style="width:60px">Boarding Pass</th>
                        <th rowspan=2 style="width:60px">Lembar SPPD<br>(ttd & cap)</th>
                        <th rowspan=2 style="width:150px">Lampiran</th>
                    </tr>
                    <tr>
                        <th nowrap style="width:80px">Pergi</th>
                        <th nowrap style="width:80px">Pulang</th>
                        <th nowrap style="width:80px">Check In</th>
                        <th nowrap style="width:80px">Check Out</th>
                    </tr>
                    <?
                            $hasil = json_decode($laporan);
                            foreach ($hasil as $l) {
                            ?>
                    <tr>
                        <td align="center" style="font-size:9pt;"><?= $no; ?></td>
                        <td align="center" style="font-size:9pt;background-color:<?= $l->bg_color; ?>"><?= $l->pers_no; ?></td>
                        <td style="font-size:9pt;"><?= $l->nama; ?></td>
                        <td align="center" style="font-size:9pt;"><?= $l->trip_no; ?></td>
                        <td align="center" style="font-size:9pt;"><?= date('d-m-Y', strtotime($l->tgl_berangkat)); ?></td>
                        <td align="center" style="font-size:9pt;"><?= date('d-m-Y', strtotime($l->tgl_pulang)); ?></td>
                        <td align="center" style="font-size:9pt;"><?= date('d-m-Y', strtotime($l->tgl_check_in)); ?></td>
                        <td align="center" style="font-size:9pt;"><?= date('d-m-Y', strtotime($l->tgl_check_out)); ?></td>
                        <td align="center" style="font-size:9pt;"><?= $l->struk; ?></td>
                        <td align="center" style="font-size:9pt;"><?= $l->berkas_penginapan; ?></td>
                        <td align="center" style="font-size:9pt;"><?= $l->berkas_tiket; ?></td>
                        <td align="center" style="font-size:9pt;"><?= $l->berkas_bagasi; ?></td>
                        <td align="center" style="font-size:9pt;"><?= $l->berkas_sppd; ?></td>
                        <td style="font-size:9pt;"><?= $l->lampiran; ?></td>
                    </tr>
                    <? $no++;
                            } ?>
                </table>
                <?
                        break;
                    case 2:
                    ?>
                <table class="rekaman">
                    <tr>
                        <th rowspan=2 style="width:20px;">No.</th>
                        <th rowspan=2 style="width:80px">Pers. No</th>
                        <th rowspan=2 style="width:100px">Nama</th>
                        <th rowspan=2 style="width:80px">Trip Number</th>
                        <th rowspan=2 style="width:100px">Tujuan</th> <!-- dari dan ke -->
                        <th rowspan=2 style="width:150px">Perihal</th> <!-- maksud -->
                        <th colspan=2 nowrap>Tanggal SPPD</th>
                        <th rowspan=2 style="width:80px">Dur</th>
                        <th rowspan=2 style="width:80px">Bid</th>
                        <th rowspan=2 style="width:60px">Business Area</th>
                        <th colspan=3 nowrap>Rek./Kartu Kredit</th>
                        <th colspan=3 nowrap>Biaya</th>
                        <th rowspan=2 style="width:60px">Jumlah Biaya<br>(Rp)</th>
                    </tr>
                    <tr>
                        <th nowrap style="width:80px">Pergi</th>
                        <th nowrap style="width:80px">Pulang</th>
                        <th nowrap style="width:80px">Nomor</th>
                        <th nowrap style="width:80px">Nama</th>
                        <th nowrap style="width:80px">Bank</th>
                        <th nowrap style="width:80px">Tiket</th>
                        <th nowrap style="width:80px">Bagasi</th>
                        <th nowrap style="width:80px">Penginapan</th>
                    </tr>
                    <?
                            $hasil = json_decode($laporan);
                            foreach ($hasil as $l) {
                            ?>
                    <tr>
                        <td align="center" style="font-size:9pt;"><?= $no; ?></td>
                        <td align="center" style="font-size:9pt;background-color:<?= $l->bg_color; ?>"><?= $l->pers_no; ?></td>
                        <td style="font-size:9pt;"><?= $l->nama; ?></td>
                        <td align="center" style="font-size:9pt;"><?= $l->trip_no; ?></td>
                        <td align="center" style="font-size:9pt;"><?= $l->dari . "-" . $l->ke; ?></td>
                        <td style="font-size:9pt;"><?= $l->maksud; ?></td>
                        <td align="center" style="font-size:9pt;"><?= date('d-m-Y', strtotime($l->tgl_berangkat)); ?></td>
                        <td align="center" style="font-size:9pt;"><?= date('d-m-Y', strtotime($l->tgl_pulang)); ?></td>
                        <td align="center" style="font-size:9pt;"><?= $l->durasi; ?></td>
                        <td align="center" style="font-size:9pt;"><?= $l->bidang; ?></td>
                        <td align="center" style="font-size:9pt;"><?= $l->area; ?></td>
                        <td align="center" style="font-size:9pt;"><?= $l->nomor; ?></td>
                        <td align="center" style="font-size:9pt;"><?= $l->nama; ?></td>
                        <td align="center" style="font-size:9pt;"><?= $l->bank; ?></td>
                        <td align="center" style="font-size:9pt;"><?= number_format($l->total_transport, 0, ',', ','); ?></td>
                        <td align="center" style="font-size:9pt;"><?= number_format($l->bagasi, 0, ',', ','); ?></td>
                        <td align="center" style="font-size:9pt;"><?= number_format($l->penginapan, 0, ',', ','); ?></td>
                        <td align="right" style="font-size:9pt;"><?= number_format($l->total, 0, ',', ','); ?>&nbsp;</td>
                    </tr>
                    <? $no++;
                            } ?>
                    <tr>
                        <th colspan=17 align="right">Total:&nbsp;</th>
                        <th align="right"><?= number_format($grandtotal, 0, ',', ','); ?>&nbsp;</th>
                    </tr>
                </table>
                <? break;
                } ?>
            </td>
        </tr>
        <? if ($kelompok == 1) { ?>
        <tr>
            <td align="right" colspan=3><br><br></td>
        </tr>
        <tr>
            <td colspan=2></td>
            <td align="right">
                <table>
                    <tr>
                        <td nowrap align="center" style="width:300px;font-size:11pt;">Balikpapan, ............................................</td>
                    </tr>
                    <tr>
                        <th align="center" style="font-size:11pt;">MANAGER</th>
                    </tr>
                    <tr>
                        <td align="center">
                            <br><br><br><br>
                            ............................................
                        </td>

                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan=3 align="right" style="font-size:10pt;">Paraf</td>
                        <td colspan=3>&nbsp;</td>
                        <td colspan=3 style="width:80px;border-bottom:1px solid #000000;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
        <? } ?>

        <? if ($format_laporan == "1") { ?>
        <tr>
            <td align="right" colspan=3><br><br><br><br></td>
        </tr>
        <tr>
            <td align="right" colspan=3 style="border-top:1px solid #000000;">
                <b style="font-size:7pt;border:1px solid #000000;background-color:white;">Pelaporan Baru</b>
                <b style="font-size:7pt;border:1px solid #000000;background-color:chartreuse;">Pelaporan Approved</b>
                <b style="font-size:7pt;border:1px solid #000000;background-color:tomato;">Pelaporan Rejected</b>
                <b style="font-size:7pt;border:1px solid #000000;background-color:yellow;">Pelaporan Selesai di proses</b>
            </td>
        </tr>
        <? } ?>
    </table>
</body>

</html>