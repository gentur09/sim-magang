<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        check_login_pembimbing(); //Memanggil function dari Helper
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('pembimbing', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->load->view('backend/pembimbing/layout/header');
        $this->load->view('backend/pembimbing/layout/sidebar');
        $this->load->view('backend/pembimbing/layout/navbar', $data);
        $this->load->view('backend/pembimbing/dashboard/index');
        $this->load->view('backend/pembimbing/layout/footer');
        $this->load->view('backend/pembimbing/dashboard/index-js');
    }
}
