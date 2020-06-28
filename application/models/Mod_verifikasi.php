<?
class mod_verifikasi extends CI_Model
{
    public function verifikasi($persno)
    {
        $this->db->query("update pegawai set status_email='1' where pers_no='$persno'");
    }
}
