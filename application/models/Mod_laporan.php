<?
class mod_laporan extends CI_Model
{
    public function laporan_sppd($query, $orderby)
    {
        return $this->db->query("select a.*,b.*
                                    from sppd a
                                        inner join pengeluaran b
                                            on a.kd_sppd=b.kd_sppd
                                    where $query 
                                        order by $orderby");
    }

    public function ambil_pegawai($kode)
    {
        return $this->db->query("select * from pegawai where kd_pegawai='$kode'");
    }
}
