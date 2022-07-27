<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Regulation extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!user_logged_in()) {
            return redirect('auth');
        }

        $this->load->model('M_crud', 'm_crud');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        //$data['jabatan'] = $this->M_crud->getAll('struktur_jabatan')->result();
        $data['regulasi'] = $this->m_crud->getAll('regulasi')->result_array();
        //$data['sidebar'] = 'website';
        $data['judul'] = 'Data Regulasi';
        $data['title'] = 'Data Regulasi';

        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar', $data);
        $this->load->view('admin/regulation', $data);
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

    public function tambah()
    {
        $data['judul'] = 'Data Regulasi';
        $data['title'] = 'Data Regulasi';
        $data['user']  = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();

        //rules
        $this->form_validation->set_rules('judul', 'Judul Regulasi', 'trim|required|callback_addr_line1');
        $this->form_validation->set_rules('isi', 'Isi Regulasi', 'trim|required');

        //custom pesan
        $this->form_validation->set_message('required', 'Mohon maaf, {field} harus diisi');

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
            $data['regulasi'] = $this->m_crud->getAll('regulasi')->result_array();
            $this->load->view('admin/template/v_header', $data);
            $this->load->view('admin/template/v_navbar', $data);
            $this->load->view('admin/template/v_sidebar', $data);
            $this->load->view('admin/regulation', $data);
            $this->load->view('admin/template/v_footer');
        } else {
            $data = [
                'judul'  => $this->input->post('judul'),
                'isi'    => $this->input->post('isi'),
                'status' => 0,
            ];

            $this->m_crud->insert($data, 'regulasi');
            if ($this->db->affected_rows() == true) {
                set_flashdata('pesan', '
                <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Selamat!</strong> Anda berhasil menambahkan data.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ');
                redirect('regulation');
            } else {
                set_flashdata('pesan', '
                <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Maaf!</strong> Anda gagal menambahkan data.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ');
                redirect('regulation');
            }
        }
    }

    public function edit()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $id_regulasi = $this->input->post('ID_REG');

        //rules
        $this->form_validation->set_rules('judul1', 'Judul Regulasi', 'trim|required|callback_addr_line1');
        $this->form_validation->set_rules('isi1', 'Isi Regulasi', 'trim|required');

        //custom pesan
        $this->form_validation->set_message('required', 'Mohon maaf, {field} harus diisi');

        //wadah pesan
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
            $data['regulasi'] = $this->m_crud->getAll('regulasi')->result_array();
            $this->load->view('admin/template/v_header', $data);
            $this->load->view('admin/template/v_navbar', $data);
            $this->load->view('admin/template/v_sidebar', $data);
            $this->load->view('admin/regulation', $data);
            $this->load->view('admin/template/v_footer');
        } else {
            $array = [
                'judul' => $this->input->post('judul1'),
                'isi'   => $this->input->post('isi1'),
            ];
            $where = ['id_regulasi' => $id_regulasi];
            $this->m_crud->update($where, $array, 'regulasi');
            if ($this->db->affected_rows() == true) {
                set_flashdata('pesan', '
                        <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Selamat!</strong> Anda berhasil mengubah data.
                            <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        ');
                redirect('regulation');
            } else {
                set_flashdata('pesan', '
                        <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Maaf!</strong> Anda gagal mengubah data.
                            <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>');
                redirect('regulation');
            }
        }
    }

    public function delete()
    {
        $id    = $this->input->post('id_delete');
        $where = [
            'id_regulasi' => $id,
        ];
        $this->m_crud->delete($where, 'regulasi');
        if ($this->db->affected_rows() == true) {
            set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Selamat!</strong> Anda berhasil menghapus data.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ');
            redirect('regulation');
        } else {
            set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf!</strong> Anda gagal menghapus data.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
            redirect('regulation');
        }
        redirect('regulation');
    }

    public function tampil()
    {
        $id = $this->input->post('id_tampil');
        $this->m_crud->tampil($id);
        if ($this->db->affected_rows() == true) {
            set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Info!</strong> data yang Anda pilih akan ditampilkan.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ');
            redirect('regulation');
        } else {
            set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Info!</strong> Anda gagal mengubah data.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
            redirect('regulation');
        }
    }

    public function tak_tampil()
    {
        $id = $this->input->post('id_tak_tampil');
        $this->m_crud->tak_tampil($id);
        if ($this->db->affected_rows() == true) {
            set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Info!</strong> data yang Anda pilih tidak akan ditampilkan.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ');
            redirect('regulation');
        } else {
            set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Info!</strong> Anda gagal mengubah data.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>/ ');
            redirect('regulation');
        }
    }
}
