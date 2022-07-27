<?php

defined('BASEPATH') || exit('No direct script access allowed');

class M_struktur extends CI_Model
{
    public function getAll()
    {
        $this->db->select('*');
        $this->db->from('struktur');
        $this->db->join('jabatan', 'struktur.id_jabatan=jabatan.id_jabatan');
        $this->db->order_by('struktur.id_struktur', 'DESC');

        return $this->db->get();
    }

    public function insert($data)
    {
        $this->db->insert('struktur', $data);

        return (bool) ($this->db->affected_rows() > 0);
    }

    public function update($id, $data)
    {
        $this->db->where('id_struktur', $id);
        $this->db->update('struktur', $data);

        return (bool) ($this->db->affected_rows() > 0);
    }

    public function delete($id_struktur)
    {
        $get = $this->db->get_where('struktur', ['id_struktur' => $id_struktur])->row();

        $this->db->delete('struktur', ['id_struktur' => $id_struktur]);

        unlink(FCPATH . 'uploads/images/' . $get->image);
        unlink(FCPATH . 'uploads/images/thumb/' . $get->image);

        return (bool) ($this->db->affected_rows() > -1);
    }
}
