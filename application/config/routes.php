<?php

defined('BASEPATH') || exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller']   = 'index';
$route['404_override']         = 'index/notfound';
$route['block']                = '';
$route['translate_uri_dashes'] = false;

// USER
$route['notfound']                = 'admin/Notfound';
$route['laporan-utama']           = 'Index/laporanUtama';
$route['laporan-utama/(:any)']    = 'Index/laporanUtama/$1';
$route['laporan-khusus']          = 'Index/laporanKhusus';
$route['laporan-khusus/(:any)']   = 'Index/laporanKhusus/$1';
$route['opini-wacana']            = 'Index/opini';
$route['opini-wacana/(:any)']     = 'Index/opini/$1';
$route['visi-misi']               = 'Index/visiMisi';
$route['regulasi']                = 'Index/regulasi';
$route['daftar-aspirasi']         = 'Index/daftar_aspirasi';
$route['daftar-aspirasi/submit']  = 'Index/submit_aspirasi';
$route['data-sekolah']            = 'Index/data_sekolah';
$route['lihat-sekolah']           = 'Index/lihat_sekolah';
$route['lihat-sekolah/(:any)']    = 'Index/lihat_sekolah';
$route['struktur']                = 'Index/struktur';
$route['sejarah']                 = 'Index/sejarah';
$route['sambutan']                = 'Index/sambutan';
$route['ad-art']                  = 'Index/AD_ART';
$route['tim-redaksi']             = 'Index/timredaksi';
$route['foto']                    = 'Index/foto';
$route['foto/(:any)']             = 'Index/foto/$1';
$route['foto/detail/(:any)']      = 'Index/detail_foto/$1';
$route['video']                   = 'Index/video';
$route['video/(:any)']            = 'Index/video/$1';
$route['liputan']                 = 'Index/liputan';
$route['liputan/(:any)']          = 'Index/liputan/$1';
$route['post/detail/(:any)']      = 'Index/detail_post/$1';
$route['showpost']                = 'Index/post_by_id';
$route['publikasi-riset']         = 'Index/publikasiRiset';
$route['publikasi-riset/(:any)']  = 'Index/publikasiRiset/$1';
$route['informasi-publik']        = 'Index/informasiPublik';
$route['informasi-publik/(:any)'] = 'Index/informasiPublik/$1';
$route['dinas-terkait']           = 'Index/dinasTerkait';
$route['kirim_komentar']          = 'Index/add_comment'; // kirim komentar

$route['auth']['get']       = 'Auth/index';
$route['login']['get']      = 'Auth/index';
$route['login/cek']['post'] = 'Auth/cek_login';
$route['logout']            = 'Auth/logout';

// ADMIN
$route['admin/beranda'] = 'admin/Home';
$route['admin/panduan'] = 'admin/Guide';

$route['profile']        = 'admin/Profile';
$route['profile/submit'] = 'admin/Profile/update';
$route['profile/update_password'] = 'admin/Profile/editpsw';

$route['forgot']                   = 'admin/Auth/forgot';
$route['recover']                  = 'admin/Auth/recover';
$route['forbidden']                = 'admin/Forbidden';
$route['tambah']                   = 'admin/Post/tambah';
$route['create']                   = 'admin/Post/create';
$route['category']                 = 'admin/Category';
$route['post']                     = 'admin/Post';
$route['slider']                   = 'admin/SLider';
$route['slider_2']                 = 'admin/SLider_kedua';
$route['manage']                   = 'admin/Manage';
$route['visitor']                  = 'admin/Visitor';
$route['riset']                    = 'admin/Riset';
$route['comment']                  = 'admin/Comment/show/publik';
$route['comment/update']           = 'admin/Comment/edit';
$route['comment/(:any)']           = 'admin/Comment/show/$1';
$route['regulation']               = 'admin/Regulation';
$route['structure']                = 'admin/Struktur';
$route['structure/tambah']         = 'admin/Struktur/tambah';
$route['structure/submit']         = 'admin/Struktur/simpan';
$route['structure/edit/(:any)']    = 'admin/Struktur/edit/$1';
$route['struktur-jabatan']         = 'admin/Jabatan';
$route['redaction']                = 'admin/Redaksi';
$route['redaction/tambah']         = 'admin/Redaksi/tambah';
$route['redaction/tambah1']        = 'admin/Redaksi/tambah1';
$route['redaction/edit/(:any)']    = 'admin/Redaksi/edit/$1';
$route['struktur-redaksi']         = 'admin/Struktur_redaksi';
$route['unggah']                   = 'admin/Post/publish';
$route['foto_gk']                  = 'admin/Foto';
$route['foto_gk/edit/(:any)']      = 'admin/Foto/edit/$1';
$route['video_gk']                 = 'admin/Video';
$route['video_gk/edit/(:any)']     = 'admin/Video/edit/$1';
$route['data_sekolah']             = 'admin/Sekolah';
$route['data_sekolah/edit/(:any)'] = 'admin/Sekolah/edit/$1';
$route['download/get/(:any)']      = 'Index/download/$1';
$route['aspirasi']                 = 'admin/Aspirasi';
$route['aspirasi/(:any)']          = 'admin/Aspirasi/index/$1';
$route['aspirasi/detail/(:any)']   = 'admin/Aspirasi/detail/$1';
$route['dinas']                    = 'admin/Dinas';
$route['dinas/edit/(:any)']        = 'admin/Dinas/edit/$1';
$route['sosmed']                   = 'admin/Sosmed';
$route['banner']                   = 'admin/Banner';
$route['banner/edit/(:any)']       = 'admin/Banner/edit/$1';
$route['pengaturan']               = 'admin/Pengaturan';
