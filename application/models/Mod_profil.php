<?
class mod_profil extends CI_Model
{
    public function daftar($kode)
    {
        return $this->db->query("select * from pegawai where kd_pegawai='$kode'");
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

    public function cek_pers_no($pers_no)
    {
        return $this->db->query("select kd_pegawai from pegawai where pers_no='$pers_no'")->num_rows();
    }

    public function cek_email($email)
    {
        return $this->db->query("select kd_pegawai from pegawai where email='$email'")->num_rows();
    }

    public function ubah($data)
    {
        extract($data);
        $this->db->query("update pegawai set pers_no='$persno',nama='$nama',jabatan='$jabatan',unit='$unit',bidang='$bidang',area='$area',email='$email',password='$password',foto='$foto',ttd='$ttd' where kd_pegawai='$kd_pegawai'");
    }
}
