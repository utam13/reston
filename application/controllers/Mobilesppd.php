<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mobilesppd extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('stat_log_mobile') == "") {
            redirect(base_url("mobilelogin"));
        }

        $this->load->model('mod_sppd');
    }

    public function index($page = 1, $isicari = "-", $katcari = "-", $pesan = "", $isipesan = "")
    {
        //cari
        if ($isicari != "-") {
            $cari = str_replace("%20", " ", $isicari);
            $kategori = $katcari;
        } else {
            $kategori = $this->input->post('kategori');
            switch ($kategori) {
                case "a.approve":
                    $cari =  $this->input->post('cari_approval');
                    break;
                case "a.selesai":
                    $cari =  $this->input->post('cari_proses');
                    break;
                default:
                    $cari =  $this->clear_string->clear_quotes($this->input->post('cari'));
                    break;
            }
        }

        //if ($this->session->userdata('level') == "0" || $this->session->userdata('level') == "3") {
        $hanya_pegawai = " and a.kd_pegawai='" . $this->session->userdata('kode_user') . "'";
        //} else {
        //$hanya_pegawai = "";
        //}

        switch ($kategori) {
            case "butuh_approve":
                $q_cari = "a.approve='0' and a.kd_atasan='" . $this->session->userdata('kode_user') . "'";
                break;
            case "a.approve":
                $q_cari = "$kategori='$cari'" . $hanya_pegawai;
                break;
            case "a.selesai":
                if ($cari == 1) {
                    $q_cari = "$kategori<>'0000-00-00'" . $hanya_pegawai;
                } else {
                    $q_cari = "$kategori='0000-00-00'" . $hanya_pegawai;
                }
                break;
            default:
                if ($cari != "") {
                    $q_cari = "$kategori like '%$cari%'" . $hanya_pegawai;
                } else {
                    $q_cari = "a.kd_sppd<>''" . $hanya_pegawai;
                }
                break;
        }

        $data['cari'] =  $cari;
        $data['kategori'] =  $kategori;
        $data['q_cari'] =  $q_cari;

        $data['alert'] = $this->alert_lib->alert($pesan, $isipesan);

        //pagination
        $jumlah_data = $this->mod_sppd->jumlah_data($q_cari);

        if ($this->input->post('limitpage') == "") {
            $limit = 10;
            $limit_start = ($page - 1) * 10;
        } else {
            $limit = $this->input->post('limitpage');
            $limit_start = ($page - 1) * $limit;
        }

        $data['limit'] = $limit;

        $sppd = $this->mod_sppd->daftar($limit_start, $limit, $q_cari)->result();

        $record = array();
        $subrecord = array();
        foreach ($sppd as $s) {
            $subrecord['kd_sppd'] = $s->kd_sppd;
            $subrecord['tgl_pelaporan'] = $s->tgl_pelaporan;
            $subrecord['kd_pegawai'] = $s->kd_pegawai;
            $subrecord['trip_no'] = $s->trip_no;
            $subrecord['dari'] = $s->dari;
            $subrecord['ke'] = $s->ke;
            $subrecord['tgl_berangkat'] = $s->tgl_berangkat;
            $subrecord['tgl_pulang'] = $s->tgl_pulang;
            $subrecord['durasi'] = $s->durasi;
            $subrecord['maksud'] = $s->maksud;
            $subrecord['isi_laporan'] = $s->isi_laporan;
            $subrecord['catatan_ubah'] = $s->catatan_ubah;
            $subrecord['kd_atasan'] = $s->kd_atasan;
            $subrecord['approve'] = $s->approve;

            if ($s->selesai == "0000-00-00") {
                $subrecord['selesai'] = "Proses";
                $subrecord['status_proses'] = 1;
                $subrecord['btn_selesai'] = "btn-danger";
            } else {
                $subrecord['selesai'] = "Selesai: " . date('d-m-Y', strtotime($s->selesai));
                $subrecord['status_proses'] = 0;
                $subrecord['btn_selesai'] = "btn-success";
            }

            switch ($s->approve) {
                case "0":
                    $subrecord['status_approve'] = "Waiting...";
                    $subrecord['btn_pesan_approve'] = "Approval pelaporan SPPD";
                    $subrecord['btn_approve'] = "btn-default";
                    break;
                case "1":
                    $subrecord['status_approve'] = "Approved";
                    $subrecord['btn_pesan_approve'] = "Tolak pelaporan SPPD";
                    $subrecord['btn_approve'] = "btn-success";
                    break;
                case "2":
                    $subrecord['status_approve'] = "Rejected";
                    $subrecord['btn_pesan_approve'] = "Approval pelaporan SPPD";
                    $subrecord['btn_approve'] = "btn-danger";
                    break;
            }

            $pegawai = $this->mod_sppd->ambil_pegawai($s->kd_pegawai)->result();
            foreach ($pegawai as $p) {
                $subrecord['pers_no'] = $p->pers_no;
                $subrecord['nama'] = $p->nama;
                $subrecord['email'] = $p->email;
            }

            array_push($record, $subrecord);
        }
        $data['sppd'] = json_encode($record);

        $data['page'] = $page;
        $data['limit'] = $limit;
        $data['get_jumlah'] = $jumlah_data;
        $data['jumlah_page'] = ceil($jumlah_data / $limit);
        $data['jumlah_number'] = 2;
        $data['start_number'] = ($page > $data['jumlah_number']) ? $page - $data['jumlah_number'] : 1;
        $data['end_number'] = ($page < ($data['jumlah_page'] - $data['jumlah_number'])) ? $page + $data['jumlah_number'] : $data['jumlah_page'];

        $data['no'] = $limit_start + 1;
        //end

        //save log
        $this->log_lib->log_info("Akses halaman pelaporan sppd");

        $this->load->view('body/mobile_body_atas');
        $this->load->view('frontend/sppd', $data);
        $this->load->view('body/mobile_body_bawah');
    }

    public function formulir($proses, $kode = "")
    {
        $data['proses'] = $proses;

        switch ($proses) {
            case "1":
                $data['kd_sppd'] = "PSPPD-" . date('yHmids');
                $data['tgl_pelaporan'] = date('Y-m-d');
                $data['approve'] = 0;

                //data pegawai
                if ($this->session->userdata('level') != 0 && $this->session->userdata('level') != "3") {
                    $data['kd_pegawai'] = "";
                    $data['pers_no'] = "";
                    $data['email'] = "";
                    $data['nama'] = "";
                    $data['jabatan'] = "";
                    $data['unit'] = "";
                    $data['bidang'] = "";
                    $data['area'] = "";
                    $data['file_foto'] = base_url() . "upload/no-pic.jpg" . "?" . rand();
                    $data['file_ttd'] = base_url() . "upload/no-image.png" . "?" . rand();
                    $data['ttd_pegawai'] = base_url() . "upload/no-bg.png" . "?" . rand();
                } else {
                    $data['kd_pegawai'] = $this->session->userdata('kode_user');
                    $pegawai = $this->mod_sppd->ambil_pegawai($data['kd_pegawai'])->result();
                    foreach ($pegawai as $p) {
                        $data['pers_no'] = $p->pers_no;
                        $data['email'] = $p->email;
                        $data['nama'] = $p->nama;
                        $data['jabatan'] = $p->jabatan;
                        $data['unit'] = $p->unit;
                        $data['bidang'] = $p->bidang;
                        $data['area'] = $p->area;

                        if ($p->foto != "") {
                            $foto_pegawai = "upload/pegawai/" . $p->foto;
                            if (file_exists($foto_pegawai)) {
                                $data['file_foto'] = base_url() . "upload/pegawai/" . $p->foto . "?" . rand();
                            } else {
                                $data['file_foto'] = base_url() . "upload/no-pic.jpg" . "?" . rand();
                            }
                        } else {
                            $data['file_foto'] = base_url() . "upload/no-pic.jpg" . "?" . rand();
                        }

                        if ($p->ttd != "" && substr_count($p->ttd, "data:image/png;base64") == 0) {
                            $ttd_pegawai = "upload/pegawai/" . $p->ttd;
                            if (file_exists($ttd_pegawai)) {
                                $data['file_ttd'] = base_url() . "upload/pegawai/" . $p->ttd . "?" . rand();
                                $data['ttd_pegawai'] = base_url() . "upload/pegawai/" . $p->ttd . "?" . rand();
                            } else {
                                $data['file_ttd'] = base_url() . "upload/no-image.png" . "?" . rand();
                                $data['ttd_pegawai'] = base_url() . "upload/no-bg.png" . "?" . rand();
                            }
                        } elseif (substr_count($p->ttd, "data:image/png;base64") > 0) {
                            $data['file_ttd'] = $p->ttd;
                            $data['ttd_pegawai'] = $p->ttd;
                        } else {
                            $data['file_ttd'] = base_url() . "upload/no-image.png" . "?" . rand();
                            $data['ttd_pegawai'] = base_url() . "upload/no-bg.png" . "?" . rand();
                        }
                    }
                }

                $approval = $this->mod_sppd->cek_approval($data['jabatan']);
                switch ($approval) {
                    case 0:
                        $data['pilih_atasan'] = "block";
                        $data['tombol_proses'] = "none";
                        break;
                    case 1:
                        $data['pilih_atasan'] = "none";
                        $data['tombol_proses'] = "block";
                        break;
                }

                //data sppd
                $data['trip_no'] = "";
                $data['dari'] = "";
                $data['ke'] = "";
                $data['tgl_berangkat'] = date('Y-m-d');
                $data['tgl_pulang'] = date('Y-m-d');
                $data['maksud'] = "";
                $data['file_berkas1'] = base_url() . "upload/no-image.png" . "?" . rand();
                $data['berkas1'] = date('dmYHis') . "-berkas1";
                $data['file_berkas2'] = base_url() . "upload/no-image.png" . "?" . rand();
                $data['berkas2'] = date('dmYHis') . "-berkas2";
                $data['file_berkas3'] = base_url() . "upload/no-image.png" . "?" . rand();
                $data['berkas3'] = date('dmYHis') . "-berkas3";

                //laporan singkat
                $data['isilap'] = "";
                $data['file_berkas_lap'] = base_url() . "upload/no-image.png" . "?" . rand();
                $data['berkas_lap'] = date('dmYHis') . "-berkas-lap";

                //biaya
                $data['nominal_pergi'] = 0;
                $data['berkas_pergi'] = date('dmYHis') . "-berkas-pergi";
                $data['file_berkas_pergi'] = base_url() . "upload/no-image.png" . "?" . rand();
                $data['nominal_pulang'] = 0;
                $data['berkas_pulang'] = date('dmYHis') . "-berkas-pulang";
                $data['file_berkas_pulang'] = base_url() . "upload/no-image.png" . "?" . rand();
                $data['nama_penginapan'] = "";
                $data['tgl_check_in'] = date('Y-m-d');
                $data['tgl_check_out'] = date('Y-m-d');
                $data['nominal_penginapan'] = 0;
                $data['berkas_penginapan'] = date('dmYHis') . "-berkas-penginapan";
                $data['file_berkas_penginapan'] = base_url() . "upload/no-image.png" . "?" . rand();
                $data['nominal_bagasi'] = 0;
                $data['berkas_bagasi'] = date('dmYHis') . "-berkas-bagasi";
                $data['file_berkas_bagasi'] = base_url() . "upload/no-image.png" . "?" . rand();
                $data['total_biaya'] = 0;

                //pakta integritas
                $data['catatan'] = "";
                $data['kd_atasan'] = "";
                $data['persno_atasan'] = "";
                $data['nama_atasan'] = "";
                $data['ttd_atasan'] = base_url() . "upload/no-bg.png" . "?" . rand();
                break;
            case "2":
                //ambil sppd
                $sppd = $this->mod_sppd->ambil_sppd($kode)->result();
                foreach ($sppd as $s) {
                    $data['kd_sppd'] = $kode;
                    $data['tgl_pelaporan'] = $s->tgl_pelaporan;
                    $data['approve'] = $s->approve;

                    //data pegawai
                    $data['kd_pegawai'] = $s->kd_pegawai;
                    $pegawai = $this->mod_sppd->ambil_pegawai($s->kd_pegawai)->result();
                    foreach ($pegawai as $p) {
                        $data['pers_no'] = $p->pers_no;
                        $data['email'] = $p->email;
                        $data['nama'] = $p->nama;
                        $data['jabatan'] = $p->jabatan;
                        $data['unit'] = $p->unit;
                        $data['bidang'] = $p->bidang;
                        $data['area'] = $p->area;

                        if ($p->foto != "") {
                            $foto_pegawai = "upload/pegawai/" . $p->foto;
                            if (file_exists($foto_pegawai)) {
                                $data['file_foto'] = base_url() . "upload/pegawai/" . $p->foto . "?" . rand();
                            } else {
                                $data['file_foto'] = base_url() . "upload/no-pic.jpg" . "?" . rand();
                            }
                        } else {
                            $data['file_foto'] = base_url() . "upload/no-pic.jpg" . "?" . rand();
                        }

                        if ($p->ttd != "" && substr_count($p->ttd, "data:image/png;base64") == 0) {
                            $ttd_pegawai = "upload/pegawai/" . $p->ttd;
                            if (file_exists($ttd_pegawai)) {
                                $data['file_ttd'] = base_url() . "upload/pegawai/" . $p->ttd . "?" . rand();
                                $data['ttd_pegawai'] = base_url() . "upload/pegawai/" . $p->ttd . "?" . rand();
                            } else {
                                $data['file_ttd'] = base_url() . "upload/no-image.png" . "?" . rand();
                                $data['ttd_pegawai'] = base_url() . "upload/no-bg.png" . "?" . rand();
                            }
                        } elseif (substr_count($p->ttd, "data:image/png;base64") > 0) {
                            $data['file_ttd'] = $p->ttd;
                            $data['ttd_pegawai'] = $p->ttd;
                        } else {
                            $data['file_ttd'] = base_url() . "upload/no-image.png" . "?" . rand();
                            $data['ttd_pegawai'] = base_url() . "upload/no-bg.png" . "?" . rand();
                        }
                    }

                    //data sppd
                    $data['trip_no'] = $s->trip_no;
                    $data['dari'] = $s->dari;
                    $data['ke'] = $s->ke;
                    $data['tgl_berangkat'] = $s->tgl_berangkat;
                    $data['tgl_pulang'] = $s->tgl_pulang;
                    $data['maksud'] = $s->maksud;

                    if ($s->berkas1 != "") {
                        $berkas1 = "upload/pelaporan/" . $s->berkas1;
                        if (file_exists($berkas1)) {
                            $data['file_berkas1'] = base_url() . "upload/pelaporan/" . $s->berkas1 . "?" . rand();
                            $data['berkas1'] = $s->berkas1;
                        } else {
                            $data['file_berkas1'] = base_url() . "upload/no-image.png" . "?" . rand();
                            $data['berkas1'] = date('dmYHis') . "-berkas1";
                        }
                    } else {
                        $data['file_berkas1'] = base_url() . "upload/no-image.png" . "?" . rand();
                        $data['berkas1'] = date('dmYHis') . "-berkas1";
                    }

                    if ($s->berkas2 != "") {
                        $berkas2 = "upload/pelaporan/" . $s->berkas2;
                        if (file_exists($berkas2)) {
                            $data['file_berkas2'] = base_url() . "upload/pelaporan/" . $s->berkas2 . "?" . rand();
                            $data['berkas2'] = $s->berkas2;
                        } else {
                            $data['file_berkas2'] = base_url() . "upload/no-image.png" . "?" . rand();
                            $data['berkas2'] = date('dmYHis') . "-berkas2";
                        }
                    } else {
                        $data['file_berkas2'] = base_url() . "upload/no-image.png" . "?" . rand();
                        $data['berkas2'] = date('dmYHis') . "-berkas2";
                    }

                    if ($s->berkas3 != "") {
                        $berkas3 = "upload/pelaporan/" . $s->berkas3;
                        if (file_exists($berkas3)) {
                            $data['file_berkas3'] = base_url() . "upload/pelaporan/" . $s->berkas3 . "?" . rand();
                            $data['berkas3'] = $s->berkas3;
                        } else {
                            $data['file_berkas3'] = base_url() . "upload/no-image.png" . "?" . rand();
                            $data['berkas3'] = date('dmYHis') . "-berkas3";
                        }
                    } else {
                        $data['file_berkas3'] = base_url() . "upload/no-image.png" . "?" . rand();
                        $data['berkas3'] = date('dmYHis') . "-berkas3";
                    }

                    //laporan singkat
                    $data['isilap'] = $s->isi_laporan;


                    if ($s->berkas_lap != "") {
                        $berkas_lap = "upload/pelaporan/" . $s->berkas_lap;
                        if (file_exists($berkas_lap)) {
                            $data['file_berkas_lap'] = base_url() . "upload/pelaporan/" . $s->berkas_lap . "?" . rand();
                            $data['berkas_lap'] = $s->berkas_lap;
                        } else {
                            $data['file_berkas_lap'] = base_url() . "upload/no-image.png" . "?" . rand();
                            $data['berkas_lap'] = date('dmYHis') . "-berkas-lap";
                        }
                    } else {
                        $data['file_berkas_lap'] = base_url() . "upload/no-image.png" . "?" . rand();
                        $data['berkas_lap'] = date('dmYHis') . "-berkas-lap";
                    }

                    //pakta integritas
                    $data['catatan'] = $s->catatan_ubah;
                    $data['kd_atasan'] = $s->kd_atasan;
                    if ($s->kd_atasan != 0) {
                        $pegawai = $this->mod_sppd->ambil_pegawai($s->kd_atasan)->result();
                        foreach ($pegawai as $p) {
                            $data['persno_atasan'] = $p->pers_no;
                            $data['nama_atasan'] = $p->nama;

                            if ($p->ttd != "" && $s->approve == 1) {
                                $ttd_atasan = "upload/pegawai/" . $p->ttd;
                                if (file_exists($ttd_atasan)) {
                                    $data['ttd_atasan'] = base_url() . "upload/pegawai/" . $p->ttd . "?" . rand();
                                } else {
                                    $data['ttd_atasan'] = base_url() . "upload/no-bg.png" . "?" . rand();
                                }
                            } else {
                                $data['ttd_atasan'] = base_url() . "upload/no-bg.png" . "?" . rand();
                            }
                        }
                    } else {
                        $data['persno_atasan'] = "";
                        $data['nama_atasan'] = "";
                        $data['ttd_atasan'] = base_url() . "upload/no-bg.png" . "?" . rand();
                    }
                }

                //biaya
                $pengeluaran = $this->mod_sppd->ambil_pengeluaran($kode)->result();
                foreach ($pengeluaran as $p) {
                    $data['nominal_pergi'] = $p->transport_pergi;

                    if ($p->berkas_pergi != "") {
                        $berkas_pergi = "upload/bukti/" . $p->berkas_pergi;
                        if (file_exists($berkas_pergi)) {
                            $data['file_berkas_pergi'] = base_url() . "upload/bukti/" . $p->berkas_pergi . "?" . rand();
                            $data['berkas_pergi'] = $p->berkas_pergi;
                        } else {
                            $data['berkas_pergi'] = date('dmYHis') . "-berkas-pergi";
                            $data['file_berkas_pergi'] = base_url() . "upload/no-image.png" . "?" . rand();
                        }
                    } else {
                        $data['berkas_pergi'] = date('dmYHis') . "-berkas-pergi";
                        $data['file_berkas_pergi'] = base_url() . "upload/no-image.png" . "?" . rand();
                    }

                    $data['nominal_pulang'] = $p->transport_pulang;

                    if ($p->berkas_pulang != "") {
                        $berkas_pulang = "upload/bukti/" . $p->berkas_pulang;
                        if (file_exists($berkas_pulang)) {
                            $data['file_berkas_pulang'] = base_url() . "upload/bukti/" . $p->berkas_pulang . "?" . rand();
                            $data['berkas_pulang'] = $p->berkas_pulang;
                        } else {
                            $data['berkas_pulang'] = date('dmYHis') . "-berkas-pulang";
                            $data['file_berkas_pulang'] = base_url() . "upload/no-image.png" . "?" . rand();
                        }
                    } else {
                        $data['berkas_pulang'] = date('dmYHis') . "-berkas-pulang";
                        $data['file_berkas_pulang'] = base_url() . "upload/no-image.png" . "?" . rand();
                    }

                    $data['nama_penginapan'] = $p->nama_penginapan;
                    $data['tgl_check_in'] = $p->tgl_check_in;
                    $data['tgl_check_out'] = $p->tgl_check_out;
                    $data['nominal_penginapan'] = $p->penginapan;

                    if ($p->berkas_penginapan != "") {
                        $berkas_penginapan = "upload/bukti/" . $p->berkas_penginapan;
                        if (file_exists($berkas_penginapan)) {
                            $data['file_berkas_penginapan'] = base_url() . "upload/bukti/" . $p->berkas_penginapan . "?" . rand();
                            $data['berkas_penginapan'] = $p->berkas_penginapan;
                        } else {
                            $data['berkas_penginapan'] = date('dmYHis') . "-berkas-penginapan";
                            $data['file_berkas_penginapan'] = base_url() . "upload/no-image.png" . "?" . rand();
                        }
                    } else {
                        $data['berkas_penginapan'] = date('dmYHis') . "-berkas-penginapan";
                        $data['file_berkas_penginapan'] = base_url() . "upload/no-image.png" . "?" . rand();
                    }

                    $data['nominal_bagasi'] = $p->bagasi;

                    if ($p->berkas_bagasi != "") {
                        $berkas_bagasi = "upload/bukti/" . $p->berkas_bagasi;
                        if (file_exists($berkas_bagasi)) {
                            $data['file_berkas_bagasi'] = base_url() . "upload/bukti/" . $p->berkas_bagasi . "?" . rand();
                            $data['berkas_bagasi'] = $p->berkas_bagasi;
                        } else {
                            $data['berkas_bagasi'] = date('dmYHis') . "-berkas-bagasi";
                            $data['file_berkas_bagasi'] = base_url() . "upload/no-image.png" . "?" . rand();
                        }
                    } else {
                        $data['berkas_bagasi'] = date('dmYHis') . "-berkas-bagasi";
                        $data['file_berkas_bagasi'] = base_url() . "upload/no-image.png" . "?" . rand();
                    }

                    $data['total_biaya'] = $p->transport_pergi + $p->transport_pulang + $p->penginapan + $p->bagasi;
                }
                break;
        }

        $approval = $this->mod_sppd->cek_approval($data['jabatan']);
        switch ($approval) {
            case 0:
                $data['pilih_atasan'] = "block";
                break;
            case 1:
                $data['pilih_atasan'] = "none";
                break;
        }

        $data['tombol_proses'] = "block";

        if ($data['approve'] == 0) {
            //save log
            $this->log_lib->log_info("Akses halaman formulir pelaporan sppd");

            $this->load->view('body/mobile_body_atas');
            $this->load->view('frontend/formsppd', $data);
            $this->load->view('body/mobile_body_bawah');
        } else {
            $pesan = 3;
            $isipesan = "Akses halaman formulir pelaporan sppd tertolak karena nomor trip " . $data['trip_no'] . "  sudah di approve";

            $msg = str_replace(" ", "-", $isipesan);

            //save log
            $this->log_lib->log_info($isipesan);

            redirect("mobilesppd/index/1/-/-/$pesan/$msg");
        }
    }

    public function detail($kode = "", $cari = "", $kategori = "")
    {
        $data['cari'] =  $cari;
        $data['kategori'] =  $kategori;

        //ambil sppd
        $sppd = $this->mod_sppd->ambil_sppd($kode)->result();
        foreach ($sppd as $s) {
            $data['kd_sppd'] = $kode;
            $data['tgl_pelaporan'] = $s->tgl_pelaporan;
            $data['approve'] = $s->approve;

            //data pegawai
            $data['kd_pegawai'] = $s->kd_pegawai;
            $pegawai = $this->mod_sppd->ambil_pegawai($s->kd_pegawai)->result();
            foreach ($pegawai as $p) {
                $data['pers_no'] = $p->pers_no;
                $data['email'] = $p->email;
                $data['nama'] = $p->nama;
                $data['jabatan'] = $p->jabatan;
                $data['unit'] = $p->unit;
                $data['bidang'] = $p->bidang;
                $data['area'] = $p->area;

                if ($p->foto != "") {
                    $foto_pegawai = "upload/pegawai/" . $p->foto;
                    if (file_exists($foto_pegawai)) {
                        $data['file_foto'] = base_url() . "upload/pegawai/" . $p->foto . "?" . rand();
                    } else {
                        $data['file_foto'] = base_url() . "upload/no-pic.jpg" . "?" . rand();
                    }
                } else {
                    $data['file_foto'] = base_url() . "upload/no-pic.jpg" . "?" . rand();
                }

                if ($p->ttd != "" && substr_count($p->ttd, "data:image/png;base64") == 0) {
                    $ttd_pegawai = "upload/pegawai/" . $p->ttd;
                    if (file_exists($ttd_pegawai)) {
                        $data['file_ttd'] = base_url() . "upload/pegawai/" . $p->ttd . "?" . rand();
                        $data['ttd_pegawai'] = base_url() . "upload/pegawai/" . $p->ttd . "?" . rand();
                    } else {
                        $data['file_ttd'] = base_url() . "upload/no-image.png" . "?" . rand();
                        $data['ttd_pegawai'] = base_url() . "upload/no-bg.png" . "?" . rand();
                    }
                } elseif (substr_count($p->ttd, "data:image/png;base64") > 0) {
                    $data['file_ttd'] = $p->ttd;
                    $data['ttd_pegawai'] = $p->ttd;
                } else {
                    $data['file_ttd'] = base_url() . "upload/no-image.png" . "?" . rand();
                    $data['ttd_pegawai'] = base_url() . "upload/no-bg.png" . "?" . rand();
                }
            }

            //data sppd
            $data['trip_no'] = $s->trip_no;
            $data['dari'] = $s->dari;
            $data['ke'] = $s->ke;
            $data['tgl_berangkat'] = $s->tgl_berangkat;
            $data['tgl_pulang'] = $s->tgl_pulang;
            $data['maksud'] = $s->maksud;

            if ($s->berkas1 != "") {
                $berkas1 = "upload/pelaporan/" . $s->berkas1;
                if (file_exists($berkas1)) {
                    $data['file_berkas1'] = base_url() . "upload/pelaporan/" . $s->berkas1 . "?" . rand();
                    $data['berkas1'] = $s->berkas1;
                } else {
                    $data['file_berkas1'] = base_url() . "upload/no-image.png" . "?" . rand();
                    $data['berkas1'] = date('dmYHis') . "-berkas1";
                }
            } else {
                $data['file_berkas1'] = base_url() . "upload/no-image.png" . "?" . rand();
                $data['berkas1'] = date('dmYHis') . "-berkas1";
            }

            if ($s->berkas2 != "") {
                $berkas2 = "upload/pelaporan/" . $s->berkas2;
                if (file_exists($berkas2)) {
                    $data['file_berkas2'] = base_url() . "upload/pelaporan/" . $s->berkas2 . "?" . rand();
                    $data['berkas2'] = $s->berkas2;
                } else {
                    $data['file_berkas2'] = base_url() . "upload/no-image.png" . "?" . rand();
                    $data['berkas2'] = date('dmYHis') . "-berkas2";
                }
            } else {
                $data['file_berkas2'] = base_url() . "upload/no-image.png" . "?" . rand();
                $data['berkas2'] = date('dmYHis') . "-berkas2";
            }

            if ($s->berkas3 != "") {
                $berkas3 = "upload/pelaporan/" . $s->berkas3;
                if (file_exists($berkas3)) {
                    $data['file_berkas3'] = base_url() . "upload/pelaporan/" . $s->berkas3 . "?" . rand();
                    $data['berkas3'] = $s->berkas3;
                } else {
                    $data['file_berkas3'] = base_url() . "upload/no-image.png" . "?" . rand();
                    $data['berkas3'] = date('dmYHis') . "-berkas3";
                }
            } else {
                $data['file_berkas3'] = base_url() . "upload/no-image.png" . "?" . rand();
                $data['berkas3'] = date('dmYHis') . "-berkas3";
            }

            //laporan singkat
            $data['isilap'] = $s->isi_laporan;


            if ($s->berkas_lap != "") {
                $berkas_lap = "upload/pelaporan/" . $s->berkas_lap;
                if (file_exists($berkas_lap)) {
                    $data['file_berkas_lap'] = base_url() . "upload/pelaporan/" . $s->berkas_lap . "?" . rand();
                    $data['berkas_lap'] = $s->berkas_lap;
                } else {
                    $data['file_berkas_lap'] = base_url() . "upload/no-image.png" . "?" . rand();
                    $data['berkas_lap'] = date('dmYHis') . "-berkas-lap";
                }
            } else {
                $data['file_berkas_lap'] = base_url() . "upload/no-image.png" . "?" . rand();
                $data['berkas_lap'] = date('dmYHis') . "-berkas-lap";
            }

            //pakta integritas
            $data['catatan'] = $s->catatan_ubah;
            $data['kd_atasan'] = $s->kd_atasan;
            $pegawai = $this->mod_sppd->ambil_pegawai($s->kd_atasan)->result();
            foreach ($pegawai as $p) {
                $data['persno_atasan'] = $p->pers_no;
                $data['nama_atasan'] = $p->nama;

                if ($p->ttd != "" && $s->approve == 1) {
                    $ttd_atasan = "upload/pegawai/" . $p->ttd;
                    if (file_exists($ttd_atasan)) {
                        $data['ttd_atasan'] = base_url() . "upload/pegawai/" . $p->ttd . "?" . rand();
                    } else {
                        $data['ttd_atasan'] = base_url() . "upload/no-bg.png" . "?" . rand();
                    }
                } else {
                    $data['ttd_atasan'] = base_url() . "upload/no-bg.png" . "?" . rand();
                }
            }
        }

        //biaya
        $pengeluaran = $this->mod_sppd->ambil_pengeluaran($kode)->result();
        foreach ($pengeluaran as $p) {
            $data['nominal_pergi'] = $p->transport_pergi;

            if ($p->berkas_pergi != "") {
                $berkas_pergi = "upload/bukti/" . $p->berkas_pergi;
                if (file_exists($berkas_pergi)) {
                    $data['file_berkas_pergi'] = base_url() . "upload/bukti/" . $p->berkas_pergi . "?" . rand();
                    $data['berkas_pergi'] = $p->berkas_pergi;
                } else {
                    $data['berkas_pergi'] = date('dmYHis') . "-berkas-pergi";
                    $data['file_berkas_pergi'] = base_url() . "upload/no-image.png" . "?" . rand();
                }
            } else {
                $data['berkas_pergi'] = date('dmYHis') . "-berkas-pergi";
                $data['file_berkas_pergi'] = base_url() . "upload/no-image.png" . "?" . rand();
            }

            $data['nominal_pulang'] = $p->transport_pulang;

            if ($p->berkas_pulang != "") {
                $berkas_pulang = "upload/bukti/" . $p->berkas_pulang;
                if (file_exists($berkas_pulang)) {
                    $data['file_berkas_pulang'] = base_url() . "upload/bukti/" . $p->berkas_pulang . "?" . rand();
                    $data['berkas_pulang'] = $p->berkas_pulang;
                } else {
                    $data['berkas_pulang'] = date('dmYHis') . "-berkas-pulang";
                    $data['file_berkas_pulang'] = base_url() . "upload/no-image.png" . "?" . rand();
                }
            } else {
                $data['berkas_pulang'] = date('dmYHis') . "-berkas-pulang";
                $data['file_berkas_pulang'] = base_url() . "upload/no-image.png" . "?" . rand();
            }

            $data['nama_penginapan'] = $p->nama_penginapan;
            $data['tgl_check_in'] = $p->tgl_check_in;
            $data['tgl_check_out'] = $p->tgl_check_out;
            $data['nominal_penginapan'] = $p->penginapan;

            if ($p->berkas_penginapan != "") {
                $berkas_penginapan = "upload/bukti/" . $p->berkas_penginapan;
                if (file_exists($berkas_penginapan)) {
                    $data['file_berkas_penginapan'] = base_url() . "upload/bukti/" . $p->berkas_penginapan . "?" . rand();
                    $data['berkas_penginapan'] = $p->berkas_penginapan;
                } else {
                    $data['berkas_penginapan'] = date('dmYHis') . "-berkas-penginapan";
                    $data['file_berkas_penginapan'] = base_url() . "upload/no-image.png" . "?" . rand();
                }
            } else {
                $data['berkas_penginapan'] = date('dmYHis') . "-berkas-penginapan";
                $data['file_berkas_penginapan'] = base_url() . "upload/no-image.png" . "?" . rand();
            }

            $data['nominal_bagasi'] = $p->bagasi;

            if ($p->berkas_bagasi != "") {
                $berkas_bagasi = "upload/bukti/" . $p->berkas_bagasi;
                if (file_exists($berkas_bagasi)) {
                    $data['file_berkas_bagasi'] = base_url() . "upload/bukti/" . $p->berkas_bagasi . "?" . rand();
                    $data['berkas_bagasi'] = $p->berkas_bagasi;
                } else {
                    $data['berkas_bagasi'] = date('dmYHis') . "-berkas-bagasi";
                    $data['file_berkas_bagasi'] = base_url() . "upload/no-image.png" . "?" . rand();
                }
            } else {
                $data['berkas_bagasi'] = date('dmYHis') . "-berkas-bagasi";
                $data['file_berkas_bagasi'] = base_url() . "upload/no-image.png" . "?" . rand();
            }

            $data['total_biaya'] = $p->transport_pergi + $p->transport_pulang + $p->penginapan + $p->bagasi;
        }

        //save log
        $this->log_lib->log_info("Akses halaman detail pelaporan sppd");

        $this->load->view('body/mobile_body_atas');
        $this->load->view('frontend/detail', $data);
        $this->load->view('body/mobile_body_bawah');
    }

    public function cek_tripno($tripno)
    {
        $jml = $this->mod_sppd->cek_trip_no($tripno);

        $record = array();
        $subrecord = array();

        $subrecord['jml'] = $jml;
        array_push($record, $subrecord);

        echo json_encode($record);
    }

    public function proses($proses = 1, $kode = "", $nomor_trip = "", $approve = "")
    {
        $kd_sppd = $this->input->post('kd_sppd');
        $tgl_pelaporan = $this->input->post('tgl_pelaporan');
        $kd_pegawai = $this->input->post('kd_pegawai');
        $trip_no = $this->input->post('trip_no');
        $dari = $this->input->post('dari');
        $ke = $this->input->post('ke');
        $tgl_berangkat = $this->input->post('tgl_berangkat');
        $tgl_pulang = $this->input->post('tgl_pulang');
        $maksud = $this->input->post('maksud');

        if (substr_count($this->input->post('nama_berkas1'), ".") == 0) {
            $nama_berkas1 = "";
        } else {
            $nama_berkas1 = $this->input->post('nama_berkas1');
        }

        if (substr_count($this->input->post('nama_berkas2'), ".") == 0) {
            $nama_berkas2 = "";
        } else {
            $nama_berkas2 = $this->input->post('nama_berkas2');
        }

        if (substr_count($this->input->post('nama_berkas3'), ".") == 0) {
            $nama_berkas3 = "";
        } else {
            $nama_berkas3 = $this->input->post('nama_berkas3');
        }

        if (substr_count($this->input->post('nama_berkas_lap'), ".") == 0) {
            $nama_berkas_lap = "";
        } else {
            $nama_berkas_lap = $this->input->post('nama_berkas_lap');
        }

        $isilap = $this->input->post('isilap');
        $nominal_pergi = str_replace(",", "", $this->input->post('nominal_pergi'));
        $nominal_pulang = str_replace(",", "", $this->input->post('nominal_pulang'));

        if (substr_count($this->input->post('nama_berkas_pergi'), ".") == 0) {
            $nama_berkas_pergi = "";
        } else {
            $nama_berkas_pergi = $this->input->post('nama_berkas_pergi');
        }

        if (substr_count($this->input->post('nama_berkas_pulang'), ".") == 0) {
            $nama_berkas_pulang = "";
        } else {
            $nama_berkas_pulang = $this->input->post('nama_berkas_pulang');
        }

        $nama_penginapan = $this->input->post('nama_penginapan');
        $tgl_check_in = $this->input->post('tgl_check_in');
        $tgl_check_out = $this->input->post('tgl_check_out');
        $nominal_penginapan = str_replace(",", "", $this->input->post('nominal_penginapan'));

        if (substr_count($this->input->post('nama_berkas_penginapan'), ".") == 0) {
            $nama_berkas_penginapan = "";
        } else {
            $nama_berkas_penginapan = $this->input->post('nama_berkas_penginapan');
        }

        $nominal_bagasi = str_replace(",", "", $this->input->post('nominal_bagasi'));

        if (substr_count($this->input->post('nama_berkas_bagasi'), ".") == 0) {
            $nama_berkas_bagasi = "";
        } else {
            $nama_berkas_bagasi = $this->input->post('nama_berkas_bagasi');
        }

        $catatan = $this->input->post('catatan');
        $kd_atasan = $this->input->post('kd_atasan');

        //durasi
        $waktu_pergi = new DateTime(date('Y-m-d', strtotime($tgl_berangkat)));
        $waktu_balik = new DateTime(date('Y-m-d', strtotime($tgl_pulang)));
        $durasi = date_diff($waktu_pergi, $waktu_balik);

        //cek email atasan
        $email_atasan = "";
        $cek_email_atasan = $this->mod_sppd->cek_email_atasan($kd_atasan)->result();
        foreach ($cek_email_atasan as $cea) {
            $email_atasan = $cea->email;
        }

        //cek daftar pengelola data restitusi
        $email_cc = "";
        $cek_admin_app = $this->mod_sppd->cek_admin_app()->result();
        foreach ($cek_admin_app as $caa) {
            $email_cc .= $caa->email . ",";
        }

        //data pegawai
        $data_pegawai = "";
        $jabatan_pegawai = "";
        $cek_pegawai = $this->mod_sppd->ambil_pegawai($kd_pegawai)->result();
        foreach ($cek_pegawai as $cp) {
            $jabatan_pegawai = $cp->jabatan;

            $data_pegawai = "Pegawai dengan data: <br>" .
                "Pers. No. : " . $cp->pers_no . "<br>" .
                "Nama : " . $cp->nama . "<br>" .
                "Jabatan : " . $cp->jabatan . "<br>" .
                "Bidang : " . $cp->bidang . "<br>" .
                "Business Area : " . $cp->area . "<br>" .
                "Trip No. : " . $trip_no;
        }

        $approval = $this->mod_sppd->cek_approval($jabatan_pegawai);
        switch ($approval) {
            case 0:
                $status_approval = "<b>Approval</b>";
                break;
            case 1:
                $status_approval = "selanjutnya";
                break;
        }

        $data_sppd = array(
            "kd_sppd" => $kd_sppd,
            "tgl_pelaporan" => $tgl_pelaporan,
            "kd_pegawai" => $kd_pegawai,
            "trip_no" => $trip_no,
            "dari" => $dari,
            "ke" => $ke,
            "tgl_berangkat" => $tgl_berangkat,
            "tgl_pulang" => $tgl_pulang,
            "durasi" => $durasi->d,
            "maksud" => $maksud,
            "nama_berkas1" => $nama_berkas1,
            "nama_berkas2" => $nama_berkas2,
            "nama_berkas3" => $nama_berkas3,
            "nama_berkas_lap" => $nama_berkas_lap,
            "isilap" => $isilap,
            "catatan_ubah" => $catatan,
            "kd_atasan" => $kd_atasan,
            "approval" => $approval,
            "updated" => date('Y-m-d H:i:s')
        );

        $data_pengeluaran = array(
            "kd_sppd" => $kd_sppd,
            "nominal_pergi" => $nominal_pergi,
            "nominal_pulang" => $nominal_pulang,
            "nama_berkas_pergi" => $nama_berkas_pergi,
            "nama_berkas_pulang" => $nama_berkas_pulang,
            "nama_penginapan" => $nama_penginapan,
            "tgl_check_in" => $tgl_check_in,
            "tgl_check_out" => $tgl_check_out,
            "nominal_penginapan" => $nominal_penginapan,
            "nama_berkas_penginapan" => $nama_berkas_penginapan,
            "nominal_bagasi" => $nominal_bagasi,
            "nama_berkas_bagasi" => $nama_berkas_bagasi,
            "updated" => date('Y-m-d H:i:s')
        );

        switch ($proses) {
            case 1:
                $this->mod_sppd->simpan_sppd($data_sppd);
                $this->mod_sppd->simpan_pengeluaran($data_pengeluaran);

                //kirim email
                $judul = "Pelaporan Perjalanan Dinas dan Permohonan Restitusi <b style='color:red;'>Baru</b> (noreply)";
                $isi = $data_pegawai . "<br><br>Telah melaporkan perjalanan dinas nya dan menunggu proses $status_approval";

                $proses = $this->kirim_email->email($email_atasan, $judul, $isi, $email_cc);

                $pesan = 1;
                $isipesan = "Data pelaporan SPPD baru di tambahkan menunggu proses approval atasan";
                break;
            case 2:
                $this->mod_sppd->ubah_sppd($data_sppd);
                $this->mod_sppd->ubah_pengeluaran($data_pengeluaran);

                //create PDF Laporan
                //$this->cetak($kd_sppd, 'no');

                $pesan = 2;
                $isipesan = "Data pelaporan SPPD di ubah dengan nomor trip $trip_no";
                break;
            case 3:
                $data_sppd = $this->mod_sppd->ambil_file_sppd($kode)->result();
                foreach ($data_sppd as $ds) {
                    if ($ds->berkas1 != "") {
                        $berkas1 = "upload/pelaporan/" . $ds->berkas1;
                        if (file_exists($berkas1)) {
                            unlink("./upload/pelaporan/" . $ds->berkas1);
                        }
                    }

                    if ($ds->berkas2 != "") {
                        $berkas2 = "upload/pelaporan/" . $ds->berkas2;
                        if (file_exists($berkas2)) {
                            unlink("./upload/pelaporan/" . $ds->berkas2);
                        }
                    }

                    if ($ds->berkas3 != "") {
                        $berkas3 = "upload/pelaporan/" . $ds->berkas3;
                        if (file_exists($berkas3)) {
                            unlink("./upload/pelaporan/" . $ds->berkas3);
                        }
                    }

                    if ($ds->berkas_lap != "") {
                        $berkas_lap = "upload/pelaporan/" . $ds->berkas_lap;
                        if (file_exists($berkas_lap)) {
                            unlink("./upload/pelaporan/" . $ds->berkas_lap);
                        }
                    }
                }

                $data_pengeluaran = $this->mod_sppd->ambil_file_pengeluaran($kode)->result();
                foreach ($data_pengeluaran as $dp) {
                    if ($dp->berkas_pergi != "") {
                        $berkas_pergi = "upload/bukti/" . $dp->berkas_pergi;
                        if (file_exists($berkas_pergi)) {
                            unlink("./upload/bukti/" . $dp->berkas_pergi);
                        }
                    }

                    if ($dp->berkas_pulang != "") {
                        $berkas_pulang = "upload/bukti/" . $dp->berkas_pulang;
                        if (file_exists($berkas_pulang)) {
                            unlink("./upload/bukti/" . $dp->berkas_pulang);
                        }
                    }

                    if ($dp->berkas_penginapan != "") {
                        $berkas_penginapan = "upload/bukti/" . $dp->berkas_penginapan;
                        if (file_exists($berkas_penginapan)) {
                            unlink("./upload/bukti/" . $dp->berkas_penginapan);
                        }
                    }

                    if ($dp->berkas_bagasi != "") {
                        $berkas_bagasi = "upload/bukti/" . $dp->berkas_bagasi;
                        if (file_exists($berkas_bagasi)) {
                            unlink("./upload/bukti/" . $dp->berkas_bagasi);
                        }
                    }
                }

                $this->mod_sppd->hapus_sppd($kode);
                $this->mod_sppd->hapus_pengeluaran($kode);

                $pesan = 3;
                $isipesan = "Data pelaporan SPPD dengan nomor trip $nomor_trip di hapus";
                break;
        }

        $msg = str_replace(" ", "-", $isipesan);

        //save log
        $this->log_lib->log_info($isipesan);

        redirect("mobilesppd/index/1/-/-/$pesan/$msg");
    }

    public function upload($kelompok, $nama_file)
    {
        switch ($kelompok) {
            case '1':
            case '2':
            case '3':
            case '4':
                $lokasi = './upload/pelaporan';
                break;
            case '5':
            case '6':
            case '7':
            case '8':
                $lokasi = './upload/bukti';
                break;
        }

        $config['upload_path']        =  $lokasi;
        $config['allowed_types']     = 'gif|jpg|png|bmp';
        $config['file_name']        = $nama_file;
        $config['overwrite']        = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('berkas')) {
            $error = "";
            echo "gagal";
        } else {
            $data = $this->upload->data();

            //Compress Image
            $config['image_library'] = 'gd2';
            $config['source_image'] =  $lokasi . '/' . $data['file_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['quality'] = '50%';
            $config['width'] = 400;
            $config['height'] = 600;
            $config['new_image'] =  $lokasi . '/' . $data['file_name'];
            $this->load->library('image_lib', $config);
            if (!$this->image_lib->resize()) {
                echo $this->image_lib->display_errors();
            }

            extract($data);

            echo $file_name;
        }
    }

    public function daftar_pegawai($kelompok = 1, $page = 1, $isicari = "-")
    {
        //cari
        if ($isicari != "-") {
            $cari = urldecode($isicari);
        } else {
            $cari =  $this->input->post('cari');
        }

        if ($cari != "") {
            $q_cari = "pers_no like '%$cari%' or nama like '%$cari%'";
        } else {
            $q_cari = "pers_no<>''";
        }

        $data['cari'] =  $cari;

        $data['kelompok'] =  $kelompok;

        //pagination
        $jumlah_data = $this->mod_sppd->jumlah_pegawai($q_cari);

        if ($this->input->post('limitpage') == "") {
            $limit = 10;
            $limit_start = ($page - 1) * 10;
        } else {
            $limit = $this->input->post('limitpage');
            $limit_start = ($page - 1) * $limit;
        }

        $data['limit'] = $limit;

        $pegawai = $this->mod_sppd->daftar_pegawai($limit_start, $limit, $q_cari)->result();

        $record = array();
        $subrecord = array();
        foreach ($pegawai as $p) {
            $nama_pegawai = $this->clear_string->clear_quotes($p->nama);

            $subrecord['kd_pegawai'] = $p->kd_pegawai;
            $subrecord['pers_no'] = $p->pers_no;
            $subrecord['nama'] = $nama_pegawai;
            $subrecord['jabatan'] = $p->jabatan;
            $subrecord['unit'] = $p->unit;
            $subrecord['bidang'] = $p->bidang;
            $subrecord['area'] = $p->area;
            $subrecord['email'] = $p->email;
            $subrecord['status_email'] = $p->status_email;
            $subrecord['status_pegawai'] = $p->aktif;

            if ($p->foto != "") {
                $foto_pegawai = "upload/pegawai/" . $p->foto;
                if (file_exists($foto_pegawai)) {
                    $subrecord['foto'] = $p->foto;
                    $subrecord['file_foto'] = base_url() . "upload/pegawai/" . $p->foto . "?" . rand();
                } else {
                    $subrecord['foto'] = date('dmYHis') . "-pegawai";
                    $subrecord['file_foto'] = base_url() . "upload/no-pic.jpg" . "?" . rand();
                }
            } else {
                $subrecord['foto'] = date('dmYHis') . "-pegawai";
                $subrecord['file_foto'] = base_url() . "upload/no-pic.jpg" . "?" . rand();
            }

            if ($p->ttd != "" && substr_count($p->ttd, "data:image/png;base64") == 0) {
                $ttd_pegawai = "upload/pegawai/" . $p->ttd;
                if (file_exists($ttd_pegawai)) {
                    $subrecord['ttd'] = $p->ttd;
                    $subrecord['file_ttd'] = base_url() . "upload/pegawai/" . $p->ttd . "?" . rand();
                } else {
                    $subrecord['ttd'] = date('dmYHis') . "-ttd";
                    $subrecord['file_ttd'] = base_url() . "upload/no-image.png" . "?" . rand();
                }
            } elseif (substr_count($p->ttd, "data:image/png;base64") > 0) {
                $subrecord['ttd'] = $p->ttd;
                $subrecord['file_ttd'] = $p->ttd;
            } else {
                $subrecord['ttd'] = date('dmYHis') . "-ttd";
                $subrecord['file_ttd'] = base_url() . "upload/no-image.png" . "?" . rand();
            }

            switch ($p->aktif) {
                case "0":
                    $subrecord['nama_status'] = "Non Aktif";
                    $subrecord['btn_pesan_status'] = "Aktifkan pegawai";
                    $subrecord['btn_status'] = "btn-default";
                    break;
                case "1":
                    $subrecord['nama_status'] = "Aktif";
                    $subrecord['btn_pesan_status'] = "Non aktifkan pegawai";
                    $subrecord['btn_status'] = "btn-success";
                    break;
            }

            array_push($record, $subrecord);
        }
        $data['pegawai'] = json_encode($record);

        $data['page'] = $page;
        $data['limit'] = $limit;
        $data['get_jumlah'] = $jumlah_data;
        $data['jumlah_page'] = ceil($jumlah_data / $limit);
        $data['jumlah_number'] = 2;
        $data['start_number'] = ($page > $data['jumlah_number']) ? $page - $data['jumlah_number'] : 1;
        $data['end_number'] = ($page < ($data['jumlah_page'] - $data['jumlah_number'])) ? $page + $data['jumlah_number'] : $data['jumlah_page'];

        $data['no'] = $limit_start + 1;
        //end

        $this->load->view('frontend/daftar_pegawai', $data);
    }

    public function approval($approve, $kode, $nomor_trip, $kode_pegawai = "", $email = "")
    {
        //cek daftar pengelola data restitusi
        $email_cc = "";
        $cek_admin_app = $this->mod_sppd->cek_admin_app()->result();
        foreach ($cek_admin_app as $caa) {
            $email_cc .= $caa->email . ",";
        }

        //data pegawai
        $data_pegawai = "";
        $cek_pegawai = $this->mod_sppd->ambil_pegawai($kode_pegawai)->result();
        foreach ($cek_pegawai as $cp) {
            $data_pegawai = "Pegawai dengan data: <br>" .
                "Pers. No. : " . $cp->pers_no . "<br>" .
                "Nama : " . $cp->nama . "<br>" .
                "Jabatan : " . $cp->jabatan . "<br>" .
                "Bidang : " . $cp->bidang . "<br>" .
                "Business Area : " . $cp->area . "<br>" .
                "Trip No. : " . $nomor_trip;
        }

        $this->mod_sppd->approval($approve, $kode);

        switch ($approve) {
            case 0:
                $pesan = 3;
                $isipesan = "Pelaporan SPPD dengan nomor trip $nomor_trip reset approval";
                break;
            case 1:
                //kirim email
                $judul = "Pelaporan Perjalanan Dinas dan Permohonan Restitusi <b style='color:red;'>Approved</b> (noreply)";
                $isi = $data_pegawai . "<br><br>Pelaporan perjalanan dinas <b>disetujui dan diterima</b> selanjutnya akan di proses oleh pengelola data Restitusi SPPD";

                $proses = $this->kirim_email->email($email, $judul, $isi, $email_cc);

                //create PDF Laporan
                $this->cetak($kode, 'no');

                $pesan = 3;
                $isipesan = "Pelaporan SPPD dengan nomor trip $nomor_trip diterima ($proses)";
                break;
            case 2:
                //kirim email
                $judul = "Pelaporan Perjalanan Dinas dan Permohonan Restitusi <b style='color:red;'>Rejected</b> (noreply)";
                $isi = $data_pegawai . "<br><br>Pelaporan perjalanan dinas <b>ditolak</b> silakan hubungi atasan Anda atau pengelola data Resetitusi SPPD untuk konfirmasi lebih lanjut";

                $proses = $this->kirim_email->email($email, $judul, $isi, $email_cc);

                $pesan = 3;
                $isipesan = "Pelaporan SPPD dengan nomor trip $nomor_trip ditolak  ($proses)";
                break;
        }

        $msg = str_replace(" ", "-", $isipesan);

        //save log
        $this->log_lib->log_info($isipesan);

        redirect("mobilesppd/index/1/0/butuh_approve/$pesan/$msg");
    }

    public function selesai($selesai, $kode, $nomor_trip, $kode_pegawai = "", $email = "")
    {
        //cek daftar pengelola data restitusi
        $email_cc = "";
        $cek_admin_app = $this->mod_sppd->cek_admin_app()->result();
        foreach ($cek_admin_app as $caa) {
            $email_cc .= $caa->email . ",";
        }

        //data pegawai
        $data_pegawai = "";
        $cek_pegawai = $this->mod_sppd->ambil_pegawai($kode_pegawai)->result();
        foreach ($cek_pegawai as $cp) {
            $data_pegawai = "Pegawai dengan data: <br>" .
                "Pers. No. : " . $cp->pers_no . "<br>" .
                "Nama : " . $cp->nama . "<br>" .
                "Jabatan : " . $cp->jabatan . "<br>" .
                "Bidang : " . $cp->bidang . "<br>" .
                "Business Area : " . $cp->area . "<br>" .
                "Trip No. : " . $nomor_trip;
        }

        switch ($selesai) {
            case 1:
                $this->mod_sppd->selesai(date('Y-m-d'), $kode);

                //kirim email
                $judul = "Pelaporan Perjalanan Dinas dan Permohonan Restitusi <b style='color:red;'>Batal Diproses</b> (noreply)";
                $isi = $data_pegawai . "<br><br>Pelaporan perjalanan dinas <b>BATAL DIPROSES</b> silakan hubungi pengelola data Resetitusi SPPD untuk konfirmasi lebih lanjut";

                $proses = $this->kirim_email->email($email, $judul, $isi, $email_cc);

                $pesan = 3;
                $isipesan = "Pelaporan SPPD dengan nomor trip $nomor_trip batal proses";
                break;
            case 0:
                $this->mod_sppd->selesai("", $kode);

                //kirim email
                $judul = "Pelaporan Perjalanan Dinas dan Permohonan Restitusi <b style='color:red;'>Selesai Diproses</b> (noreply)";
                $isi = $data_pegawai . "<br><br>Pelaporan perjalanan dinas <b>SELESAI DIPROSES</b> silakan hubungi pengelola data Resetitusi SPPD untuk konfirmasi lebih lanjut";

                $proses = $this->kirim_email->email($email, $judul, $isi, $email_cc);

                $pesan = 3;
                $isipesan = "Pelaporan SPPD dengan nomor trip $nomor_trip selesai proses ($proses)";
                break;
        }

        $msg = str_replace(" ", "-", $isipesan);

        //save log
        $this->log_lib->log_info($isipesan);

        redirect("mobilesppd/index/1/-/-/$pesan/$msg");
    }

    public function cetak($kode = "", $cetak = "yes")
    {
        $data['cetak'] = $cetak;

        //ambil sppd
        $sppd = $this->mod_sppd->ambil_sppd($kode)->result();
        foreach ($sppd as $s) {
            $data['kd_sppd'] = $kode;
            $data['tgl_pelaporan'] = $s->tgl_pelaporan;

            //data pegawai
            $data['kd_pegawai'] = $s->kd_pegawai;
            $pegawai = $this->mod_sppd->ambil_pegawai($s->kd_pegawai)->result();
            foreach ($pegawai as $p) {
                $data['pers_no'] = $p->pers_no;
                $data['email'] = $p->email;
                $data['nama'] = $p->nama;
                $data['jabatan'] = $p->jabatan;
                $data['unit'] = $p->unit;
                $data['bidang'] = $p->bidang;
                $data['area'] = $p->area;


                if ($p->ttd != "" && substr_count($p->ttd, "data:image/png;base64") == 0) {
                    $ttd_pegawai = "upload/pegawai/" . $p->ttd;
                    if (file_exists($ttd_pegawai)) {
                        $data['ttd_pegawai'] = base_url() . "upload/pegawai/" . $p->ttd . "?" . rand();
                    } else {
                        $data['ttd_pegawai'] = base_url() . "upload/no-bg.png" . "?" . rand();
                    }
                } elseif (substr_count($p->ttd, "data:image/png;base64") > 0) {
                    $data['ttd_pegawai'] = $p->ttd;
                } else {
                    $data['ttd_pegawai'] = base_url() . "upload/no-bg.png" . "?" . rand();
                }
            }

            //data sppd
            $data['trip_no'] = $s->trip_no;
            $data['dari'] = $s->dari;
            $data['ke'] = $s->ke;
            $data['tgl_berangkat'] = $s->tgl_berangkat;
            $data['tgl_pulang'] = $s->tgl_pulang;
            $data['maksud'] = $s->maksud;

            if ($s->berkas1 != "" || $s->berkas2 != "" || $s->berkas3 != "") {
                $data['berkas_sppd'] = 1;
            } else {
                $data['berkas_sppd'] = 0;
            }

            //laporan singkat
            $data['isilap'] = $s->isi_laporan;

            //pakta integritas
            $data['catatan'] = $s->catatan_ubah;

            $data['kd_atasan'] = $s->kd_atasan;
            if ($s->kd_atasan != 0) {
                $data['kd_atasan'] = $s->kd_atasan;
                $pegawai = $this->mod_sppd->ambil_pegawai($s->kd_atasan)->result();
                foreach ($pegawai as $p) {
                    $data['persno_atasan'] = $p->pers_no;
                    $data['nama_atasan'] = $p->nama;

                    if ($p->ttd != "" && $s->approve == 1) {
                        $ttd_atasan = "upload/pegawai/" . $p->ttd;
                        if (file_exists($ttd_atasan)) {
                            $data['ttd_atasan'] = base_url() . "upload/pegawai/" . $p->ttd . "?" . rand();
                        } else {
                            $data['ttd_atasan'] = base_url() . "upload/no-bg.png" . "?" . rand();
                        }
                    } else {
                        $data['ttd_atasan'] = base_url() . "upload/no-bg.png" . "?" . rand();
                    }
                }
            }
        }

        //biaya
        $pengeluaran = $this->mod_sppd->ambil_pengeluaran($kode)->result();
        foreach ($pengeluaran as $p) {
            $data['nominal_pergi'] = $p->transport_pergi;
            $data['nominal_pulang'] = $p->transport_pulang;

            if ($p->berkas_pergi != "" || $p->berkas_pulang != "") {
                $data['berkas_tiket'] = 1;
            } else {
                $data['berkas_tiket'] = 0;
            }

            $data['nama_penginapan'] = $p->nama_penginapan;
            $data['tgl_check_in'] = $p->tgl_check_in;
            $data['tgl_check_out'] = $p->tgl_check_out;
            $data['nominal_penginapan'] = $p->penginapan;

            if ($p->berkas_penginapan != "") {
                $data['berkas_penginapan'] = 1;
            } else {
                $data['berkas_penginapan'] = 0;
            }

            $data['nominal_bagasi'] = $p->bagasi;

            if ($p->berkas_bagasi != "") {
                $data['berkas_bagasi'] = 1;
            } else {
                $data['berkas_bagasi'] = 0;
            }

            $data['total_biaya'] = $p->transport_pergi + $p->transport_pulang + $p->penginapan + $p->bagasi;
        }

        //save log
        $this->log_lib->log_info("cetak pelaporan sppd $kode");

        if ($cetak == "yes") {
            $this->load->view('frontend/cetak', $data);

            //$mpdf->Output(); // opens in browser
        } else {
            $mpdf = new mPDF('utf-8', 'A4', 11, 'Times');
            $html = $this->load->view('frontend/cetak', $data, true);
            $mpdf->WriteHTML($html);

            $nama_file = $data['kd_sppd'] . ".pdf";

            $mpdf->Output($nama_file, 'F');

            //$mpdf->Output('arjun.pdf', 'D'); // it downloads the file into the user system, with give name
        }
    }
}
