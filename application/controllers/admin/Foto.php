<?php

class Foto extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_crud', 'm_crud');
        $this->load->model('M_foto');
        $this->load->library('UploadFoto');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $data['tittle'] = 'Data Foto';

        /** Ambil data tags */
        $data['foto']  = $this->M_foto->tampil_foto()->result();
        $data['judul'] = 'Foto - Dewandik';
        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar', $data);
        $this->load->view('admin/foto', $data);
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

    public function tambah_foto()
    {
        $judul     = htmlspecialchars($this->input->post('judul_foto'));
        $deskripsi = htmlspecialchars($this->input->post('deskripsi_foto'));


        $this->form_validation->set_rules('deskripsi_foto', 'Deskripsi Slider', 'trim|required|callback_addr_line1');
        $this->form_validation->set_rules('judul_foto', 'Judul Foto', 'trim|required|callback_addr_line1');


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
            <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Maaf!</strong> Anda gagal menambahkan data, cek isian Anda kembali.
                <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ');

            $data['foto']  = $this->M_foto->tampil_foto()->result();
            $data['tittle'] = 'Data Foto';
            $data['judul'] = 'Publikasi Riset - Dewandik';
            $this->load->view('admin/template/v_header', $data);
            $this->load->view('admin/template/v_navbar', $data);
            $this->load->view('admin/template/v_sidebar', $data);
            $this->load->view('admin/foto', $data);
            $this->load->view('admin/template/v_footer');
        } else {

            $data = [
                'judul_foto'     => $judul,
                'deskripsi_foto' => $deskripsi,
            ];

            if ($this->uploadfoto->fileUploaded('foto')) {
                $upload = $this->uploadfoto->doUpload('foto', true, url_title($judul, '_', true));

                if (!$upload['pass']) {
                    set_flashdata('pesan', '<div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Maaf!</strong> Anda gagal mengunggah foto.
                <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');

                    return redirect('foto_gk');
                }

                $data['foto'] = $upload['file_name'];
            }

            $this->M_foto->upload_($data, 'foto_gk');
            set_flashdata('pesan', '<div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Selamat!</strong> Anda berhasil mengunggah foto.
        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');

            redirect('foto_gk');
        }
    }



    public function update()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $id_foto = $this->input->post('id_foto');

        // rules
        $this->form_validation->set_rules('deskripsi_foto', 'Deskripsi Slider', 'trim|required|callback_addr_line1');
        $this->form_validation->set_rules('judul_foto', 'Judul Foto', 'trim|required|callback_addr_line1');

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
            <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Maaf!</strong> Anda gagal mengubah data, cek isian Anda kembali.
                <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ');
            $where        = ['id_foto' => $id_foto];
            $data['foto'] = $this->m_crud->edit($where, 'foto_gk')->result();
            //$data['sidebar'] = 'website';
            $data['judul']  = 'Publikasi Riset - Dewandik';
            $data['tittle'] = 'Foto Giat Kerja - Dewandik';
            //$data['tittle'] = "Data Kategori";
            $this->load->view('admin/template/v_header', $data);
            $this->load->view('admin/template/v_navbar', $data);
            $this->load->view('admin/template/v_sidebar', $data);
            $this->load->view('admin/edit_foto', $data);
            $this->load->view('admin/template/v_footer');
        } else {
            $id        = $this->input->post('id_foto');
            $judul     = $this->input->post('judul_foto');
            $deskripsi = $this->input->post('deskripsi_foto');
            // Tentukan masukan ke database
            $save = [
                'judul_foto'     => $judul,
                'deskripsi_foto' => $deskripsi,
            ];

            // jika upload foto
            if ($this->uploadfoto->fileUploaded('foto')) {
                // hapus foto yang lama
                $c = $this->M_foto->detail($id)->row();

                unlink(FCPATH . 'uploads/images/' . $c->foto);
                unlink(FCPATH . 'uploads/images/thumb/' . $c->foto);

                $post = $this->uploadfoto->doUpload('foto', true, url_title($judul, '-', true));

                if (!$post['pass']) {
                    set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf!</strong> Anda gagal mengunggah foto.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ');

                    return redirect('foto_gk/edit/' . $id_foto);
                }
                $save['foto'] = $post['file_name'];
            }

            $this->M_foto->update_(['id_foto' => $id], $save, 'foto_gk');

            if ($this->db->affected_rows() > -1) {
                set_flashdata('pesan', '
				<div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Selamat!</strong> Anda berhasil mengubah data.
					<button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				');
            } else {
                set_flashdata('pesan', '
				<div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Maaf!</strong> Anda gagal mengubah data.
					<button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				');
            }

            return redirect('foto_gk');
        }
    }

    public function edit($id_foto)
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $data['tittle'] = 'Data Foto';
        $where          = ['id_foto' => $id_foto];
        $data['foto']   = $this->m_crud->edit($where, 'foto_gk')->result();
        //$data['sidebar'] = 'website';
        $data['judul'] = 'Data Foto - Dewandik';
        //$data['tittle'] = "Data Kategori";
        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar', $data);
        $this->load->view('admin/edit_foto', $data);
        $this->load->view('admin/template/v_footer');
    }

    public function delete()
    {
        $id  = $this->input->post('id_hapus', true);
        $get = $this->db->get_where('foto_gk', ['id_foto' => $id])->row();
        unlink(FCPATH . 'uploads/images/' . $get->foto);
        unlink(FCPATH . 'uploads/images/thumb/' . $get->foto);

        $where = [
            'id_foto' => $id,
        ];
        $this->M_foto->delete_($where, 'foto_gk');
        // set_flashdata('pesan', 'dataDelete');
        set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Selamat!</strong> Anda berhasil menghapus data.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ');
        redirect('foto_gk');
    }

    public function detail($id_foto)
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $data['tittle'] = 'Data Foto';
        // $where = array(
        //     'ID_REG' => $id_regulasi
        // );
        // $this->M_crud->detail($where, 'regulasi');
        $data['judul']  = 'Detail Data Foto Giat Kerja';
        $data['dtfoto'] = $this->M_foto->detail($id_foto)->result();
        //$data['regulasi'] = $this->M_crud->detail($id_regulasi)->result();
        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar', $data);
        $this->load->view('admin/foto', $data);
        $this->load->view('admin/template/v_footer');
    }
}
