<?php

class M_post extends CI_Model
{
    public function get_utama_list($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('post');
        $this->db->join('kategori', 'kategori.id_kategori = post.id_kategori', 'right');
        $this->db->limit($limit, $start);
        $this->db->where('post_status', 1);
        $this->db->where('kategori.nama_kategori', 'Laporan Utama');
        $this->db->order_by('id_post', 'DESC');

        return $this->db->get()->result();
    }

    public function get_laporan_utama()
    {
        return $this->db->query("SELECT * FROM post, kategori WHERE post.id_kategori = kategori.id_kategori AND kategori.nama_kategori = 'Laporan Utama'");
    }

    public function get_khusus_list($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('post');
        $this->db->join('kategori', 'kategori.id_kategori = post.id_kategori', 'right');
        $this->db->limit($limit, $start);
        $this->db->where('post_status', 1);
        $this->db->where('kategori.nama_kategori', 'Laporan Khusus');
        $this->db->order_by('id_post', 'DESC');

        return $this->db->get()->result();
    }

    public function get_laporan_khusus()
    {
        return $this->db->query("SELECT * FROM post, kategori WHERE post.id_kategori = kategori.id_kategori AND kategori.nama_kategori = 'Laporan Khusus'");
    }

    public function get_informasi_list($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('post');
        $this->db->join('kategori', 'kategori.id_kategori = post.id_kategori', 'right');
        $this->db->limit($limit, $start);
        $this->db->where('post_status', 1);
        $this->db->where('kategori.nama_kategori', 'Informasi Publik');
        $this->db->order_by('id_post', 'DESC');

        return $this->db->get()->result();
    }

    public function get_informasi_publik()
    {
        return $this->db->query("SELECT * FROM post, kategori WHERE post.id_kategori = kategori.id_kategori AND kategori.nama_kategori = 'Informasi Publik'");
    }

    public function get_opini_list($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('post');
        $this->db->join('kategori', 'kategori.id_kategori = post.id_kategori', 'right');
        $this->db->limit($limit, $start);
        $this->db->where('post_status', 1);
        $this->db->where('kategori.nama_kategori', 'Opini / Wacana');
        $this->db->order_by('id_post', 'DESC');

        return $this->db->get()->result();
    }

    public function get_opini_wacana()
    {
        return $this->db->query("SELECT * FROM post, kategori WHERE post.id_kategori = kategori.id_kategori AND kategori.nama_kategori = 'Opini / Wacana'");
    }

    public function get_liputan_list($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('post');
        $this->db->join('kategori', 'kategori.id_kategori = post.id_kategori', 'right');
        $this->db->limit($limit, $start);
        $this->db->where('post_status', 1);
        $this->db->where('kategori.nama_kategori', 'Liputan');
        $this->db->order_by('id_post', 'DESC');

        return $this->db->get()->result();
    }

    public function get_liputan()
    {
        return $this->db->query("SELECT * FROM post, kategori WHERE post.id_kategori = kategori.id_kategori AND kategori.nama_kategori = 'Liputan'");
    }

    //BACKEND
    public function get_all_post(?int $status = null)
    {
        $this->db->select('p.id_post, p.id_kategori, p.judul_post, p.foto_post, p.permalink, DATE_FORMAT(tanggal_post,"%d %M %Y") AS tanggal_post, p.post_status, p.post_views, k.nama_kategori');

        $this->db->from('post p');
        $this->db->join('kategori k', 'p.id_kategori=k.id_kategori');
        if ($status !== null) {
            $this->db->where('p.post_status', $status);
        }
        $this->db->order_by('p.id_post DESC');

        return $this->db->get();
    }

    public function get_all_comment()
    {
        return $this->db->query('SELECT * FROM komentar JOIN post ON komentar.id_post= post.id_post');
    }

    public function get_post_by_slug($slug)
    {
        $this->db->from('post');
        $this->db->join('kategori', 'post.id_kategori = kategori.id_kategori');
        $this->db->where(['permalink' => $slug]);

        return $this->db->get();
    }

    public function get_post_by_id($id)
    {
        $this->db->from('post');
        $this->db->join('kategori', 'post.id_kategori = kategori.id_kategori');
        $this->db->where(['id_post' => $id]);

        return $this->db->get();
    }

    public function save_post($title, $description, $contents, $category, $slug, $image, $status)
    {
        $data = [
            'judul_post'     => $title,
            'deskripsi_post' => $description,
            'konten_post'    => $contents,
            'foto_post'      => $image,
            'id_kategori'    => $category,
            'permalink'      => $slug,
            'post_status'    => $status,
            'id_user'        => $this->session->userdata('user_id'),
        ];
        $this->db->insert('post', $data);
    }

    public function edit_post($id, $title, $description, $contents, $slug, $category, $image, $status)
    {
        $data = [
            'judul_post'     => $title,
            'deskripsi_post' => $description,
            'konten_post'    => $contents,
            'id_kategori'    => $category,
            'permalink'      => $slug,
            'post_status'    => $status,
            'tanggal_ubah'   => date('Y-m-d H:i:s'),
            // 'permalink'    => $slug,
        ];

        // jika $image tidak dirubah
        if ($image !== null) {
            $data['foto_post'] = $image;
        }

        $this->db->where('id_post', $id);
        $this->db->update('post', $data);

        return (bool) ($this->db->affected_rows() > 0);
    }

    public function delete_post($post_id)
    {
        $get = $this->db->get_where('post', ['id_post' => $post_id])->row();

        // hapus foto
        $this->delete_post_foto($post_id, $get->foto_post);

        $this->db->where('id_post', $post_id);
        $this->db->delete('post');

        return (bool) ($this->db->affected_rows() > -1);
    }

    public function delete_post_foto($post_id, $foto)
    {
        unlink(FCPATH . 'uploads/images/' . $foto);
        unlink(FCPATH . 'uploads/images/thumb/' . $foto);

        $this->db->set('foto_post', null);
        $this->db->where('id_post', $post_id);
        $this->db->update('post');

        return (bool) ($this->db->affected_rows() > 0);
    }
}
