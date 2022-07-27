<?php

class M_landingpage extends CI_Model
{
    public function getBulanforSidebar()
    {
        return $this->db->query("SELECT tanggal_info FROM tb_informasi WHERE status_info = '1' GROUP BY month(tanggal_info) ORDER BY tanggal_info DESC LIMIT 10");
    }

    public function getInformasibyBulan($bulan)
    {
        return $this->db->query("SELECT * FROM tb_informasi  WHERE status_info = '1' AND tanggal_info LIKE '%{$bulan}%' ORDER BY tanggal_info ASC");
    }

    public function searchresult($search, $number, $offset)
    {
        $this->db->like('nama_pembuat', $search);
        $this->db->order_by('tgl', 'asc');

        return $query = $this->db->get('publikasi_riset', $number, $offset)->result();
    }

    public function searchall($search)
    {
        return $this->db->query("SELECT * FROM publikasi_riset WHERE nama_pembuat LIKE '%{$search}%' ORDER BY tgl ASC");
    }

    public function allresult($number, $offset)
    {
        $this->db->where('id_video');

        return $query = $this->db->get('video_gk', $number, $offset)->result();
    }

    public function landingpageinformasi()
    {
        $row = $this->db->query('SELECT * FROM tb_informasi WHERE status_info = 1')->num_rows();
        if ($row > 0 && $row < 6) {
            return $this->db->query('SELECT * FROM tb_informasi WHERE status_info = 1 LIMIT 3');
        }
        if ($row > 0 && $row >= 6) {
            return $this->db->query('SELECT * FROM tb_informasi WHERE status_info = 1 LIMIT 6');
        }
        $this->db->query('SELECT * FROM tb_informasi');
    }
}
