<?
class mod_mobile_dashboard extends CI_Model
{
    public function butuh_approve($kode)
    {
        return $this->db->query("select kd_sppd from sppd where kd_atasan='$kode' and approve='0'")->num_rows();
    }

    public function baru($kode)
    {
        return $this->db->query("select kd_sppd from sppd where kd_pegawai='$kode' and approve='0'")->num_rows();
    }

    public function proses($kode)
    {
        return $this->db->query("select kd_sppd from sppd where kd_pegawai='$kode' and approve='1' and selesai='0000-00-00'")->num_rows();
    }

    public function selesai($kode)
    {
        return $this->db->query("select kd_sppd from sppd where kd_pegawai='$kode' and selesai<>'0000-00-00'")->num_rows();
    }
}
