<?
class mod_sppd extends CI_Model
{
    public function daftar($start = 0, $end = 10, $q_cari)
    {
        return $this->db->query("select a.*
                                    from sppd a
                                        inner join pegawai b
                                            on a.kd_pegawai=b.kd_pegawai
                                    where $q_cari 
                                        order by a.tgl_pelaporan DESC 
                                            limit $start,$end");
    }

    public function jumlah_data($q_cari)
    {
        return $this->db->query("select a.kd_pegawai from sppd a inner join pegawai b on a.kd_pegawai=b.kd_pegawai where $q_cari")->num_rows();
    }

    public function cek_trip_no($trip_no)
    {
        return $this->db->query("select kd_sppd from sppd where trip_no='$trip_no'")->num_rows();
    }

    public function ambil_pegawai($kode)
    {
        return $this->db->query("select * from pegawai where kd_pegawai='$kode'");
    }

    public function ambil_sppd($kode)
    {
        return $this->db->query("select * from sppd where kd_sppd='$kode'");
    }

    public function ambil_file_sppd($kode)
    {
        return $this->db->query("select berkas1,berkas2,berkas3,berkas_lap from sppd where kd_sppd='$kode'");
    }

    public function ambil_pengeluaran($kode)
    {
        return $this->db->query("select * from pengeluaran where kd_sppd='$kode'");
    }

    public function ambil_file_pengeluaran($kode)
    {
        return $this->db->query("select berkas_pergi, berkas_pulang, berkas_penginapan, berkas_bagasi from pengeluaran where kd_sppd='$kode'");
    }

    public function cek_email_atasan($kode_pegawai)
    {
        return $this->db->query("select email from pegawai where kd_pegawai='$kode_pegawai'");
    }

    public function cek_admin_app()
    {
        return $this->db->query("select email from pegawai where level<>'0' and level <>'3'");
    }

    public function simpan_sppd($data)
    {
        extract($data);
        $this->db->query("insert into sppd values('$kd_sppd','$tgl_pelaporan','$kd_pegawai','$trip_no','$dari','$ke','$tgl_berangkat','$tgl_pulang','$durasi','$maksud','$isilap','$catatan_ubah','$kd_atasan','$nama_berkas1','$nama_berkas2','$nama_berkas3','$nama_berkas_lap','$approval','','$updated')");
    }

    public function simpan_pengeluaran($data)
    {
        extract($data);
        $this->db->query("insert into pengeluaran values('','$kd_sppd','$nominal_pergi','$nominal_pulang','$nominal_penginapan','$nama_penginapan','$tgl_check_in','$tgl_check_out','$nominal_bagasi','$nama_berkas_pergi','$nama_berkas_pulang','$nama_berkas_penginapan','$nama_berkas_bagasi','$updated')");
    }

    public function ubah_sppd($data)
    {
        extract($data);
        $this->db->query("update sppd set kd_pegawai='$kd_pegawai',trip_no='$trip_no',dari='$dari',ke='$ke',tgl_berangkat='$tgl_berangkat',tgl_pulang='$tgl_pulang',durasi='$durasi',maksud='$maksud',isi_laporan='$isilap',catatan_ubah='$catatan_ubah',kd_atasan='$kd_atasan',berkas1='$nama_berkas1',berkas2='$nama_berkas2',berkas3='$nama_berkas3',berkas_lap='$nama_berkas_lap',`update`='$updated' where kd_sppd='$kd_sppd'");
    }

    public function ubah_pengeluaran($data)
    {
        extract($data);
        $this->db->query("update pengeluaran set transport_pergi='$nominal_pergi',transport_pulang='$nominal_pulang',penginapan='$nominal_penginapan',nama_penginapan='$nama_penginapan',tgl_check_in='$tgl_check_in',tgl_check_out='$tgl_check_out',bagasi='$nominal_bagasi',berkas_pergi='$nama_berkas_pergi',berkas_pulang='$nama_berkas_pulang',berkas_penginapan='$nama_berkas_penginapan',berkas_bagasi='$nama_berkas_bagasi',`update`='$updated' where kd_sppd='$kd_sppd'");
    }

    public function hapus_sppd($kode)
    {
        $this->db->query("delete from sppd where kd_sppd='$kode'");
    }

    public function hapus_pengeluaran($kode)
    {
        $this->db->query("delete from pengeluaran where kd_sppd='$kode'");
    }

    //approval pelaporan
    public function approval($status, $kode)
    {
        $this->db->query("update sppd set approve='$status' where kd_sppd='$kode'");
    }

    //selesai proses pelaporan
    public function selesai($tgl, $kode)
    {
        $this->db->query("update sppd set selesai='$tgl' where kd_sppd='$kode'");
    }

    //pegawai
    public function daftar_pegawai($start = 0, $end = 10, $q_cari)
    {
        return $this->db->query("select * from pegawai where $q_cari order by pers_no ASC limit $start,$end");
    }

    public function jumlah_pegawai($q_cari)
    {
        return $this->db->query("select kd_pegawai from pegawai where $q_cari")->num_rows();
    }

    public function cek_approval($jabatan)
    {
        return $this->db->query("select kd_jabatan from jabatan where nama='$jabatan' and approval='0'")->num_rows();
    }
}
