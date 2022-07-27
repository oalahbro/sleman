<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Index extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_foto');
        $this->load->model('M_komentar', 'komentar');
        $this->load->model('M_landing');
        $this->load->model('M_post', 'post');
        $this->load->model('M_publikasi');
        $this->load->model('M_video');
        $this->load->model('M_visitor', 'pengunjung');
        $this->load->model('M_crud');
        $this->load->model('M_landingpage');
        $this->pengunjung->count_visitor();
    }

    public function index()
    {
        $data['informasi'] = $this->db->query("SELECT * FROM post, kategori WHERE post.id_kategori = kategori.id_kategori AND post.post_status='1'")->result();
        $data['saran']     = $this->db->get_where('aspirasi', ['status' => '1', 'slider' => '1']);
        $data['slide']     = $this->db->query("SELECT * FROM regulasi WHERE status='1'")->result();
        $data['judul']     = 'Dewandik';
        $data['data']      = $this->db->get('pengaturan')->row_array();
        $this->load->view('landingpage/template/header', $data);
        $this->load->view('landingpage/index', $data);
        $this->load->view('landingpage/template/footer');
    }

    public function block()
    {
        $data['judul'] = '403 Forbidden Page';
        $this->load->view('forbidden', $data);
    }

    public function notfound()
    {
        $data['judul'] = '404 Page Not Found';

        $this->output->set_status_header('404');
        $this->load->view('landingpage/notfound', $data);
    }

    public function data_sekolah()
    {
        // $data['sekolah'] = $this->m_crud->getAll('data_sekolah')->result();
        $data['judul'] = 'Data Sekolah';
        $data['title'] = 'Data Sekolah';
        $data['data']  = $this->db->get('pengaturan')->row_array();
        $this->load->view('landingpage/template/header', $data);
        $this->load->view('landingpage/data_sekolah', $data);
        $this->load->view('landingpage/template/footer', $data);
    }

    public function lihat_sekolah()
    {
        $where           = $this->uri->segment(2);
        $data['sekolah'] = $this->db->query("SELECT * FROM data_sekolah WHERE kategori_sekolah='{$where}'")->result();
        $data['data']  = $this->db->get('pengaturan')->row_array();
        $data['judul']   = 'Data Sekolah';
        $data['title']   = 'Data Sekolah';
        $this->load->view('landingpage/template/header', $data);
        $this->load->view('landingpage/lihat_sekolah', $data);
        $this->load->view('landingpage/template/footer', $data);
    }

    public function detail_post($slug)
    {
        $data['data']  = $this->db->get('pengaturan')->row_array();
        $post = $this->post->get_post_by_slug($slug);
        if ($post->num_rows() > 0) {
            $q = $post->row();

            $data['judul']    = $q->judul_post;
            $data['list']     = $this->M_landing->list();
            $data['list1']    = $this->M_landing->list1();
            $data['post']     = $q;
            $data['komentar'] = $this->show_tree($q->id_post);

            $kode          = $q->id_post;
            $data['komen'] = $this->db->query("SELECT * FROM komentar, post WHERE komentar.id_post = post.id_post AND komentar.id_post={$kode} AND komentar.status=1")->num_rows();
            $this->M_landing->count_views($kode);

            $this->load->view('landingpage/template/header', $data);
            $this->load->view('landingpage/detail_post', $data);
            $this->load->view('landingpage/template/footer');
        } else {
            show_404();
        }
    }

    public function post_by_id()
    {
        $data['data']  = $this->db->get('pengaturan')->row_array();
        $q = $this->post->get_post_by_id((int) $_GET['id']);

        if ($q->num_rows() > 0) {
            $r = $q->row();

            return redirect('post/detail/' . $r->permalink);
        }

        return show_404();
    }

    public function laporanUtama()
    {
        $data['data']  = $this->db->get('pengaturan')->row_array();
        $config['base_url']    = site_url('laporan-utama');
        $config['total_rows']  = $this->post->get_laporan_utama()->num_rows();
        $config['per_page']    = 8;
        $config['uri_segment'] = 2;
        $choice                = $config['total_rows'] / $config['per_page'];
        $config['num_links']   = floor($choice);

        $config['full_tag_open']      = '<div class="d-flex justify-content-between mt-5 mb-3">';
        $config['full_tag_close']     = '</div>';
        $config['next_tag_open']      = '<div>';
        $config['next_tag_close']     = '</div>';
        $config['prev_tag_open']      = '<div>';
        $config['prev_tag_close']     = '</div>';
        $config['display_pages']      = false;
        $config['attributes']         = ['class' => 'btn btn-secondary btn-lg'];
        $config['display_prev_link']  = true;
        $config['dead_tag_prev_open'] = '<span class="btn btn-secondary btn-lg disabled">';
        $config['display_next_link']  = true;
        $config['dead_tag_next_open'] = '<span class="btn btn-secondary btn-lg disabled">';

        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(2)) ?: 0;

        //panggil function get_utama_list yang ada pada model Post.
        $data['liputan'] = $this->post->get_utama_list($config['per_page'], $data['page']);

        $data['halaman'] = $this->pagination->create_links();

        $data['judul'] = 'Laporan Utama';
        $data['title'] = 'Laporan Utama';
        $this->load->view('landingpage/template/header', $data);
        $this->load->view('landingpage/post_page', $data);
        $this->load->view('landingpage/template/footer');
    }

    public function opini()
    {
        $data['data']  = $this->db->get('pengaturan')->row_array();
        $config['base_url']    = site_url('opini-wacana');
        $config['total_rows']  = $this->post->get_opini_wacana()->num_rows();
        $config['per_page']    = 8;
        $config['uri_segment'] = 2;
        $choice                = $config['total_rows'] / $config['per_page'];
        $config['num_links']   = floor($choice);

        $config['full_tag_open']      = '<div class="d-flex justify-content-between mt-5 mb-3">';
        $config['full_tag_close']     = '</div>';
        $config['next_tag_open']      = '<div>';
        $config['next_tag_close']     = '</div>';
        $config['prev_tag_open']      = '<div>';
        $config['prev_tag_close']     = '</div>';
        $config['display_pages']      = false;
        $config['attributes']         = ['class' => 'btn btn-secondary btn-lg'];
        $config['display_prev_link']  = true;
        $config['dead_tag_prev_open'] = '<span class="btn btn-secondary btn-lg disabled">';
        $config['display_next_link']  = true;
        $config['dead_tag_next_open'] = '<span class="btn btn-secondary btn-lg disabled">';

        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(2)) ?: 0;

        //panggil function get_utama_list yang ada pada model Post.
        $data['liputan'] = $this->post->get_opini_list($config['per_page'], $data['page']);

        $data['halaman'] = $this->pagination->create_links();
        $data['judul']   = 'Opini / Wacana';
        $data['title']   = 'Opini / Wacana';
        // $data['liputan'] = $this->db->query("SELECT * FROM post, kategori WHERE post.id_kategori = kategori.id_kategori AND kategori.nama_kategori='Opini / Wacana'")->result();
        $this->load->view('landingpage/template/header', $data);
        $this->load->view('landingpage/post_page', $data);
        $this->load->view('landingpage/template/footer');
    }

    public function laporanKhusus()
    {
        $data['data']  = $this->db->get('pengaturan')->row_array();
        $config['base_url']    = site_url('laporan-khusus');
        $config['total_rows']  = $this->post->get_laporan_khusus()->num_rows();
        $config['per_page']    = 8;
        $config['uri_segment'] = 2;
        $choice                = $config['total_rows'] / $config['per_page'];
        $config['num_links']   = floor($choice);

        $config['full_tag_open']      = '<div class="d-flex justify-content-between mt-5 mb-3">';
        $config['full_tag_close']     = '</div>';
        $config['next_tag_open']      = '<div>';
        $config['next_tag_close']     = '</div>';
        $config['prev_tag_open']      = '<div>';
        $config['prev_tag_close']     = '</div>';
        $config['display_pages']      = false;
        $config['attributes']         = ['class' => 'btn btn-secondary btn-lg'];
        $config['display_prev_link']  = true;
        $config['dead_tag_prev_open'] = '<span class="btn btn-secondary btn-lg disabled">';
        $config['display_next_link']  = true;
        $config['dead_tag_next_open'] = '<span class="btn btn-secondary btn-lg disabled">';

        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(2)) ?: 0;

        //panggil function get_utama_list yang ada pada model Post.
        $data['liputan'] = $this->post->get_khusus_list($config['per_page'], $data['page']);

        $data['halaman'] = $this->pagination->create_links();
        $data['judul']   = 'Laporan Khusus';
        $data['title']   = 'Laporan Khusus';
        // $data['liputan'] = $this->db->query("SELECT * FROM post, kategori WHERE post.id_kategori = kategori.id_kategori AND kategori.nama_kategori='Laporan Khusus'")->result();
        $this->load->view('landingpage/template/header', $data);
        $this->load->view('landingpage/post_page', $data);
        $this->load->view('landingpage/template/footer');
    }

    public function visiMisi()
    {
        $data['judul'] = 'Visi dan Misi';
        $data['title'] = 'Visi dan Misi';
        $data['data'] = $this->db->get('pengaturan')->row_array();
        $this->load->view('landingpage/template/header', $data);
        $this->load->view('landingpage/visiMisi', $data);
        $this->load->view('landingpage/template/footer');
    }

    public function struktur()
    {
        $data['judul']            = 'Struktur';
        $data['title']            = 'Struktur';
        $data['struktur_jabatan'] = $this->db->query('SELECT * FROM jabatan')->result();
        $data['data'] = $this->db->get('pengaturan')->row_array();

        $this->load->view('landingpage/template/header', $data);
        $this->load->view('landingpage/struktur', $data);
        $this->load->view('landingpage/template/footer');
    }

    public function sejarah()
    {
        $data['judul'] = 'Sejarah';
        $data['title'] = 'Sejarah';
        $data['data'] = $this->db->get('pengaturan')->row_array();
        $this->load->view('landingpage/template/header', $data);
        $this->load->view('landingpage/sejarah', $data);
        $this->load->view('landingpage/template/footer');
    }

    public function sambutan()
    {
        $data['judul'] = 'Sambutan';
        $data['title'] = 'Sambutan';
        $data['data'] = $this->db->get('pengaturan')->row_array();
        $this->load->view('landingpage/template/header', $data);
        $this->load->view('landingpage/sambutan', $data);
        $this->load->view('landingpage/template/footer');
    }

    public function AD_ART()
    {
        $data['judul'] = 'AD / ART';
        $data['title'] = 'Anggaran Dasar dan Anggaran Dasar Rumah Tangga';
        $data['data'] = $this->db->get('pengaturan')->row_array();
        $this->load->view('landingpage/template/header', $data);
        $this->load->view('landingpage/ad_art', $data);
        $this->load->view('landingpage/template/footer');
    }

    public function timredaksi()
    {
        $data['judul']            = 'Tim Redaksi';
        $data['title']            = 'Tim Redaksi';
        $data['struktur_redaksi'] = $this->M_crud->getAll('struktur_redaksi')->result();
        $data['data'] = $this->db->get('pengaturan')->row_array();
        $this->load->view('landingpage/template/header', $data);
        $this->load->view('landingpage/redaksi', $data);
        $this->load->view('landingpage/template/footer');
    }

    public function foto()
    {
        $data['data'] = $this->db->get('pengaturan')->row_array();
        $config['base_url']    = site_url('foto');
        $config['total_rows']  = $this->M_foto->get_foto()->num_rows();
        $config['per_page']    = 8;
        $config['uri_segment'] = 2;
        $choice                = $config['total_rows'] / $config['per_page'];
        $config['num_links']   = floor($choice);

        $config['full_tag_open']      = '<div class="d-flex justify-content-between mt-5 mb-3">';
        $config['full_tag_close']     = '</div>';
        $config['next_tag_open']      = '<div>';
        $config['next_tag_close']     = '</div>';
        $config['prev_tag_open']      = '<div>';
        $config['prev_tag_close']     = '</div>';
        $config['display_pages']      = false;
        $config['attributes']         = ['class' => 'btn btn-secondary btn-lg'];
        $config['display_prev_link']  = true;
        $config['dead_tag_prev_open'] = '<span class="btn btn-secondary btn-lg disabled">';
        $config['display_next_link']  = true;
        $config['dead_tag_next_open'] = '<span class="btn btn-secondary btn-lg disabled">';

        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(2)) ?: 0;

        //panggil function get_utama_list yang ada pada model Post.
        $data['foto'] = $this->M_foto->get_foto_list($config['per_page'], $data['page']);

        $data['halaman'] = $this->pagination->create_links();

        $data['judul'] = 'Foto';
        $data['title'] = 'Foto';
        $this->load->view('landingpage/template/header', $data);
        $this->load->view('landingpage/foto', $data);
        $this->load->view('landingpage/template/footer');
    }

    public function detail_foto($id_foto)
    {
        // $where = array(
        //     'ID_REG' => $id_regulasi
        // );
        // $this->M_crud->detail($where, 'regulasi');
        $data['judul']  = 'Detail Foto Giat Kerja';
        $data['dtfoto'] = $this->M_foto->detail($id_foto)->result();
        //$data['regulasi'] = $this->M_crud->detail($id_regulasi)->result();
        $data['data'] = $this->db->get('pengaturan')->row_array();
        $this->load->view('landingpage/template/header', $data);
        $this->load->view('landingpage/detail_foto', $data);
        $this->load->view('landingpage/template/footer', $data);
    }

    public function video()
    {
        $data['data'] = $this->db->get('pengaturan')->row_array();
        $config['base_url']    = site_url('video');
        $config['total_rows']  = $this->M_crud->get_video()->num_rows();
        $config['per_page']    = 8;
        $config['uri_segment'] = 2;
        $choice                = $config['total_rows'] / $config['per_page'];
        $config['num_links']   = floor($choice);

        $config['full_tag_open']      = '<div class="d-flex justify-content-between mt-5 mb-3">';
        $config['full_tag_close']     = '</div>';
        $config['next_tag_open']      = '<div>';
        $config['next_tag_close']     = '</div>';
        $config['prev_tag_open']      = '<div>';
        $config['prev_tag_close']     = '</div>';
        $config['display_pages']      = false;
        $config['attributes']         = ['class' => 'btn btn-secondary btn-lg'];
        $config['display_prev_link']  = true;
        $config['dead_tag_prev_open'] = '<span class="btn btn-secondary btn-lg disabled">';
        $config['display_next_link']  = true;
        $config['dead_tag_next_open'] = '<span class="btn btn-secondary btn-lg disabled">';

        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(2)) ?: 0;

        //panggil function get_utama_list yang ada pada model Post.
        $data['video'] = $this->M_crud->get_video_list($config['per_page'], $data['page']);

        $data['halaman'] = $this->pagination->create_links();
        // $data['video'] = $this->M_crud->getAll('video_gk')->result();
        $data['judul'] = 'Video';
        $data['title'] = 'Video';
        //$data['video'] = $this->db->query("SELECT * FROM video_gk")->result();
        $this->load->view('landingpage/template/header', $data);
        $this->load->view('landingpage/video', $data);
        $this->load->view('landingpage/template/footer');
    }

    public function detail_video($id_video)
    {
        $data['data'] = $this->db->get('pengaturan')->row_array();
        $data['video'] = $this->db->query("SELECT * FROM video_gk WHERE id_video = {$id_video}")->result();
        $data['judul'] = 'Detail Video';
        // $data['list'] = $this->M_landing->list();
        //$data['list']  = $this->M_landing->list_vid();
        //$data['video'] = $this->db->query("SELECT * FROM video_gk WHERE id_video={$id}")->result_array();
        $this->load->view('landingpage/template/header', $data);
        $this->load->view('landingpage/detail_video', $data);
        $this->load->view('landingpage/template/footer');
    }

    public function liputan()
    {
        $data['data'] = $this->db->get('pengaturan')->row_array();
        $config['base_url']    = site_url('liputan');
        $config['total_rows']  = $this->post->get_liputan()->num_rows();
        $config['per_page']    = 8;
        $config['uri_segment'] = 2;
        $choice                = $config['total_rows'] / $config['per_page'];
        $config['num_links']   = floor($choice);

        $config['full_tag_open']      = '<div class="d-flex justify-content-between mt-5 mb-3">';
        $config['full_tag_close']     = '</div>';
        $config['next_tag_open']      = '<div>';
        $config['next_tag_close']     = '</div>';
        $config['prev_tag_open']      = '<div>';
        $config['prev_tag_close']     = '</div>';
        $config['display_pages']      = false;
        $config['attributes']         = ['class' => 'btn btn-secondary btn-lg'];
        $config['display_prev_link']  = true;
        $config['dead_tag_prev_open'] = '<span class="btn btn-secondary btn-lg disabled">';
        $config['display_next_link']  = true;
        $config['dead_tag_next_open'] = '<span class="btn btn-secondary btn-lg disabled">';

        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(2)) ?: 0;

        //panggil function get_utama_list yang ada pada model Post.
        $data['liputan'] = $this->post->get_liputan_list($config['per_page'], $data['page']);

        $data['halaman'] = $this->pagination->create_links();
        $data['judul']   = 'Liputan';
        $data['title']   = 'Liputan';
        // $data['liputan'] = $this->db->query("SELECT * FROM post, kategori WHERE post.id_kategori = kategori.id_kategori AND kategori.nama_kategori='Liputan'")->result();
        $this->load->view('landingpage/template/header', $data);
        $this->load->view('landingpage/post_page', $data);
        $this->load->view('landingpage/template/footer');
    }

    public function publikasiRiset()
    {
        $data['data'] = $this->db->get('pengaturan')->row_array();
        $config['base_url']    = site_url('publikasi-riset');
        $config['total_rows']  = $this->M_publikasi->get_publikasi()->num_rows();
        $config['per_page']    = 6;
        $config['uri_segment'] = 2;
        $choice                = $config['total_rows'] / $config['per_page'];
        $config['num_links']   = floor($choice);

        $config['full_tag_open']      = '<div class="d-flex justify-content-between mt-5 mb-3">';
        $config['full_tag_close']     = '</div>';
        $config['next_tag_open']      = '<div>';
        $config['next_tag_close']     = '</div>';
        $config['prev_tag_open']      = '<div>';
        $config['prev_tag_close']     = '</div>';
        $config['display_pages']      = false;
        $config['attributes']         = ['class' => 'btn btn-secondary btn-lg'];
        $config['display_prev_link']  = true;
        $config['dead_tag_prev_open'] = '<span class="btn btn-secondary btn-lg disabled">';
        $config['display_next_link']  = true;
        $config['dead_tag_next_open'] = '<span class="btn btn-secondary btn-lg disabled">';

        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(2)) ?: 0;

        //panggil function get_utama_list yang ada pada model Post.
        $data['publikasi'] = $this->M_publikasi->get_publikasi_list($config['per_page'], $data['page']);

        $data['halaman'] = $this->pagination->create_links();
        // $data['video'] = $this->M_crud->getAll('video_gk')->result();
        $data['judul'] = 'Publikasi Riset';
        $data['title'] = 'Publikasi Riset';
        //$data['video'] = $this->db->query("SELECT * FROM video_gk")->result();
        $this->load->view('landingpage/template/header', $data);
        $this->load->view('landingpage/publikasiRiset', $data);
        $this->load->view('landingpage/template/footer');
    }

    public function search()
    {
        $data['data'] = $this->db->get('pengaturan')->row_array();
        $query  = strip_tags(htmlspecialchars($this->input->get('cari', true), ENT_QUOTES));
        $result = $this->M_publikasi->search($query);
        if ($result->num_rows() > 0) {
            $data['data']  = $result;
            $data['cari']  = $query;
            $data['hasil'] = 'Hasil Pencarian :' . ' " ' . $query . ' "';
        } else {
            $data['data']  = $result;
            $data['cari']  = $query;
            $data['hasil'] = 'Tidak ditemukan';
        }

        $data['judul'] = 'Publikasi Riset';
        $data['title'] = 'Publikasi Riset';
        $this->load->view('landingpage/template/header', $data);
        $this->load->view('landingpage/search_result', $data);
        $this->load->view('landingpage/template/footer');
    }

    public function search_video()
    {
        $data['data'] = $this->db->get('pengaturan')->row_array();
        $query  = strip_tags(htmlspecialchars($this->input->get('cari', true), ENT_QUOTES));
        $result = $this->M_video->search($query);
        if ($result->num_rows() > 0) {
            $data['data']  = $result;
            $data['cari']  = $query;
            $data['hasil'] = 'Hasil Pencarian :' . ' " ' . $query . ' "';
        } else {
            $data['data']  = $result;
            $data['cari']  = $query;
            $data['hasil'] = 'Tidak ditemukan';
        }

        $data['judul'] = 'Video';
        $data['title'] = 'Video';
        $this->load->view('landingpage/template/header', $data);
        $this->load->view('landingpage/search_video', $data);
        $this->load->view('landingpage/template/footer');
    }

    public function search_foto()
    {
        $data['data'] = $this->db->get('pengaturan')->row_array();
        $query  = strip_tags(htmlspecialchars($this->input->get('cari', true), ENT_QUOTES));
        $result = $this->M_foto->search($query);
        if ($result->num_rows() > 0) {
            $data['data']  = $result;
            $data['cari']  = $query;
            $data['hasil'] = 'Hasil Pencarian :' . ' " ' . $query . ' "';
        } else {
            $data['data']  = $result;
            $data['cari']  = $query;
            $data['hasil'] = 'Tidak ditemukan';
        }

        $data['judul'] = 'Foto';
        $data['title'] = 'Foto';
        $this->load->view('landingpage/template/header', $data);
        $this->load->view('landingpage/search_foto', $data);
        $this->load->view('landingpage/template/footer');
    }

    public function informasiPublik()
    {
        $data['data'] = $this->db->get('pengaturan')->row_array();
        $config['base_url']    = site_url('informasi-publik');
        $config['total_rows']  = $this->post->get_informasi_publik()->num_rows();
        $config['per_page']    = 8;
        $config['uri_segment'] = 2;
        $choice                = $config['total_rows'] / $config['per_page'];
        $config['num_links']   = floor($choice);

        $config['full_tag_open']      = '<div class="d-flex justify-content-between mt-5 mb-3">';
        $config['full_tag_close']     = '</div>';
        $config['next_tag_open']      = '<div>';
        $config['next_tag_close']     = '</div>';
        $config['prev_tag_open']      = '<div>';
        $config['prev_tag_close']     = '</div>';
        $config['display_pages']      = true;
        $config['attributes']         = ['class' => 'btn btn-secondary btn-lg'];
        $config['display_prev_link']  = true;
        $config['dead_tag_prev_open'] = '<span class="btn btn-secondary btn-lg disabled">';
        $config['display_next_link']  = true;
        $config['dead_tag_next_open'] = '<span class="btn btn-secondary btn-lg disabled">';

        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(2)) ?: 0;

        //panggil function get_utama_list yang ada pada model Post.
        $data['liputan'] = $this->post->get_informasi_list($config['per_page'], $data['page']);

        $data['halaman'] = $this->pagination->create_links();
        $data['judul']   = 'Informasi Publik';
        $data['title']   = 'Informasi Publik';
        $this->load->view('landingpage/template/header', $data);
        $this->load->view('landingpage/post_page', $data);
        $this->load->view('landingpage/template/footer');
    }

    public function regulasi()
    {
        $data['data'] = $this->db->get('pengaturan')->row_array();
        $data['regulasi'] = $this->db->get('regulasi')->result_array();
        $data['judul']    = 'Regulasi';
        $data['title']    = 'Regulasi';
        $this->load->view('landingpage/template/header', $data);
        $this->load->view('landingpage/regulasi', $data);
        $this->load->view('landingpage/template/footer');
    }

    public function daftar_aspirasi()
    {
        $data['data'] = $this->db->get('pengaturan')->row_array();
        $data['saran'] = $this->db->get_where('aspirasi', ['status' => '1']);
        $data['judul'] = 'Aspirasi Publik';
        $data['title'] = 'Aspirasi Publik';

        $this->load->view('landingpage/template/header', $data);
        $this->load->view('landingpage/daftar_aspirasi', $data);
        $this->load->view('landingpage/template/footer');
    }

    public function submit_aspirasi()
    {
        if ($this->form_validation->run('aspirasi/submit') === false) {
            $this->daftar_aspirasi();
        } else {
            $this->db->insert('aspirasi', [
                'nama'    => htmlspecialchars($this->input->post('nama')),
                'email'   => htmlspecialchars($this->input->post('email')),
                'isi'     => htmlspecialchars($this->input->post('isi')),
                'tipe'    => htmlspecialchars($this->input->post('tipe')),
                'tanggal' => date('Y-m-d H:i:s'),
            ]);

            $return = [
                'text'  => 'Aspirasi Anda sudah terkirim, akan divalidasi lebih dahulu.',
                'class' => 'success',
            ];

            set_flashdata('pesan', '<div id="pesan" class="alert alert-' . $return['class'] . ' alert-dismissible fade show" role="alert">
                ' . $return['text'] . '
            </div>');

            redirect('daftar-aspirasi');
        }
    }

    public function dinasTerkait()
    {
        $data['data'] = $this->db->get('pengaturan')->row_array();
        $data['dinas'] = $this->db->query('SELECT * FROM dinas WHERE status=1 ORDER BY id_diter DESC');
        $data['judul'] = 'Dinas Terkait';
        $data['title'] = 'Dinas Terkait';
        $this->load->view('landingpage/template/header', $data);
        $this->load->view('landingpage/dinasTerkait', $data);
        $this->load->view('landingpage/template/footer');
    }

    public function download($id)
    {
        if (!empty($id)) {
            $fileInfo = $this->db->get_where('publikasi_riset', [
                'id_publikasi' => $id,
            ])->row_array();

            //file path
            $file = 'uploads/docs/' . $fileInfo['file'];
            force_download($file, null);
        }
    }

    public function add_comment()
    {
        $url = $this->input->post('url');

        //set validation rules
        $this->form_validation->set_rules('comment_name', 'Nama', 'required|trim|htmlspecialchars');
        $this->form_validation->set_rules('comment_email', 'Email', 'required|valid_email|trim|htmlspecialchars');
        $this->form_validation->set_rules('comment_body', 'Komentar', 'required|trim|htmlspecialchars');

        // set session nama & email
        $comment = [
            'cnama'  => $this->input->post('comment_name'),
            'cemail' => $this->input->post('comment_email'),
        ];

        $this->session->set_userdata($comment);

        if ($this->form_validation->run() === false) {
            // if not valid load comments
            set_flashdata('error_msg', validation_errors());
        } else {
            //if valid send comment to admin to tak approve
            $this->komentar->add_new_comment();
            set_flashdata('error_msg', 'Komentar Anda akan dimoderasi.');
        }
        redirect($url);
    }

    private function show_tree($post_id)
    {
        // create array to store all comments ids
        $store_all_id = [];
        // get all parent comments ids by using news id
        $id_result = $this->komentar->tree_all($post_id);
        // loop through all comments to save parent ids $store_all_id array
        if ($id_result === null) {
            return '<div class="alert alert-info">Belum ada komentar, jadilah yang pertama.</div>';
        }

        foreach ($id_result as $comment_id) {
            $store_all_id[] = $comment_id['komentar_parent'];
        }
        // return all hierarchical tree data from in_parent by sending
        //  initiate parameters 0 is the main parent,news id, all parent ids

        return $this->in_parent(0, $post_id, $store_all_id);
    }

    public function in_parent($in_parent, $post_id, $store_all_id)
    {
        // this variable to save all concatenated html
        $html = '';
        // build hierarchy  html structure based on ul li (parent-child) nodes
        if (in_array($in_parent, $store_all_id, false)) {
            $result = $this->komentar->tree_by_parent($post_id, $in_parent);
            $html .= '<div class="thread_comments">';

            foreach ($result as $re) {
                $grav_url = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($re['email']))) . '?d=mp&s=50';

                $html .= '<div class="d-flex pt-3 ' . ($in_parent === 0 ? 'border-bottom' : '') . '">';
                $html .= '<img class="flex-shrink-0 me-2 rounded-circle" style="width:50px; height:50px;" alt="" src="' . $grav_url . '" />';
                $html .= '<div class="pb-3 mb-0 lh-sm w-100">

				<div class="d-flex justify-content-between">
                <strong class="text-gray-dark">' . $re['nama'] . '</strong>
                <a href="#form_komentar" class="reply-comment" data-nama="' . $re['nama'] . '" id=' . $re['id_komentar'] . '><span>balas</span></a>
				</div>
				<span class="d-block small text-muted">' . $re['tanggal_komentar'] . '</span>
				<p class="mt-3">' . $re['pesan'] . '</p>';
                $html .= $this->in_parent($re['id_komentar'], $post_id, $store_all_id);
                $html .= '</div>';
                $html .= '</div>';
            }
            $html .= '</div>';
        }

        return $html;
    }
}
