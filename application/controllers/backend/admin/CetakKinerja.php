<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CetakKinerja extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('backend/KinerjaModel', 'kinerja');
    }

    public function kinerjaMahasiswa($id = 0)
    {
        $data = [
            'kinerja' => $this->kinerja->detailKinerja($id)
        ];
        $mpdf = new \Mpdf\Mpdf(['format' => 'Legal']);
        $html = $this->load->view('backend/admin/cetak/kinerja-mahasiswa', $data, true);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}
