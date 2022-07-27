<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Banner extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!user_logged_in()) {
            return redirect('auth');
        }
        $this->load->model('M_crud', 'm_crud');
    }

    function index()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $data['banner'] = $this->db->query("SELECT * FROM banner ORDER BY id_banner DESC")->result_array();
        //$data['sidebar'] = 'website';
        $data['judul'] = 'Data Banner';
        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar');
        $this->load->view('admin/v_banner', $data);
        $this->load->view('admin/template/v_footer');
    }


    function addr_line1($addr_line1)
    {
        if (preg_match('/[<>]/', $addr_line1)) {
            $this->form_validation->set_message('addr_line1', 'Mohon maaf tidak diperbolehkan menggunakan karakter spesial');
            return false;
        } else {
            return true;
        }
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


    public function tambah1()
    {
        //$nama  = htmlspecialchars($this->input->post('nama_dinas'));
        $link = htmlspecialchars($this->input->post('link'));
        $status = htmlspecialchars($this->input->post('status'));
        // rules
        //$this->form_validation->set_rules('nama_dinas', 'Nama Dinas', 'trim|required|callback_addr_line1');
        $this->form_validation->set_rules('link', 'Link Banner', 'trim|required|callback_addr_line1|callback_check_valid_url');
        $this->form_validation->set_rules('status', 'Status Banner', 'trim|required');


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
            $data['banner'] = $this->m_crud->getAll('banner')->result_array();
            //$data['sidebar'] = 'website';
            $data['judul'] = 'Data Banner';
            //$data['tittle'] = "Data Kategori";
            $this->load->view('admin/template/v_header', $data);
            $this->load->view('admin/template/v_navbar', $data);
            $this->load->view('admin/template/v_sidebar');
            $this->load->view('admin/v_banner', $data);
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
                    $this->db->set('foto_banner', $file);
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

                'link_banner'       => $link,
                'status_banner'     => $status,
                
            ];

            $this->m_crud->insert($data, 'banner');
            if ($this->db->affected_rows() == true) {
                set_flashdata('pesan', '
                <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Selamat!</strong> Anda berhasil menambahkan data.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ');
                redirect('banner');
            } else {
                set_flashdata('pesan', '
                <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Maaf!</strong> Anda gagal menambahkan data.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ');
                redirect('banner');
            }
        }
    }

    public function edit($id_banner)
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $data['judul']   = 'Edit Banner';
        $data['banner'] = $this->db->query("SELECT * FROM banner WHERE id_banner={$id_banner}")->result();
        // $data['struktur'] = $this->M_crud->jabatan();
        //$data['struktur_redaksi'] = $this->m_crud->getredaksi()->result();
        // $data['struktur'] = $this->M_crud->jabatan();
        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar');
        $this->load->view('admin/edit_banner', $data);
        $this->load->view('admin/template/v_footer');
    }

    public function update()
    {
        $id_banner = $this->input->post('id_banner');

        //$this->form_validation->set_rules('nama_dinas', 'Nama Dinas', 'trim|required|callback_addr_line1');
        $this->form_validation->set_rules('link_banner', 'Link Banner', 'trim|required|callback_addr_line1|callback_check_valid_url');
        $this->form_validation->set_rules('status_banner', 'Status Banner', 'trim|required');

        // custom pesan
        $this->form_validation->set_message('required', 'Mohon maaf, {field} harus diisi');

        // custom wadah pesan (delimiter)
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
            $where           = ['id_banner' => $id_banner];
            $data['banner'] = $this->m_crud->edit($where, 'banner')->result();
            $data['sidebar'] = 'website';
            $data['judul']   = 'Data Banner';
            $data['tittle']  = 'Data Banner';
            $this->load->view('admin/template/v_header', $data);
            $this->load->view('admin/template/v_navbar', $data);
            $this->load->view('admin/template/v_sidebar', $data);
            $this->load->view('admin/edit_banner', $data);
            $this->load->view('admin/template/v_footer');
        } else {
            $thumbnail = null;
            $thumbnail = $_FILES['foto']['name'];
            $select    = $this->m_crud->edit(['id_banner' => $this->input->post('id_banner')], 'banner');

            if ($thumbnail !== '') {
                $filename = explode('.', $select->row()->foto_banner)[0];
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
                    $where           = ['id_banner' => $id_banner];
                    $data['banner'] = $this->m_crud->edit($where, 'banner')->result();
                    $this->load->view('admin/template/v_header', $data);
                    $this->load->view('admin/template/v_navbar', $data);
                    $this->load->view('admin/template/v_sidebar');
                    $this->load->view('admin/edit_banner', $data);
                    $this->load->view('admin/template/v_footer');
                } else {
                    $thumbnail = $this->upload->data('file_name');
                }

                // Tentukan masukan ke database
                $save = [
                    //'id_struktur_redaksi' => $this->input->post('struktur_redaksi'),
                    'foto_banner'              => $thumbnail,
                    'link_banner'       => $this->input->post('link_banner'),
                    'status_banner'        => $this->input->post('status_banner'),

                ];

                $where = ['id_banner' => $id_banner];
                // query update data ke database
                $this->m_crud->update($where, $save, 'banner');
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
                    redirect("banner");
                } else {
                    set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf!</strong> Anda gagal mengubah data.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ');
                    redirect("banner/edit/{$id_banner}");
                }
            } else {
                $where = [
                    'id_banner' => $id_banner,
                ];

                $data = [
                    //'id_struktur_redaksi' => $this->input->post('struktur_redaksi'),
                    'link_banner'       => $this->input->post('link_banner'),
                    'status_banner'        => $this->input->post('status_banner'),

                ];

                $this->m_crud->update($where, $data, 'banner');
                if ($this->db->affected_rows() == true) {
                    set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Selamat!</strong> Anda berhasil mengubah data.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ');
                    redirect("banner");
                } else {
                    set_flashdata('pesan', '
                    <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf!</strong> Anda gagal mengubah data.
                        <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ');
                    redirect("banner/edit/{$id_banner}");
                }
                // terima kode data
            }
        }
    }

    public function delete()
    {
        $id_banner = $this->input->post('id_banner');
        $where    = [
            'id_banner' => $id_banner,
        ];
        $get = $this->db->get_where('banner', ['id_banner' => $id_banner])->row();
        unlink(FCPATH . 'uploads/images/' . $get->foto_banner);
        $this->m_crud->delete($where, 'banner');
        if ($this->db->affected_rows() == true) {
            set_flashdata('pesan', '
                <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Selamat!</strong> Anda berhasil menghapus data.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ');
            redirect('banner');
        } else {
            set_flashdata('pesan', '
                <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Maaf!</strong> Anda gagal menghapus data.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ');
            redirect('banner');
        }
    }
}
