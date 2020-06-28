<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mobiledashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('stat_log_mobile') == "") {
            redirect(base_url("mobilelogin"));
        }

        $this->load->model('mod_mobile_dashboard');
    }

    public function index()
    {
        if ($this->session->userdata('level') == 3) {
            $data['notif_approve'] = $this->mod_mobile_dashboard->butuh_approve($this->session->userdata('kode_user'));
        }
        $data['baru'] = $this->mod_mobile_dashboard->baru($this->session->userdata('kode_user'));
        $data['proses'] = $this->mod_mobile_dashboard->proses($this->session->userdata('kode_user'));
        $data['selesai'] = $this->mod_mobile_dashboard->selesai($this->session->userdata('kode_user'));

        $this->load->view('body/mobile_body_atas');
        $this->load->view('frontend/dashboard', $data);
        $this->load->view('body/mobile_body_bawah');
    }
}
