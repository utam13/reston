<?
class mod_user extends CI_Model
{
    public function daftar($start = 0, $end = 10, $q_cari)
    {
        return $this->db->query("select * from wira_user where $q_cari and level<>'0' order by username ASC limit $start,$end");
    }

    public function jumlah_data($q_cari)
    {
        return $this->db->query("select * from wira_user where $q_cari and level<>'0' ")->num_rows();
    }

    public function cek_username($username)
    {
        return $this->db->query("select * from wira_user where username='$username' and level<>'0' ")->num_rows();
    }

    public function ambil($username)
    {
        return $this->db->query("select * from wira_user where username='$username'");
    }

    public function simpan($data)
    {
        extract($data);
        $this->db->query("insert into wira_user values('$kd_user','$username','$password','$email','$level')");
    }

    public function ubah($data)
    {
        extract($data);
        $this->db->query("update wira_user set username='$username',password='$password',email='$email',level='$level' where kd_user='$kd_user' ");
    }

    public function ubah_profil($data)
    {
        extract($data);
        $this->db->query("update wira_user set username='$username',password='$password',email='$email' where kd_user='$kd_user' ");
    }

    public function hapus($username)
    {
        $this->db->query("delete from wira_user where username='$username'");
    }
}
