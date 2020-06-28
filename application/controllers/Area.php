<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Area extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('stat_log') == "") {
            redirect(base_url("login"));
        }

        $this->load->model('mod_area');
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
            $q_cari = "nomor like '%$cari%'";
        } else {
            $q_cari = "nomor<>''";
        }

        $data['cari'] =  $cari;

        $data['alert'] = $this->alert_lib->alert($pesan, $isipesan);

        //pagination
        $jumlah_data = $this->mod_area->jumlah_data($q_cari);

        if ($this->input->post('limitpage') == "") {
            $limit = 10;
            $limit_start = ($page - 1) * 10;
        } else {
            $limit = $this->input->post('limitpage');
            $limit_start = ($page - 1) * $limit;
        }

        $data['limit'] = $limit;

        $area = $this->mod_area->daftar($limit_start, $limit, $q_cari)->result();

        $record = array();
        $subrecord = array();
        foreach ($area as $s) {
            $subrecord['nomor'] = strtoupper($s->nomor);

            array_push($record, $subrecord);
        }
        $data['area'] = json_encode($record);

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
        $this->log_lib->log_info("Akses halaman pengaturan business area");

        $this->load->view('body/body_atas');
        $this->load->view('body/menu_kiri');
        $this->load->view('backend/area', $data);
        $this->load->view('body/body_bawah');
    }

    public function proses($proses = 1, $area = "")
    {
        $area_awal = $this->input->post('area_awal');
        $nama = strtoupper($this->input->post('nama'));

        $nama_area = $this->clear_string->clear_quotes($nama);

        $cek_nama = $this->mod_area->cek_nama($nama_area);

        switch ($proses) {
            case 1:
                if ($cek_nama == 0) {
                    $this->mod_area->simpan($nama_area);
                    $pesan = 1;
                    $isipesan = "Data area baru di tambahkan dengan kode $nama_area";
                } else {
                    $pesan = 4;
                    $isipesan = "Area dengan kode $nama_area sudah terdaftar";
                }
                break;
            case 2:
                if (($area_awal != $nama_area && $cek_nama == 0) || $area_awal == $nama_area) {
                    $this->mod_area->hapus($area_awal);
                    $this->mod_area->simpan($nama_area);
                    $pesan = 2;
                    $isipesan = "Data area dengan kode $nama_area diubah, sebelumnya $area_awal";
                } else {
                    $pesan = 4;
                    $isipesan = "Area dengan kode $nama_area sudah terdaftar";
                }
                break;
            case 3:
                $nama_area = str_replace("-", " ", $area);
                $this->mod_area->hapus($nama_area);
                $pesan = 3;
                $isipesan = "Area dengan kode $area telah dihapus ";
                break;
        }

        $msg = str_replace(" ", "-", $isipesan);

        //save log
        $this->log_lib->log_info($isipesan);

        redirect("area/index/1/-/$pesan/$msg");
    }
}
