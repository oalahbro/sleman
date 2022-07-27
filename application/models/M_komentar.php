<?php

defined('BASEPATH') || exit('No direct script access allowed');

class M_komentar extends CI_Model
{
    public function update($id, $data)
    {
        $this->db->where('id_komentar', $id);
        $this->db->update('komentar', $data);

        return (bool) ($this->db->affected_rows() > 0);
    }

    public function terbit(int $id, int $status)
    {
        $data = [
            'status' => $status,
        ];

        return $this->update($id, $data);
    }

    public function delete_comment($id)
    {
        $this->db->where('id_komentar', $id);
        $this->db->delete('komentar');

        return (bool) ($this->db->affected_rows() > -1);
    }

    public function delete_by_post($post_id)
    {
        $this->db->where('id_post', $post_id);
        $this->db->delete('komentar');

        return (bool) ($this->db->affected_rows() > -1);
    }

    public function getComments(int $status = 1, $limit, $offset)
    {
        $this->db->where('status', $status);

        if (!is_null($limit) && !is_null($offset)) {
            $this->db->limit($limit, $offset);
        }

        return $this->db->get('komentar');
    }

    public function get_all_comment(int $offset, int $limit)
    {
        $this->db->limit($limit);
        $this->db->offset($offset);

        return $this->db->get('komentar');
    }

    // get full tree comments based on news id
    public function tree_all($post_id)
    {
        $this->db->where(['id_post' => $post_id, 'status' => '1']);
        // $this->db->from('komentar');

        $result = $this->db->get('komentar');

        if ($result->num_rows() === 0) {
            return null;
        }

        foreach ($result->result_array() as $row) {
            $data[] = $row;
        }

        return $data;
    }

    // to get child comments by entry id and parent id and news id
    public function tree_by_parent($post_id, $parent_id)
    {
        $this->db->where([
            'komentar_parent' => $parent_id,
            'id_post'         => $post_id,
            'status'          => '1',
        ]);

        $get = $this->db->get('komentar');

        if ($get->num_rows() > 0) {
            return $get->result_array();
        }

        return [];
    }

    // to insert comments
    public function add_new_comment()
    {
        $this->db->set('id_post', $this->input->post('id_post'));
        $this->db->set('komentar_parent', $this->input->post('parent_id') ?? 0);
        $this->db->set('nama', $this->input->post('comment_name'));
        $this->db->set('email', $this->input->post('comment_email'));
        $this->db->set('pesan', $this->input->post('comment_body'));
        // $this->db->set("tanggal_komentar", time());
        $this->db->insert('komentar');

        return $this->input->post('komentar_parent');
    }

    public function counter(?int $status = null)
    {
        if ($status !== null) {
            $this->db->where('status', $status);
        }

        return $this->db->get('komentar');
    }
}
