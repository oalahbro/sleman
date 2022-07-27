<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Redaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!user_logged_in()) {
            return redirect('auth');
        }

        $this->load->model('M_crud');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $data['redaksi'] = $this->M_crud->tampil_redaksi()->result();
        //$data['sidebar'] = 'website';
        $data['judul'] = 'Struktur Redaksi';
        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar');
        $this->load->view('admin/redaksi', $data);
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

    public function addr_line2($addr_line2)
    {
        if (preg_match('/[\^£$%&*}{@#~><>|=+¬]/', $addr_line2)) {
            $this->form_validation->set_message('addr_line2', 'Mohon maaf tidak diperbolehkan menggunakan karakter spesial');

            return false;
        }

        return true;
    }

    public function tambah1()
    {

        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $data['redaksi']          = $this->M_crud->redaksi();
        $data['struktur_redaksi'] = $this->M_crud->getredaksi()->result();
        //$data['sidebar'] = 'website';
        $data['judul'] = 'Struktur Redaksi';
        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar');
        $this->load->view('admin/tambah_redaksi', $data);
        $this->load->view('admin/template/v_footer');
    }

    public function tambah()
    {
        // rules
        $this->form_validation->set_rules('struktur_redaksi', 'Struktur Redaksi', 'trim|required');
        $this->form_validation->set_rules('nama_pengurus', 'Nama Pengurus', 'trim|required|callback_addr_line2');
        $this->form_validation->set_rules('masjab', 'Masjab', 'trim|required|callback_addr_line2');


        // custom pesan
        $this->form_validation->set_message('required', 'Mohon maaf, {field} harus diisi');
        $this->form_validation->set_message('alpha_numeric', 'Mohon maaf, {field} harus diisi menggunakan huruf dan angka');
        $this->form_validation->set_message('alpha_numeric_spaces', 'Mohon maaf, {field} harus diisi menggunakan huruf, angka, spasi');
        $this->form_validation->set_message('min_length', 'Mohon maaf, Masukan {field} minimum {param} karakter');
        $this->form_validation->set_message('max_length', 'Mohon maaf, Masukan {field} maximum {param} karakter');

        //wadah pesan
        $this->form_validation->set_error_delimiters('<div class="text-center"><span class="badge badge-danger text-white mt-2 px-4">', '</span></div>');

        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        if ($this->form_validation->run() === false) {
            set_flashdata('pesan', '
            <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Maaf!</strong> Anda gagal menambahkan data, cek isian Anda.
                <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ');
            $data['judul']            = 'Struktur Redaksi';
            $data['redaksi']          = $this->M_crud->redaksi();
            $data['struktur_redaksi'] = $this->M_crud->getredaksi()->result();
            $this->load->view('admin/template/v_header', $data);
            $this->load->view('admin/template/v_navbar', $data);
            $this->load->view('admin/template/v_sidebar');
            $this->load->view('admin/tambah_redaksi', $data);
            $this->load->view('admin/template/v_footer');
        } else {
            $thumbnail = null;
            if ($_FILES['foto']['name'] !== null) {
                $thumbnail = $_FILES['foto']['name'];

                if ($thumbnail !== '') {
                    $config['upload_path']   = './uploads/images/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['max_size']      = '2048';
                    $config['encrypt_name']  = true;
                    // $this->load->library('upload');
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('foto')) {
                        set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Maaf!</strong> Anda gagal mengunggah foto.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    ');
                        $data['redaksi'] = $this->M_crud->getAll('redaksi')->result();
                        $this->load->view('admin/template/v_header', $data);
                        $this->load->view('admin/template/v_navbar', $data);
                        $this->load->view('admin/template/v_sidebar');
                        $this->load->view('admin/tambah_redaksi', $data);
                        $this->load->view('admin/template/v_footer');
                    } else {
                        $thumbnail = $this->upload->data('file_name');
                    }
                }
                $redaksi = [
                    'id_struktur_redaksi' => $this->input->post('struktur_redaksi'),
                    'gambar'              => $thumbnail,
                    'nama_pengurus'       => $this->input->post('nama_pengurus'),
                    'masa_jabatan'        => $this->input->post('masjab'),

                ];

                $this->M_crud->insert($redaksi, 'redaksi');
                if ($this->db->affected_rows() == true) {
                    set_flashdata('pesan', '
                <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Selamat!</strong> Anda berhasil menambahkan data.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                ');
                    redirect('redaction');
                } else {
                    set_flashdata('pesan', '
                <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Maaf!</strong> Anda gagal menambahkan data.
                <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                ');
                    redirect('redaction');
                }
            }
        }
    }

    public function edit($id_redaksi)
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $data['judul']   = 'Edit Redaksi';
        $data['redaksi'] = $this->db->query("SELECT * FROM redaksi, struktur_redaksi WHERE redaksi.id_struktur_redaksi = struktur_redaksi.id_struktur_redaksi AND redaksi.id_redaksi={$id_redaksi}")->result();
        // $data['struktur'] = $this->M_crud->jabatan();
        $data['struktur_redaksi'] = $this->M_crud->getredaksi()->result();
        // $data['struktur'] = $this->M_crud->jabatan();
        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar');
        $this->load->view('admin/edit_redaksi', $data);
        $this->load->view('admin/template/v_footer');
    }

    public function update()
    {
        $id_redaksi = $this->input->post('id_redaksi');

        // rules
        $this->form_validation->set_rules('struktur_redaksi', 'Redaksi', 'trim|required');
        $this->form_validation->set_rules('nama_pengurus', 'Nama Pengurus', 'trim|required|callback_addr_line1');
        $this->form_validation->set_rules('masjab', 'Nama Jabatan', 'trim|required|callback_addr_line1');


        // custom pesan
        $this->form_validation->set_message('required', 'Mohon maaf, {field} harus diisi');
        $this->form_validation->set_message('alpha_numeric', 'Mohon maaf, {field} harus diisi menggunakan huruf dan angka');
        $this->form_validation->set_message('alpha_numeric_spaces', 'Mohon maaf, {field} harus diisi menggunakan huruf, angka, spasi');
        $this->form_validation->set_message('min_length', 'Mohon maaf, Masukan {field} minimum {param} karakter');
        $this->form_validation->set_message('max_length', 'Mohon maaf, Masukan {field} maximum {param} karakter');

        //wadah pesan
        $this->form_validation->set_error_delimiters('<div class="text-center"><span class="badge badge-danger text-white mt-2 px-4">', '</span></div>');

        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        if ($this->form_validation->run() == false) {
            set_flashdata('pesan', '
            <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Maaf!</strong> Anda gagal mengubah data, cek isian Anda.
                <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ');
            $where           = ['id_redaksi' => $id_redaksi];
            $data['redaksi'] = $this->M_crud->edit($where, 'redaksi')->result();
            $data['sidebar'] = 'website';
            $data['judul']   = 'Data Tim Redaksi';
            $data['tittle']  = 'Data Tim Redaksi';
            $this->load->view('admin/template/v_header', $data);
            $this->load->view('admin/template/v_navbar', $data);
            $this->load->view('admin/template/v_sidebar', $data);
            $this->load->view('admin/edit_redaksi', $data);
            $this->load->view('admin/template/v_footer');
        } else {

            $thumbnail = null;
            $thumbnail = $_FILES['foto']['name'];
            $select    = $this->M_crud->edit(['id_redaksi' => $this->input->post('id_redaksi')], 'redaksi');

            if ($thumbnail !== '') {
                $filename = explode('.', $select->row()->gambar)[0];
                array_map('unlink', glob(FCPATH . "./uploads/images/{$filename}.*"));

                $config['upload_path']   = './uploads/images/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size']      = '2048';
                $config['encrypt_name']  = true;

                // $config['max_width']  = '2048';
                // $config['max_height']  = '2048';

                // $this->load->library('upload');
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('foto')) {
                    set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf!</strong> Anda gagal mengunggah thumbnail.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ');
                    $data['redaksi'] = $this->M_crud->getAll('redaksi')->result();
                    $this->load->view('admin/template/v_header', $data);
                    $this->load->view('admin/template/v_navbar', $data);
                    $this->load->view('admin/template/v_sidebar');
                    $this->load->view('admin/edit_redaksi', $data);
                    $this->load->view('admin/template/v_footer');
                } else {
                    $thumbnail = $this->upload->data('file_name');
                }

                // Tentukan masukan ke database
                $save = [
                    'id_struktur_redaksi' => $this->input->post('struktur_redaksi'),
                    'gambar'              => $thumbnail,
                    'nama_pengurus'       => $this->input->post('nama_pengurus'),
                    'masa_jabatan'        => $this->input->post('masjab'),

                ];

                $where = ['id_redaksi' => $id_redaksi];
                // query update data ke database
                $this->M_crud->update($where, $save, 'redaksi');
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
                    redirect('redaction');
                } else {
                    set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf!</strong> Anda gagal mengubah data.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ');
                    redirect("redaction/edit/{$id_redaksi}");
                }
            } else {
                $where = [
                    'id_redaksi' => $id_redaksi,
                ];

                $data = [
                    'id_struktur_redaksi' => $this->input->post('struktur_redaksi'),
                    'nama_pengurus'       => $this->input->post('nama_pengurus'),
                    'masa_jabatan'        => $this->input->post('masjab'),

                ];

                $this->M_crud->update($where, $data, 'redaksi');
                if ($this->db->affected_rows() == true) {
                    set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Selamat!</strong> Anda berhasil mengubah data.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ');
                    redirect('redaction');
                } else {
                    set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf!</strong> Anda gagal mengubah data.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ');
                    redirect("redaction/edit/{$id_redaksi}");
                }
                // terima kode data
            }
        }
    }

    public function delete()
    {
        $id  = $this->input->post('id_hapus', true);
        $get = $this->db->get_where('redaksi', ['id_redaksi' => $id])->row();
        // unlink(FCPATH . 'assets/dist/img/' . $get->gambar);
        unlink(FCPATH . 'uploads/images/' . $get->gambar);

        $where = [
            'id_redaksi' => $id,
        ];
        $this->M_crud->delete($where, 'redaksi');
        // set_flashdata('pesan', 'dataDelete');
        set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Selamat!</strong> Anda berhasil menghapus data.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ');
        redirect('redaction');
    }
}
