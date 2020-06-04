<?php

function is_logged_in()
{
    $ci = get_instance();

    $admin = $ci->db->get_where('ref_role', ['nama' => 'Administrator'])->row_array();
    $pembimbing = $ci->db->get_where('ref_role', ['nama' => 'Pembimbing'])->row_array();
    $mahasiswa = $ci->db->get_where('ref_role', ['nama' => 'Mahasiswa'])->row_array();

    if (!empty($ci->session->userdata('id_role'))) {
        if ($ci->session->userdata('id_role') == $admin['id']) {
            redirect('backend/admin/dashboard');
        } elseif ($ci->session->userdata('id_role') == $mahasiswa['id']) {
            redirect('backend/mahasiswa/profile');
        } elseif ($ci->session->userdata('id_role') == $pembimbing['id']) {
            redirect('backend/pembimbing/dashboard');
        }
    }
}

function check_login_admin()
{
    $ci = get_instance();

    $admin = $ci->db->get_where('ref_role', ['nama' => 'Administrator'])->row_array();

    if ($ci->session->userdata('id_role') != $admin['id']) {
        redirect('login');
    }
}

function check_login_mahasiswa()
{
    $ci = get_instance();

    $mahasiswa = $ci->db->get_where('ref_role', ['nama' => 'Mahasiswa'])->row_array();

    if ($ci->session->userdata('id_role') != $mahasiswa['id']) {
        redirect('login');
    }
}

function check_login_pembimbing()
{
    $ci = get_instance();

    $pembimbing = $ci->db->get_where('ref_role', ['nama' => 'Pembimbing'])->row_array();

    if ($ci->session->userdata('id_role') != $pembimbing['id']) {
        redirect('login');
    }
}
