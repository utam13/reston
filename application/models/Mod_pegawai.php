<?
class mod_pegawai extends CI_Model
{
    public function daftar($start = 0, $end = 10, $q_cari)
    {
        return $this->db->query("select * from pegawai where $q_cari order by pers_no ASC limit $start,$end");
    }

    public function jumlah_data($q_cari)
    {
        return $this->db->query("select kd_pegawai from pegawai where $q_cari")->num_rows();
    }

    public function cek_pers_no($pers_no)
    {
        return $this->db->query("select kd_pegawai from pegawai where pers_no='$pers_no'")->num_rows();
    }

    public function cek_email($email)
    {
        return $this->db->query("select kd_pegawai from pegawai where email='$email'")->num_rows();
    }

    public function jabatan()
    {
        return $this->db->query("select nama from jabatan order by nama ASC");
    }

    public function unit()
    {
        return $this->db->query("select nama from unit order by nama ASC");
    }

    public function bidang()
    {
        return $this->db->query("select nama from bidang order by nama ASC");
    }

    public function area()
    {
        return $this->db->query("select nomor from area order by nomor ASC");
    }

    public function ambil($kode)
    {
        return $this->db->query("select * from pegawai where kd_pegawai='$kode'");
    }

    public function ambil_file($kode)
    {
        return $this->db->query("select foto,ttd from pegawai where kd_pegawai='$kode'");
    }

    public function simpan($data)
    {
        extract($data);
        $this->db->query("insert into pegawai values('$kd_pegawai','$persno','$nama','$jabatan','$unit','$bidang','$area','$email','$persno','$foto','$ttd','0','1','$level','$updated')");
    }

    public function ubah($data)
    {
        extract($data);
        $this->db->query("update pegawai set pers_no='$persno',nama='$nama',jabatan='$jabatan',unit='$unit',bidang='$bidang',area='$area',email='$email',level='$level',foto='$foto',ttd='$ttd' where kd_pegawai='$kd_pegawai'");
    }

    public function hapus($kode)
    {
        $this->db->query("delete from pegawai where kd_pegawai='$kode'");
    }

    //menonaktifkan data
    public function status_pegawai($status, $kode)
    {
        $this->db->query("update pegawai set aktif='$status' where kd_pegawai='$kode'");
    }
}
