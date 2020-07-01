<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UniversitasModel extends CI_Model
{
    var $table = 'ref_universitas';
    var $column_order = array('ref_universitas.id', 'ref_universitas.nama', 'ref_universitas.alamat', 'provinsi.nama', 'kabupaten.nama', 'kecamatan.nama');
    var $column_search = array('ref_universitas.id', 'ref_universitas.nama', 'ref_universitas.alamat', 'provinsi.nama', 'kabupaten.nama', 'kecamatan.nama');
    var $order = array('ref_universitas.id' => 'DESC');

    private function _get_datatables_query()
    {
        $this->db->select('
            ref_universitas.id as id_universitas, 
            ref_universitas.nama, 
            ref_universitas.alamat, 
            ref_universitas.provinsi, 
            ref_universitas.kabupaten, 
            ref_universitas.kecamatan, 
            ref_universitas.kelurahan, 
            provinsi.nama as nama_provinsi,
            kabupaten.nama as nama_kabupaten,
            kecamatan.nama as nama_kecamatan,
            kelurahan.nama as nama_kelurahan
        ');
        $this->db->from($this->table);
        $this->db->join('provinsi', 'provinsi.kode_wilayah = ref_universitas.provinsi', 'LEFT');
        $this->db->join('kabupaten', 'kabupaten.kode_wilayah = ref_universitas.kabupaten', 'LEFT');
        $this->db->join('kecamatan', 'kecamatan.kode_wilayah = ref_universitas.kecamatan', 'LEFT');
        $this->db->join('kelurahan', 'kelurahan.kode_wilayah = ref_universitas.kelurahan', 'LEFT');
        $this->db->where('ref_universitas.aktif', '1');
        $this->db->where('ref_universitas.dihapus_pada is NULL');

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
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
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
        $this->db->select('
            ref_universitas.id as id_universitas, 
            ref_universitas.nama, 
            ref_universitas.alamat, 
            ref_universitas.provinsi, 
            ref_universitas.kabupaten, 
            ref_universitas.kecamatan, 
            provinsi.nama as nama_provinsi,
            kabupaten.nama as nama_kabupaten,
            kecamatan.nama as nama_kecamatan,
            kelurahan.nama as nama_kelurahan
        ');
        $this->db->from($this->table);
        $this->db->join('provinsi', 'provinsi.kode_wilayah = ref_universitas.provinsi', 'LEFT');
        $this->db->join('kabupaten', 'kabupaten.kode_wilayah = ref_universitas.kabupaten', 'LEFT');
        $this->db->join('kecamatan', 'kecamatan.kode_wilayah = ref_universitas.kecamatan', 'LEFT');
        $this->db->join('kelurahan', 'kelurahan.kode_wilayah = ref_universitas.kelurahan', 'LEFT');
        $this->db->where('ref_universitas.aktif', '1');
        $this->db->where('ref_universitas.dihapus_pada is NULL');
        return $this->db->count_all_results();
    }

    public function daftar_semua($table)
    {
        $query = $this->db->get_where($table, ['aktif' => '1', 'dihapus_pada is NULL']);
        return $query->result_array();
    }

    public function daftar_sebagian($where, $table)
    {
        $query = $this->db->get_where($table, $where);
        return $query->result_array();
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
}
