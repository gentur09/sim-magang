<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KinerjaModel extends CI_Model
{
    var $table = 'kinerja';
    var $column_order = array('mahasiswa.id', 'mahasiswa.nama');
    var $column_search = array('mahasiswa.id', 'mahasiswa.nama');
    var $order = array('mahasiswa.id' => 'DESC');

    private function _get_datatables_query()
    {
        $this->db->select('
            mahasiswa.id as id_mahasiswa,
            mahasiswa.nama,
            mahasiswa.id_universitas,
            mahasiswa.semester,
            mahasiswa.email,
            mahasiswa.nomor_telpon,
            mahasiswa.foto,
            mahasiswa.status,
            mahasiswa.alamat,
            mahasiswa.id_provinsi,
            mahasiswa.id_kabupaten,
            mahasiswa.id_kecamatan,
            ref_universitas.nama as nama_universitas,
            provinsi.nama as nama_provinsi,
            kabupaten.nama as nama_kabupaten,
            kecamatan.nama as nama_kecamatan
        ');
        $this->db->from('mahasiswa');
        $this->db->join('ref_universitas', 'ref_universitas.id = mahasiswa.id_universitas', 'LEFT');
        $this->db->join('provinsi', 'provinsi.kode_wilayah = mahasiswa.id_provinsi', 'LEFT');
        $this->db->join('kabupaten', 'kabupaten.kode_wilayah = mahasiswa.id_kabupaten', 'LEFT');
        $this->db->join('kecamatan', 'kecamatan.kode_wilayah = mahasiswa.id_kecamatan', 'LEFT');
        $this->db->where('mahasiswa.aktif', '1');
        $this->db->where('mahasiswa.dihapus_pada is NULL');

        $i = 0;

        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from('mahasiswa');
        $this->db->where('aktif', '1');
        $this->db->where('dihapus_pada is NULL');
        return $this->db->count_all_results();
    }

    public function detail($where, $table)
    {
        $query = $this->db->get_where($table, $where);
        return $query->row_array();
    }

    public function tambah($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function ubah($data, $where, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function hapus($where, $table)
    {
        $this->db->where($where);
        return $this->db->delete($table);
    }

    public function detailKinerja($id = '')
    {
        $this->db->select('
            kinerja.id as id_kinerja,
            kinerja.judul as kinerja,
            kinerja.keterangan,
            kinerja.id_mahasiswa,
            kinerja.tanggal,
            kinerja.id_projek_magang,
            projek_magang.id_pembimbing,
            pembimbing.nama as nama_pembimbing,
            mahasiswa.nama as nama_mahasiswa,
            projek_magang.judul as projek
        ');
        $this->db->from($this->table);
        $this->db->join('mahasiswa', 'mahasiswa.id = kinerja.id_mahasiswa', 'LEFT');
        $this->db->join('projek_magang', 'projek_magang.id = kinerja.id_projek_magang', 'LEFT');
        $this->db->join('pembimbing', 'pembimbing.id = projek_magang.id_pembimbing', 'LEFT');
        $this->db->where('kinerja.aktif', '1');
        $this->db->where('kinerja.dihapus_pada is NULL');
        $this->db->where('kinerja.id_mahasiswa', $id);
        $query = $this->db->get();
        return $query->result();
    }
}
