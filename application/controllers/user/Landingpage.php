<?php

class Landingpage extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_crud', 'm_crud');
        //$this->load->model('M_landingpage', 'm_landingpage');
        // $this->load->library('Primslib');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $data['saran']   = $this->m_crud->getAll('saran')->result();
        $data['sidebar'] = 'website';
        $data['judul']   = 'Aspirasi Publik';
        //$data['judul'] = 'Dewan Pendidikan Kabupaten Sleman';
        $this->load->view('landingpage/template/header', $data);
        $this->load->view('landingpage/aspirasi', $data);
        $this->load->view('landingpage/template/footer', $data);
    }

    public function addr_line1($addr_line1)
    {
        if (preg_match('/[\^£$%&*}{@#~><>|=+¬]/', $addr_line1)) {
            $this->form_validation->set_message('addr_line1', 'Mohon maaf tidak diperbolehkan menggunakan karakter spesial');

            return false;
        }

        return true;
    }

    public function add()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        //$data['saran'] = $this->m_crud->getAll('saran')->result();
        $data['sidebar'] = 'website';
        $data['judul']   = 'Aspirasi - Dewandik';
        //$data['tittle'] = "Data Informasi";
        $this->load->view('landingpage/template/header', $data);
        $this->load->view('landingpage/aspirasi', $data);
        $this->load->view('landingpage/template/footer', $data);
    }

    public function blog()
    {
        $this->load->view('landingpage/template/header');
        $this->load->view('landingpage/blog');
        $this->load->view('landingpage/template/footer');
    }

    // function blog_all()
    // {
    //     $data['judul'] = 'Dewan Pendidikan Kabupaten Sleman';
    //     $jumlah_data = $this->m_crud->getAll('tb_informasi')->num_rows();
    //     $this->load->library('pagination');
    //     $config['base_url'] = site_url('user/landingpage/blog_all/');
    //     $config['total_rows'] = $jumlah_data;
    //     $config['per_page'] = 9;  //show record per halaman
    //     $config["uri_segment"] = 4;  // uri parameter
    //     $choice = $config["total_rows"] / $config["per_page"];
    //     $config["num_links"] = floor($choice);

    //     $config['first_link']       = 'First';
    //     $config['last_link']        = 'Last';
    //     $config['next_link']        = 'Next';
    //     $config['prev_link']        = 'Prev';
    //     $config['full_tag_open']    = '<div class="blog-pagination" data-aos="fade-up"><ul class="justify-content-center">';
    //     $config['full_tag_close']   = '</ul></div>';
    //     $config['num_tag_open']     = '<li>';
    //     $config['num_tag_close']    = '</li>';
    //     $config['cur_tag_open']     = '<li class="active"><a href="">';
    //     $config['cur_tag_close']    = '</a></li>';
    //     $config['next_tag_open']    = '<li>';
    //     $config['next_tagl_close']  = '<i class="icofont-rounded-right"></i></li>';
    //     $config['prev_tag_open']    = '<li>';
    //     $config['prev_tagl_close']  = '</li>';
    //     $config['first_tag_open']   = '<li>';
    //     $config['first_tagl_close'] = '</li>';
    //     $config['last_tag_open']    = '<li>';
    //     $config['last_tagl_close']  = '</li>';
    //     $this->pagination->initialize($config);

    //     $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    //     $data['result'] = $this->m_landingpage->allresult($config["per_page"], $data['page']);
    //     $data['pagination'] = $this->pagination->create_links();
    //     $data['breadcrum'] = 'Pendistribusian';

    //     $this->load->view("landingpage/template/header", $data);
    //     $this->load->view("landingpage/search_result");
    //     $this->load->view("landingpage/template/footer", $data);
    // }
}
