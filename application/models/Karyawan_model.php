<?php

defined('BASEPATH') OR exit('No direct script access allowed'); //agar tidak bisa diakses langsung ke lokasi dir

/**
 * Created by PhpStorm.
 * User: rroos
 * Date: 26-Nov-2018
 * Time: 11:33
 */
class Karyawan_model extends CI_Model
{
    //nama tabel
    public $table = 'karyawan';

    public function __construct()
    {
        parent::__construct();
    }

    //fungsi fungsi yg mengakses DB

    //get all data
    public function find_all()
    {
        //menggunakan result array agar hasilnya array
        //querynya diubah sesuai dengan kebutuhan
//        return $this->db->get($this->table)->result_array();
        //menggunakan query native di codeigniter
        return $this->db->query("SELECT karyawan.*, divisi.nama as namadivisi FROM `karyawan`
INNER JOIN divisi on divisi.id = karyawan.iddivisi")->result_array();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    //detail dari satu baris tabel berdasarkan id
    public function find_by_id($id)
    {
//        $result = $this->db->get_where($this->table, ['id' => $id])->result_array();
        $result = $this->db->query("SELECT karyawan.*, divisi.nama as namadivisi FROM `karyawan`
INNER JOIN divisi on divisi.id = karyawan.iddivisi where karyawan.id=$id")->result_array();
        if ($result) {
            return $result[0];
        } else {
            return false;
        }
    }

    public function find_by_name($name)
    {
//        $result = $this->db->get_where($this->table, ['id' => $id])->result_array();
        $result = $this->db->query("SELECT karyawan.*, divisi.nama as namadivisi FROM `karyawan`
INNER JOIN divisi on divisi.id = karyawan.iddivisi where karyawan.nama LIKE '%$name%'")->result_array();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

}