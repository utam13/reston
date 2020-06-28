<?
class mod_jabatan extends CI_Model
{
    public function daftar($start = 0, $end = 10, $q_cari)
    {
        return $this->db->query("select * from jabatan where $q_cari  order by nama ASC limit $start,$end");
    }

    public function jumlah_data($q_cari)
    {
        return $this->db->query("select * from jabatan where $q_cari ")->num_rows();
    }

    public function cek_nama($nama)
    {
        return $this->db->query("select * from jabatan where nama='$nama'")->num_rows();
    }

    public function ambil($nama)
    {
        return $this->db->query("select * from jabatan where nama='$nama'");
    }

    public function simpan($nama, $approval)
    {
        $this->db->query("insert into jabatan values('','$nama','$approval')");
    }

    public function hapus($nama)
    {
        $this->db->query("delete from jabatan where nama='$nama'");
    }
}
