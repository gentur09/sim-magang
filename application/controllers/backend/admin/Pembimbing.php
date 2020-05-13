<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pembimbing extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('backend/PembimbingModel', 'PembimbingModel');
        $this->load->model('backend/referensi/RoleModel', 'RoleModel');

        check_login_admin(); //Memanggil function dari Helper
    }

    public function index()
    {
        $data['role'] = $this->db->get_where('ref_role', ['id' => $this->session->userdata('id_role')])->row_array();

        $this->load->view('backend/admin/layout/header');
        $this->load->view('backend/admin/layout/sidebar');
        $this->load->view('backend/admin/layout/navbar', $data);
        $this->load->view('backend/admin/pembimbing/index');
        $this->load->view('backend/admin/pembimbing/modal-tambah');
        $this->load->view('backend/admin/pembimbing/modal-ubah');
        $this->load->view('backend/admin/pembimbing/modal-hapus');
        $this->load->view('backend/admin/layout/footer');
        $this->load->view('backend/admin/pembimbing/index-js');
    }

    public function getDataPembimbing()
    {
        $records = $this->PembimbingModel->get_datatables();
        $data = [];
        $no = $_POST['start'];

        foreach ($records as $field) {
            $no++;
            $row = [];
            $row[] = $no;
            $row[] = $field->nama;
            $row[] = ' 
                <a href="javascript:;" title="Edit" class="btn btn-light text-warning mb-1 border-0 tombol-ubah" data="' . $field->id . '"><i class="fad fa-edit"></i></a>
                <a href="javascript:;" title="Hapus" class="btn btn-light text-danger mb-1 border-0 tombol-hapus" data="' . $field->id . '"><i class="fad fa-trash-alt"></i></a>
                ';
            $data[] = $row;
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->PembimbingModel->count_all(),
            "recordsFiltered" => $this->PembimbingModel->count_filtered(),
            "data" => $data
        ];

        echo json_encode($output);
    }

    public function aksiDetail()
    {
        $where = array(
            'id' => $this->input->post('id')
        );
        $data = $this->PembimbingModel->detail($where, 'pembimbing');

        $where_user = array(
            'id' => $data['id_user']
        );

        $data += $this->PembimbingModel->detail($where_user, 'user');

        echo json_encode($data);
    }

    public function aksiTambah()
    {
        $json = [];
        $this->form_validation->set_rules('nama', 'nama', 'required', array(
            'required' => 'Masukkan nama lengkap pembimbing!'
        ));
        $this->form_validation->set_rules('jabatan', 'jabatan', 'required', array(
            'required' => 'Pilih jabatan pembimbing!'
        ));
        $this->form_validation->set_rules('username', 'username', 'required|is_unique[user.username]', array(
            'required' => 'Masukkan username mahasiswa!',
            'is_unique' => 'Username sudah dipakai, pilih username lain.'
        ));
        $this->form_validation->set_rules('password', 'password', 'required|min_length[5]', array(
            'required' => 'Masukkan password yang dipilih!',
            'min_length' => 'Password minimal 5 karakter.'
        ));

        // mendapatkan role id dari pembimbing
        $role = $this->RoleModel->detail(['nama' => 'Pembimbing'], 'ref_role');

        if ($this->form_validation->run() != false) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2048';
            $config['upload_path'] = './assets/image/profile/';
            $config['encrypt_name'] = true;
            $config['remove_spaces'] = true;

            // Insert User
            $data_user = [
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'id_role' => $role['id'],
                'aktif' => '1',
                'dibuat_pada' => date("Y-m-d H:i:s")
            ];

            $this->PembimbingModel->tambah($data_user, 'user');
            $id_user = $this->db->insert_id();
            // End insert User

            // Jika memilih sebuah file foto
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                $foto = ['upload_data' => $this->upload->data()];
                $foto_profile = [
                    'foto' => $foto['upload_data']['file_name']
                ];
            } else {
                $foto_profile = [
                    'foto' => 'user-default.png'
                ];
            }

            // Insert pambimbing
            $data = [
                'nama' => $this->input->post('nama'),
                'id_jabatan' => $this->input->post('jabatan'),
                'id_user' => $id_user,
                'aktif' => '1',
                'dibuat_pada' => date("Y-m-d H:i:s")
            ];

            $data += $foto_profile;
            $this->PembimbingModel->tambah($data, 'pembimbing');
            // End insert pembimbing

            $id = $this->db->insert_id();
            $nama = $this->input->post('nama');
            echo json_encode(array('status' => true, 'id' => $id, 'nama' => $nama, 'data' => $data));
        } else {
            $json = [
                'status' => false,
                'nama' => form_error('nama', '<p class="form-text text-danger">', '</p>'),
                'jabatan' => form_error('jabatan', '<p class="form-text text-danger">', '</p>'),
                'username' => form_error('username', '<p class="form-text text-danger">', '</p>'),
                'password' => form_error('password', '<p class="form-text text-danger">', '</p>')
            ];
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
        }
    }

    public function aksiUbah()
    {
        $json = [];
        $this->form_validation->set_rules('nama', 'nama', 'required', array(
            'required' => 'Masukkan nama lengkap pembimbing!'
        ));
        $this->form_validation->set_rules('jabatan', 'jabatan', 'required', array(
            'required' => 'Pilih jabatan pembimbing!'
        ));
        $this->form_validation->set_rules('username', 'username', 'required', array(
            'required' => 'Masukkan username mahasiswa!'
        ));

        if ($this->form_validation->run() != false) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2048';
            $config['upload_path'] = './assets/image/profile/';
            $config['encrypt_name'] = true;
            $config['remove_spaces'] = true;

            $where_pembimbing = array(
                'id' => $this->input->post('id')
            );

            $pembimbing = $this->PembimbingModel->detail(['id' => $where_pembimbing['id']], 'pembimbing');

            $where_user = array(
                'id' => $pembimbing['id_user']
            );

            $data_user = array(
                'username' => $this->input->post('username'),
                'diubah_pada' => date('Y-m-d H:i:s')
            );

            $this->PembimbingModel->ubah($data_user, $where_user, 'user');

            // Jika memilih sebuah file foto
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto_ubah')) {
                $foto_lama = $pembimbing['foto'];
                $foto = ['upload_data' => $this->upload->data()];

                // jika gambar berhasil diupload maka file gambar lama akan dihapus pada folder penyimpanan file gambar terkecuali file `default.png` tidak akan terhapus karena merupakan gambar bawaan semua user yang berhasil terdaftar
                if ($foto_lama != 'user-default.png') {
                    unlink(FCPATH . 'assets/image/profile/' . $foto_lama);
                }

                $foto_profile = [
                    'foto' => $foto['upload_data']['file_name']
                ];
            } else {
                $foto_profile = [
                    'foto' => $pembimbing['foto']
                ];
            }

            $data_pembimbing = array(
                'nama' => $this->input->post('nama'),
                'id_jabatan' => $this->input->post('jabatan'),
                'diubah_pada' => date('Y-m-d H:i:s')
            );

            $data_pembimbing += $foto_profile;

            $proses = $this->PembimbingModel->ubah($data_pembimbing, $where_pembimbing, 'pembimbing');

            echo json_encode(array('status' => true, 'data' => $proses));
        } else {
            $json = [
                'status' => false,
                'nama' => form_error('nama', '<p class="form-text text-danger">', '</p>'),
                'jabatan' => form_error('jabatan', '<p class="form-text text-danger">', '</p>'),
                'username' => form_error('username', '<p class="form-text text-danger">', '</p>')
            ];
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
        }
    }

    public function aksiHapus()
    {
        $where = array(
            'id' => $this->input->post('id')
        );

        $pembimbing = $this->PembimbingModel->detail(['id' => $where['id']], 'pembimbing');

        $where_user = array(
            'id' => $pembimbing['id_user']
        );

        $data = array(
            'aktif' => '0',
            'dihapus_pada' => date("Y-m-d H:i:s")
        );

        $proses = $this->PembimbingModel->ubah($data, $where, 'pembimbing');

        $this->PembimbingModel->ubah($data, $where_user, 'user');

        echo json_encode($proses);
    }

    public function select_jabatan()
    {
        $data = $this->db->get('ref_jabatan')->result_array();
        echo json_encode($data);
    }
}
