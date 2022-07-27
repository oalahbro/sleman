<?php

class M_jabatan extends CI_Model
{
    public function insert() // ?
    {
        return $this->db->query('SELECT id_jabatan, jenis_jabatan FROM jabatan ORDER BY id_jabatan ASC');
    }
}
