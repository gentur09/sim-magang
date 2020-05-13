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
}
