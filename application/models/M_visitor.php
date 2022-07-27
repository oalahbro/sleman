<?php

defined('BASEPATH') || exit('No direct script access allowed');

class M_visitor extends CI_Model
{
    public function count_visitor()
    {
        $user_ip = '';
        if (isset($_SERVER['REMOTE_ADDR'])) {
            $user_ip = $_SERVER['REMOTE_ADDR'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $user_ip = $_SERVER['HTTP_X_FORWARDED'];
        } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $user_ip = $_SERVER['HTTP_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
            $user_ip = $_SERVER['HTTP_FORWARDED'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $user_ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        if ($this->agent->is_browser()) {
            $agent = $this->agent->browser();
        } elseif ($this->agent->is_robot()) {
            $agent = $this->agent->robot();
        } elseif ($this->agent->is_mobile()) {
            $agent = $this->agent->mobile();
        } else {
            $agent = 'Other';
        }
        $cek_ip = $this->db->query("SELECT * FROM pengunjung WHERE ip_pengguna='{$user_ip}' AND DATE(tanggal)=CURDATE()");
        if ($cek_ip->num_rows() <= 0) {
            $hsl = $this->db->query("INSERT INTO pengunjung (ip_pengguna,media_browser) VALUES('{$user_ip}','{$agent}')");

            return $hsl;
        }
    }

    public function visitor_statistics()
    {
        $query = $this->db->query("SELECT DATE_FORMAT(tanggal,'%d') AS tgl,COUNT(ip_pengguna) AS jumlah FROM pengunjung WHERE MONTH(tanggal)=MONTH(CURDATE()) GROUP BY DATE(tanggal)");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $result[] = $data;
            }

            return $result;
        }
    }

    public function count_all_visitors()
    {
        return $this->db->count_all('pengunjung');
    }

    public function count_all_page_views()
    {
        return $this->db->count_all('post_pengunjung');
    }

    public function count_all_posts()
    {
        return $this->db->count_all('post');
    }

    public function count_all_comments()
    {
        return $this->db->count_all('komentar');
    }

    public function top_five_articles()
    {
        return $this->db->query('SELECT * FROM post ORDER BY post_views DESC LIMIT 5');
    }

    public function count_visitor_this_month()
    {
        return $this->db->query('SELECT COUNT(*) tot_visitor FROM pengunjung WHERE MONTH(tanggal)=MONTH(CURDATE())');
    }

    public function count_chrome_visitors()
    {
        return $this->db->query("SELECT COUNT(*) chrome_visitor FROM pengunjung WHERE media_browser='Chrome' AND MONTH(tanggal)=MONTH(CURDATE())");
    }

    public function count_firefox_visitors()
    {
        return $this->db->query("SELECT COUNT(*) firefox_visitor FROM pengunjung WHERE (media_browser='Firefox' OR media_browser='Mozilla') AND MONTH(tanggal)=MONTH(CURDATE())");
    }

    public function count_explorer_visitors()
    {
        return $this->db->query("SELECT COUNT(*) explorer_visitor FROM pengunjung WHERE media_browser='Internet Explorer' AND MONTH(tanggal)=MONTH(CURDATE())");
    }

    public function count_safari_visitors()
    {
        return $this->db->query("SELECT COUNT(*) safari_visitor FROM pengunjung WHERE media_browser='Safari' AND MONTH(tanggal)=MONTH(CURDATE())");
    }

    public function count_opera_visitors()
    {
        return $this->db->query("SELECT COUNT(*) opera_visitor FROM pengunjung WHERE media_browser='Opera' AND MONTH(tanggal)=MONTH(CURDATE())");
    }

    public function count_robot_visitors()
    {
        return $this->db->query("SELECT COUNT(*) robot_visitor FROM pengunjung WHERE (media_browser='YandexBot' OR media_browser='Googlebot' OR media_browser='Yahoo') AND MONTH(tanggal)=MONTH(CURDATE())");
    }

    public function count_other_visitors()
    {
        return $this->db->query("SELECT COUNT(*) other_visitor FROM pengunjung WHERE
			(NOT media_browser='YandexBot' AND NOT media_browser='Googlebot' AND NOT media_browser='Yahoo'
			AND NOT media_browser='Chrome' AND NOT media_browser='Firefox' AND NOT media_browser='Mozilla'
			AND NOT media_browser='Internet Explorer' AND NOT media_browser='Safari' AND NOT media_browser='Opera')
			AND MONTH(tanggal)=MONTH(CURDATE())");
    }
}
