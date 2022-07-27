<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Struktur extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (! user_logged_in()) {
            return redirect('auth');
        }

        $this->load->model('M_struktur', 'struktur');
        $this->load->model('M_crud');
        $this->load->library('uploadfoto');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();

        $data['struktur'] = $this->struktur->getAll()->result();
        $data['judul']    = 'Struktur';
        $data['title']    = 'Struktur';

        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar');
        $this->load->view('admin/struktur', $data);
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
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();

        $data['struktur'] = $this->M_crud->jabatan();
        $data['jabatan']  = $this->M_crud->getjabatan()->result();
        $data['judul']    = 'Tambah Struktur';
        $data['title']    = 'Tambah Struktur';

        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar');
        $this->load->view('admin/tambahstruk', $data);
        $this->load->view('admin/template/v_footer');
    }

    public function simpan()
    {
        $this->form_validation->set_error_delimiters('<div class="text-center"><span class="badge badge-danger text-white mt-2 px-4">', '</span></div>');

        if ($this->form_validation->run('struktur/submit') === false) {
            $this->tambah();
        } else {
            $this->load->library('uploadfoto');

            $id_jabatan    = htmlspecialchars($this->input->post('jabatan'), ENT_QUOTES);
            $nama_pengurus = htmlspecialchars($this->input->post('nama_pengurus'), ENT_QUOTES);
            $masa_jabatan  = htmlspecialchars($this->input->post('masjab'), ENT_QUOTES);
            $thumbnail     = null; // default jika tidak ada foto yang diupload

            // jika upload foto
            if ($this->uploadfoto->fileUploaded('foto')) {
                $diupload = $this->uploadfoto->doUpload('foto', false, url_title($nama_pengurus, '-', true), 2048, 500, 500);

                if (! $diupload['pass']) {
                    set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf!</strong> Anda gagal mengunggah foto.
                    </div>');

                    return redirect('structure/tambah');
                }

                $thumbnail = $diupload['file_name'];
            }

            $struktur = [
                'id_jabatan'    => $id_jabatan,
                'image'         => $thumbnail,
                'nama_pengurus' => $nama_pengurus,
                'masa_jabatan'  => $masa_jabatan,

            ];

            $this->M_crud->insert($struktur, 'struktur');

            if ($this->db->affected_rows() > 0) {
                $pesan = '<strong>Selamat!</strong> Anda berhasil menambahkan data.';
            } else {
                $pesan = '<strong>Maaf!</strong> Anda gagal menambahkan data.';
            }

            set_flashdata('pesan', '<div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                ' . $pesan . '
                <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('structure');
        }
    }

    public function edit($id_struktur)
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $data['judul']    = 'Edit Struktur';
        $data['struktur'] = $this->db->query("SELECT * FROM struktur, jabatan WHERE struktur.id_jabatan = jabatan.id_jabatan AND struktur.id_struktur={$id_struktur}")->result();
        // $data['struktur'] = $this->M_crud->jabatan();
        $data['jabatan'] = $this->M_crud->getjabatan()->result();
        // $data['struktur'] = $this->M_crud->jabatan();
        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar');
        $this->load->view('admin/edit_struktur', $data);
        $this->load->view('admin/template/v_footer');
    }

    public function update()
    {
        $id_struktur   = $this->input->post('id_struktur');
        $nama_pengurus = $this->input->post('nama_pengurus');
        $masa_jabatan  = $this->input->post('masjab');
        $jabatan       = $this->input->post('jabatan');

        $this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required');
        $this->form_validation->set_rules('nama_pengurus', 'Nama Pengurus', 'trim|required|callback_addr_line1');
        $this->form_validation->set_rules('masjab', 'Nama Jabatan', 'trim|required|callback_addr_line1');
        //$this->form_validation->set_rules('masir', 'Masa Berakhir', 'trim|required|alpha_numeric_spaces|min_length[2]|max_length[100]');

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
                <strong>Maaf!</strong> Anda gagal mengubah data, cek isian Anda.
                <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ');
            $where            = ['id_struktur' => $id_struktur];
            $data['struktur'] = $this->M_crud->edit($where, 'struktur')->result();
            $data['sidebar']  = 'website';
            $data['judul']    = 'Data Struktur Jabatan';
            $data['tittle']   = 'Data Struktur Jabatan';
            $this->load->view('admin/template/v_header', $data);
            $this->load->view('admin/template/v_navbar', $data);
            $this->load->view('admin/template/v_sidebar', $data);
            $this->load->view('admin/edit_struktur', $data);
            $this->load->view('admin/template/v_footer');
        } else {
            $save = [
                'id_jabatan'    => $jabatan,
                'nama_pengurus' => $nama_pengurus,
                'masa_jabatan'  => $masa_jabatan,
            ];

            if ($this->uploadfoto->fileUploaded('foto')) {
                // gambarnya diganti
                $data = $this->uploadfoto->doUpload('foto', true, url_title($nama_pengurus . ' ' . mt_rand(0, 999), '-', true));

                if (! $data['pass']) {
                    set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error</strong> Gambar gagal diunggah
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');

                    return redirect('admin/struktur/edit/' . $id_struktur);
                }

                // hapus gambar lama
                $gambar_lama = $this->input->post('gambar_lama');

                unlink(FCPATH . 'uploads/images/' . $gambar_lama);
                unlink(FCPATH . 'uploads/images/thumb/' . $gambar_lama);

                $save['image'] = $data['file_name'];
            }

            // query update data ke database
            $this->struktur->update($id_struktur, $save);

            set_flashdata('pesan', '
            <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Selamat!</strong> Anda berhasil mengubah data.
                <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');

            return redirect('structure');
        }
        // Tentukan masukan ke database
    }

    public function delete()
    {
        $id  = $this->input->post('id_hapus', true);
        $get = $this->db->get_where('struktur', ['id_struktur' => $id])->row();
        // unlink(FCPATH . 'assets/dist/img/' . $get->gambar);
        unlink(FCPATH . 'uploads/images/' . $get->image);

        $where = [
            'id_struktur' => $id,
        ];
        $this->M_crud->delete($where, 'struktur');
        // set_flashdata('pesan', 'dataDelete');
        set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Selamat!</strong> Anda berhasil menghapus data.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ');
        redirect('structure');

        // $id = $this->input->post('id_hapus', true);
        // $this->struktur->delete($id);
        // // set_flashdata('pesan', 'dataDelete');
        // redirect('structure');
    }

    public function detail($id_struktur)
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        // $where = array(
        //     'ID_REG' => $id_regulasi
        // );
        // $this->M_crud->detail($where, 'regulasi');
        $data['judul']    = 'Detail Data Struktur';
        $data['struktur'] = $this->M_crud->detail($id_struktur)->result();
        //$data['regulasi'] = $this->M_crud->detail($id_regulasi)->result();
        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar');
        $this->load->view('admin/detail_struktur', $data);
        $this->load->view('admin/template/v_footer');
    }
}
