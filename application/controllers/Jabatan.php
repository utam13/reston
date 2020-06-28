<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('stat_log') == "") {
            redirect(base_url("login"));
        }

        $this->load->model('mod_jabatan');
    }

    public function index($page = 1, $isicari = "-", $pesan = "", $isipesan = "")
    {
        //cari
        if ($isicari != "-") {
            $cari = str_replace("-", " ", $isicari);
        } else {
            $cari =  $this->clear_string->clear_quotes($this->input->post('cari'));
        }

        if ($cari != "") {
            $q_cari = "nama like '%$cari%'";
        } else {
            $q_cari = "nama<>''";
        }

        $data['cari'] =  $cari;

        $data['alert'] = $this->alert_lib->alert($pesan, $isipesan);

        //pagination
        $jumlah_data = $this->mod_jabatan->jumlah_data($q_cari);

        if ($this->input->post('limitpage') == "") {
            $limit = 10;
            $limit_start = ($page - 1) * 10;
        } else {
            $limit = $this->input->post('limitpage');
            $limit_start = ($page - 1) * $limit;
        }

        $data['limit'] = $limit;

        $jabatan = $this->mod_jabatan->daftar($limit_start, $limit, $q_cari)->result();

        $record = array();
        $subrecord = array();
        foreach ($jabatan as $b) {
            $nama = $this->clear_string->clear_quotes($b->nama);

            $subrecord['nama'] = strtoupper($nama);
            $subrecord['approval'] = $b->approval;

            switch ($b->approval) {
                case 0:
                    $subrecord['status_approval'] = "Tidak";
                    break;
                case 1:
                    $subrecord['status_approval'] = "Ya";
                    break;
            }

            array_push($record, $subrecord);
        }
        $data['jabatan'] = json_encode($record);

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
        $this->log_lib->log_info("Akses halaman pengaturan jabatan");

        $this->load->view('body/body_atas');
        $this->load->view('body/menu_kiri');
        $this->load->view('backend/jabatan', $data);
        $this->load->view('body/body_bawah');
    }

    public function proses($proses = 1, $jabatan = "")
    {
        $jabatan_awal = $this->input->post('jabatan_awal');
        $nama = strtoupper($this->input->post('nama'));
        $approval = strtoupper($this->input->post('approval'));

        $nama = $this->clear_string->clear_quotes($nama);

        $cek_nama = $this->mod_jabatan->cek_nama($nama);

        switch ($proses) {
            case 1:
                if ($cek_nama == 0) {
                    $this->mod_jabatan->simpan($nama, $approval);
                    $pesan = 1;
                    $isipesan = "Data jabatan baru di tambahkan dengan nama $nama";
                } else {
                    $pesan = 4;
                    $isipesan = "Jabatan dengan nama $nama sudah terdaftar";
                }
                break;
            case 2:
                if (($jabatan_awal != $nama && $cek_nama == 0) || $jabatan_awal == $nama) {
                    $this->mod_jabatan->hapus($jabatan_awal);
                    $this->mod_jabatan->simpan($nama, $approval);
                    $pesan = 2;
                    $isipesan = "Data jabatan dengan nama $nama diubah, sebelumnya $jabatan_awal";
                } else {
                    $pesan = 4;
                    $isipesan = "Jabatan dengan nama $nama sudah terdaftar";
                }
                break;
            case 3:
                $nama = str_replace("-", " ", $jabatan);
                $this->mod_jabatan->hapus($nama);
                $pesan = 3;
                $isipesan = "Jabatan dengan nama $jabatan telah dihapus ";
                break;
        }

        $msg = str_replace(" ", "-", $isipesan);

        //save log
        $this->log_lib->log_info($isipesan);

        redirect("jabatan/index/1/-/$pesan/$msg");
    }
}
