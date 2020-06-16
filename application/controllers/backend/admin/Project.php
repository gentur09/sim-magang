<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Project extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('backend/ProjectModel', 'ProjectModel');

        check_login_admin(); //Memanggil function dari Helper
    }

    public function index()
    {
        $data['role'] = $this->db->get_where('ref_role', ['id' => $this->session->userdata('id_role')])->row_array();

        $this->load->view('backend/admin/layout/header');
        $this->load->view('backend/admin/layout/sidebar');
        $this->load->view('backend/admin/layout/navbar', $data);
        $this->load->view('backend/admin/project/index');
        $this->load->view('backend/admin/project/modal-tambah');
        $this->load->view('backend/admin/project/modal-ubah');
        $this->load->view('backend/admin/project/modal-hapus');
        $this->load->view('backend/admin/layout/footer');
        $this->load->view('backend/admin/project/index-js');
    }

    public function getDataProject()
    {
        $records = $this->ProjectModel->get_datatables();
        $data = [];
        $no = $_POST['start'];

        foreach ($records as $field) {
            $no++;
            $row = [];
            $row[] = $no;
            $row[] = $field->judul . "<br><small>Project Manager: " . $field->nama_pembimbing . "</small>";
            $row[] = ' 
                <a href="' . $field->repositori . '" title="Link Repositori" target="_blank" class="btn btn-light text-success mb-1 border-0"><i class="far fa-link"></i></a>
                <a href="javascript:;" title="Edit" class="btn btn-light text-warning mb-1 border-0 tombol-ubah" data="' . $field->id_projek . '"><i class="far fa-edit"></i></a>
                <a href="javascript:;" title="Hapus" class="btn btn-light text-danger mb-1 border-0 tombol-hapus" data="' . $field->id_projek . '"><i class="far fa-trash-alt"></i></a>
                ';
            $data[] = $row;
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->ProjectModel->count_all(),
            "recordsFiltered" => $this->ProjectModel->count_filtered(),
            "data" => $data
        ];

        echo json_encode($output);
    }

    public function aksiDetail()
    {
        $where = array(
            'id' => $this->input->post('id'),
        );
        $data = $this->ProjectModel->detail($where, 'projek_magang');

        echo json_encode($data);
    }

    public function aksiTambah()
    {
        $json = [];
        $this->form_validation->set_rules('judul', 'judul', 'required', array(
            'required' => 'Masukkan judul project!'
        ));
        $this->form_validation->set_rules('dosen_pembimbing', 'dosen pembimbing', 'required', array(
            'required' => 'Pilih dosen pembimbing project!'
        ));
        $this->form_validation->set_rules('waktu_mulai', 'waktu', 'required', array(
            'required' => 'Masukkan rentang waktu pengerjaan project!'
        ));
        $this->form_validation->set_rules('deskripsi', 'deskripsi', 'required', array(
            'required' => 'Masukkan deskripsi project!'
        ));
        $this->form_validation->set_rules('file_laporan', '', 'callback_file_check');

        if ($this->form_validation->run() != false) {
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = '102400';
            $config['upload_path'] = './assets/softfile_laporan/';
            $config['remove_spaces'] = true;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file_laporan')) {
                $file = ['upload_data' => $this->upload->data()];
                $file = [
                    'file' => $file['upload_data']['file_name']
                ];
            } else {
                $file = [
                    'file' => 'None'
                ];
            }

            $data = [
                'judul' => $this->input->post('judul'),
                'id_pembimbing' => $this->input->post('dosen_pembimbing'),
                'deskripsi' => $this->input->post('deskripsi'),
                'waktu_mulai' => $this->input->post('waktu_mulai'),
                'waktu_selesai' => $this->input->post('waktu_selesai'),
                'repositori' => $this->input->post('repositori'),
                'aktif' => '1',
                'dibuat_pada' => date("Y-m-d H:i:s")
            ];

            $data += $file;
            $this->ProjectModel->tambah($data, 'projek_magang');

            $id = $this->db->insert_id();
            echo json_encode(array('status' => true, 'id' => $id, 'data' => $data));
        } else {
            $json = [
                'status' => false,
                'judul' => form_error('judul', '<p class="form-text text-danger">', '</p>'),
                'dosen_pembimbing' => form_error('dosen_pembimbing', '<p class="form-text text-danger">', '</p>'),
                'waktu_pengerjaan' => form_error('waktu_mulai', '<p class="form-text text-danger">', '</p>'),
                'deskripsi' => form_error('deskripsi', '<p class="form-text text-danger">', '</p>'),
                'file_laporan' => form_error('file_laporan', '<p class="form-text text-danger">', '</p>')
            ];
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
        }
    }

    public function aksiUbah()
    {
        $json = [];
        $this->form_validation->set_rules('judul', 'judul', 'required', array(
            'required' => 'Masukkan judul project!'
        ));
        $this->form_validation->set_rules('dosen_pembimbing', 'dosen pembimbing', 'required', array(
            'required' => 'Pilih dosen pembimbing project!'
        ));
        $this->form_validation->set_rules('waktu_mulai', 'waktu', 'required', array(
            'required' => 'Masukkan rentang waktu pengerjaan project!'
        ));
        $this->form_validation->set_rules('deskripsi', 'deskripsi', 'required', array(
            'required' => 'Masukkan deskripsi project!'
        ));
        $this->form_validation->set_rules('file_laporan', '', 'callback_file_check');

        if ($this->form_validation->run() != false) {
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = '102400';
            $config['upload_path'] = './assets/softfile_laporan/';
            $config['remove_spaces'] = true;

            $where = [
                'id' => $this->input->post('id')
            ];

            $project = $this->ProjectModel->detail(['id' => $where['id']], 'projek_magang');

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file_laporan')) {
                $file_lama = $project['file'];
                $file = ['upload_data' => $this->upload->data()];
                if ($file_lama != 'None') {
                    unlink(FCPATH . 'assets/softfile_laporan/' . $file_lama);
                }

                $file_baru = [
                    'file' => $file['upload_data']['file_name']
                ];
            } else {
                $file_baru = [
                    'file' => $project['file']
                ];
            }

            $data = [
                'judul' => $this->input->post('judul'),
                'id_pembimbing' => $this->input->post('dosen_pembimbing'),
                'deskripsi' => $this->input->post('deskripsi'),
                'waktu_mulai' => $this->input->post('waktu_mulai'),
                'waktu_selesai' => $this->input->post('waktu_selesai'),
                'repositori' => $this->input->post('repositori'),
                'diubah_pada' => date('Y-m-d H:i:s')
            ];

            $data += $file_baru;
            $proses = $this->ProjectModel->ubah($data, $where, 'projek_magang');
            echo json_encode(array('status' => true, 'data' => $proses));
        } else {
            $json = [
                'status' => false,
                'judul' => form_error('judul', '<p class="form-text text-danger">', '</p>'),
                'dosen_pembimbing' => form_error('dosen_pembimbing', '<p class="form-text text-danger">', '</p>'),
                'waktu_pengerjaan' => form_error('waktu_mulai', '<p class="form-text text-danger">', '</p>'),
                'deskripsi' => form_error('deskripsi', '<p class="form-text text-danger">', '</p>'),
                'file_laporan' => form_error('file_laporan', '<p class="form-text text-danger">', '</p>')
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

        $proses = $this->ProjectModel->ubah($data, $where, 'projek_magang');

        echo json_encode($proses);
    }

    public function file_check($str)
    {
        $allowed_mime_type_arr = array('application/pdf');
        $mime = get_mime_by_extension($_FILES['file_laporan']['name']);
        if (isset($_FILES['file_laporan']['name']) && $_FILES['file_laporan']['name'] != "") {
            if (in_array($mime, $allowed_mime_type_arr)) {
                return true;
            } else {
                $this->form_validation->set_message('file_check', 'Upload softfile laporan hanya dalam bentuk PDF.');
                return false;
            }
        } else {
            return true;
        }
    }

    public function select_pembimbing()
    {
        $data = $this->db->get('pembimbing')->result_array();
        echo json_encode($data);
    }
}
