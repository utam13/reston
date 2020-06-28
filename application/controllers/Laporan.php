<?
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('stat_log') == "") {
            redirect(base_url("login"));
        }

        $this->load->model('mod_laporan');
    }

    public function index()
    {
        $kelompok = $this->input->post('kelompok_laporan');
        $status = $this->input->post('status');
        $approval = $this->input->post('approval');
        $dari = $this->input->post('dari');
        $sampai = $this->input->post('sampai');
        $hasil = $this->input->post('hasil');

        $data['kelompok'] = $kelompok;
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;
        $data['format_laporan'] = $hasil;

        if ($status == 0) {
            $query = "a.tgl_pelaporan>='$dari' and a.tgl_pelaporan<='$sampai' and a.selesai='0000-00-00'";
            $orderby = "a.tgl_pelaporan ASC";
        } else {
            $query = "a.selesai>='$dari' and a.selesai<='$sampai'";
            $orderby = "a.selesai ASC";
        }

        if ($approval != "") {
            $query .= " and a.approve='$approval'";
        }

        $laporan = $this->mod_laporan->laporan_sppd($query, $orderby)->result();

        $data['no'] = 1;

        switch ($kelompok) {
            case 1:
                $data['file_laporan'] = "Daftar-Pelaporan-SPPD-" . date('dmYHis');
                $data['judul'] = "Daftar Pelaporan SPPD";
                $data['lampiran'] = "Lampiran 2";

                $record = array();
                $subrecord = array();
                foreach ($laporan as $l) {
                    $subrecord['tgl_pelaporan'] = $l->tgl_pelaporan;
                    $subrecord['kd_pegawai'] = $l->kd_pegawai;
                    /*--------------------------------------*/
                    $pegawai = $this->mod_laporan->ambil_pegawai($l->kd_pegawai)->result();
                    foreach ($pegawai as $p) {
                        $subrecord['pers_no'] = $p->pers_no;
                        $subrecord['nama'] = $p->nama;
                    }
                    $subrecord['trip_no'] = $l->trip_no;
                    $subrecord['tgl_berangkat'] = $l->tgl_berangkat;
                    $subrecord['tgl_pulang'] = $l->tgl_pulang;
                    $subrecord['tgl_check_in'] = $l->tgl_check_in;
                    $subrecord['tgl_check_out'] = $l->tgl_check_out;
                    $subrecord['struk'] = "-";

                    $subrecord['lampiran'] = "";

                    if ($l->berkas_penginapan != "") {
                        $subrecord['berkas_penginapan'] = "&radic;";
                        $subrecord['lampiran'] .= "Bill Hotel, ";
                    } else {
                        $subrecord['berkas_penginapan'] = "-";
                    }

                    if ($l->berkas_pergi != "" || $l->berkas_pulang != "") {
                        $subrecord['berkas_tiket'] = "&radic;";
                        $subrecord['lampiran'] .= "Tiket Pesawat, ";
                    } else {
                        $subrecord['berkas_tiket'] = "-";
                    }

                    if ($l->berkas_bagasi != "") {
                        $subrecord['berkas_bagasi'] = "&radic;";
                        $subrecord['lampiran'] .= "Boarding Pass, ";
                    } else {
                        $subrecord['berkas_bagasi'] = "-";
                    }

                    if ($l->berkas1 != "" || $l->berkas2 != "" || $l->berkas3 != "") {
                        $subrecord['berkas_sppd'] = "&radic;";
                        $subrecord['lampiran'] .= "Lembar SPPD";
                    } else {
                        $subrecord['berkas_sppd'] = "-";
                    }

                    switch ($l->approve) {
                        case 0:
                            $subrecord['bg_color'] = "white";
                            break;
                        case 1:
                            $subrecord['bg_color'] = "chartreuse";
                            break;
                        case 2:
                            $subrecord['bg_color'] = "tomato";
                            break;
                    }

                    if ($l->selesai != "0000-00-00") {
                        $subrecord['bg_color'] = "yellow";
                    }

                    array_push($record, $subrecord);
                }

                $data['laporan'] = json_encode($record);

                $this->load->view('backend/laporan', $data);
                break;
            case 2:
                $data['file_laporan'] = "Daftar-Pengeluaran-SPPD-" . date('dmYHis');
                $data['judul'] = "Daftar Pengeluaran SPPD";
                $data['lampiran'] = "Lampiran 1";

                $grandtotal = 0;

                $record = array();
                $subrecord = array();
                foreach ($laporan as $l) {
                    $subrecord['tgl_pelaporan'] = $l->tgl_pelaporan;
                    $subrecord['kd_pegawai'] = $l->kd_pegawai;
                    /*--------------------------------------*/
                    $pegawai = $this->mod_laporan->ambil_pegawai($l->kd_pegawai)->result();
                    foreach ($pegawai as $p) {
                        $subrecord['pers_no'] = $p->pers_no;
                        $subrecord['nama'] = $p->nama;
                        $subrecord['bidang'] = $p->bidang;
                        $subrecord['area'] = $p->area;
                        $subrecord['nomor'] = "-";
                        $subrecord['bank'] = "-";
                    }
                    $subrecord['trip_no'] = $l->trip_no;
                    $subrecord['dari'] = $l->dari;
                    $subrecord['ke'] = $l->ke;
                    $subrecord['maksud'] = $l->maksud;
                    $subrecord['tgl_berangkat'] = $l->tgl_berangkat;
                    $subrecord['tgl_pulang'] = $l->tgl_pulang;
                    $subrecord['durasi'] = $l->durasi;
                    $subrecord['transport_pergi'] = $l->transport_pergi;
                    $subrecord['transport_pulang'] = $l->transport_pulang;
                    $subrecord['total_transport'] = $l->transport_pergi + $l->transport_pulang;
                    $subrecord['bagasi'] = $l->bagasi;
                    $subrecord['penginapan'] = $l->penginapan;
                    $subrecord['total'] = $l->transport_pergi + $l->transport_pulang + $l->bagasi + $l->penginapan;

                    switch ($l->approve) {
                        case 0:
                            $subrecord['bg_color'] = "white";
                            break;
                        case 1:
                            $subrecord['bg_color'] = "chartreuse";
                            break;
                        case 2:
                            $subrecord['bg_color'] = "tomato";
                            break;
                    }

                    if ($l->selesai != "0000-00-00") {
                        $subrecord['bg_color'] = "yellow";
                    }

                    $grandtotal +=  $subrecord['total'];
                    array_push($record, $subrecord);
                }

                $data['laporan'] = json_encode($record);

                $data['grandtotal'] = $grandtotal;

                $this->load->view('backend/laporan', $data);
                break;
            case 3:
                $this->load->library('zip');

                $count = 0;
                foreach ($laporan as $l) {
                    $tgl_pelaporan = date('d-m-Y', strtotime($l->tgl_pelaporan));
                    $trip_no = $l->trip_no;

                    $pers_no = "";
                    $nama = "";
                    $pegawai = $this->mod_laporan->ambil_pegawai($l->kd_pegawai)->result();
                    foreach ($pegawai as $p) {
                        $pers_no = $p->pers_no;
                        $nama = $p->nama;
                    }

                    $folder_zip =  $tgl_pelaporan . "_" . $trip_no . "_" . $pers_no . "_" . $nama;

                    $laporan_pdf = $l->kd_sppd . ".pdf";
                    if (file_exists($laporan_pdf)) {
                        $fileName = $l->kd_sppd . ".pdf";
                        $fileName2 = $folder_zip . "/" . $l->kd_sppd . ".pdf";

                        $this->zip->read_file($fileName, $fileName2);

                        $count++;
                    }

                    if ($l->berkas1 != "") {
                        $berkas1 = "upload/pelaporan/" . $l->berkas1;
                        if (file_exists($berkas1)) {
                            $fileName = "upload/pelaporan/" . $l->berkas1;
                            $fileName2 = $folder_zip . "/" . $l->berkas1;

                            $this->zip->read_file($fileName, $fileName2);

                            $count++;
                        }
                    }

                    if ($l->berkas2 != "") {
                        $berkas2 = "upload/pelaporan/" . $l->berkas2;
                        if (file_exists($berkas2)) {
                            $fileName = "upload/pelaporan/" . $l->berkas2;
                            $fileName2 = $folder_zip . "/" . $l->berkas2;

                            $this->zip->read_file($fileName, $fileName2);

                            $count++;
                        }
                    }

                    if ($l->berkas3 != "") {
                        $berkas3 = "upload/pelaporan/" . $l->berkas3;
                        if (file_exists($berkas3)) {
                            $fileName = "upload/pelaporan/" . $l->berkas3;
                            $fileName2 = $folder_zip . "/" . $l->berkas3;

                            $this->zip->read_file($fileName, $fileName2);

                            $count++;
                        }
                    }

                    if ($l->berkas_lap != "") {
                        $berkas_lap = "upload/pelaporan/" . $l->berkas_lap;
                        if (file_exists($berkas_lap)) {
                            $fileName = "upload/pelaporan/" . $l->berkas_lap;
                            $fileName2 = $folder_zip . "/" . $l->berkas_lap;

                            $this->zip->read_file($fileName, $fileName2);

                            $count++;
                        }
                    }

                    if ($l->berkas_pergi != "") {
                        $berkas_pergi = "upload/bukti/" . $l->berkas_pergi;
                        if (file_exists($berkas_pergi)) {
                            $fileName = "upload/bukti/" . $l->berkas_pergi;
                            $fileName2 = $folder_zip . "/" . $l->berkas_pergi;

                            $this->zip->read_file($fileName, $fileName2);

                            $count++;
                        }
                    }

                    if ($l->berkas_pulang != "") {
                        $berkas_pulang = "upload/bukti/" . $l->berkas_pulang;
                        if (file_exists($berkas_pulang)) {
                            $fileName = "upload/bukti/" . $l->berkas_pulang;
                            $fileName2 = $folder_zip . "/" . $l->berkas_pulang;

                            $this->zip->read_file($fileName, $fileName2);

                            $count++;
                        }
                    }

                    if ($l->berkas_penginapan != "") {
                        $berkas_penginapan = "upload/bukti/" . $l->berkas_penginapan;
                        if (file_exists($berkas_penginapan)) {
                            $fileName = "upload/bukti/" . $l->berkas_penginapan;
                            $fileName2 = $folder_zip . "/" . $l->berkas_penginapan;

                            $this->zip->read_file($fileName, $fileName2);

                            $count++;
                        }
                    }

                    if ($l->berkas_bagasi != "") {
                        $berkas_bagasi = "upload/bukti/" . $l->berkas_bagasi;
                        if (file_exists($berkas_bagasi)) {
                            $fileName = "upload/bukti/" . $l->berkas_bagasi;
                            $fileName2 = $folder_zip . "/" . $l->berkas_bagasi;

                            $this->zip->read_file($fileName, $fileName2);

                            $count++;
                        }
                    }
                }

                if ($count > 0) {
                    $filename = "Lampiran_Restitusi_" . date('d-m-Y', strtotime($dari)) . "_sd_" . date('d-m-Y', strtotime($sampai)) . ".zip";
                    $this->zip->download($filename);
                } else {
                    $pesan = 3;
                    $isipesan = "Tidak ada file lampiran yang dapat di download";

                    redirect("sppd/index/1/-/-/$pesan/$isipesan");
                }
                break;
        }
    }
}
