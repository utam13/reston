<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bidang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('stat_log') == "") {
            redirect(base_url("login"));
        }

        $this->load->model('mod_bidang');
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
        $jumlah_data = $this->mod_bidang->jumlah_data($q_cari);

        if ($this->input->post('limitpage') == "") {
            $limit = 10;
            $limit_start = ($page - 1) * 10;
        } else {
            $limit = $this->input->post('limitpage');
            $limit_start = ($page - 1) * $limit;
        }

        $data['limit'] = $limit;

        $bidang = $this->mod_bidang->daftar($limit_start, $limit, $q_cari)->result();

        $record = array();
        $subrecord = array();
        foreach ($bidang as $s) {
            $nama = $this->clear_string->clear_quotes($s->nama);

            $subrecord['nama'] = strtoupper($nama);

            array_push($record, $subrecord);
        }
        $data['bidang'] = json_encode($record);

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
        $this->log_lib->log_info("Akses halaman pengaturan bidang");

        $this->load->view('body/body_atas');
        $this->load->view('body/menu_kiri');
        $this->load->view('backend/bidang', $data);
        $this->load->view('body/body_bawah');
    }

    public function proses($proses = 1, $bidang = "")
    {
        $bidang_awal = $this->input->post('bidang_awal');
        $nama = strtoupper($this->input->post('nama'));

        $nama_bidang = $this->clear_string->clear_quotes($nama);

        $cek_nama = $this->mod_bidang->cek_nama($nama_bidang);

        switch ($proses) {
            case 1:
                if ($cek_nama == 0) {
                    $this->mod_bidang->simpan($nama_bidang);
                    $pesan = 1;
                    $isipesan = "Data bidang baru di tambahkan dengan nama $nama_bidang";
                } else {
                    $pesan = 4;
                    $isipesan = "Bidang dengan nama $nama_bidang sudah terdaftar";
                }
                break;
            case 2:
                if (($bidang_awal != $nama_bidang && $cek_nama == 0) || $bidang_awal == $nama_bidang) {
                    $this->mod_bidang->hapus($bidang_awal);
                    $this->mod_bidang->simpan($nama_bidang);
                    $pesan = 2;
                    $isipesan = "Data bidang dengan nama bidang $nama_bidang diubah, sebelumnya $bidang_awal";
                } else {
                    $pesan = 4;
                    $isipesan = "Bidang dengan nama $nama_bidang sudah terdaftar";
                }
                break;
            case 3:
                $nama_bidang = str_replace("-", " ", $bidang);
                $this->mod_bidang->hapus($nama_bidang);
                $pesan = 3;
                $isipesan = "Bidang dengan nama $bidang telah dihapus ";
                break;
        }

        $msg = str_replace(" ", "-", $isipesan);

        //save log
        $this->log_lib->log_info($isipesan);

        redirect("bidang/index/1/-/$pesan/$msg");
    }
}
