<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Video extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!user_logged_in()) {
            return redirect('auth');
        }

        $this->load->model('M_crud', 'm_crud');
        $this->load->model('M_video', 'video');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();

        $data['video'] = $this->video->getAll();
        $data['judul'] = 'Video Kegiatan';

        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar');
        $this->load->view('admin/v_video', $data);
        $this->load->view('admin/template/v_footer');
    }

    public function addr_line1($addr_line1)
    {
        if (preg_match('/[<>]/', $addr_line1)) {
            $this->form_validation->set_message('addr_line1', 'Mohon maaf tidak diperbolehkan menggunakan karakter spesial');

            return false;
        }

        return true;
    }

    public function check_valid_url($param)
    {
        if (!filter_var($param, FILTER_VALIDATE_URL)) {
            $this->form_validation->set_message('check_valid_url', 'Masukkan {field} link yang benar');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function tambah()
    {
        // rules
        $this->form_validation->set_rules('judul_vid', 'Judul Video', 'trim|required|callback_addr_line1');
        $this->form_validation->set_rules('deskripsi_vid', 'Deskripsi Video', 'trim|required|callback_addr_line1');
        $this->form_validation->set_rules('tanggal_vid', 'Tanggal Video', 'trim|required');
        $this->form_validation->set_rules('link', 'Link Video', 'trim|required|callback_check_valid_url|callback_addr_line1');


        //custom pesan
        $this->form_validation->set_message('required', 'Mohon maaf, {field} harus diisi');
        $this->form_validation->set_message('valid_url', 'Mohon maaf, URL video yang anda masukkan harus valid');


        // custom wadah pesan (delimiter)
        $this->form_validation->set_error_delimiters('<div class="text-center"><span class="badge badge-danger text-white mt-2 px-4">', '</span></div>');

        // cek inputan sudah sesuai rules apa belum
        if ($this->form_validation->run() === false) {
            set_flashdata('pesan', '
            <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Maaf!</strong> Anda gagal menambah data, cek isian Anda.
                <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ');
            return redirect('video_gk');
        }

        $data = [
            'judul_vid'     => $this->input->post('judul_vid'),
            'deskripsi_vid' => $this->input->post('deskripsi_vid'),
            'tanggal_vid'   => $this->input->post('tanggal_vid'),
            'link'          => $this->input->post('link'),
        ];

        $insertVideo = $this->video->insert($data);

        if ($insertVideo) {
            $classAlert = 'success';
            $judulAlert = '<strong>Selamat!</strong> Anda berhasil menambahkan data.';
        } else {
            $classAlert = 'danger';
            $judulAlert = '<strong>Maaf!</strong> Anda gagal menambahkan data.';
        }

        set_flashdata('pesan', '
        <div id="pesan" class="alert alert-' . $classAlert . ' alert-dismissible fade show" role="alert">
            ' . $judulAlert . '
            <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');

        redirect('video_gk');
    }

    public function edit($id_video)
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $where         = ['id_video' => $id_video];
        $data['video'] = $this->m_crud->edit($where, 'video_gk')->result();
        $data['judul'] = 'Video - Dewandik';

        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar');
        $this->load->view('admin/v_edit_video', $data);
        $this->load->view('admin/template/v_footer');
    }
    

    public function update()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $id_video = $this->input->post('id_video');

        // rules
        $this->form_validation->set_rules('judul_vid', 'Judul Video', 'trim|required|callback_addr_line1');
        $this->form_validation->set_rules('deskripsi_vid', 'Deskripsi Video', 'trim|required|callback_addr_line1');
        $this->form_validation->set_rules('tanggal_vid', 'Tanggal Video', 'trim|required');
        $this->form_validation->set_rules('link', 'Link Video', 'trim|required|valid_url');


        //custom pesan
        $this->form_validation->set_message('required', 'Mohon maaf, {field} harus diisi');
        $this->form_validation->set_message('valid_url', 'Mohon maaf, URL video yang anda masukkan harus valid');


        // custom wadah pesan (delimiter)
        $this->form_validation->set_error_delimiters('<div class="text-center"><span class="badge badge-danger text-white mt-2 px-4">', '</span></div>');

        // cek inputan sudah sesuai rules apa belum
        if ($this->form_validation->run() === false) {
            set_flashdata('pesan', '
            <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Maaf!</strong> Anda gagal mengubah data, cek isian Anda.
                <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            $where         = ['id_video' => $id_video];
            $data['video'] = $this->m_crud->edit($where, 'video_gk')->result();
            $data['judul'] = 'Video - Dewandik';

            $this->load->view('admin/template/v_header', $data);
            $this->load->view('admin/template/v_navbar', $data);
            $this->load->view('admin/template/v_sidebar');
            $this->load->view('admin/v_edit_video', $data);
            $this->load->view('admin/template/v_footer');

        }
        $save = [
            'judul_vid'     => $this->input->post('judul_vid'),
            'deskripsi_vid' => $this->input->post('deskripsi_vid'),
            'tanggal_vid'   => $this->input->post('tanggal_vid'),
            'link'          => $this->input->post('link'),
        ];

        $updated = $this->video->update($id_video, $save);

        // cek apakah update berhasil
        if ($updated) {
            $classAlert = 'success';
            $titleAlert = '<strong>Selamat!</strong> Anda berhasil mengubah data.';
        } else {
            $classAlert = 'danger';
            $titleAlert = '<strong>Maaf!</strong> Anda gagal mengubah data.';
        }

        set_flashdata('pesan', '
            <div id="pesan" class="alert alert-' . $classAlert . ' alert-dismissible fade show" role="alert">
                ' . $titleAlert . '
                <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('video_gk');
    }

    public function delete()
    {
        $id  = $this->input->post('id_hapus', true);
        $del = $this->video->delete($id);

        if ($del) {
            set_flashdata('pesan', '
            <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Selamat!</strong> Anda berhasil menghapus data.
                <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        }

        redirect('video_gk');
    }
}
