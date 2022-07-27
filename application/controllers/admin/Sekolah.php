<?php

// Class Anggota
class Sekolah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_crud', 'm_crud');
        // $this->load->library('Primslib');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $data['sekolah'] = $this->m_crud->getAll('data_sekolah')->result();
        $data['sidebar'] = 'website';
        $data['judul']   = 'Data Sekolah';
        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar', $data);
        $this->load->view('admin/v_sekolah', $data);
        $this->load->view('admin/template/v_footer');
    }

    public function addr_line1($addr_line1)
    {
        if (preg_match('/[\_^£$%&!*}{@#~><>|=+¬]/', $addr_line1)) {
            $this->form_validation->set_message('addr_line1', 'Mohon maaf tidak diperbolehkan menggunakan karakter spesial');

            return false;
        }

        return true;
    }

    public function tambah()
    {
        // rules
        $this->form_validation->set_rules('alamat', 'Alamat Sekolah', 'trim|required|callback_addr_line1');
        $this->form_validation->set_rules('nama', 'Nama Sekolah', 'trim|required|callback_addr_line1');
        $this->form_validation->set_rules('notelp', 'Nomor Telepon', 'trim|required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

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
                    <strong>Maaf!</strong> Anda gagal menambahkan data, cek isian Anda.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ');
            $data['sekolah'] = $this->m_crud->getAll('data_sekolah')->result();
            $data['sidebar'] = 'website';
            $data['judul']   = 'Data Sekolah';
            $data['tittle']  = 'Data Kategori';
            $this->load->view('admin/template/v_header', $data);
            $this->load->view('admin/template/v_navbar', $data);
            $this->load->view('admin/template/v_sidebar', $data);
            $this->load->view('admin/v_sekolah', $data);
            $this->load->view('admin/template/v_footer');
        } else {
            $data = [
                'nama_sekolah'     => $this->input->post('nama'),
                'alamat_sekolah'   => $this->input->post('alamat'),
                'no_telepon'       => $this->input->post('notelp'),
                'kategori_sekolah' => $this->input->post('kategori'),
            ];
            $this->m_crud->insert($data, 'data_sekolah');
            if ($this->db->affected_rows() == true) {
                set_flashdata('pesan', '
                <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Selamat!</strong> Anda berhasil menambahkan data.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ');
                redirect('data_sekolah');
            } else {
                set_flashdata('pesan', '
                <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Maaf!</strong> Anda gagal menambahkan data.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ');
                redirect('data_sekolah');
            }
        }
    }

    public function edit($id_sekolah)
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $where           = ['id_sekolah' => $id_sekolah];
        $data['sekolah'] = $this->m_crud->edit($where, 'data_sekolah')->result();
        $data['sidebar'] = 'website';
        $data['judul']   = 'Data Sekolah';
        $data['tittle']  = 'Data Kategori';
        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar', $data);
        $this->load->view('admin/v_edit_sekolah', $data);
        $this->load->view('admin/template/v_footer');
    }

    public function addr_line2($addr_line2)
    {
        if (preg_match('/[\!_^£$%&*}{@#~><>|=+¬]/', $addr_line2)) {
            $this->form_validation->set_message('addr_line2', 'Mohon maaf tidak diperbolehkan menggunakan karakter spesial');

            return false;
        }

        return true;
    }

    public function update()
    {
        $id_sekolah = $this->input->post('id_sekolah');

        // rules
        $this->form_validation->set_rules('alamat', 'Alamat Sekolah', 'trim|required|callback_addr_line2');
        $this->form_validation->set_rules('nama', 'Nama Sekolah', 'trim|required|callback_addr_line2');
        $this->form_validation->set_rules('notelp', 'Nomor Telepon', 'trim|required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        //custom pesan
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
            <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Maaf!</strong> Anda gagal mengubah data, cek isian Anda.
                <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ');
            $where           = ['id_sekolah' => $id_sekolah];
            $data['sekolah'] = $this->m_crud->edit($where, 'data_sekolah')->result();
            $data['sidebar'] = 'website';
            $data['judul']   = 'Data Sekolah';
            $data['tittle']  = 'Data Kategori';
            $this->load->view('admin/template/v_header', $data);
            $this->load->view('admin/template/v_navbar', $data);
            $this->load->view('admin/template/v_sidebar', $data);
            $this->load->view('admin/v_edit_sekolah', $data);
            $this->load->view('admin/template/v_footer');
        } else {
            // Tentukan masukan ke database
            $save = [
                'nama_sekolah'     => $this->input->post('nama'),
                'alamat_sekolah'   => $this->input->post('alamat'),
                'no_telepon'       => $this->input->post('notelp'),
                'kategori_sekolah' => $this->input->post('kategori'),
            ];

            $where = ['id_sekolah' => $id_sekolah];
            // query update data ke database
            $this->m_crud->update($where, $save, 'data_sekolah');
            // cek apakah update berhasil
            if ($this->db->affected_rows() == true) {
                set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Selamat!</strong> Anda berhasil mengubah data.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ');
                redirect("data_sekolah/edit/{$id_sekolah}");
            } else {
                set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf!</strong> Anda gagal mengubah data.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ');
                redirect("data_sekolah/edit/{$id_sekolah}");
            }
        }
    }

    public function delete()
    {
        $id  = $this->input->post('id_hapus', true);
        $get = $this->db->get_where('data_sekolah', ['id_sekolah' => $id])->row();

        $where = [
            'id_sekolah' => $id,
        ];
        $this->m_crud->delete($where, 'data_sekolah');
        // set_flashdata('pesan', 'dataDelete');
        set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Selamat!</strong> Anda berhasil menghapus data.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ');
        redirect('data_sekolah');
    }
}
