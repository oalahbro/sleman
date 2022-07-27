<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Comment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!user_logged_in()) {
            return redirect('auth');
        }

        $this->load->model('M_komentar', 'komentar');
    }

    public function show(string $page = 'publik')
    {
        if (!in_array($page, ['publik', 'pending'], true)) {
            redirect('forbidden');
            // return false;
        }

        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();

        $limit  = 20;
        $offset = $this->input->get('per_page');

        if (!isset($offset)) {
            $offset = 0;
        }

        $status = 1;
        if ($page === 'pending') {
            $status = 0;
        }

        $config['base_url']             = base_url('comment/' . $page);
        $config['total_rows']           = $this->komentar->getComments($status, null, null)->num_rows();
        $config['per_page']             = $limit;
        $config['enable_query_strings'] = true;
        $config['page_query_string']    = true;
        $config['reuse_query_string']   = true;

        $this->pagination->initialize($config);

        $data['paginasi'] = $this->pagination->create_links();

        $data['judul']    = 'Komentar';
        $data['title']    = 'Daftar Komentar';
        $data['current']  = $page;
        $data['komentar'] = $this->komentar->getComments($status, $limit, $offset);

        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar');
        $this->load->view('admin/post/comment', $data);
        $this->load->view('admin/template/v_footer');
    }

    public function edit()
    {
        $this->form_validation->set_rules('id', 'ID', 'required|integer');
        $this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('isi', 'Isi Komentar', 'required');

        $redirect = $this->input->post('redirect');

        if ($this->form_validation->run() === false) {
            set_flashdata('message', '<div id="pesan" class="alert alert-danger">Galat: <br/>' . validation_errors() . '</div>');
        } else {
            $id   = $this->input->post('id');
            $data = [
                'nama'  => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'pesan' => $this->input->post('isi'),
            ];
            $this->komentar->update($id, $data);

            set_flashdata('message', '<div id="pesan" class="alert alert-success">Komentar sudah diperbarui.</div>');
        }

        redirect($redirect !== null ? $redirect : 'comment');
    }

    public function delete(int $id)
    {
        $del = $this->komentar->delete_comment($id);

        if ($del) {
            set_flashdata('message', '<div id="pesan" class="alert alert-success">Komentar sudah dihapus.</div>');
        } else {
            set_flashdata('message', '<div id="pesan" class="alert alert-danger">Komentar gagal dihapus.</div>');
        }
        redirect($this->agent->referrer());
    }

    public function terbit(int $id, int $status)
    {
        $changed = $this->komentar->terbit($id, $status);

        if ($changed) {
            set_flashdata('message', '<div id="pesan" class="alert alert-success">Komentar sudah diterbitkan.</div>');
        } else {
            set_flashdata('message', '<div id="pesan" class="alert alert-danger">Komentar gagal diterbitkan.</div>');
        }
        redirect($this->agent->referrer());
    }
}
