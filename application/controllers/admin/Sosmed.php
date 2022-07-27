<?php

class Sosmed extends CI_Controller
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
        $data['title'] = 'Data Sosial Media';

        /** Ambil data tags */
        $data['sosmed'] = $this->m_crud->getAll('sosmed')->result();
        $data['judul']  = 'Data Sosial Media';
        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar', $data);
        $this->load->view('admin/v_sosmed', $data);
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
        // rules
        $this->form_validation->set_rules('nama_sos', 'Nama Sosial Media', 'trim|required');
        $this->form_validation->set_rules('link', 'Link Sosial Media', 'trim|required|callback_addr_line1|callback_check_valid_url');

        // custom pesan
        $this->form_validation->set_message('required', 'Mohon maaf, {field} harus diisi');
        $this->form_validation->set_message('valid_url', 'Mohon maaf, URL video yang anda masukkan harus valid');

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
            $data['user'] = $this->db->get_where('user', [
                'email' => $this->session->userdata('mail'),
            ])->row_array();
            $data['sosmed'] = $this->m_crud->getAll('sosmed')->result();
            //$data['sidebar'] = 'website';
            $data['judul'] = 'Sosial Media - Dewandik';
            //$data['tittle'] = "Data Kategori";
            $this->load->view('admin/template/v_header', $data);
            $this->load->view('admin/template/v_navbar', $data);
            $this->load->view('admin/template/v_sidebar');
            $this->load->view('admin/v_sosmed', $data);
            $this->load->view('admin/template/v_footer');
        } else {
            $data = [
                'nama_sos' => $this->input->post('nama_sos'),
                'link'     => $this->input->post('link'),
            ];

            $this->m_crud->insert($data, 'sosmed');
            if ($this->db->affected_rows() == true) {
                set_flashdata('pesan', '
                <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Selamat!</strong> Anda berhasil menambahkan data.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ');
                redirect('sosmed');
            } else {
                set_flashdata('pesan', '
                <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Maaf!</strong> Anda gagal menambahkan data.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ');
                redirect('sosmed');
            }
        }
    }

    public function edit()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $id_sosmed = $this->input->post('id_sosmed');

        //rules
        $this->form_validation->set_rules('nama_sos1', 'Nama Sosial Media', 'trim|required');
        $this->form_validation->set_rules('link1', 'Link Sosial Media', 'trim|required|callback_addr_line1|valid_url');

        //custom pesan
        $this->form_validation->set_message('required', 'Mohon maaf, {field} harus diisi');
        $this->form_validation->set_message('valid_url', 'Mohon maaf, URL video yang anda masukkan harus valid');

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
            $data['title'] = 'Data Sosial Media';

            /** Ambil data tags */
            $data['sosmed'] = $this->m_crud->getAll('sosmed')->result();
            $data['judul']  = 'Data Sosial Media';
            $this->load->view('admin/template/v_header', $data);
            $this->load->view('admin/template/v_navbar', $data);
            $this->load->view('admin/template/v_sidebar', $data);
            $this->load->view('admin/v_sosmed', $data);
            $this->load->view('admin/template/v_footer');
        } else {

            $array = [
                'nama_sos' => $this->input->post('nama_sos1'),
                'link'     => $this->input->post('link1'),
            ];
            $where = ['id_sosmed' => $id_sosmed];
            $this->m_crud->update($where, $array, 'sosmed');
            if ($this->db->affected_rows() == true) {
                set_flashdata('pesan', '
                        <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Selamat!</strong> Anda berhasil mengubah data.
                            <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        ');
                redirect('sosmed');
            } else {
                set_flashdata('pesan', '
                        <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Maaf!</strong> Anda gagal mengubah data.
                            <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>');
                redirect('sosmed');
            }
        }
    }

    public function delete()
    {
        $id_sosmed = $this->input->post('id_sosmed');
        $where     = [
            'id_sosmed' => $id_sosmed,
        ];
        $this->m_crud->delete($where, 'sosmed');
        if ($this->db->affected_rows() == true) {
            set_flashdata('pesan', '
                <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Selamat!</strong> Anda berhasil menghapus data.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ');
            redirect('sosmed');
        } else {
            set_flashdata('pesan', '
                <div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Maaf!</strong> Anda gagal menghapus data.
                    <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ');
            redirect('sosmed');
        }
    }
}
