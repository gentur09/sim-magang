<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kinerja extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('backend/KinerjaModel', 'KinerjaModel');
        $this->load->model('backend/MahasiswaModel', 'MahasiswaModel');

        check_login_admin(); //Memanggil function dari Helper
    }

    public function index()
    {
        $data['role'] = $this->db->get_where('ref_role', ['id' => $this->session->userdata('id_role')])->row_array();

        $this->load->view('backend/admin/layout/header');
        $this->load->view('backend/admin/layout/sidebar');
        $this->load->view('backend/admin/layout/navbar', $data);
        $this->load->view('backend/admin/kinerja/index');
        $this->load->view('backend/admin/layout/footer');
        $this->load->view('backend/admin/kinerja/index-js');
    }

    public function getDataMahasiswa()
    {
        $records = $this->KinerjaModel->get_datatables();
        $data = [];
        $no = $_POST['start'];

        foreach ($records as $field) {
            $no++;
            $row = [];
            $row[] = $no;
            $row[] = $field->nama;
            $row[] = ' 
                <a href="javascript:;" title="Detail Kinerja" class="btn btn-light text-info mb-1 border-0 tombol-detail" data="' . $field->id_mahasiswa . '"><i class="fal fa-clipboard-check"></i></a>
                <a href="javascript:;" title="Cetak Kinerja" class="btn btn-light text-danger mb-1 border-0 tombol-cetak" data="' . $field->id_mahasiswa . '"><i class="fal fa-file-pdf"></i></a>
                ';
            $data[] = $row;
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->KinerjaModel->count_all(),
            "recordsFiltered" => $this->KinerjaModel->count_filtered(),
            "data" => $data
        ];

        echo json_encode($output);
    }

    public function aksiDetail()
    {
        $where = array(
            'id' => $this->input->post('id'),
        );
        $data = $this->KinerjaModel->detail($where, 'kinerja');

        echo json_encode($data);
    }

    public function aksiTambah()
    {
        $json = [];
        $this->form_validation->set_rules('projek', 'projek', 'required', array(
            'required' => 'Pilih project!'
        ));
        $this->form_validation->set_rules('judul', 'judul', 'required', array(
            'required' => 'Masukkan Judul kinerja!'
        ));
        $this->form_validation->set_rules('keterangan', 'keterangan', 'required', array(
            'required' => 'Masukkan keterangan kinerja!'
        ));

        if ($this->form_validation->run() != false) {
            $data = [
                'tanggal' => date("Y-m-d H:i:s"),
                'judul' => $this->input->post('judul'),
                'keterangan' => $this->input->post('keterangan'),
                'id_mahasiswa' => $this->input->post('id_mahasiswa'),
                'id_projek_magang' => $this->input->post('projek'),
                'aktif' => '1',
                'dibuat_pada' => date("Y-m-d H:i:s")
            ];

            $this->KinerjaModel->tambah($data, 'kinerja');

            $id = $this->db->insert_id();
            echo json_encode(array('status' => true, 'id' => $id, 'data' => $data));
        } else {
            $json = [
                'status' => false,
                'projek' => form_error('projek', '<p class="form-text text-danger">', '</p>'),
                'judul' => form_error('judul', '<p class="form-text text-danger">', '</p>'),
                'keterangan' => form_error('keterangan', '<p class="form-text text-danger">', '</p>')
            ];

            $this->output->set_content_type('application/json')->set_output(json_encode($json));
        }
    }

    public function detail($id_mahasiswa)
    {
        $data['role'] = $this->db->get_where('ref_role', ['id' => $this->session->userdata('id_role')])->row_array();
        $data['mahasiswa'] = $this->db->get_where('mahasiswa', ['id' => $id_mahasiswa])->row_array();
        $data['kinerja'] = $this->db->order_by('id', 'DESC')->get_where('kinerja', ['id_mahasiswa' => $id_mahasiswa, 'aktif' => '1'])->result_array();
        $data['rows'] = $this->db->get_where('kinerja', ['id_mahasiswa' => $id_mahasiswa, 'aktif' => '1'])->num_rows();

        $this->load->view('backend/admin/layout/header');
        $this->load->view('backend/admin/layout/sidebar');
        $this->load->view('backend/admin/layout/navbar', $data);
        $this->load->view('backend/admin/kinerja/detail', $data);
        $this->load->view('backend/admin/kinerja/modal-tambah-kinerja');
        $this->load->view('backend/admin/kinerja/modal-hapus-kinerja');
        $this->load->view('backend/admin/kinerja/modal-ubah-kinerja');
        $this->load->view('backend/admin/kinerja/modal-detail-kinerja');
        $this->load->view('backend/admin/layout/footer');
        $this->load->view('backend/admin/kinerja/index-js');
    }

    public function aksiUbah()
    {
        $json = [];
        $this->form_validation->set_rules('projek', 'projek', 'required', array(
            'required' => 'Pilih project!'
        ));
        $this->form_validation->set_rules('judul', 'judul', 'required', array(
            'required' => 'Masukkan Judul kinerja!'
        ));
        $this->form_validation->set_rules('keterangan', 'keterangan', 'required', array(
            'required' => 'Masukkan keterangan kinerja!'
        ));

        if ($this->form_validation->run() != false) {
            $where = [
                'id' => $this->input->post('id')
            ];

            if ($this->input->post('verifikasi') != null) {
                $tanggal_ver = [
                    'tanggal_verifikasi' => date('Y-m-d H:i:s')
                ];
            } else {
                $tanggal_ver = [
                    'tanggal_verifikasi' => null
                ];
            }

            $data = [
                'id_projek_magang' => $this->input->post('projek'),
                'judul' => $this->input->post('judul'),
                'verifikasi' => $this->input->post('verifikasi'),
                'keterangan' => $this->input->post('keterangan'),
                'aktif' => '1',
                'diubah_pada' => date("Y-m-d H:i:s")
            ];

            $data += $tanggal_ver;

            $proses = $this->KinerjaModel->ubah($data, $where, 'kinerja');
            echo json_encode(array('status' => true, 'data' => $proses));
        } else {
            $json = [
                'status' => false,
                'projek' => form_error('projek', '<p class="form-text text-danger">', '</p>'),
                'judul' => form_error('judul', '<p class="form-text text-danger">', '</p>'),
                'keterangan' => form_error('keterangan', '<p class="form-text text-danger">', '</p>')
            ];

            $this->output->set_content_type('application/json')->set_output(json_encode($json));
        }
    }

    public function aksiHapus()
    {
        $where = array(
            'id' => $this->input->post('id')
        );

        $data = array(
            'aktif' => '0',
            'dihapus_pada' => date("Y-m-d H:i:s")
        );

        $proses = $this->KinerjaModel->ubah($data, $where, 'kinerja');

        echo json_encode($proses);
    }

    public function select_project()
    {
        $data = $this->db->get('projek_magang')->result_array();
        echo json_encode($data);
    }
}
