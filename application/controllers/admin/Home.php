<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_post');
        if (! user_logged_in()) {
            return redirect('auth');
        }
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();

        $data['comment']  = $this->db->query('SELECT * FROM komentar')->num_rows();
        $data['views']    = $this->db->query('SELECT * FROM pengunjung')->num_rows();
        $data['category'] = $this->db->query('SELECT * FROM kategori')->num_rows();
        $data['post']     = $this->db->query('SELECT * FROM post')->num_rows();
        $data['komentar'] = $this->M_post->get_all_comment()->num_rows();
        $data['judul']    = 'Beranda';

        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar', $data);
        $this->load->view('admin/home', $data);
        $this->load->view('admin/template/v_footer');
    }
}
