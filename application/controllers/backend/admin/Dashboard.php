<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        check_login_admin(); //Memanggil function dari Helper
    }

    public function index()
    {
        $data['role'] = $this->db->get_where('ref_role', ['id' => $this->session->userdata('id_role')])->row_array();

        $this->load->view('backend/admin/layout/header');
        $this->load->view('backend/admin/layout/sidebar');
        $this->load->view('backend/admin/layout/navbar', $data);
        $this->load->view('backend/admin/dashboard/index');
        $this->load->view('backend/admin/layout/footer');
        $this->load->view('backend/admin/dashboard/index-js');
    }
}
