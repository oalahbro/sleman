<?php

class M_redaksi extends CI_Model
{
    public function insert()
    {
        return $this->db->query('SELECT id_struktur_redaksi, jenis_redaksi FROM struktur_redaksi ORDER BY id_struktur_redaksi ASC');
    }
}
