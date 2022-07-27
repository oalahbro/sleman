<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Jabatan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!user_logged_in()) {
            return redirect('auth');
        }
        $this->load->model('M_crud', 'm_crud');
        $this->load->model('M_jabatan');
    }

    public function addr_line1($addr_line1)
    {
        if (preg_match('/[\_^£$%&!*}{@#~><>|=+¬;.,:?]/', $addr_line1)) {
            $this->form_validation->set_message('addr_line1', 'Mohon maaf tidak diperbolehkan menggunakan karakter spesial');

            return false;
        }

        return true;
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        //$data['jabatan'] = $this->M_crud->getAll('struktur_jabatan')->result();
        $data['jabatan'] = $this->m_crud->getAll('jabatan')->result();
        //$data['sidebar'] = 'website';
        $data['judul'] = 'Data Jabatan';
        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar', $data);
        $this->load->view('admin/jabatan', $data);
        $this->load->view('admin/template/v_footer');
    }


    public function tambah()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $this->form_validation->set_rules('jenis_jabatan', 'Jenis Jabatan', 'trim|required|callback_addr_line1');

        // custom pesan
        $this->form_validation->set_message('required', 'Mohon maaf, {field} harus diisi');

        // custom wadah pesan (delimiter)
        $this->form_validation->set_error_delimiters('<div class="text-center"><span class="badge badge-danger text-white mt-2 px-4">', '</span></div>');

        // cek inputan sudah sesuai rules apa belum
        if ($this->form_validation->run() === false) {
            set_flashdata('pesan', '
            <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Maaf!</strong> Anda gagal menambahkan data, cek isian Anda.
                <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ');
            $data['jabatan'] = $this->m_crud->getAll('jabatan')->result();
            //$data[''] = 'website';
            $data['judul'] = 'Data Jabatan';
            $this->load->view('admin/template/v_header', $data);
            $this->load->view('admin/template/v_navbar', $data);
            $this->load->view('admin/template/v_sidebar', $data);
            $this->load->view('admin/jabatan', $data);
            $this->load->view('admin/template/v_footer');
        } else {
            $data = [
                // 'ID_REG' => $this->input->post('ID_REG'),
                'jenis_jabatan' => $this->input->post('jenis_jabatan'),

            ];

            $this->m_crud->insert($data, 'jabatan');
            if ($this->db->affected_rows() == true) {
                set_flashdata('pesan', '
                <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Selamat!</strong> Anda berhasil menambahkan data.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ');
                redirect('struktur-jabatan');
            } else {
                set_flashdata('pesan', '
                <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Maaf!</strong> Anda gagal menambahkan data.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ');
                redirect('struktur-jabatan');
            }
        }
    }

    public function delete()
    {
        $id  = $this->input->post('id_hapus', true);
        $get = $this->db->get_where('jabatan', ['id_jabatan' => $id])->row();

        $where = [
            'id_jabatan' => $id,
        ];
        $this->m_crud->delete($where, 'jabatan');
        // set_flashdata('pesan', 'dataDelete');
        set_flashdata('pesan', '
        <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Selamat!</strong> Anda berhasil menghapus data.
            <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        ');
        redirect('struktur-jabatan');
    }


    public function addr_line2($addr_line2)
    {
        if (preg_match('/[\_^£$%&!*}{@#~><>|=+¬;.,:?]/', $addr_line2)) {
            $this->form_validation->set_message('addr_line2', 'Mohon maaf tidak diperbolehkan menggunakan karakter spesial');

            return false;
        }

        return true;
    }

    public function edit()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $id_jabatan = $this->input->post('id_jabatan');

        //rules
        $this->form_validation->set_rules('jenis_jabatan1', 'Nama Jabatan', 'trim|required|callback_addr_line2');

        //custom pesan
        $this->form_validation->set_message('required', 'Mohon maaf, {field} harus diisi');

        //wadah pesan
        $this->form_validation->set_error_delimiters('<div class="text-center"><span class="badge badge-danger text-white mt-2 px-4">', '</span></div>');

        if ($this->form_validation->run() === false) {
            set_flashdata('pesan', '
            <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Maaf!</strong> Anda gagal mengubah data, cek isian Anda.
                <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ');
            $data['jabatan'] = $this->m_crud->getAll('jabatan')->result();
            //$data['sidebar'] = 'website';
            $data['judul'] = 'Data Jabatan';
            $this->load->view('admin/template/v_header', $data);
            $this->load->view('admin/template/v_navbar', $data);
            $this->load->view('admin/template/v_sidebar', $data);
            $this->load->view('admin/jabatan', $data);
            $this->load->view('admin/template/v_footer');
        } else {

            $data = [
                'jenis_jabatan' => $this->input->post('jenis_jabatan1'),
            ];
            // print_r('<pre>');
            // print_r($array);
            // print_r('<pre>');
            $where = ['id_jabatan' => $id_jabatan];
            $this->m_crud->update($where, $data, 'jabatan');
            if ($this->db->affected_rows() == true) {
                set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Selamat!</strong> Anda berhasil mengubah data.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ');
                redirect('struktur-jabatan');
            } else {
                set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf!</strong> Anda gagal mengubah data.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>/ ');
                redirect('struktur-jabatan');
            }
        }
    }
}
