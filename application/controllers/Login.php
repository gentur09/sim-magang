<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
        is_logged_in(); //Memanggil function dari Helper

        $data['title'] = 'Login';
        $this->load->view('login', $data);
    }

    private function _validasiInput()
    {
        $form = array(
            array(
                'label' => 'Username',
                'field' => 'username',
                'rules' => 'required'
            ),
            array(
                'label' => 'Password',
                'field' => 'password',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($form);
        return $this->form_validation->run();
    }

    public function proses()
    {
        if ($this->_validasiInput()) {
            $username = strtolower($this->input->post('username', true));
            $password = $this->input->post('password', true);

            $user = $this->db->get_where('user', ['username' => $username])->row_array();

            if ($user) {
                // cek akun aktif
                if ($user['aktif'] == '1') {
                    // cek user password
                    if (password_verify($password, $user['password'])) {
                        $data = array(
                            'id_user' => $user['id'],
                            'id_role' => $user['id_role']
                        );

                        $this->session->set_userdata($data);

                        if ($user['id_role'] == 4) {
                            redirect('backend/admin/dashboard');
                        } elseif ($user['id_role'] == 2) {
                            redirect('backend/mahasiswa/profile');
                        } else {
                            redirect('login');
                        }
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Gagal!</strong> Username atau Password anda salah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="far fa-times"></i></span></button></div>');
                        redirect('login');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Gagal!</strong> Akun anda tidak aktif.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="far fa-times"></i></span></button></div>');
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Gagal!</strong> Username atau Password anda salah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="far fa-times"></i></span></button></div>');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Gagal!</strong> Tidak dapat memvalidasi. Username atau Password masih kosong!.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="far fa-times"></i></span></button></div>');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('id_role');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Anda berhasil logout.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="far fa-times"></i></span></button></div>');
        redirect('login');
    }
}
