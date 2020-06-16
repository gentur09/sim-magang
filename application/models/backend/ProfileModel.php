<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfileModel extends CI_Model
{
    var $table = 'mahasiswa';
    var $column_order = array('mahasiswa.id', 'mahasiswa.semester', 'mahasiswa.nama', 'mahasiswa.email', 'mahasiswa.alamat');
    var $column_search = array('mahasiswa.id', 'mahasiswa.nama', 'ref_universitas.nama', 'mahasiswa.semester', 'mahasiswa.email', 'mahasiswa.alamat', 'mahasiswa.status');
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
            ref_universitas.nama as nama_universitas
        ');
        $this->db->from($this->table);
        $this->db->join('ref_universitas', 'ref_universitas.id = mahasiswa.id_universitas', 'LEFT');
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
        $this->db->from($this->table);
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
}
