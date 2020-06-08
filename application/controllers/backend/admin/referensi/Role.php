<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Role extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('backend/referensi/RoleModel', 'RoleModel');

        check_login_admin(); //Memanggil function dari Helper
    }

    public function index()
    {
        $data['role'] = $this->db->get_where('ref_role', ['id' => $this->session->userdata('id_role')])->row_array();

        $this->load->view('backend/admin/layout/header');
        $this->load->view('backend/admin/layout/sidebar');
        $this->load->view('backend/admin/layout/navbar', $data);
        $this->load->view('backend/admin/referensi/role/index');
        $this->load->view('backend/admin/referensi/role/modal-tambah');
        $this->load->view('backend/admin/referensi/role/modal-ubah');
        $this->load->view('backend/admin/referensi/role/modal-hapus');
        $this->load->view('backend/admin/layout/footer');
        $this->load->view('backend/admin/referensi/role/index-js');
    }

    public function getDataRole()
    {
        $list = $this->RoleModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nama;
            $row[] = ' 
            <a href="javascript:;" title="Edit" class="btn btn-light text-warning mb-1 border-0 tombol-ubah" data="' . $field->id . '"><i class="far fa-edit"></i></a>
            <a href="javascript:;" title="Hapus" class="btn btn-light text-danger mb-1 border-0 tombol-hapus" data="' . $field->id . '"><i class="far fa-trash-alt"></i></a>
                ';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->RoleModel->count_all(),
            "recordsFiltered" => $this->RoleModel->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function aksiDetail()
    {
        $where = array(
            'id' => $this->input->post('id'),
        );
        $data = $this->RoleModel->detail($where, 'ref_role');

        echo json_encode($data);
    }

    public function aksiTambah()
    {
        $json = [];
        $this->form_validation->set_rules('nama', 'Nama Role tidak boleh kosong', 'required');
        $this->form_validation->set_message('required', 'Anda melewatkan input, {field}!');

        if ($this->form_validation->run() != false) {
            $data = [
                'nama' => $this->input->post('nama'),
                'aktif' => '1',
                'dibuat_pada' => date("Y-m-d H:i:s")
            ];

            $this->RoleModel->tambah($data, 'ref_role');

            $id = $this->db->insert_id();
            $nama = $this->input->post('nama');
            echo json_encode(array('status' => true, 'id' => $id, 'nama' => $nama, 'data' => $data));
        } else {
            $json = [
                'status' => false,
                'nama' => form_error('nama', '<p class="form-text text-danger">', '</p>')
            ];

            $this->output->set_content_type('application/json')->set_output(json_encode($json));
        }
    }

    public function aksiUbah()
    {
        $json = [];
        $this->form_validation->set_rules('nama', 'Nama Role tidak boleh kosong', 'required');
        $this->form_validation->set_message('required', 'Anda melewatkan input, {field)!');

        if ($this->form_validation->run() != false) {
            $where = [
                'id' => $this->input->post('id')
            ];

            $data = [
                'nama' => $this->input->post('nama'),
                'diubah_pada' => date("Y-m-d H:i:s")
            ];

            $proses = $this->RoleModel->ubah($data, $where, 'ref_role');
            echo json_encode(array('status' => true, 'data' => $proses));
        } else {
            $json = [
                'status' => false,
                'nama' => form_error('nama', '<p class="form-text text-danger">', '</p>')
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

        $proses = $this->RoleModel->ubah($data, $where, 'ref_role');

        echo json_encode($proses);
    }
}
