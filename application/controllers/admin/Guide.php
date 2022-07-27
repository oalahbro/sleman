<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Guide extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!user_logged_in()) {
            return redirect('auth');
        }
    }

    /**
     * Menampilkan Form Login
     */
    public function index()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();

        $data['judul'] = 'Panduan';
        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar');
        $this->load->view('admin/template/v_sidebar', $data);
        $this->load->view('admin/guide');
        $this->load->view('admin/template/v_footer');
    }

    public function dataset()
    {
        force_download('assets/dist/dataset/Testing.xlsx', null);
    }
}
