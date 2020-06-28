<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('stat_log') == "") {
            redirect(base_url("login"));
        }

        $this->load->model('mod_dashboard');
    }

    public function index()
    {
        $data['baru'] = $this->mod_dashboard->baru();
        $data['proses'] = $this->mod_dashboard->proses();
        $data['selesai'] = $this->mod_dashboard->selesai();

        $this->load->view('body/body_atas');
        $this->load->view('body/menu_kiri');
        $this->load->view('backend/dashboard', $data);
        $this->load->view('body/body_bawah');
    }
}
