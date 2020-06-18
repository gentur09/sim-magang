<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KinerjaModel extends CI_Model
{
    var $table = 'kinerja';

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
