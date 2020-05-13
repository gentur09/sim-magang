<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('backend/referensi/JabatanModel', 'JabatanModel');

        check_login_admin(); //Memanggil function dari Helper
    }

    public function index()
    {
        $data['role'] = $this->db->get_where('ref_role', ['id' => $this->session->userdata('id_role')])->row_array();

        $this->load->view('backend/admin/layout/header');
        $this->load->view('backend/admin/layout/sidebar');
        $this->load->view('backend/admin/layout/navbar', $data);
        $this->load->view('backend/admin/referensi/jabatan/index');
        $this->load->view('backend/admin/referensi/jabatan/modal-tambah');
        $this->load->view('backend/admin/referensi/jabatan/modal-ubah');
        $this->load->view('backend/admin/referensi/jabatan/modal-hapus');
        $this->load->view('backend/admin/layout/footer');
        $this->load->view('backend/admin/referensi/jabatan/index-js');
    }

    public function getDataJabatan()
    {
        $list = $this->JabatanModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nama;
            $row[] = ' 
                <a href="javascript:;" title="Edit" class="btn btn-light text-warning mb-1 border-0 tombol-ubah" data="' . $field->id . '"><i class="fad fa-edit"></i></a>
                <a href="javascript:;" title="Hapus" class="btn btn-light text-danger mb-1 border-0 tombol-hapus" data="' . $field->id . '"><i class="fad fa-trash-alt"></i></a>
                ';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->JabatanModel->count_all(),
            "recordsFiltered" => $this->JabatanModel->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function aksiDetail()
    {
        $where = array(
            'id' => $this->input->post('id'),
        );
        $data = $this->JabatanModel->detail($where, 'ref_jabatan');

        echo json_encode($data);
    }

    public function aksiTambah()
    {
        $json = array();
        $this->form_validation->set_rules('nama', 'Nama Jabatan tidak boleh kosong', 'required');
        $this->form_validation->set_message('required', 'Anda melewatkan input, {field}!');

        if ($this->form_validation->run() != false) {
            $data = array(
                'nama' => $this->input->post('nama'),
                'aktif' => '1',
                'dibuat_pada' => date("Y-m-d H:i:s")
            );

            $proses = $this->JabatanModel->tambah($data, 'ref_jabatan');
            echo json_encode(array('status' => true, 'data' => $proses));
        } else {
            $json = array(
                'status' => false,
                'nama' => form_error('nama', '<p class="form-text text-danger">', '</p>')
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
        }
    }

    public function aksiUbah()
    {
        $json = array();
        $this->form_validation->set_rules('nama', 'Nama Jabatan tidak boleh kosong', 'required');
        $this->form_validation->set_message('required', 'Anda melewatkan input, {field}!');

        if ($this->form_validation->run() != false) {
            $where = array(
                'id' => $this->input->post('id')
            );

            $data = array(
                'nama' => $this->input->post('nama'),
                'diubah_pada' => date("Y-m-d H:i:s")
            );

            $proses = $this->JabatanModel->ubah($data, $where, 'ref_jabatan');
            echo json_encode(array('status' => true, 'data' => $proses));
        } else {
            $json = array(
                'status' => false,
                'nama' => form_error('nama', '<p class="form-text text-danger">', '</p>')
            );
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

        $proses = $this->JabatanModel->ubah($data, $where, 'ref_jabatan');

        echo json_encode($proses);
    }
}
