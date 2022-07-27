<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Category extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!user_logged_in()) {
            return redirect('auth');
        }

        $this->load->model('M_kategori', 'm_kategori');
        $this->load->library('upload');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $data['judul'] = 'Data Kategori';

        /** Ambil data kategori */
        $data['kategori'] = $this->m_kategori->tampil_kategori()->result();
        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar', $data);
        $this->load->view('admin/post/category', $data);
        $this->load->view('admin/template/v_footer');
    }

    public function addr_line1($addr_line1)
    {
        if (preg_match('/[\_^£$%&!*}{@#~><>|=+¬;.,:?]/', $addr_line1)) {
            $this->form_validation->set_message('addr_line1', 'Mohon maaf tidak diperbolehkan menggunakan karakter spesial');

            return false;
        }

        return true;
    }

    //tambah kategori di kategori
    public function tambah_kategori()
    {
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'trim|required|callback_addr_line1');

        //custom pesan
        $this->form_validation->set_message('required', 'Mohon maaf, {field} harus diisi');
        $this->form_validation->set_message('alpha_numeric', 'Mohon maaf, {field} harus diisi menggunakan huruf dan angka');
        $this->form_validation->set_message('alpha_numeric_spaces', 'Mohon maaf, {field} harus diisi menggunakan huruf, angka, spasi');
        $this->form_validation->set_message('min_length', 'Mohon maaf, Masukan {field} minimum {param} karakter');
        $this->form_validation->set_message('max_length', 'Mohon maaf, Masukan {field} maximum {param} karakter');

        // custom wadah pesan (delimiter)
        $this->form_validation->set_error_delimiters('<div class="text-center"><span class="badge badge-danger text-white mt-2 px-4">', '</span></div>');

        if ($this->form_validation->run() === false) {
            set_flashdata('pesan', '
                <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Maaf!</strong> Anda gagal menambahkan, data cek isian Anda kembali.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ');
            $data['judul'] = 'Data Kategori';
            $data['kategori'] = $this->m_kategori->tampil_kategori()->result();
            $this->load->view('admin/template/v_header', $data);
            $this->load->view('admin/template/v_navbar', $data);
            $this->load->view('admin/template/v_sidebar', $data);
            $this->load->view('admin/post/category', $data);
            $this->load->view('admin/template/v_footer');
        } else {

            $NM_CT = htmlspecialchars($this->input->post('nama_kategori'));
            $this->m_kategori->tmbh_kategori($NM_CT);
            set_flashdata('pesan', '
                        <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Selamat!</strong> Anda berhasil menambah data.
                            <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        ');
            redirect('category');
        }
    }

    //hapus kategori
    public function hapus()
    {
        $ID_CT = $this->input->post('ID_CT');
        $this->m_kategori->hapus_kategori($ID_CT);
        set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Selamat!</strong> Anda berhasil menghapus data.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ');
        redirect('category');
    }

    public function addr_line2($addr_line2)
    {
        if (preg_match('/[\_^£$%&!*}{@#~><>|=+¬;.,:?]/', $addr_line2)) {
            $this->form_validation->set_message('addr_line2', 'Mohon maaf tidak diperbolehkan menggunakan karakter spesial');

            return false;
        }

        return true;
    }


    //update kategori
    public function update_kategori()
    {
        $ID_CT = htmlspecialchars($this->input->post('id_kategori'));
        $NM_CT = htmlspecialchars($this->input->post('nama_kategori1'));

        $this->form_validation->set_rules('nama_kategori1', 'Nama Kategori', 'trim|required|callback_addr_line2');

        //custom pesan
        $this->form_validation->set_message('required', 'Mohon maaf, {field} harus diisi');
        $this->form_validation->set_message('alpha_numeric', 'Mohon maaf, {field} harus diisi menggunakan huruf dan angka');
        $this->form_validation->set_message('alpha_numeric_spaces', 'Mohon maaf, {field} harus diisi menggunakan huruf, angka, spasi');
        $this->form_validation->set_message('min_length', 'Mohon maaf, Masukan {field} minimum {param} karakter');
        $this->form_validation->set_message('max_length', 'Mohon maaf, Masukan {field} maximum {param} karakter');

        // custom wadah pesan (delimiter)
        $this->form_validation->set_error_delimiters('<div class="text-center"><span class="badge badge-danger text-white mt-2 px-4">', '</span></div>');

        if ($this->form_validation->run() === false) {
            set_flashdata('pesan', '
            <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Maaf!</strong> Anda gagal mengubah data, cek isian Anda kembali.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            ');
            $data = [
                'nama_kategori' => $NM_CT,
            ];
            $where = ['id_kategori' => $ID_CT];
            $data['judul'] = 'Data Kategori';
            $data['kategori'] = $this->m_kategori->tampil_kategori()->result();
            $this->load->view('admin/template/v_header', $data);
            $this->load->view('admin/template/v_navbar', $data);
            $this->load->view('admin/template/v_sidebar', $data);
            $this->load->view('admin/post/category', $data);
            $this->load->view('admin/template/v_footer');
        } else {
            $data = [
                'nama_kategori' => $NM_CT,
            ];
            $where = ['id_kategori' => $ID_CT];
            $this->m_kategori->update_kategori($where, $data, 'kategori');
            set_flashdata('pesan', '
                        <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Selamat!</strong> Anda berhasil mengubah data.
                            <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        ');
            redirect('category');
        }
    }
}
