<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasiemail extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('mod_verifikasi');
    }

    public function proses($persno)
    {
        $this->mod_verifikasi->verifikasi($persno);

        $this->load->view('backend/verifikasi');
    }
}
