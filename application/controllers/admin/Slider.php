<?php

defined('BASEPATH') || exit('No direct script access allowed');

// Class Anggota
class Slider extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (! user_logged_in()) {
            return redirect('auth');
        }

        $this->load->model('M_crud', 'm_crud');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $data['slider'] = $this->m_crud->getAll('foto_slider')->result();
        //$data['sidebar'] = 'website';
        $data['judul'] = 'Slider';
        $data['title'] = 'Slider';
        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar');
        $this->load->view('admin/slider', $data);
        $this->load->view('admin/template/v_footer');
    }

    public function addr_line1($addr_line1)
    {
        if (preg_match('/[\^£$%&*}{@#~><>|=+¬]/', $addr_line1)) {
            $this->form_validation->set_message('addr_line1', 'Mohon maaf tidak diperbolehkan menggunakan karakter spesial');

            return false;
        }

        return true;
    }

    public function tambah()
    {
        // rules
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Slider', 'trim|callback_addr_line1');
        $this->form_validation->set_rules('nama', 'Nama Slider', 'trim|required|alpha_numeric_spaces|min_length[2]|max_length[100]');

        // custom pesan
        $this->form_validation->set_message('required', 'Mohon maaf, {field} harus diisi');
        $this->form_validation->set_message('alpha_numeric', 'Mohon maaf, {field} harus diisi menggunakan huruf dan angka');
        $this->form_validation->set_message('alpha_numeric_spaces', 'Mohon maaf, {field} harus diisi menggunakan huruf, angka, spasi');
        $this->form_validation->set_message('min_length', 'Mohon maaf, Masukan {field} minimum {param} karakter');
        $this->form_validation->set_message('max_length', 'Mohon maaf, Masukan {field} maximum {param} karakter');

        // custom wadah pesan (delimiter)
        $this->form_validation->set_error_delimiters('<div class="text-center"><span class="badge badge-danger text-white mt-2 px-4">', '</span></div>');

        // cek inputan sudah sesuai rules apa belum
        if ($this->form_validation->run() === false) {
            set_flashdata('pesan', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Maaf!</strong> Anda gagal menambahkan data.
                <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ');
            $data['slider'] = $this->m_crud->getAll('foto_slider')->result();
            //$data['sidebar'] = 'website';
            $data['judul'] = 'Slider';
            $data['title'] = 'Slider 2';
            $this->load->view('admin/template/v_header', $data);
            $this->load->view('admin/template/v_navbar', $data);
            $this->load->view('admin/template/v_sidebar');
            $this->load->view('admin/slider', $data);
            $this->load->view('admin/template/v_footer');
        } else {
            $foto = null;
            // memeriksa apakah admin mengganti gambar atau tidak
            if ($_FILES['foto']['name'] !== null) {
                // jika memilih gambar
                $foto = $_FILES['foto']['name'];

                if ($foto !== '') {
                    $config['upload_path']   = './assets/dist/img/slide/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['max_size']      = '20000';
                    //$config['overwrite'] = true;
                    $config['encrypt_name'] = true;
                    //$config['file_name'] = $this->db->get_where('promo', array('id_promo' => $this->input->post('id_promo')))->row()->gambar;
                    // $config['max_width']  = '2048';
                    // $config['max_height']  = '2048';
                    // $config['encrypt_name'] = TRUE;

                    $this->load->library('upload');
                    $this->upload->initialize($config);

                    if (! $this->upload->do_upload('foto')) {
                        set_flashdata('pesan', '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf!</strong> Anda gagal mengunggah foto.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ');
                        $data['slider'] = $this->m_crud->getAll('foto_slider')->result();
                        //$data['sidebar'] = 'website';
                        $data['judul'] = 'Slider';
                        $data['title'] = 'Slider 2';
                        $this->load->view('admin/template/v_header', $data);
                        $this->load->view('admin/template/v_navbar', $data);
                        $this->load->view('admin/template/v_sidebar');
                        $this->load->view('admin/slider', $data);
                        $this->load->view('admin/template/v_footer');
                    } else {
                        $foto = $this->upload->data('file_name');
                    }
                }
            }
            $data = [
                'foto'      => $this->input->post('nama'),
                'deskripsi' => $this->input->post('deskripsi'),
                'file'      => $foto,
            ];

            $this->m_crud->insert($data, 'foto_slider');
            if ($this->db->affected_rows() === true) {
                set_flashdata('pesan', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Selamat!</strong> Anda berhasil menambahkan data.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ');
                redirect('admin/slider');
            } else {
                set_flashdata('pesan', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Maaf!</strong> Anda gagal menambahkan data.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ');
                redirect('admin/slider');
            }
        }
    }

    public function edit($id_foto)
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $where          = ['id_foto' => $id_foto];
        $data['slider'] = $this->m_crud->edit($where, 'foto_slider')->result();
        //$data['sidebar'] = 'website';
        $data['judul'] = 'Slider';
        $data['title'] = 'Slider 2';
        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar');
        $this->load->view('admin/edit_slider', $data);
        $this->load->view('admin/template/v_footer');
    }

    public function update()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();

        $id_foto      = $this->input->post('id_foto');
        $nama         = $this->input->post('nama');
        $deskripsi    = $this->input->post('deskripsi');
        $foto         = $this->input->post('foto_hapus');
        $upload_image = $_FILES['foto']['name'];
        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size']      = '2048';
            $config['upload_path']   = './assets/dist/img/slide/';
            $config['encrypt_name']  = true;

            $this->upload->initialize($config);

            if (! $this->upload->do_upload('foto')) {
                set_flashdata('message', 'gagal_upload');
                redirect('slider');
            } else {
                $upload_data = $this->upload->data();

                //Compress Image buat foto web
                $config['image_library']  = 'gd2';
                $config['width']          = 1600;
                $config['height']         = 900;
                $config['source_image']   = './assets/dist/img/slide/' . $upload_data['file_name'];
                $config['create_thumb']   = false;
                $config['maintain_ratio'] = false;
                $config['quality']        = '60%';
                $config['width']          = 600;
                $config['height']         = 400;
                $config['new_image']      = './assets/dist/img/slide/' . $upload_data['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $get = $this->db->get_where('foto_slider', ['id_foto' => $id_foto])->row();
                unlink(FCPATH . 'assets/dist/img/slide/' . $get->file);

                $upload_image = $this->upload->data('file_name');
            }
        } else {
            $upload_image = $foto;
        }

        $where = ['id_foto' => $id_foto];

        $data = [
            'foto'      => $nama,
            'deskripsi' => $deskripsi,
        ];

        $this->m_crud->update($where, $data, 'foto_slider');

        set_flashdata('message', 'edit');
        redirect('slider');
    }

    public function hapus($id_foto)
    {
        $where = [
            'id_foto' => $id_foto,
        ];
        $_id = $this->db->get_where('foto_slider', ['id_foto' => $id_foto])->row();
        $this->m_crud->delete($where, 'foto_slider');
        if ($this->db->affected_rows() === true) {
            unlink(FCPATH . 'assets/dist/img/slide/' . $_id->file);
            set_flashdata('pesan', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Selamat!</strong> Anda berhasil menghapus data.
                <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ');
            redirect('admin/slider');
        } else {
            set_flashdata('pesan', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Maaf!</strong> Anda gagal menghapus data.
                <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ');
            redirect('admin/slider');
        }
    }

    public function detail($id_foto)
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $where          = ['id_foto' => $id_foto];
        $data['slider'] = $this->m_crud->edit($where, 'foto_slider')->result();
        //$data['sidebar'] = 'website';
        $data['judul'] = 'Slider';
        $data['title'] = 'Slider 2';
        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar');
        $this->load->view('admin/detail_slider', $data);
        $this->load->view('admin/template/v_footer');
    }
}
