<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Emailsender extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('stat_log') == "") {
            redirect(base_url("login"));
        }

        $this->load->model('mod_email_sender');
    }

    public function index($pesan = "", $isipesan = "")
    {
        $data['alert'] = $this->alert_lib->alert($pesan, urldecode($isipesan));

        /*-----------------------------tarik data pegawai-------------------------------------------------------*/
        $smtp = $this->mod_email_sender->daftar()->result();
        foreach ($smtp as $s) {
            $data['host'] = $s->host;
            $data['email'] = $s->email;
            $data['password'] = $s->password;
            $data['port'] = $s->port;
            $data['ssl'] = $s->ssl;
            if ($s->ssl == 0) {
                $data['ssl_set'] = "Tidak";
                $data['checked'] = "";
            } else {
                $data['ssl_set'] = "Ya";
                $data['checked'] = "checked";
            }
        }
        /*-------------------------------end-------------------------------------------*/

        //save log
        $this->log_lib->log_info("Akses halaman pengaturan email sender");

        $this->load->view('body/body_atas');
        $this->load->view('body/menu_kiri');
        $this->load->view('backend/emailsender', $data);
        $this->load->view('body/body_bawah');
    }

    public function proses()
    {
        $host = $this->input->post('host');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $port =  $this->input->post('port');
        $ssl = $this->input->post('ssl', true) == null ? 0 : 1;

        $data = array(
            "host" => $host,
            "email" => $email,
            "password" => $password,
            "port" => $port,
            "ssl" => $ssl
        );

        $this->mod_email_sender->hapus();
        $this->mod_email_sender->simpan($data);

        $pesan = 2;
        $isipesan = "Pengaturan Email Sender tersimpan, silakan melakukan testing pengiriman email";

        $msg = str_replace(" ", "-", $isipesan);

        //save log
        $this->log_lib->log_info($isipesan);

        redirect("emailsender/index/$pesan/$msg");
    }

    public function teskirim()
    {
        $email_target = $this->input->post('email_testing');
        $judul = "Tes pengiriman email (noreply)";
        $isi = "Ini adalah email tes dari server untuk keperluan alert aplikasi.";

        $proses = $this->kirim_email->email($email_target, $judul, $isi);

        $pesan = 2;
        $isipesan = "Hasil tes $proses ke $email_target ";

        $msg = str_replace(" ", "-", $isipesan);

        //save log
        $this->log_lib->log_info($isipesan);

        redirect("emailsender/index/$pesan/$msg");
    }
}
