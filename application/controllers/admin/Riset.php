<?php

class Riset extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!user_logged_in()) {
            return redirect('auth');
        }

        $this->load->model('M_publikasi');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $data['judul'] = 'Data Publikasi';
        $data['title'] = 'Data Publikasi';

        $data['publikasi'] = $this->M_publikasi->tampil_publikasi()->result();
        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar', $data);
        $this->load->view('admin/riset', $data);
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

    public function cek($cek)
    {
        if (preg_match('/[\^£$%&*}{@#~><>|=+¬]/', $cek)) {
            $this->form_validation->set_message('cek', 'Mohon maaf tidak diperbolehkan menggunakan karakter spesial');

            return false;
        }

        return true;
    }

    // CREATE FILE Publikasi Riset
    public function tambah_publikasi()
    {
        $this->form_validation->set_rules('nama_pembuat', 'Nama Pembuat', 'trim|required|callback_addr_line1');
        $this->form_validation->set_rules('judul_riset', 'Judul Riset', 'trim|required|callback_addr_line1');
        //$this->form_validation->set_rules('file', 'File', 'trim|required');

        // custom pesan
        $this->form_validation->set_message('required', 'Mohon maaf, {field} harus diisi');

        // custom wadah pesan (delimiter)
        $this->form_validation->set_error_delimiters('<div class="text-center"><span class="badge badge-danger text-white mt-2 px-4">', '</span></div>');

        if ($this->form_validation->run() == false) {
            set_flashdata('pesan', '
            <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Maaf!</strong> Anda gagal menambahkan data, cek isian Anda.
                <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ');

            $data['user'] = $this->db->get_where('user', [
                'email' => $this->session->userdata('mail'),
            ])->row_array();
            $data['judul'] = 'Data Publikasi';
            $data['title'] = 'Data Publikasi';

            $data['publikasi'] = $this->M_publikasi->tampil_publikasi()->result();
            $this->load->view('admin/template/v_header', $data);
            $this->load->view('admin/template/v_navbar', $data);
            $this->load->view('admin/template/v_sidebar', $data);
            $this->load->view('admin/riset', $data);
            $this->load->view('admin/template/v_footer');
        } else {

            $upload = $_FILES['file']['name'];
            if ($upload) {
                $config['upload_path'] = $this->config->item('uploadPublikasiPath');
                $config['allowed_types'] = 'pdf|doc|docx|ppt|pptx|xlsx|xlx';
                $config['max_size'] = 10048;
                $config['overwrite'] = true;
                $config['encrypt_name'] = true;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('file')) {
                    $new = $this->upload->data('file_name');
                    $this->db->set('file', $new);
                } else {
                    set_flashdata('pesan', '<div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Info!</strong> Anda gagal menambahkan.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect("riset");
                }
            }

            $data = [
                'nama_pembuat' => $this->input->post('nama_pembuat'),
                'judul_riset'  => $this->input->post('judul_riset'),
            
                // 'tgl'  => ''
            ];
            $this->M_publikasi->upload_($data, 'publikasi_riset');
            set_flashdata('pesan', '<div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Info!</strong> Anda Berhasil menambahkan.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>');

            redirect("riset");
        }
    }

    // UPDATE FILE MATERI
    public function edit()
    {
        $id = $this->input->post('id_edit');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required|callback_cek');
        $this->form_validation->set_rules('judul', 'Judul', 'trim|required|callback_cek');
        // $this->form_validation->set_rules('berkas', 'Berkas', 'required');

        // custom pesan
        $this->form_validation->set_message('required', 'Mohon maaf, {field} harus diisi');

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

            $data['user'] = $this->db->get_where('user', [
                'email' => $this->session->userdata('mail'),
            ])->row_array();
            $data['judul'] = 'Data Publikasi';
            $data['title'] = 'Data Publikasi';

            $data['publikasi'] = $this->M_publikasi->tampil_publikasi()->result();
            $this->load->view('admin/template/v_header', $data);
            $this->load->view('admin/template/v_navbar', $data);
            $this->load->view('admin/template/v_sidebar', $data);
            $this->load->view('admin/riset', $data);
            $this->load->view('admin/template/v_footer');
        } else {
            $upload = $_FILES['berkas']['name'];
            if ($upload) {
                $config['upload_path'] = $this->config->item('uploadPublikasiPath');
                $config['allowed_types'] = 'pdf|doc|docx|ppt|pptx|xlsx|xlx';
                $config['max_size'] = 10048;
                $config['overwrite'] = true;
                $config['encrypt_name'] = true;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('berkas')) {
                    $new = $this->upload->data('file_name');
                    $this->db->set('file', $new);
                    $get = $this->db->get_where('publikasi_riset', ['id_publikasi' => $id])->row();
                    unlink(FCPATH . 'uploads/docs/' . $get->file);
                } else {
                    set_flashdata('pesan', '<div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Info!</strong> Anda Gagal menambahkan file.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                    redirect("riset");
                }
            }

            $data = array(
                'nama_pembuat' => $this->input->post('nama'),
                'judul_riset'  => $this->input->post('judul')
            );

            $where = array(
                'id_publikasi' => $id
            );
            $this->M_publikasi->update_($where, $data, 'publikasi_riset');
            set_flashdata('pesan', '<div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Info!</strong> Anda Berhasil menambahkan.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');

            redirect("riset");
        }
    }

    // DELETE
    public function delete()
    {
        $id = $this->input->post('id_hapus', TRUE);
        $where = array(
            'id_publikasi' => $id
        );
        $this->M_publikasi->delete_($where, 'publikasi_riset');
        $get = $this->db->get_where('publikasi_riset', ['id_publikasi' => $id])->row();
        unlink(FCPATH . 'uploads/docs/' . $get->file);
        set_flashdata('pesan', '<div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Info!</strong> Anda Berhasil menghapus data.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
        redirect("riset");
    }
}
