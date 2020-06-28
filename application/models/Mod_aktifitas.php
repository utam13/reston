<?
class mod_aktifitas extends CI_Model
{
    public function daftar($start = 0, $end = 10, $q_cari)
    {
        return $this->db->query("select * from loginfo where $q_cari order by waktulog DESC limit $start,$end");
    }

    public function jumlah_data($q_cari = "")
    {
        return $this->db->query("select * from loginfo where $q_cari")->num_rows();
    }

    public function laporan()
    {
        return $this->db->query("select * from loginfo order by waktulog DESC");
    }

    public function hapus()
    {
        $this->db->query("truncate table loginfo");
    }
}
