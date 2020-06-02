<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        check_login_mahasiswa(); //Memanggil function dari Helper
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('mahasiswa', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->load->view('backend/mahasiswa/layout/header');
        $this->load->view('backend/mahasiswa/layout/sidebar');
        $this->load->view('backend/mahasiswa/layout/navbar', $data);
        $this->load->view('backend/mahasiswa/profile/index');
        $this->load->view('backend/mahasiswa/layout/footer');
        $this->load->view('backend/mahasiswa/profile/index-js');
    }


    public function getDataMahasiswa()
    {
        $records = $this->MahasiswaModel->get_datatables();
        $data = [];
        $no = $_POST['start'];

        foreach ($records as $field) {
            $no++;
            $row = [];
            $row[] = $no;
            $row[] = $field->nama . "<br><small>" . $field->nama_universitas . "</small>";
            $row[] = $field->semester;
            $row[] = $field->email;
            $row[] = $field->alamat;
            $row[] = '
                <a href="javascript:;" title="Edit" class="btn btn-light text-warning mb-1 border-0 tombol-ubah" data="' . $field->id_mahasiswa . '"><i class="fad fa-edit"></i></a>
                <a href="javascript:;" title="Hapus" class="btn btn-light text-danger mb-1 border-0 tombol-hapus" data="' . $field->id_mahasiswa . '"><i class="fad fa-trash-alt"></i></a>
                ';
            $data[] = $row;
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->MahasiswaModel->count_all(),
            "recordsFiltered" => $this->MahasiswaModel->count_filtered(),
            "data" => $data
        ];

        echo json_encode($output);
    }

    public function aksiDetail()
    {
        $where = array(
            'id' => $this->input->post('id')
        );
        $data = $this->MahasiswaModel->detail($where, 'mahasiswa');

        $where_user = array(
            'id' => $data['id_user']
        );

        $data += $this->MahasiswaModel->detail($where_user, 'user');

        echo json_encode($data);
    }

    public function aksiTambah()
    {
        $json = [];
        $this->form_validation->set_rules('nama', 'nama', 'required', array(
            'required' => 'Masukkan nama lengkap mahasiswa!'
        ));
        $this->form_validation->set_rules('universitas', 'universitas', 'required', array(
            'required' => 'Pilih universitas mahasiswa!'
        ));
        $this->form_validation->set_rules('email', 'email', 'required|valid_email', array(
            'required' => 'Masukkan email mahasiswa!',
            'valid_email' => 'Email yang dimasukkan tidak valid.'
        ));
        $this->form_validation->set_rules('nomor_telpon', 'nomor telepon', 'required', array(
            'required' => 'Masukkan no telp / HP mahasiswa!'
        ));
        $this->form_validation->set_rules('username', 'username', 'required|is_unique[user.username]', array(
            'required' => 'Masukkan username mahasiswa!',
            'is_unique' => 'Username sudah dipakai, pilih username lain.'
        ));
        $this->form_validation->set_rules('password', 'password', 'required|min_length[5]', array(
            'required' => 'Masukkan password yang dipilih!',
            'min_length' => 'Password minimal 5 karakter.'
        ));
        $this->form_validation->set_rules('alamat', 'alamat', 'required', array(
            'required' => 'Masukkan alamat mahasiswa!'
        ));
        $this->form_validation->set_rules('provinsi', 'provinsi', 'required', array(
            'required' => 'Pilih provinsi alamat asal!'
        ));
        $this->form_validation->set_rules('kabupaten', 'kabupaten', 'required', array(
            'required' => 'Pilih kabupaten alamat asal!'
        ));
        $this->form_validation->set_rules('kecamatan', 'kecamatan', 'required', array(
            'required' => 'Pilih kecamatan alamat asal!'
        ));

        // mendapatkan role id dari mahasiswa
        $role = $this->MahasiswaModel->detail(['nama' => 'Mahasiswa'], 'ref_role');

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

            $this->MahasiswaModel->tambah($data_user, 'user');
            $id_user = $this->db->insert_id();

            // Jika memilih sebuah file foto
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                $foto = ['upload_data' => $this->upload->data()];
                $foto_profile = [
                    'foto' => $foto['upload_data']['file_name']
                ];
            } else {
                $foto_profile = [
                    'foto' => 'user-default-student.png'
                ];
            }

            // Insert mahasiswa
            $data = [
                'nama' => $this->input->post('nama'),
                'id_universitas' => $this->input->post('universitas'),
                'semester' => $this->input->post('semester'),
                'email' => $this->input->post('email'),
                'nomor_telpon' => $this->input->post('nomor_telpon'),
                'status' => '1',
                'alamat' => $this->input->post('alamat'),
                'id_provinsi' => $this->input->post('provinsi'),
                'id_kabupaten' => $this->input->post('kabupaten'),
                'id_kecamatan' => $this->input->post('kecamatan'),
                'id_user' => $id_user,
                'aktif' => '1',
                'dibuat_pada' => date("Y-m-d H:i:s")
            ];

            $data += $foto_profile;
            $this->MahasiswaModel->tambah($data, 'mahasiswa');
            // End insert mahasiswa

            $id = $this->db->insert_id();
            $nama = $this->input->post('nama');
            echo json_encode(array('status' => true, 'id' => $id, 'nama' => $nama, 'data' => $data));
        } else {
            $json = [
                'status' => false,
                'nama' => form_error('nama', '<p class="form-text text-danger">', '</p>'),
                'universitas' => form_error('universitas', '<p class="form-text text-danger">', '</p>'),
                'email' => form_error('email', '<p class="form-text text-danger">', '</p>'),
                'nomor_telpon' => form_error('nomor_telpon', '<p class="form-text text-danger">', '</p>'),
                'username' => form_error('username', '<p class="form-text text-danger">', '</p>'),
                'password' => form_error('password', '<p class="form-text text-danger">', '</p>'),
                'alamat' => form_error('alamat', '<p class="form-text text-danger">', '</p>'),
                'provinsi' => form_error('provinsi', '<p class="form-text text-danger">', '</p>'),
                'kabupaten' => form_error('kabupaten', '<p class="form-text text-danger">', '</p>'),
                'kecamatan' => form_error('kecamatan', '<p class="form-text text-danger">', '</p>')
            ];
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
        }
    }

    public function aksiUbah()
    {
        $json = [];
        $this->form_validation->set_rules('nama', 'nama', 'required', array(
            'required' => 'Masukkan nama lengkap mahasiswa!'
        ));
        $this->form_validation->set_rules('universitas', 'universitas', 'required', array(
            'required' => 'Pilih universitas mahasiswa!'
        ));
        $this->form_validation->set_rules('email', 'email', 'required|valid_email', array(
            'required' => 'Masukkan email mahasiswa!',
            'valid_email' => 'Email yang dimasukkan tidak valid.'
        ));
        $this->form_validation->set_rules('nomor_telpon', 'nomor telepon', 'required', array(
            'required' => 'Masukkan no telp / HP mahasiswa!'
        ));
        $this->form_validation->set_rules('username', 'username', 'required', array(
            'required' => 'Masukkan username mahasiswa!'
        ));
        $this->form_validation->set_rules('alamat', 'alamat', 'required', array(
            'required' => 'Masukkan alamat mahasiswa!'
        ));

        if ($this->form_validation->run() != false) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2048';
            $config['upload_path'] = './assets/image/profile/';
            $config['encrypt_name'] = true;
            $config['remove_spaces'] = true;

            $where_mahasiswa = array(
                'id' => $this->input->post('id')
            );

            $mahasiswa = $this->MahasiswaModel->detail(['id' => $where_mahasiswa['id']], 'mahasiswa');

            $where_user = array(
                'id' => $mahasiswa['id_user']
            );

            $data_user = array(
                'username' => $this->input->post('username'),
                'diubah_pada' => date('Y-m-d H:i:s')
            );

            $this->MahasiswaModel->ubah($data_user, $where_user, 'user');

            // Jika memilih sebuah file foto
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto_ubah')) {
                $foto_lama = $mahasiswa['foto'];
                $foto = ['upload_data' => $this->upload->data()];

                // jika gambar berhasil diupload maka file gambar lama akan dihapus pada folder penyimpanan file gambar terkecuali file `default.png` tidak akan terhapus karena merupakan gambar bawaan semua user yang berhasil terdaftar
                if ($foto_lama != 'user-default-student.png') {
                    unlink(FCPATH . 'assets/image/profile/' . $foto_lama);
                }

                $foto_profile = [
                    'foto' => $foto['upload_data']['file_name']
                ];
            } else {
                $foto_profile = [
                    'foto' => $mahasiswa['foto']
                ];
            }

            $data_mahasiswa = array(
                'nama' => $this->input->post('nama'),
                'id_universitas' => $this->input->post('universitas'),
                'semester' => $this->input->post('semester'),
                'email' => $this->input->post('email'),
                'nomor_telpon' => $this->input->post('nomor_telpon'),
                'alamat' => $this->input->post('alamat')
            );

            $data_mahasiswa += $foto_profile;

            $proses = $this->MahasiswaModel->ubah($data_mahasiswa, $where_mahasiswa, 'mahasiswa');

            echo json_encode(array('status' => true, 'data' => $proses));
        } else {
            $json = [
                'status' => false,
                'nama' => form_error('nama', '<p class="form-text text-danger">', '</p>'),
                'universitas' => form_error('universitas', '<p class="form-text text-danger">', '</p>'),
                'email' => form_error('email', '<p class="form-text text-danger">', '</p>'),
                'nomor_telpon' => form_error('nomor_telpon', '<p class="form-text text-danger">', '</p>'),
                'username' => form_error('username', '<p class="form-text text-danger">', '</p>'),
                'alamat' => form_error('alamat', '<p class="form-text text-danger">', '</p>'),
            ];
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
        }
    }

}
