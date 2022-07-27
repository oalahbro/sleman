<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Pengaturan extends CI_Controller
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
        $data['judul'] = 'Data Pengaturan Website';
        $data['title'] = 'Data Pengaturan Website';

        $data['data'] = $this->m_crud->getAll('pengaturan', 1)->row_array();
        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar', $data);
        $this->load->view('admin/pengaturan', $data);
        $this->load->view('admin/template/v_footer');
    }

    public function update()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $data['data'] = $this->db->get('pengaturan')->row_array();

        $data['judul'] = 'Pengaturan';
        $data['title'] = 'Pengaturan';
        $id_pengaturan = $this->input->post('id_edit', true);
        $visi = $this->input->post('visi', true);
        $anggaran = $this->input->post('anggaran', true);
        $sejarah = $this->input->post('sejarah', true);
        $sambutan = $this->input->post('sambutan', true);

        /** Proses Edit Gambar */
        $upload_image1 = $_FILES['logo']['name'];

        if ($upload_image1) {
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']      = '2048';
            $config['encrypt_name']      = true;
            $config['upload_path']   = './assets/dist/img/logo/';

            $this->upload->initialize($config);

            if ($this->upload->do_upload('logo')) {
                $old_image = $data['data']['gambar_logo'];
                if ($old_image !== 'default-image.png') {
                    unlink(FCPATH . 'assets/dist/img/logo/' . $old_image);
                }
                $new_image = $this->upload->data('file_name');
                $this->db->set('gambar_logo', $new_image);
                $get = $this->db->get_where('pengaturan', ['id_pengaturan' => $id_pengaturan])->row();
                unlink(FCPATH . 'assets/dist/img/logo' . $get->gambar_logo);
            } else {
                set_flashdata('pesan', '
                <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Maaf!</strong> Anda gagal mengupload foto anda.
                <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
                ');
                redirect('pengaturan');
            }
        }

        /** Proses Edit Gambar */
        $upload_image2 = $_FILES['banner']['name'];

        if ($upload_image2) {
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']      = '3048';
            $config['encrypt_name']      = true;
            $config['upload_path']   = './assets/dist/img/banner/';

            $this->upload->initialize($config);

            if ($this->upload->do_upload('banner')) {
                $old_image = $data['data']['gambar_beranda'];
                if ($old_image !== 'default-image.png') {
                    unlink(FCPATH . 'assets/dist/img/banner/' . $old_image);
                }
                $new_image = $this->upload->data('file_name');
                $this->db->set('gambar_beranda', $new_image);
                $get = $this->db->get_where('pengaturan', ['id_pengaturan' => $id_pengaturan])->row();
                unlink(FCPATH . 'assets/dist/img/banner' . $get->gambar_beranda);
            } else {
                set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf!</strong> Anda gagal mengupload foto anda.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ');
                redirect('pengaturan');
            }
        }

        $this->m_crud->update_($id_pengaturan, $anggaran, $sambutan, $visi, $sejarah);
        if ($this->db->affected_rows() == true) {
            set_flashdata('pesan', '
                        <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Info!</strong> Anda berhasil mengubah data.
                            <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        ');
            redirect('pengaturan');
        } else {
            set_flashdata('pesan', '
                        <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Maaf!</strong> Anda gagal mengubah data.
                            <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>');
            redirect('pengaturan');
        }
    }
}
