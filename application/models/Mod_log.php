<?
class mod_log extends CI_Model
{
	public function daftar($start = 0, $end = 10, $q_cari)
	{
		return $this->db->query("select * from wira_log where $q_cari order by waktulog DESC limit $start,$end");
	}

	public function jumlah_data($q_cari = "")
	{
		return $this->db->query("select * from wira_log where $q_cari")->num_rows();
	}

	public function laporan()
	{
		return $this->db->query("select * from wira_log order by waktulog DESC");
	}

	public function hapus()
	{
		$this->db->query("truncate table wira_log");
	}
}
