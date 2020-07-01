<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Universitas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('backend/referensi/UniversitasModel', 'UniversitasModel');

        check_login_admin(); //Memanggil function dari Helper
    }
    public function index()
    {
        $data['role'] = $this->db->get_where('ref_role', ['id' => $this->session->userdata('id_role')])->row_array();

        $this->load->view('backend/admin/layout/header');
        $this->load->view('backend/admin/layout/sidebar');
        $this->load->view('backend/admin/layout/navbar', $data);
        $this->load->view('backend/admin/referensi/universitas/index');
        $this->load->view('backend/admin/referensi/universitas/modal-tambah');
        $this->load->view('backend/admin/referensi/universitas/modal-ubah');
        $this->load->view('backend/admin/referensi/universitas/modal-hapus');
        $this->load->view('backend/admin/layout/footer');
        $this->load->view('backend/admin/referensi/universitas/index-js');
    }

    public function getDataUniversitas()
    {
        $records = $this->UniversitasModel->get_datatables();
        $data = [];
        $no = $_POST['start'];

        foreach ($records as $field) {
            $no++;
            $row = [];
            $row[] = $no;
            $row[] = $field->nama;
            $row[] = $field->alamat . ", " . $field->nama_kelurahan . ", " . $field->nama_kecamatan . ", " . $field->nama_kabupaten . ", " . $field->nama_provinsi;
            $row[] = ' 
                <a href="javascript:;" title="Edit" class="btn btn-light text-warning mb-1 border-0 tombol-ubah" data="' . $field->id_universitas . '"><i class="far fa-edit"></i></a>
                <a href="javascript:;" title="Hapus" class="btn btn-light text-danger mb-1 border-0 tombol-hapus" data="' . $field->id_universitas . '"><i class="far fa-trash-alt"></i></a>
                ';
            $data[] = $row;
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->UniversitasModel->count_all(),
            "recordsFiltered" => $this->UniversitasModel->count_filtered(),
            "data" => $data
        ];

        echo json_encode($output);
    }

    public function aksiDetail()
    {
        $where = array(
            'id' => $this->input->post('id'),
        );
        $data = $this->UniversitasModel->detail($where, 'ref_universitas');

        echo json_encode($data);
    }

    public function aksiTambah()
    {
        $json = [];
        $this->form_validation->set_rules('nama', 'Nama tidak boleh kosong', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat tidak boleh kosong', 'required');
        $this->form_validation->set_rules('provinsi', 'Provinsi tidak boleh kosong', 'required');
        $this->form_validation->set_rules('kabupaten', 'Kabupaten tidak boleh kosong', 'required');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan tidak boleh kosong', 'required');
        $this->form_validation->set_rules('kelurahan', 'Kelurahan tidak boleh kosong', 'required');
        $this->form_validation->set_message('required', 'Anda melewatkan input, {field}!');

        if ($this->form_validation->run() != false) {
            $data = [
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'provinsi' => $this->input->post('provinsi'),
                'kabupaten' => $this->input->post('kabupaten'),
                'kecamatan' => $this->input->post('kecamatan'),
                'kelurahan' => $this->input->post('kelurahan'),
                'aktif' => '1',
                'dibuat_pada' => date("Y-m-d H:i:s")
            ];

            $this->UniversitasModel->tambah($data, 'ref_universitas');

            $id = $this->db->insert_id();
            $nama = $this->input->post('nama');
            echo json_encode(array('status' => true, 'id' => $id, 'nama' => $nama, 'data' => $data));
        } else {
            $json = [
                'status' => false,
                'nama' => form_error('nama', '<p class="form-text text-danger">', '</p>'),
                'alamat' => form_error('alamat', '<p class="form-text text-danger">', '</p>'),
                'provinsi' => form_error('provinsi', '<p class="form-text text-danger">', '</p>'),
                'kabupaten' => form_error('kabupaten', '<p class="form-text text-danger">', '</p>'),
                'kecamatan' => form_error('kecamatan', '<p class="form-text text-danger">', '</p>'),
                'kelurahan' => form_error('kelurahan', '<p class="form-text text-danger">', '</p>')
            ];
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
        }
    }

    public function aksiUbah()
    {
        $json = [];
        $this->form_validation->set_rules('nama', 'Nama tidak boleh kosong', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat tidak boleh kosong', 'required');
        $this->form_validation->set_rules('provinsi', 'Provinsi tidak boleh kosong', 'required');
        $this->form_validation->set_rules('kabupaten', 'Kabupaten tidak boleh kosong', 'required');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan tidak boleh kosong', 'required');
        $this->form_validation->set_rules('kelurahan', 'Kelurahan tidak boleh kosong', 'required');
        $this->form_validation->set_message('required', 'Anda melewatkan input, {field}!');

        if ($this->form_validation->run() != false) {
            $where = [
                'id' => $this->input->post('id')
            ];

            $data = [
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'provinsi' => $this->input->post('provinsi'),
                'kabupaten' => $this->input->post('kabupaten'),
                'kecamatan' => $this->input->post('kecamatan'),
                'kelurahan' => $this->input->post('kelurahan'),
                'aktif' => '1',
                'diubah_pada' => date("Y-m-d H:i:s")
            ];

            $proses = $this->UniversitasModel->ubah($data, $where, 'ref_universitas');
            echo json_encode(array('status' => true, 'data' => $proses));
        } else {
            $json = [
                'status' => false,
                'nama' => form_error('nama', '<p class="form-text text-danger">', '</p>'),
                'alamat' => form_error('alamat', '<p class="form-text text-danger">', '</p>'),
                'provinsi' => form_error('provinsi', '<p class="form-text text-danger">', '</p>'),
                'kabupaten' => form_error('kabupaten', '<p class="form-text text-danger">', '</p>'),
                'kecamatan' => form_error('kecamatan', '<p class="form-text text-danger">', '</p>'),
                'kelurahan' => form_error('kelurahan', '<p class="form-text text-danger">', '</p>')
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

        $proses = $this->UniversitasModel->ubah($data, $where, 'ref_universitas');

        echo json_encode($proses);
    }

    public function select_provinsi()
    {
        $data = $this->db->get('provinsi')->result_array();
        echo json_encode($data);
    }

    public function select_kabupaten()
    {
        $provinsi = $this->input->post('provinsi');
        $where = array(
            'kode_prop' => $provinsi,
        );
        $data = $this->db->get_where('kabupaten', $where)->result_array();
        echo json_encode($data);
    }

    public function select_kecamatan()
    {
        $kabupaten = $this->input->post('kabupaten');
        $where = array(
            'kode_kab' => $kabupaten,
        );
        $data = $this->db->get_where('kecamatan', $where)->result_array();
        echo json_encode($data);
    }

    public function select_kelurahan()
    {
        $kecamatan = $this->input->post('kecamatan');
        $where = array(
            'kode_kec' => $kecamatan,
        );
        $data = $this->db->get_where('kelurahan', $where)->result_array();
        echo json_encode($data);
    }
}
