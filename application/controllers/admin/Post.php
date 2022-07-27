<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Post extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!user_logged_in()) {
            return redirect('auth');
        }

        $this->load->model('M_post', 'posting');
        $this->load->model('M_komentar', 'komentar');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();

        $page = $this->input->get('page');

        if ($page === '' || !isset($page)) {
            $page = 'publish';
        }

        // jika $page tidak sesuai, maka tampilkan error
        if (!in_array($page, ['publish', 'draft'], true)) {
            return show_404();
        }

        switch ($page) {
            case 'publish':
                $post_status = 1;
                break;

            case 'draft':
                $post_status = 0;
                break;

            default:
                $post_status = null;
                break;
        }

        $data['post']     = $this->posting->get_all_post($post_status)->result();
        $data['komentar'] = $this->posting->get_all_comment()->num_rows();
        $data['judul']    = 'Data Posting';
        $data['tab']      = $page;

        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar', $data);
        $this->load->view('admin/post/post', $data);
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

    public function addr_line2($addr_line2)
    {
        if (preg_match('/[<>]/', $addr_line2)) {
            $this->form_validation->set_message('addr_line2', 'Mohon maaf tidak diperbolehkan menggunakan karakter spesial');

            return false;
        }

        return true;
    }

    public function tambah()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();

        $data['judul'] = 'Tambah Post';
        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar', $data);
        $this->load->view('admin/post/create', $data);
        $this->load->view('admin/template/v_footer');
    }

    public function create()
    {
        $this->load->model('M_foto', 'fotoin');
        // load library UploadFoto
        $this->load->library('uploadfoto');

        $this->form_validation->set_rules('judul', 'Judul Post', 'trim|required|callback_addr_line1');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Post', 'trim|callback_addr_line1');
        $this->form_validation->set_rules('konten', 'Isi Konten', 'trim|required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

        //custom pesan
        $this->form_validation->set_message('required', 'Mohon maaf, {field} harus diisi');

        //wadah pesan
        $this->form_validation->set_error_delimiters('<div class="text-center"><span class="badge badge-danger text-white mt-2 px-4">', '</span></div>');

        if ($this->form_validation->run() === false) {
            set_flashdata('message', '
            <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Maaf!</strong> Anda gagal menambahkan data, cek isian Anda.
                <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            $data['user'] = $this->db->get_where('user', [
                'email' => $this->session->userdata('mail'),
            ])->row_array();

            $data['judul'] = 'Tambah Post';
            $this->load->view('admin/template/v_header', $data);
            $this->load->view('admin/template/v_navbar', $data);
            $this->load->view('admin/template/v_sidebar', $data);
            $this->load->view('admin/post/create', $data);
            $this->load->view('admin/template/v_footer');
        } else {
            $title       = strip_tags(htmlspecialchars($this->input->post('judul', true), ENT_QUOTES));
            $contents    = $this->input->post('konten', true);
            $description = $this->input->post('deskripsi');
            $category    = $this->input->post('kategori', true);
            $slug        = url_title($title, '-', true);
            $status      = $this->input->post('status', true);

            // cek duplikat slug
            $query = $this->db->get_where('post', ['permalink' => $slug]);
            if ($query->num_rows() > 0) {
                $slug = url_title($slug . ' ' . uniqid(), '-', true);
            }

            // jika upload foto
            if ($this->uploadfoto->fileUploaded('foto')) {
                $data = $this->uploadfoto->doUpload('foto', true, $slug);

                if (!$data['pass']) {
                    set_flashdata('message', '<div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Info!</strong> Maaf Gambar tidak sesuai!.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>');

                    $form_session = [
                        'form_title'   => $title,
                        'form_description'   => $description,
                        'form_content' => strip_tags($contents),
                    ];

                    $this->session->set_userdata($form_session);

                    return redirect('create');
                }

                $image = $data['file_name'];
            }

            // simpan ke DB
            $this->posting->save_post($title, $description, $contents, $category, $slug, $image, $status);

            set_flashdata('message', '
                <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Info!</strong> Data berhasil Anda tambahkan.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>');

            $this->session->unset_userdata(['form_title', 'form_content']);

            redirect('post');
        }
    }

    public function get_edit()
    {
        $x['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $post_id       = $this->uri->segment(4);
        $x['category'] = $this->db->get('kategori')->result_array();
        $x['data']     = $this->db->query("SELECT * FROM post, kategori WHERE kategori.id_kategori = post.id_kategori AND post.id_post='{$post_id}'")->row_array();
        $x['judul']    = 'Edit Posting';

        $this->load->view('admin/template/v_header', $x);
        $this->load->view('admin/template/v_navbar', $x);
        $this->load->view('admin/template/v_sidebar', $x);
        $this->load->view('admin/post/edit_post', $x);
        $this->load->view('admin/template/v_footer');
    }

    public function edit()
    {
        // load library UploadFoto
        $this->load->library('uploadfoto');

        $this->form_validation->set_rules('judul2', 'Judul Post2', 'trim|required|callback_addr_line1');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Post', 'trim|callback_addr_line1');
        $this->form_validation->set_rules('konten', 'Isi Konten', 'trim|required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

        //custom pesan
        $this->form_validation->set_message('required', 'Mohon maaf, {field} harus diisi');

        //wadah pesan
        $this->form_validation->set_error_delimiters('<div class="text-center"><span class="badge badge-danger text-white mt-2 px-4">', '</span></div>');
        if ($this->form_validation->run() === false) {
            set_flashdata('message', '
                <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Info!</strong> Anda gagal menambahkan data, cek isian Anda kembali.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
            $data['user'] = $this->db->get_where('user', [
                'email' => $this->session->userdata('mail'),
            ])->row_array();

            $data['judul'] = 'Edit Post';
            $this->load->view('admin/template/v_header', $data);
            $this->load->view('admin/template/v_navbar', $data);
            $this->load->view('admin/template/v_sidebar', $data);
            $this->load->view('admin/post/edit_post', $data);
            $this->load->view('admin/template/v_footer');
        } else {

            $id          = $this->input->post('id_post', true);
            $title       = strip_tags(htmlspecialchars($this->input->post('judul2', true), ENT_QUOTES));
            $description = $this->input->post('deskripsi');
            $contents    = $this->input->post('konten', true);
            // $contents    = str_replace("'", "'", htmlspecialchars($this->input->post('konten', true)));
            $status      = $this->input->post('status', true);
            $category    = $this->input->post('kategori', true);
            $slug        = url_title($title, '-', true);

            $query = $this->db->get_where('post', ['permalink' => $slug]);
            if ($query->num_rows() > 0) {
                $slug = url_title($slug . ' ' . uniqid(), '-', true);
            }

            // jika upload foto
            if ($this->uploadfoto->fileUploaded('foto')) {
                $data = $this->uploadfoto->doUpload('foto', true, $slug);

                if (!$data['pass']) {
                    set_flashdata('message', '<div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Info!</strong> Maaf Gambar tidak sesuai!.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>');

                    $form_session = [
                        'form_title'   => $title,
                        'form_content' => strip_tags($contents),
                    ];

                    $this->session->set_userdata($form_session);

                    return redirect('admin/post/get_edit/' . $id);
                }
                $image = $data['file_name'];
            }

            // perbarui DB
            $this->posting->edit_post($id, $title, $description, $contents, $slug, $category, $image, $status);

            $this->session->unset_userdata(['form_title', 'form_content']);

            set_flashdata('message', '
                <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Info!</strong> Data berhasil Anda ubah.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>');

            redirect('post');
        }
    }

    public function delete_foto($id_post)
    {
        if (isset($id_post)) {
            $get = $this->db->get_where('post', ['id_post' => $id_post])->row();

            $this->posting->delete_post_foto($id_post, $get->foto_post);
        }

        redirect('admin/post/get_edit/' . $id_post);
    }

    public function delete()
    {
        $post_id = $this->input->post('ID_PS', true);
        $this->posting->delete_post($post_id);
        $this->komentar->delete_by_post($post_id);
        redirect('post');
    }
}
