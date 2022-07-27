<?php

class M_kategori extends CI_Model
{
    public function tampil_kategori()
    {
        return $this->db->query('SELECT * FROM kategori ORDER BY id_kategori ASC');
    }

    //hapus kategori
    public function hapus_kategori($id_kategori)
    {
        return $this->db->query("DELETE FROM kategori WHERE id_kategori='{$id_kategori}'");
    }

    // nyari data id kategori terakhir
    public function selectMaxID_CT()
    {
        $query = $this->db->query('SELECT MAX(id_kategori) AS id_kategori FROM kategori');
        $hasil = $query->row();

        return $hasil->id_kategori;
    }

    // tambah kategori
    public function tmbh_kategori($nama_kategori)
    {
        $this->db->query("INSERT INTO kategori ( nama_kategori ) VALUES('{$nama_kategori}')");
    }

    //update kategori
    public function update_kategori($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
