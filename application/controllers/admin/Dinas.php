<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Dinas extends CI_Controller
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
        $data['dinas'] = $this->db->query("SELECT * FROM dinas ORDER BY id_diter DESC")->result_array();
        //$data['sidebar'] = 'website';
        $data['judul'] = 'Dinas Terkait';
        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar');
        $this->load->view('admin/v_dinas', $data);
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

    public function check_valid_url($param)
    {
        if (!filter_var($param, FILTER_VALIDATE_URL)) {
            $this->form_validation->set_message('check_valid_url', 'Masukkan {field} link yang benar');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function tambah()
    {
        $nama  = htmlspecialchars($this->input->post('nama_dinas'));
        $link = htmlspecialchars($this->input->post('link'));
        $status = htmlspecialchars($this->input->post('status'));
        // rules
        $this->form_validation->set_rules('nama_dinas', 'Nama Dinas', 'trim|required|callback_addr_line1');
        $this->form_validation->set_rules('link', 'Link Website', 'trim|required|callback_addr_line1|callback_check_valid_url');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

        // custom pesan
        $this->form_validation->set_message('required', 'Mohon maaf, {field} harus diisi');

        // custom wadah pesan (delimiter)
        $this->form_validation->set_error_delimiters('<div class="text-center"><span class="badge badge-danger text-white mt-2 px-4">', '</span></div>');

        // cek inputan sudah sesuai rules apa belum
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
            $data['dinas'] = $this->m_crud->getAll('dinas')->result_array();
            //$data['sidebar'] = 'website';
            $data['judul'] = 'Dinas Terkait - Dewandik';
            //$data['tittle'] = "Data Kategori";
            $this->load->view('admin/template/v_header', $data);
            $this->load->view('admin/template/v_navbar', $data);
            $this->load->view('admin/template/v_sidebar');
            $this->load->view('admin/v_dinas', $data);
            $this->load->view('admin/template/v_footer');
        } else {
            $upload = $_FILES['file']['name'];

            if ($upload) {
                $config['upload_path']      = $this->config->item('uploadPath');
                $config['allowed_types']    = 'jpg|jpeg|png';
                $config['max_size']         = 2048;
                $config['file_ext_tolower'] = true;
                $config['encrypt_name']     = true;
                $config['max_filename']     = 120;

                $this->load->library('upload');

                $this->upload->initialize($config);

                if ($this->upload->do_upload('file')) {
                    $file = $this->upload->data('file_name');
                    $this->db->set('logo', $file);
                } else {
                    set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Info!</strong> Anda gagal menambahkan gambar, cek isian Anda.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ');
                }
            }

            $data = [
                'nama_dinas' => $nama,
                'link'       => $link,
                'status'     => $status
            ];

            $this->m_crud->insert($data, 'dinas');
            if ($this->db->affected_rows() == true) {
                set_flashdata('pesan', '
                <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Selamat!</strong> Anda berhasil menambahkan data.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ');
                redirect('dinas');
            } else {
                set_flashdata('pesan', '
                <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Maaf!</strong> Anda gagal menambahkan data.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ');
                redirect('dinas');
            }
        }
    }


    public function edit($id_diter)
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $data['judul']   = 'Edit Dinas Terkait';
        $data['dinas'] = $this->db->query("SELECT * FROM dinas WHERE dinas.id_diter={$id_diter}")->result();
        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar');
        $this->load->view('admin/edit_dinas', $data);
        $this->load->view('admin/template/v_footer');
    }

    public function update()
    {
        $id_diter = $this->input->post('id_diter');

        //rules
        $this->form_validation->set_rules('nama_dinas', 'Nama Dinas', 'trim|required|callback_addr_line1');
        $this->form_validation->set_rules('link', 'Link Website', 'trim|required|callback_addr_line1|callback_check_valid_url');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

        //custom pesan
        $this->form_validation->set_message('required', 'Mohon maaf, {field} harus diisi');

        //wadah pesan
        $this->form_validation->set_error_delimiters('<div class="text-center"><span class="badge badge-danger text-white mt-2 px-4">', '</span></div>');

        // cek inputan sudah sesuai rules apa belum
        if ($this->form_validation->run() == false) {
            set_flashdata('pesan', '
            <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Maaf!</strong> Anda gagal mengubah data, cek isian Anda.
                <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ');
            $where           = ['id_diter' => $id_diter];
            $data['dinas'] = $this->m_crud->edit($where, 'dinas')->result();
            $data['sidebar'] = 'website';
            $data['judul']   = 'Dinas Terkait';
            $data['tittle']  = 'Dinas Terkait';
            $this->load->view('admin/template/v_header', $data);
            $this->load->view('admin/template/v_navbar', $data);
            $this->load->view('admin/template/v_sidebar', $data);
            $this->load->view('admin/edit_dinas', $data);
            $this->load->view('admin/template/v_footer');
        } else {

            $thumbnail = null;
            $thumbnail = $_FILES['logo']['name'];
            $select    = $this->m_crud->edit(['id_diter' => $this->input->post('id_diter')], 'dinas');

            if ($thumbnail !== '') {
                $filename = explode('.', $select->row()->logo)[0];
                array_map('unlink', glob(FCPATH . "./uploads/images/{$filename}.*"));

                $config['upload_path']   = './uploads/images/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size']      = '2048';
                $config['encrypt_name']  = true;

                // $config['max_width']  = '2048';
                // $config['max_height']  = '2048';

                // $this->load->library('upload');
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('logo')) {
                    set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf!</strong> Anda gagal mengunggah thumbnail.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ');
                    $where = ['id_diter' => $id_diter];
                    $data['dinas'] = $this->m_crud->edit($where, 'dinas')->result();
                    $this->load->view('admin/template/v_header', $data);
                    $this->load->view('admin/template/v_navbar', $data);
                    $this->load->view('admin/template/v_sidebar');
                    $this->load->view('admin/edit_dinas', $data);
                    $this->load->view('admin/template/v_footer');
                } else {
                    $thumbnail = $this->upload->data('file_name');
                }

                // Tentukan masukan ke database
                $save = [
                    'nama_dinas'       => $this->input->post('nama_dinas'),
                    'logo'              => $thumbnail,
                    'link'        => $this->input->post('link'),
                    'status'        => $this->input->post('status'),
                ];

                $where = ['id_diter' => $id_diter];
                // query update data ke database
                $this->m_crud->update($where, $save, 'dinas');
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
                    redirect('dinas');
                } else {
                    set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf!</strong> Anda gagal mengubah data.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ');
                    redirect("dinas/edit/{$id_diter}");
                }
            } else {
                $where = [
                    'id_diter' => $id_diter,
                ];

                $data = [
                    
                    'nama_dinas'       => $this->input->post('nama_dinas'),
                    'link'        => $this->input->post('link'),
                    'status'        => $this->input->post('status'),

                ];

                $this->m_crud->update($where, $data, 'dinas');
                if ($this->db->affected_rows() == true) {
                    set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Selamat!</strong> Anda berhasil mengubah data.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ');
                    redirect('dinas');
                } else {
                    set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf!</strong> Anda gagal mengubah data.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ');
                    redirect("dinas/edit/{$id_diter}");
                }
                // terima kode data
            }
        }
    }

    public function delete()
    {
        $id_diter = $this->input->post('id_diter');
        $where    = [
            'id_diter' => $id_diter,
        ];
        $get = $this->db->get_where('dinas', ['id_diter' => $id_diter])->row();
        unlink(FCPATH . 'uploads/images/' . $get->logo);
        $this->m_crud->delete($where, 'dinas');
        if ($this->db->affected_rows() == true) {
            set_flashdata('pesan', '
                <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Selamat!</strong> Anda berhasil menghapus data.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ');
            redirect('dinas');
        } else {
            set_flashdata('pesan', '
                <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Maaf!</strong> Anda gagal menghapus data.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ');
            redirect('dinas');
        }
    }
}
