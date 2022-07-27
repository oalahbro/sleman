<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Notfound extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (! user_logged_in()) {
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

        $data['judul'] = '404 Not Found';
        $this->load->view('admin/notfound', $data);
    }
}
