<?
class mod_dashboard extends CI_Model
{
    public function baru()
    {
        return $this->db->query("select kd_sppd from sppd where approve='0'")->num_rows();
    }

    public function proses()
    {
        return $this->db->query("select kd_sppd from sppd where approve='1' and selesai='0000-00-00'")->num_rows();
    }

    public function selesai()
    {
        return $this->db->query("select kd_sppd from sppd where selesai<>'0000-00-00'")->num_rows();
    }
}
