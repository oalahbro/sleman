<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (! user_logged_in()) {
            return redirect('auth');
        }
        $this->load->model('M_user', 'm_user');
    }

    public function index($tab = 'profile')
    {
        $gtab = $this->input->get('tab');

        if (isset($gtab) && (! empty($gtab) || $gtab !== '') && $gtab === 'pass') {
            $tab = 'pass';
        }

        $email         = $this->session->userdata('mail');
        $data['user']  = $this->m_user->user($email);
        $data['judul'] = 'Profil';
        $data['title'] = 'Profil';
        $data['tab']   = $tab;

        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar', $data);
        $this->load->view('admin/profile');
        $this->load->view('admin/template/v_footer');
    }

    public function update()
    {
        $email = $this->session->userdata('mail');

        if ($this->form_validation->run('profile/update') === false) {
            $this->index();
        } else {
            $this->load->library('uploadfoto');

            $nama = htmlspecialchars($this->input->post('nama'));
            $desc = htmlspecialchars($this->input->post('deskripsi'));

            if ($this->uploadfoto->fileUploaded('image')) {
                $diupload = $this->uploadfoto->doUpload('image', false, url_title($nama, '-', true), 2048, 500, 500);

                if (! $diupload['pass']) {
                    set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf!</strong> Anda gagal mengunggah foto. Pastikan berukuran kurang dari atau sama dengan 500x500 (max 2MB).
                    </div>');

                    return redirect('profile/submit');
                }

                $thumbnail = $diupload['file_name'];
            }

            $edit = [
                'nama_user' => $nama,
                'foto_user' => $thumbnail,
                'deskripsi' => $desc,
                'ubah'      => time(),
            ];
            $get = $this->db->get_where('user', ['email' => $email])->row();
            unlink(FCPATH . 'assets/dist/img/user' . $get->foto_user);
            $this->db->set($edit);
            $this->db->where('email', $email);
            $this->db->update('user');

            set_flashdata('pesan', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Selamat!</strong> Anda berhasil mengubah data.
                <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ');
            redirect('profile');
        }
    }

    public function editpsw()
    {
        if ($this->form_validation->run('profile/password_update') === false) {
            $this->index('pass');
        } else {
            $email        = $this->session->userdata('mail');
            $data['user'] = $this->m_user->user($email);
            $pass_lama    = htmlspecialchars($this->input->post('pass_lama'));
            $pass_baru    = htmlspecialchars($this->input->post('pass_baru'));
            $alert_class  = 'danger';

            if (! password_verify($pass_lama, $data['user']['password'])) {
                $alert = '<strong>Maaf!</strong> Password yang anda masukkan salah.';
            } else {
                if ($pass_lama === $pass_baru) {
                    $alert = '<strong>Maaf!</strong> Password yang anda masukkan tidak boleh sama.';
                } else {
                    $pswhash = password_hash($pass_baru, PASSWORD_DEFAULT);
                    $this->m_user->ubhpsw($pswhash, $email);

                    $alert       = '<strong>Selamat!</strong> Anda berhasil mengganti password.';
                    $alert_class = 'success';
                }
            }

            set_flashdata('pesan', '
            <div class="alert alert-' . $alert_class . ' alert-dismissible fade show" role="alert">
                ' . $alert . '
                <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');

            return redirect('profile?tab=pass');
        }
    }
}
