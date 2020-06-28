<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('stat_log') == "") {
            redirect(base_url("login"));
        }

        $this->load->model('mod_unit');
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
        $jumlah_data = $this->mod_unit->jumlah_data($q_cari);

        if ($this->input->post('limitpage') == "") {
            $limit = 10;
            $limit_start = ($page - 1) * 10;
        } else {
            $limit = $this->input->post('limitpage');
            $limit_start = ($page - 1) * $limit;
        }

        $data['limit'] = $limit;

        $unit = $this->mod_unit->daftar($limit_start, $limit, $q_cari)->result();

        $record = array();
        $subrecord = array();
        foreach ($unit as $s) {
            $nama = $this->clear_string->clear_quotes($s->nama);

            $subrecord['nama'] = strtoupper($nama);

            array_push($record, $subrecord);
        }
        $data['unit'] = json_encode($record);

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
        $this->log_lib->log_info("Akses halaman pengaturan unit");

        $this->load->view('body/body_atas');
        $this->load->view('body/menu_kiri');
        $this->load->view('backend/unit', $data);
        $this->load->view('body/body_bawah');
    }

    public function proses($proses = 1, $unit = "")
    {
        $unit_awal = $this->input->post('unit_awal');
        $nama = strtoupper($this->input->post('nama'));

        $nama_unit = $this->clear_string->clear_quotes($nama);

        $cek_nama = $this->mod_unit->cek_nama($nama_unit);

        switch ($proses) {
            case 1:
                if ($cek_nama == 0) {
                    $this->mod_unit->simpan($nama_unit);
                    $pesan = 1;
                    $isipesan = "Data unit baru di tambahkan dengan nama $nama_unit";
                } else {
                    $pesan = 4;
                    $isipesan = "Unit dengan nama $nama_unit sudah terdaftar";
                }
                break;
            case 2:
                if (($unit_awal != $nama_unit && $cek_nama == 0) || $unit_awal == $nama_unit) {
                    $this->mod_unit->hapus($unit_awal);
                    $this->mod_unit->simpan($nama_unit);
                    $pesan = 2;
                    $isipesan = "Data unit dengan nama unit $nama_unit diubah, sebelumnya $unit_awal";
                } else {
                    $pesan = 4;
                    $isipesan = "Unit dengan nama $nama_unit sudah terdaftar";
                }
                break;
            case 3:
                $nama_unit = str_replace("%20", " ", $unit);
                $this->mod_unit->hapus($nama_unit);
                $pesan = 3;
                $isipesan = "Unit dengan nama $unit telah dihapus ";
                break;
        }

        $msg = str_replace(" ", "-", $isipesan);

        //save log
        $this->log_lib->log_info($isipesan);

        redirect("unit/index/1/-/$pesan/$msg");
    }
}
