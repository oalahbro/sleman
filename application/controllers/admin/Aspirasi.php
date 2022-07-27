<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Aspirasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (! user_logged_in()) {
            return redirect('auth');
        }

        $this->load->model('M_crud', 'm_crud');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $config['base_url']    = site_url('aspirasi');
        $config['total_rows']  = $this->m_crud->getAll('aspirasi')->num_rows();
        $config['per_page']    = 6;
        $config['uri_segment'] = 2;
        $choice                = $config['total_rows'] / $config['per_page'];
        $config['num_links']   = floor($choice);

        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(2)) ?: 0;

        //panggil function get_utama_list yang ada pada model Post.
        $data['aspirasi'] = $this->m_crud->get_aspirasi_list($config['per_page'], $data['page']);

        $data['halaman'] = $this->pagination->create_links();
        // $data['aspirasi'] = $this->m_crud->getAll('aspirasi');
        $data['judul'] = 'Data Aspirasi';
        $data['title'] = 'Data Aspirasi';

        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar');
        $this->load->view('admin/v_aspirasi', $data);
        $this->load->view('admin/template/v_footer');
    }

    public function ubah($tipe, $id_aspirasi, $key)
    {
        $this->db->where('id_aspirasi', $id_aspirasi);
        $this->db->update('aspirasi', [$tipe => ($key === '0' ? '1' : '0')]);

        if ($this->db->affected_rows() > 0) {
            $pesan = '<div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">';
            $pesan .= '<strong>Selamat!</strong> Aspirasi kini';

            if ($key === '1') {
                $pesan .= ($tipe === 'status' ? ' tidak dipublikasikan.' : ' batal ditampilkan sebagai slider.');
            } else {
                $pesan .= ($tipe === 'status' ? ' berhasil dipublikasikan.' : ' ditampilkan sebagai slider.');
            }
        } else {
            $pesan = '<div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">';
            $pesan .= '<strong>Maaf!</strong> Aspirasi gagal';

            if ($key === '1') {
                $pesan .= ($tipe === 'status' ? ' untuk tidak dipublikasikan.' : ' untuk tidak ditampilkan sebagai slider.');
            } else {
                $pesan .= ($tipe === 'status' ? ' untuk dipublikasikan.' : ' untuk ditampilkan sebagai slider.');
            }
        }

        $pesan .= ' <button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

        set_flashdata('pesan', $pesan);
        redirect('aspirasi');
    }

    public function detail($id_aspirasi)
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('mail'),
        ])->row_array();
        $data['aspirasi'] = $this->db->query("SELECT * FROM aspirasi WHERE id_aspirasi={$id_aspirasi}")->result();
        $data['judul']    = 'Detail Data Aspirasi';
        $data['judul']    = 'Data Aspirasi';

        $set = [
            'read_msg' => 1,
        ];

        $this->m_crud->read($id_aspirasi, $set);

        $this->load->view('admin/template/v_header', $data);
        $this->load->view('admin/template/v_navbar', $data);
        $this->load->view('admin/template/v_sidebar');
        $this->load->view('admin/v_detail_saran', $data);
        $this->load->view('admin/template/v_footer');
    }

    public function all()
    {
        $notif = $this->db->get_where('aspirasi', ['read_msg' => 0])->result_array();

        for ($i = 0; $i < count($notif); $i++) {
            $where = [
                'id_aspirasi' => $notif[$i]['id_aspirasi'],
            ];
            $data = [
                'read_msg' => 1,
            ];

            $this->db->update('aspirasi', $data, $where);
        }

        if ($this->db->affected_rows() === true) {
            set_flashdata('pesan', '
		<div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
		<strong>Selamat!</strong> seluruh data aspirasi telah ditandai terbaca.
		<button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
				</button>
				</div>
				');
            redirect('aspirasi');
        } else {
            set_flashdata('pesan', '
			<div id="pesan" class="alert alert-info alert-dismissible fade show" role="alert">
			<strong>Info!</strong> seluruh data aspirasi telah tertandai terbaca.
			<button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
					</button>
					</div>
					');
            redirect('aspirasi');
        }
    }

    public function empty()
    {
        $data = $this->db->get('aspirasi');

        if ($data->num_rows() > 0) {
            $this->db->truncate('aspirasi');
            set_flashdata('pesan', '
			<div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>Selamat!</strong> Anda berhasil menghapus seluruh data aspirasi.
			<button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
					</button>
					</div>
					');
            redirect('aspirasi');
        } else {
            set_flashdata('pesan', '
			<div id="pesan" class="alert alert-info alert-dismissible fade show" role="alert">
			<strong>Info!</strong> data aspirasi sudah kosong.
			<button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
					</button>
					</div>
					');
            redirect('aspirasi');
        }
    }

    public function hapus($id_aspirasi)
    {
        $where = [
            'id_aspirasi' => $id_aspirasi,
        ];

        $this->m_crud->delete($where, 'aspirasi');
        if ($this->db->affected_rows() == true) {
            set_flashdata('pesan', '
			<div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Selamat!</strong> Anda berhasil menghapus data.
				<button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			');
            redirect('aspirasi');
        } else {
            set_flashdata('pesan', '
			<div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Maaf!</strong> Anda gagal menghapus data.
				<button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			');
            redirect('aspirasi');
        }
    }

    public function export()
    {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $data        = $this->m_crud->getAll('aspirasi')->result();
        $check       = $this->db->get('aspirasi');
        $fileName    = 'Data Aspirasi';
        if ($check->num_rows() !== 0) {
            $sheet    = $spreadsheet->getActiveSheet();
            $rowCount = 1;
            $sheet->setCellValue('A' . $rowCount, 'No');
            $sheet->setCellValue('B' . $rowCount, 'Nama Pengirim');
            $sheet->setCellValue('D' . $rowCount, 'Email Pengirim');
            $sheet->setCellValue('E' . $rowCount, 'Tipe Aspirasi');
            $sheet->setCellValue('F' . $rowCount, 'Isi Aspirasi');
            $sheet->setCellValue('G' . $rowCount, 'Tanggal Aspirasi');
            $rowCount++;

            $no = 1;

            foreach ($data as $value) {
                $sheet->setCellValue('A' . $rowCount, $no);
                $sheet->setCellValue('B' . $rowCount, $value->nama);
                $sheet->setCellValue('D' . $rowCount, $value->email);
                $sheet->setCellValue('E' . $rowCount, $value->tipe);
                $sheet->setCellValue('F' . $rowCount, $value->isi);
                $sheet->setCellValue('G' . $rowCount, $value->tanggal);
                $no++;
                $rowCount++;
            }

            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="' . urlencode(url_title($fileName) . '.xlsx') . '"');
            $writer->save('php://output');
        } else {
            set_flashdata('pesan', '
			<div id="pesan" class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Info!</strong> Anda gagal melakukan Export data.
				<button type="button" class="close py-auto" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			');
            redirect('aspirasi');
        }
    }
}
