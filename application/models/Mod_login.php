<?
class mod_login extends CI_Model
{
	public function cek_pers_no($pers_no)
	{
		return $this->db->query("select kd_pegawai from pegawai where pers_no='$pers_no'")->num_rows();
	}

	public function cek_email($email)
	{
		return $this->db->query("select kd_pegawai from pegawai where email='$email'")->num_rows();
	}

	public function ambil($kode)
	{
		return $this->db->query("select kd_pegawai,pers_no,nama,jabatan,email,level,password,foto,ttd,status_email,aktif from pegawai where pers_no='$kode' or email='$kode'");
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

	public function cek_user($email)
	{
		return $this->db->query("select kd_pegawai from pegawai where email='$email'")->num_rows();
	}

	public function cek_email_verifikasi($email)
	{
		return $this->db->query("select kd_pegawai from pegawai where email='$email' and status_email='1'")->num_rows();
	}

	public function simpan($data)
	{
		extract($data);
		$this->db->query("insert into pegawai values('$kd_pegawai','$persno','$nama','$jabatan','$unit','$bidang','$area','$email','$persno','$foto','$ttd','0','1','0','$updated')");
	}

	public function resetpass($passbaru, $email)
	{
		$this->db->query("update pegawai set password='$passbaru' where email='$email'");
	}
}
