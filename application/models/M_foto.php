<?php

class M_foto extends CI_Model
{
    public function tampil_foto()
    {
        return $this->db->get('foto_gk');
    }

    public function search($query)
    {
        return $this->db->query("SELECT * FROM foto_gk WHERE judul_foto LIKE '%{$query}%' LIMIT 6");
    }

    public function get_foto_list($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('foto_gk');
        $this->db->limit($limit, $start);
        $this->db->order_by('id_foto', 'DESC');

        return $this->db->get()->result();
    }

    public function get_foto()
    {
        return $this->db->query('SELECT * FROM foto_gk');
    }

    public function upload_($data, $table)
    {
        // $this->db->where($where);
        $this->db->insert($table, $data);
    }

    public function update_($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    // DELETE
    public function delete_($where, $table)
    {
        $this->db->delete($table, $where);
    }

    public function getRows($params = [])
    {
        $this->db->select('*');
        $this->db->from('foto_gk');
        if (array_key_exists('id_foto', $params) && ! empty($params['id_foto'])) {
            $this->db->where('id_foto', $params['id_foto']);
            //get records
            $query  = $this->db->get();
            $result = ($query->num_rows() > 0) ? $query->row_array() : false;
        } else {
            //set start and limit
            if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
                $this->db->limit($params['limit'], $params['start']);
            } elseif (! array_key_exists('start', $params) && array_key_exists('limit', $params)) {
                $this->db->limit($params['limit']);
            }
            //get records
            $query  = $this->db->get();
            $result = ($query->num_rows() > 0) ? $query->result_array() : false;
        }
        //return fetched data
        return $result;
    }

    public function detail($where)
    {
        return $this->db->query("SELECT * FROM foto_gk WHERE id_foto='{$where}'");
    }
}
