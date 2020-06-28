<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('stat_log') == "") {
            redirect(base_url("login"));
        }

        $this->load->model('mod_profil');
    }

    public function index($kode = "", $pesan = "", $isipesan = "")
    {
        $data['alert'] = $this->alert_lib->alert($pesan, $isipesan);

        $pegawai = $this->mod_profil->daftar($kode)->result();
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
            $data['password'] = $p->password;

            if ($p->foto != "" && substr_count($p->foto, "data:image/png;base64") == 0) {
                $foto_pegawai = "upload/pegawai/" . $p->foto;
                if (file_exists($foto_pegawai)) {
                    $data['foto'] = $p->foto;
                    $data['file_foto'] = base_url() . "upload/pegawai/" . $p->foto . "?" . rand();
                } else {
                    $data['foto'] = date('dmYHis') . "-pegawai";
                    $data['file_foto'] = base_url() . "upload/no-pic.jpg" . "?" . rand();
                }
            } elseif (substr_count($p->foto, "data:image/png;base64") > 0) {
                $data['foto'] = date('dmYHis') . "-pegawai";
                $data['file_foto'] = $p->foto;
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
                $data['ttd'] = date('dmYHis') . "-ttd";
                $data['file_ttd'] = $p->ttd;
            } else {
                $data['ttd'] = date('dmYHis') . "-ttd";
                $data['file_ttd'] = base_url() . "upload/no-image.png" . "?" . rand();
            }
        }

        $data['jabatan'] = $this->mod_profil->jabatan()->result();
        $data['unit'] = $this->mod_profil->unit()->result();
        $data['bidang'] = $this->mod_profil->bidang()->result();
        $data['area'] = $this->mod_profil->area()->result();

        //save log
        $this->log_lib->log_info("Akses halaman formulir pegawai");

        $this->load->view('body/body_atas');
        $this->load->view('body/menu_kiri');
        $this->load->view('backend/profil', $data);
        $this->load->view('body/body_bawah');
    }

    public function cek_persno($persno)
    {
        $jml = $this->mod_profil->cek_pers_no($persno);

        $record = array();
        $subrecord = array();

        $subrecord['jml'] = $jml;
        array_push($record, $subrecord);

        echo json_encode($record);
    }

    public function cek_email($email)
    {
        $jml = $this->mod_profil->cek_email($email);

        $record = array();
        $subrecord = array();

        $subrecord['jml'] = $jml;
        array_push($record, $subrecord);

        echo json_encode($record);
    }

    public function proses()
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
        $password = $this->input->post('password');

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
            "password" => $password,
            "updated" => date('Y-m-d H:i:s')
        );

        $this->mod_profil->ubah($data);
        $pesan = 2;
        $isipesan = "Data pegawai telah diubah";

        $msg = str_replace(" ", "-", $isipesan);

        //save log
        $this->log_lib->log_info($isipesan);

        redirect("profil/index/$pesan/$msg");
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
            $config['width'] = 300;
            $config['height'] = 400;
            $config['new_image'] = './upload/pegawai/' . $data['file_name'];
            $this->load->library('image_lib', $config);
            if (!$this->image_lib->resize()) {
                echo $this->image_lib->display_errors();
            }

            extract($data);

            echo $file_name;
        }
    }
}
