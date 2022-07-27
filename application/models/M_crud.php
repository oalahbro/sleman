<?php

class M_crud extends CI_Model
{
    public function edit($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function getAll($table)
    {
        return $this->db->get($table);
    }

    public function getIds($table, $order)
    {
        return $this->db->query("SELECT * FROM {$table} ORDER BY {$order} DESC LIMIT 1");
    }

    public function insert($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function delete($where, $table)
    {
        $this->db->delete($table, $where);
    }

    public function update($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function update_($id_pengaturan, $anggaran, $sambutan, $visi, $sejarah)
    {
        $this->db->set('anggaran', $anggaran);
        $this->db->set('sambutan', $sambutan);
        $this->db->set('visi_misi', $visi);
        $this->db->set('sejarah', $sejarah);
        $this->db->where('id_pengaturan', $id_pengaturan);
        $this->db->update('pengaturan');
    }

    public function get_aspirasi_list($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('aspirasi');
        $this->db->limit($limit, $start);
        $this->db->order_by('id_aspirasi', 'DESC');

        return $this->db->get()->result();
    }

    public function tampil($id)
    {
        $this->db->set('status', 1);
        $this->db->where('id_regulasi', $id);
        $this->db->update('regulasi');

        return $this->db;
    }

    public function tak_tampil($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id_regulasi', $id);
        $this->db->update('regulasi');

        return $this->db;
    }

    public function tampil_aspirasi($id)
    {
        $this->db->set('status', 1);
        $this->db->where('id_saran', $id);
        $this->db->update('saran');

        return $this->db;
    }

    public function tak_tampilaspirasi($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id_saran', $id);
        $this->db->update('saran');

        return $this->db;
    }

    public function coy($where)
    {
        return $this->db->query("SELECT *
            FROM struktur, jabatan
            WHERE struktur.id_jabatan = jabatan.id_jabatan AND struktur.id_struktur='{$where}'");
    }

    public function coyy($where)
    {
        return $this->db->query("SELECT *
            FROM redaksi, struktur_redaksi
            WHERE redaksi.id_struktur_redaksi = struktur_redaksi.id_struktur_redaksi AND redaksi.id_redaksi='{$where}'");
    }

    public function read($id_aspirasi, $set)
    {
        $this->db->set($set);
        $this->db->where('id_aspirasi', $id_aspirasi);
        $this->db->update('aspirasi');
    }

    public function select_notif()
    {
        return $this->db->query('SELECT id_zakat, pembayaran_zakat.id_anggota, tb_anggota.nama_anggota, bulan_zakat, nominal_zakat, tanggal_zakat, status_zakat FROM tb_anggota, pembayaran_zakat WHERE tb_anggota.id_anggota = pembayaran_zakat.id_anggota ORDER BY status_zakat ASC LIMIT 5');
    }

    public function select_notifbelum()
    {
        return $this->db->query('SELECT id_zakat, pembayaran_zakat.id_anggota, tb_anggota.nama_anggota, bulan_zakat, nominal_zakat, tanggal_zakat, status_zakat FROM tb_anggota, pembayaran_zakat WHERE tb_anggota.id_anggota = pembayaran_zakat.id_anggota AND pembayaran_zakat.status_zakat = 0');
    }

    public function cetak($where)
    {
        return $this->db->query("SELECT id_penerima, nama_penerima, tb_kategori.nama_kategori, tb_anggota.nama_anggota, alamat_penerima, pekerjaan, jumlah_tanggungan, jumlah_terima, status_penerima
            FROM tb_penerima, tb_kategori, tb_anggota
            WHERE tb_penerima.id_kategori = tb_kategori.id_kategori AND tb_penerima.id_anggota = tb_anggota.id_anggota AND tb_penerima.id_penerima='{$where}'");
        //return $this->db->get_where($table, $where, );
    }

    public function detail($where)
    {
        return $this->db->query("SELECT * FROM regulasi WHERE ID_REG='{$where}'");
    }

    public function getjabatan()
    {
        return $this->db->query('SELECT * FROM jabatan');
    }

    public function jabatan()
    {
        $data = $this->db->query('SELECT * FROM struktur, jabatan WHERE struktur.id_jabatan = jabatan.id_jabatan ORDER BY struktur.id_struktur DESC');

        return $data->result();
    }

    public function tampil_redaksi()
    {
        return $this->db->query('SELECT * FROM redaksi, struktur_redaksi WHERE redaksi.id_struktur_redaksi = struktur_redaksi.id_struktur_redaksi ORDER BY redaksi.id_redaksi DESC');
    }

    public function getredaksi()
    {
        return $this->db->query('SELECT * FROM struktur_redaksi');
    }

    public function redaksi()
    {
        // $data = $this->db->query("SELECT * FROM redaksi, struktur_redaksi WHERE redaksi.id_struktur_redaksi = struktur_redaksi.id_struktur_redaksi");
        // return $data->result();
        $data = $this->db->query('SELECT * FROM redaksi, struktur_redaksi WHERE redaksi.id_struktur_redaksi = struktur_redaksi.id_struktur_redaksi ORDER BY redaksi.id_redaksi DESC');

        return $data->result();
    }

    public function get_video_list($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('video_gk');
        $this->db->limit($limit, $start);
        $this->db->order_by('id_video', 'DESC');

        return $this->db->get()->result();
    }

    public function get_video()
    {
        return $this->db->query('SELECT * FROM video_gk');
    }

    public function tampil_dinas()
    {
        return $this->db->query('SELECT * FROM dinas ORDER BY id_diter DESC');
    }
}
