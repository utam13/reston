<?
class mod_bidang extends CI_Model
{
    public function daftar($start = 0, $end = 10, $q_cari)
    {
        return $this->db->query("select * from bidang where $q_cari  order by nama ASC limit $start,$end");
    }

    public function jumlah_data($q_cari)
    {
        return $this->db->query("select * from bidang where $q_cari ")->num_rows();
    }

    public function cek_nama($nama)
    {
        return $this->db->query("select * from bidang where nama='$nama'")->num_rows();
    }

    public function ambil($nama)
    {
        return $this->db->query("select * from bidang where nama='$nama'");
    }

    public function simpan($nama)
    {
        $this->db->query("insert into bidang values('','$nama')");
    }

    public function hapus($nama)
    {
        $this->db->query("delete from bidang where nama='$nama'");
    }
}
