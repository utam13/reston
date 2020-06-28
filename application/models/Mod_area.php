<?
class mod_area extends CI_Model
{
    public function daftar($start = 0, $end = 10, $q_cari)
    {
        return $this->db->query("select * from area where $q_cari  order by nomor ASC limit $start,$end");
    }

    public function jumlah_data($q_cari)
    {
        return $this->db->query("select * from area where $q_cari ")->num_rows();
    }

    public function cek_nama($nama)
    {
        return $this->db->query("select * from area where nomor='$nama'")->num_rows();
    }

    public function ambil($nama)
    {
        return $this->db->query("select * from area where nomor='$nama'");
    }

    public function simpan($nama)
    {
        $this->db->query("insert into area values('','$nama')");
    }

    public function hapus($nama)
    {
        $this->db->query("delete from area where nomor='$nama'");
    }
}
