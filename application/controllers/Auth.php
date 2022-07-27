<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Auth extends CI_Controller
{
    /**
     * Menampilkan Form Login
     */

    public function index()
    {
        if (user_logged_in()) {
            return redirect('admin/beranda');
        }
        // $this->session->mark_as_flash('pesan');

        $data['data'] = $this->db->get('pengaturan')->row_array();
        $data['judul'] = 'Auth';
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/auth/login');
        $this->load->view('admin/template/footer');
    }

    public function cek_login()
    {
        if ($this->form_validation->run('auth/login') === false) {
            $return = [
                'text'  => validation_errors(),
                'class' => 'warning',
            ];
        } else {
            $email            = htmlspecialchars($this->input->post('email'));
            $password         = htmlspecialchars($this->input->post('password'));

            $return = $this->users->login($email, $password);
        }

        set_flashdata('pesan', '<div id="pesan" class="alert alert-' . $return['class'] . ' alert-dismissible fade show" role="alert">
                ' . $return['text'] . '
            </div>');

        return redirect('admin/beranda');
    }

    // Fungsi Log out
    public function logout()
    {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('mail');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('loggedIn');
        set_flashdata('pesan', '
            <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                Anda telah berhasil <strong>Logout!</strong>
            </div>');
        redirect('auth');
    }
}
