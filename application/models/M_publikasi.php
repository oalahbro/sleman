<?php

class M_publikasi extends CI_Model
{
    public function tampil_publikasi()
    {
        return $this->db->query('SELECT * FROM publikasi_riset ORDER BY id_publikasi DESC');
    }

    public function search($query)
    {
        return $this->db->query("SELECT * FROM publikasi_riset WHERE nama_pembuat LIKE '%{$query}%' OR judul_riset LIKE '%{$query}%' ORDER BY id_publikasi DESC ");
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
        $this->db->from('publikasi_riset');
        if (array_key_exists('id_publikasi', $params) && !empty($params['id_publikasi'])) {
            $this->db->where('id_publikasi', $params['id_publikasi']);
            //get records
            $query  = $this->db->get();
            $result = ($query->num_rows() > 0) ? $query->row_array() : false;
        } else {
            //set start and limit
            if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
                $this->db->limit($params['limit'], $params['start']);
            } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
                $this->db->limit($params['limit']);
            }
            //get records
            $query  = $this->db->get();
            $result = ($query->num_rows() > 0) ? $query->result_array() : false;
        }
        //return fetched data
        return $result;
    }

    public function get_publikasi_list($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('publikasi_riset');
        $this->db->limit($limit, $start);
        $this->db->order_by('id_publikasi', 'DESC');

        return $this->db->get()->result();
    }

    public function get_publikasi()
    {
        return $this->db->query('SELECT * FROM publikasi_riset');
    }
}
