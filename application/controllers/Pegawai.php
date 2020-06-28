<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('stat_log') == "") {
            redirect(base_url("login"));
        }

        $this->load->model('mod_pegawai');
    }

    public function index($page = 1, $isicari = "-", $katcari = "-", $pesan = "", $isipesan = "")
    {
        //cari
        if ($isicari != "-") {
            $cari = str_replace("-", " ", $isicari);
            $kategori = $katcari;
        } else {
            $cari =  $this->clear_string->clear_quotes($this->input->post('cari'));
            $kategori = $this->input->post('kategori');
        }

        if ($cari != "") {
            $q_cari = "$kategori like '%$cari%'";
        } else {
            $q_cari = "pers_no<>''";
        }

        $data['cari'] =  $cari;
        $data['kategori'] =  $kategori;

        $data['alert'] = $this->alert_lib->alert($pesan, $isipesan);

        //pagination
        $jumlah_data = $this->mod_pegawai->jumlah_data($q_cari);

        if ($this->input->post('limitpage') == "") {
            $limit = 10;
            $limit_start = ($page - 1) * 10;
        } else {
            $limit = $this->input->post('limitpage');
            $limit_start = ($page - 1) * $limit;
        }

        $data['limit'] = $limit;

        $pegawai = $this->mod_pegawai->daftar($limit_start, $limit, $q_cari)->result();

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

            switch ($p->level) {
                case 0:
                    $subrecord['level'] = "Pegawai";
                    break;
                case 1:
                    $subrecord['level'] = "Admin SPPD 1 (Admin Aplikasi)";
                    break;
                case 2:
                    $subrecord['level'] = "Admin SPPD 1 (Pengelola Data SPPD)";
                    break;
                case 3:
                    $subrecord['level'] = "Approval (Approval Pelaporan SPPD)";
                    break;
                case 4:
                    $subrecord['level'] = "Pimpinan/Pengawas (Laporan dan Monitoring)";
                    break;
            }

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
                    $data['ttd'] = $p->ttd;
                    $data['file_ttd'] = base_url() . "upload/pegawai/" . $p->ttd . "?" . rand();
                } else {
                    $data['ttd'] = date('dmYHis') . "-ttd";
                    $data['file_ttd'] = base_url() . "upload/no-image.png" . "?" . rand();
                }
            } elseif (substr_count($p->ttd, "data:image/png;base64") > 0) {
                $data['ttd'] = $p->ttd;
                $data['file_ttd'] = $p->ttd;
            } else {
                $data['ttd'] = date('dmYHis') . "-ttd";
                $data['file_ttd'] = base_url() . "upload/no-image.png" . "?" . rand();
            }

            /*
            switch ($p->status_email) {
                case "0":
                    $subrecord['status_email'] = "Belum diverifikasi";
                    $subrecord['btn_email'] = "btn-danger";
                    break;
                case "1":
                    $subrecord['status_email'] = "Sudah diverifikasi";
                    $subrecord['btn_email'] = "btn-success";
                    break;
            }
            */

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

        //save log
        $this->log_lib->log_info("Akses halaman pegawai");

        $this->load->view('body/body_atas');
        $this->load->view('body/menu_kiri');
        $this->load->view('backend/pegawai', $data);
        $this->load->view('body/body_bawah');
    }

    public function formulir($proses, $kode = "")
    {
        $data['proses'] = $proses;

        switch ($proses) {
            case "1":
                $data['kd_pegawai'] = "";
                $data['pers_no'] = "";
                $data['nama'] = "";
                $data['data_jabatan'] = "";
                $data['data_unit'] = "";
                $data['data_bidang'] = "";
                $data['data_area'] = "";
                $data['email'] = "";
                $data['level'] = "";
                $data['foto'] = date('dmYHis') . "-pegawai";
                $data['file_foto'] = base_url() . "upload/no-pic.jpg" . "?" . rand();
                $data['ttd'] = date('dmYHis') . "-ttd";
                $data['file_ttd'] = base_url() . "upload/no-image.png" . "?" . rand();
                break;
            case "2":
                $pegawai = $this->mod_pegawai->ambil($kode)->result();
                foreach ($pegawai as $p) {
                    $nama_pegawai = $this->clear_string->clear_quotes($p->nama);

                    $data['kd_pegawai'] = $p->kd_pegawai;
                    $data['pers_no'] = $p->pers_no;
                    $data['nama'] = $nama_pegawai;
                    $data['data_jabatan'] = $p->jabatan;
                    $data['data_unit'] = $p->unit;
                    $data['data_bidang'] = $p->bidang;
                    $data['data_area'] = $p->area;
                    $data['email'] = $p->email;
                    $data['level'] = $p->level;

                    if ($p->foto != "") {
                        $foto_pegawai = "upload/pegawai/" . $p->foto;
                        if (file_exists($foto_pegawai)) {
                            $data['foto'] = $p->foto;
                            $data['file_foto'] = base_url() . "upload/pegawai/" . $p->foto . "?" . rand();
                        } else {
                            $data['foto'] = date('dmYHis') . "-pegawai";
                            $data['file_foto'] = base_url() . "upload/no-pic.jpg" . "?" . rand();
                        }
                    } else {
                        $data['foto'] = date('dmYHis') . "-pegawai";
                        $data['file_foto'] = base_url() . "upload/no-pic.jpg" . "?" . rand();
                    }

                    if ($p->ttd != "" && substr_count($p->ttd, "data:image/png;base64") == 0) {
                        $ttd_pegawai = "upload/pegawai/" . $p->ttd;
                        if (file_exists($ttd_pegawai)) {
                            $data['ttd'] = $p->ttd;
                            $data['file_ttd'] = base_url() . "upload/pegawai/" . $p->ttd . "?" . rand();
                        } else {
                            $data['ttd'] = date('dmYHis') . "-ttd";
                            $data['file_ttd'] = base_url() . "upload/no-image.png" . "?" . rand();
                        }
                    } elseif (substr_count($p->ttd, "data:image/png;base64") > 0) {
                        $data['ttd'] = date('dmYHis') . "-pegawai";
                        $data['file_ttd'] = $p->ttd;
                    } else {
                        $data['ttd'] = date('dmYHis') . "-ttd";
                        $data['file_ttd'] = base_url() . "upload/no-image.png" . "?" . rand();
                    }
                }
                break;
        }

        $data['jabatan'] = $this->mod_pegawai->jabatan()->result();
        $data['unit'] = $this->mod_pegawai->unit()->result();
        $data['bidang'] = $this->mod_pegawai->bidang()->result();
        $data['area'] = $this->mod_pegawai->area()->result();

        //save log
        $this->log_lib->log_info("Akses halaman formulir pegawai");

        $this->load->view('body/body_atas');
        $this->load->view('body/menu_kiri');
        $this->load->view('backend/formpegawai', $data);
        $this->load->view('body/body_bawah');
    }

    public function cek_persno($persno)
    {
        $jml = $this->mod_pegawai->cek_pers_no($persno);

        $record = array();
        $subrecord = array();

        $subrecord['jml'] = $jml;
        array_push($record, $subrecord);

        echo json_encode($record);
    }

    public function cek_email($email)
    {
        $jml = $this->mod_pegawai->cek_email($email);

        $record = array();
        $subrecord = array();

        $subrecord['jml'] = $jml;
        array_push($record, $subrecord);

        echo json_encode($record);
    }

    public function proses($proses = 1, $kode = "", $pers_no = "", $nama_pegawai = "", $status = "")
    {
        $kd_pegawai = $this->input->post('kode');
        $persno = $this->input->post('persno');
        $nama = strtoupper($this->clear_string->clear_quotes($this->input->post('nama')));
        $jabatan = $this->input->post('jabatan');
        $unit = $this->input->post('unit');
        $bidang = $this->input->post('bidang');
        $area = $this->input->post('area');
        $email = $this->input->post('email');
        $foto = $this->input->post('nama_file_foto');
        $ttd = $this->input->post('nama_file_ttd');
        $level = $this->input->post('level');

        $data = array(
            "kd_pegawai" => $kd_pegawai,
            "persno" => $persno,
            "nama" => $nama,
            "jabatan" => $jabatan,
            "unit" => $unit,
            "bidang" => $bidang,
            "area" => $area,
            "email" => $email,
            "foto" => $foto,
            "ttd" => $ttd,
            "level" => $level,
            "updated" => date('Y-m-d H:i:s')
        );

        switch ($proses) {
            case 1:
                $this->mod_pegawai->simpan($data);

                //kirim email
                $judul = "Verifikasi email pegawai (noreply)";
                $isi = "Ini adalah email untuk mem-verifikasi email Anda.<br>Silakan klik link di bawah ini untuk melakukan verifikasi<br>Password Anda adalah $persno<br> " . base_url() . "verifikasiemail/proses/$persno";

                $proses = $this->kirim_email->email($email, $judul, $isi);

                $pesan = 1;
                $isipesan = "Data pegawai baru di tambahkan,  $persno - $nama ($proses)";
                break;
            case 2:
                $this->mod_pegawai->ubah($data);
                $pesan = 2;
                $isipesan = "Data pegawai $persno - $nama diubah";
                break;
            case 3:
                $data_pegawai = $this->mod_pegawai->ambil_file($kode)->result();
                foreach ($data_pegawai as $dp) {
                    if ($dp->foto != "") {
                        $foto_pegawai = "upload/pegawai/" . $dp->foto;
                        if (file_exists($foto_pegawai)) {
                            unlink("./upload/pegawai/" . $dp->foto);
                        }
                    }

                    if ($dp->ttd != "") {
                        $ttd_pegawai = "upload/pegawai/" . $dp->ttd;
                        if (file_exists($ttd_pegawai)) {
                            unlink("./upload/pegawai/" . $dp->ttd);
                        }
                    }
                }

                $this->mod_pegawai->hapus($kode);
                $pesan = 3;
                $isipesan = "Pegawai $pers_no - $nama_pegawai telah dihapus ";
                break;
            case 4:
                if ($status == "1") {
                    $this->mod_pegawai->status_pegawai(0, $kode);
                    $pesan = 3;
                    $isipesan = "Pegawai $pers_no - $nama_pegawai telah di Non Aktifkan ";
                } else {
                    $this->mod_pegawai->status_pegawai(1, $kode);
                    $pesan = 2;
                    $isipesan = "Pegawai $pers_no - $nama_pegawai telah di Aktifkan ";
                }
                break;
        }

        $msg = str_replace(" ", "-", $isipesan);

        //save log
        $this->log_lib->log_info($isipesan);

        redirect("pegawai/index/1/-/-/$pesan/$msg");
    }

    public function upload($nama_file)
    {
        $config['upload_path']        = './upload/pegawai';
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
            $config['source_image'] = './upload/pegawai/' . $data['file_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['quality'] = '50%';
            $config['new_image'] = './upload/pegawai/' . $data['file_name'];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            extract($data);

            echo $data['file_name'];
        }
    }

    public function reset($kode_pegawai)
    {
        $passbaru = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);

        $data_pegawai = $this->mod_pegawai->ambil($kode_pegawai)->result();
        foreach ($data_pegawai as $dp) {
            $pers_no = $dp->pers_no;
            $nama = $dp->nama;
            $email_pegawai = $dp->email;
        }

        $data = array(
            "kode" => $kode_pegawai,
            "pers_no" => $pers_no,
            "pass" => $passbaru,
            "updated" => date("Y-m-d h:i:s")
        );

        $this->mod_pegawai->reset($data);

        $pesan = 2;
        $isipesan = "Reset password pegawai dengan NIP $pers_no atas nama $nama selesai dan dikirim ke email pegawai";

        //$hasil_email = $this->email($email_pegawai, "Reset Password Aplikasi Restitusi PLN", $isipesan . "<br><br><b style='color:red;'>noREPLY</b>");

        //$isipesan .= " ($hasil_email)";

        $msg = str_replace(" ", "-", $isipesan);

        //save log
        $this->log_lib->log_info($isipesan);

        redirect("pegawai/index/1/-/-/$pesan/$msg");

        //echo $hasil_email;
    }

    public function verifikasi($kode_pegawai)
    {
        $data_pegawai = $this->mod_pegawai->ambil($kode_pegawai)->result();
        foreach ($data_pegawai as $dp) {
            $persno = $dp->pers_no;
            $nama = $dp->nama;
            $email_pegawai = $dp->email;
        }

        //kirim email
        $judul = "Verifikasi email pegawai (noreply)";
        $isi = "Ini adalah email untuk mem-verifikasi email Anda.<br>Silakan klik link di bawah ini untuk melakukan verifikasi<br>" . base_url() . "verifikasiemail/proses/$persno";

        $proses = $this->kirim_email->email($email_pegawai, $judul, $isi);

        $pesan = 2;
        $isipesan = "Verifikasi email pegawai dengan NIP $persno atas nama $nama telah dikirim ($proses)";

        $msg = str_replace(" ", "-", $isipesan);

        //save log
        $this->log_lib->log_info($isipesan);

        redirect("pegawai/index/1/-/-/$pesan/$msg");
    }

    public function export()
    {
        $dari = $this->input->post('dari');
        $sampai = $this->input->post('sampai');
        $jenis = $this->input->post('jenis');

        if ($jenis == 1) {
            $pegawai = $this->mod_pegawai->export($dari, $sampai)->result();

            $record = array();
            $subrecord = array();
            foreach ($pegawai as $p) {
                $subrecord['kd_pegawai'] = $p->kd_pegawai;
                $subrecord['nip'] = $p->nip;
                $subrecord['nama'] = $p->nama;
                $subrecord['jabatan'] = $p->jabatan;
                $subrecord['unit'] = $p->unit;
                $subrecord['rek'] = $p->rek;
                $subrecord['bank'] = $p->bank;
                $subrecord['email'] = $p->email;
                $subrecord['update'] = $p->update;

                if ($p->status_email == 0) {
                    $subrecord['info_status_email'] = "Email belum diverifikasi";
                } else {
                    $subrecord['info_status_email'] = "Email sudah diverifikasi";
                }

                array_push($record, $subrecord);
            }
            $data['pegawai'] = json_encode($record);

            $data['jenis'] = 1;
            $data['judul'] = "Data Pegawai";

            $this->load->view('backend/download', $data);
        } else {
            $this->load->library('zip');

            $pegawai = $this->mod_pegawai->export($dari, $sampai)->result();

            $count = 0;
            foreach ($pegawai as $row) {
                if ($row->foto != "") {
                    $foto_pegawai = "upload/pegawai/" . $row->foto;
                    if (file_exists($foto_pegawai)) {
                        $fileName = "upload/pegawai/" . $row->foto;

                        $this->zip->read_file($fileName);

                        $count++;
                    }
                }
            }

            if ($count > 0) {
                $filename = "Foto-Pegawai-" . date('dmYHis') . ".zip";
                $this->zip->download($filename);
            } else {
                $pesan = 3;
                $isipesan = "Tidak ada foto yang dapat di download";

                $msg = str_replace(" ", "-", $isipesan);

                redirect("pegawai/index/1/-/-/$pesan/$msg");
            }
        }
    }
}
