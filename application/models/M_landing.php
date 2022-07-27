	<?php
    class M_landing extends CI_Model
    {
        public function count_views($kode)
        {
            $user_ip = $_SERVER['REMOTE_ADDR'];
            $cek_ip  = $this->db->query("SELECT * FROM post_pengunjung WHERE ip_pengunjung='{$user_ip}' AND id_post='{$kode}' AND DATE(tanggal)=CURDATE()");
            if ($cek_ip->num_rows() <= 0) {
                $this->db->trans_start();
                $this->db->query("INSERT INTO post_pengunjung (ip_pengunjung,id_post) VALUES('{$user_ip}','{$kode}')");
                $this->db->query("UPDATE post SET post_views=post_views+1 where id_post='{$kode}'");
                $this->db->trans_complete();

                return (bool) ($this->db->trans_status() === true);
            }
        }

        public function list()
        {
            $this->db->select('*');
            $this->db->from('post');
            $this->db->limit(3);
            $this->db->where('post.post_status', 1);
            $this->db->order_by('id_post', 'DESC');

            return $this->db->get()->result();
        }

        public function list1()
        {
            $this->db->select('*');
            $this->db->from('banner');
            $this->db->limit(5);
            $this->db->where('banner.status_banner', 1);
            $this->db->order_by('id_banner', 'DESC');

            return $this->db->get()->result();
        }


        public function list_vid()
        {
            $this->db->select('*');
            $this->db->from('video_gk');
            $this->db->limit(5);
            // $this->db->where('post.post_status', 1);
            $this->db->order_by('id_video', 'DESC');

            return $this->db->get()->result();
        }
    }
    ?>
