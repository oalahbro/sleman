<?php

defined('BASEPATH') || exit('No direct script access allowed');

class M_video extends CI_Model
{
    public function getAll()
    {
        return $this->db->get('video_gk');
    }

    public function insert($data)
    {
        $this->db->insert('video_gk', $data);

        return (bool) ($this->db->affected_rows() > 0);
    }

    /**
     * update data
     *
     * @param array $data Data berupa array
     *
     * @return bool Jika berhasil return true, gagal return false
     */
    public function update(int $id, array $data): bool
    {
        $this->db->where('id_video', $id);
        $this->db->update('video_gk', $data);

        return (bool) ($this->db->affected_rows() > 0);
    }

    public function search($query)
    {
        return $this->db->query("SELECT * FROM video_gk WHERE judul_vid LIKE '%{$query}%' LIMIT 6");
    }

    /**
     * Hapus video
     */
    public function delete(int $video_id): bool
    {
        $get = $this->db->get_where('video_gk', ['id_video' => $video_id])->row();

        // hapus foto
        unlink(FCPATH . 'uploads/images/' . $get->thumbnail_vid);
        unlink(FCPATH . 'uploads/images/thumb/' . $get->thumbnail_vid);

        $this->db->where('id_video', $video_id);
        $this->db->delete('video_gk');

        return (bool) ($this->db->affected_rows() > -1);
    }
}
