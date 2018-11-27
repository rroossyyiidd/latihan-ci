<?php

class Notadetail_model extends CI_Model {

    public $table = 'nota_detail';

    public function __construct() {
        parent::__construct();
    }

    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function find_all() {
        return $this->db->query("SELECT nota_detail.*,nota.nomor FROM nota_detail
INNER JOIN nota ON nota_detail.idnota=nota.id")->result_array();
    }

    public function find_by_id($id) {
        $result = $this->db->query("SELECT nota_detail.*,nota.nomor FROM nota_detail
INNER JOIN nota ON nota_detail.idnota=nota.id WHERE nota_detail.id='$id'")->result_array();
        if ($result) {
            return $result[0];
        } else {
            return false;
        }
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function pagination($limit, $start) {
        $this->db->limit($limit, $start);
        $result = $this->db->get($this->table)->result_array();
        if (count($result) > 0) {
            return $result;
        }
        return false;
    }

    public function get_total() {
        return $this->db->count_all($this->table);
    }

    public function find_by_nomor($nomor) {
        $result = $this->db->query("SELECT nota_detail.*,nota.nomor FROM nota_detail
INNER JOIN nota ON nota_detail.idnota=nota.id WHERE nota.nomor LIKE '%$nomor%'")->result_array();
        return $result;
    }

}
