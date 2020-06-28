<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aktifitas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('stat_log') == "") {
            redirect(base_url("login"));
        }

        $this->load->model('mod_aktifitas');
    }

    public function index($page = 1, $isicari = "-")
    {
        //cari
        if ($isicari != "-") {
            $cari = urldecode($isicari);
        } else {
            $cari =  $this->input->post('cari');
        }

        if ($cari != "") {
            $q_cari = "infolog like '%$cari%'";
        } else {
            $q_cari = "waktulog<>''";
        }

        $data['cari'] =  $cari;

        //pagination
        $jumlah_data = $this->mod_aktifitas->jumlah_data($q_cari);

        $limit = 10;
        $limit_start = ($page - 1) * $limit;

        $data['log'] = $this->mod_aktifitas->daftar($limit_start, $limit, $q_cari)->result();

        $data['page'] = $page;
        $data['limit'] = $limit;
        $data['get_jumlah'] = $jumlah_data;
        $data['jumlah_page'] = ceil($jumlah_data / $limit);
        $data['jumlah_number'] = 3;
        $data['start_number'] = ($page > $data['jumlah_number']) ? $page - $data['jumlah_number'] : 1;
        $data['end_number'] = ($page < ($data['jumlah_page'] - $data['jumlah_number'])) ? $page + $data['jumlah_number'] : $data['jumlah_page'];

        $data['no'] = $limit_start + 1;
        //end

        //save log
        $this->log_lib->log_info("Akses halaman log aktifitas user");

        $this->load->view('body/body_atas');
        $this->load->view('body/menu_kiri');
        $this->load->view('backend/aktifitas', $data);
        $this->load->view('body/body_bawah');
    }

    public function laporan()
    {
        $data['log'] = $this->mod_aktifitas->laporan()->result();

        $this->load->view('backend/laporan_aktifitas', $data);
    }

    public function hapus()
    {
        $this->mod_aktifitas->hapus();

        redirect("aktifitas");
    }
}
