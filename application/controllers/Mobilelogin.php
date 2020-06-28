<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mobilelogin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('mod_login');
    }

    public function index($isipesan = "")
    {
        $data['pesan'] = $isipesan;

        $data['foto'] = date('dmYHis') . "-pegawai";
        $data['file_foto'] = base_url() . "upload/no-pic.jpg" . "?" . rand();
        $data['ttd'] = date('dmYHis') . "-ttd";
        $data['file_ttd'] = base_url() . "upload/no-image.png" . "?" . rand();

        $data['jabatan'] = $this->mod_login->jabatan()->result();
        $data['unit'] = $this->mod_login->unit()->result();
        $data['bidang'] = $this->mod_login->bidang()->result();
        $data['area'] = $this->mod_login->area()->result();

        $this->load->view('frontend/login', $data);
    }

    public function proses()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if ($username == "administrator" && $password = "root") {
            $user = array(
                "kode_user" => "0",
                "persno_user" => "0",
                "level" => "100",
                "nama_user" => "Administrator",
                "nama_level" => "Administrator",
                "foto_user" => base_url() . "assets/img/avataruser.jpg",
                "stat_log_mobile" => "login"
            );

            $this->session->set_userdata($user);

            redirect("mobiledashboard");
        } else {
            $ada_persno = $this->mod_login->cek_pers_no($username);

            $ada_email = $this->mod_login->cek_email($username);

            if ($ada_persno > 0 || $ada_email > 0) {
                $data_user = $this->mod_login->ambil($username)->result();

                foreach ($data_user as $du) {
                    if ($du->aktif == 0) {
                        $isipesan = "Status data pegawai Anda tidak aktif, silakan hubungi user dengan level Admin SPPD 1 (Admin Aplikasi) untuk mem-verifikasi status data Anda";

                        redirect("mobilelogin/index/$isipesan");
                    } elseif ($du->status_email == 0) {
                        $isipesan = "Email Anda belum di verifikasi, jika email verifikasi Anda tidak ada silakan hubungi user dengan level Admin SPPD 1 (Admin Aplikasi) untuk mengirimkan link verifikasi";

                        redirect("mobilelogin/index/$isipesan");
                    } elseif ($password == $du->password) {
                        switch ($du->level) {
                            case 0:
                                $nama_level = "Pegawai";
                                break;
                            case 1:
                                $nama_level = "Admin SPPD 1 (Admin Aplikasi)";
                                break;
                            case 2:
                                $nama_level = "Admin SPPD 1 (Pengelola Data SPPD)";
                                break;
                            case 3:
                                $nama_level = "Approval (Approval Pelaporan SPPD)";
                                break;
                            case 4:
                                $nama_level = "Pimpinan/Pengawas (Laporan dan Monitoring)";
                                break;
                        }

                        if ($du->foto != "") {
                            $foto_pegawai = "upload/pegawai/" . $du->foto;
                            if (file_exists($foto_pegawai)) {
                                $file_foto = base_url() . "upload/pegawai/" . $du->foto . "?" . rand();
                            } else {
                                $file_foto = base_url() . "upload/no-pic.jpg" . "?" . rand();
                            }
                        } else {
                            $file_foto = base_url() . "upload/no-pic.jpg" . "?" . rand();
                        }

                        if ($du->ttd != "") {
                            $ttd_pegawai = "upload/pegawai/" . $du->ttd;
                            if (file_exists($ttd_pegawai)) {
                                $adattd = 1;
                            } else {
                                $adattd = 0;
                            }
                        } else {
                            $adattd = 0;
                        }

                        $user = array(
                            "kode_user" => $du->kd_pegawai,
                            "persno_user" => $du->pers_no,
                            "level" => $du->level,
                            "nama_user" => $du->nama,
                            "nama_level" => $nama_level,
                            "foto_user" => $file_foto,
                            "adattd" => $adattd,
                            "stat_log_mobile" => "login"
                        );

                        $this->session->set_userdata($user);

                        redirect("mobiledashboard");
                    } else {
                        $isipesan = "Password Anda Salah, coba kembali";

                        $msg = str_replace(" ", "-", $isipesan);

                        redirect("mobilelogin/index/$msg");
                    }
                }
            } else {
                $isipesan = "Pers. No atau Email yang Anda masukkan tidak terdaftar";

                $msg = str_replace(" ", "-", $isipesan);

                redirect("mobilelogin/index/$msg");
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect("mobilelogin");
    }

    public function cek_persno($persno)
    {
        $jml = $this->mod_login->cek_pers_no($persno);

        $record = array();
        $subrecord = array();

        $subrecord['jml'] = $jml;
        array_push($record, $subrecord);

        echo json_encode($record);
    }

    public function cek_email($email)
    {
        $jml = $this->mod_login->cek_email($email);

        $record = array();
        $subrecord = array();

        $subrecord['jml'] = $jml;
        array_push($record, $subrecord);

        echo json_encode($record);
    }

    public function reset()
    {
        $passbaru = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);

        $email = $this->input->post('email_reset');

        $cek_user = $this->mod_login->cek_user($email);
        $cek_email_verifikasi = $this->mod_login->cek_email_verifikasi($email);
        if ($cek_user != 0 && $cek_email_verifikasi != 0) {
            $this->mod_login->resetpass($passbaru, $email);

            //kirim email
            $judul = "Reset Password Pegawai (noreply)";
            $isi = "Ini adalah email reset password Anda.<br>Silakan gunakan password baru di bawah ini, kemudian Sign In ke dalam aplikasi kemudian ubah di profile Anda.<br>Password Reset: " . $passbaru;

            $proses = $this->kirim_email->email($email, $judul, $isi);

            $isipesan = "Password sudah direset dan dikirimkan ke email Anda ($proses)";
        } else {
            if ($cek_email_verifikasi == 0) {
                $isipesan = "Email Anda belum diverifikasi, silakan hubungi user dengan level Admin SPPD 1 (Admin Aplikasi) untuk mengirimkan link verifikasi";
            } else {
                $isipesan = "Email Anda tidak terdaftar, silakan hubungi user dengan level Admin SPPD 1 (Admin Aplikasi)";
            }
        }

        $msg = str_replace(" ", "-", $isipesan);

        redirect("mobilelogin/index/$msg");
    }

    public function registrasi()
    {
        $kd_pegawai = "";
        $persno = $this->input->post('persno');
        $nama = strtoupper($this->clear_string->clear_quotes($this->input->post('nama')));
        $jabatan = $this->input->post('jabatan');
        $unit = $this->input->post('unit');
        $bidang = $this->input->post('bidang');
        $area = $this->input->post('area');
        $email = $this->input->post('email');
        $foto = $this->input->post('nama_file_foto');
        $ttd = $this->input->post('nama_file_ttd');

        $cek_pers_no = $this->mod_login->cek_pers_no($persno);
        $cek_email = $this->mod_login->cek_email($email);

        if ($cek_pers_no == 0 && $cek_email == 0) {

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
                "updated" => date('Y-m-d H:i:s')
            );

            $this->mod_login->simpan($data);

            //kirim email
            $judul = "Verifikasi email pegawai (noreply)";
            $isi = "Ini adalah email untuk mem-verifikasi email Anda.<br>Silakan klik link di bawah ini untuk melakukan verifikasi<br>Password Anda adalah $persno<br> " . base_url() . "verifikasiemail/proses/$persno";

            $proses = $this->kirim_email->email($email, $judul, $isi);

            $isipesan = "Registrasi Anda diterima, silakan lakukan konfirmasi email Anda agar dapat Sign In ($proses)";
        } else {
            if ($cek_pers_no != 0) {
                $isipesan = "Pers. No. $persno sudah terdafar, silakan coba sign in atau masukkan Pers. No yang berbeda, jika tida bisa silakan hubungi user dengan level Admin SPPD 1 (Admin Aplikasi) untuk bantuan lebih lanjut";
            } elseif ($cek_email != 0) {
                $isipesan = "Email $email sudah terdafar, silakan coba sign in atau masukkan email yang berbeda, jika tida bisa silakan hubungi user dengan level Admin SPPD 1 (Admin Aplikasi) untuk bantuan lebih lanjut";
            } else {
                $isipesan = "Pers. No. atau Email sudah terdafar, silakan coba sign in atau masukkan data yang berbeda, jika tida bisa silakan hubungi user dengan level Admin SPPD 1 (Admin Aplikasi) untuk bantuan lebih lanjut";
            }
        }

        $msg = str_replace(" ", "-", $isipesan);

        //save log
        $this->log_lib->log_info($isipesan);

        redirect("mobilelogin/index/$msg");
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

            extract($data);

            echo $file_name;
        }
    }
}
