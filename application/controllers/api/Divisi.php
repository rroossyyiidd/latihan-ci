<?php
/**
 * Created by PhpStorm.
 * User: rroos
 * Date: 28-Nov-2018
 * Time: 10:54
 */

//agar tidak bisa diakses langsung ke lokasi dir/foler
defined('BASEPATH') OR exit('No direct script access allowed');

/** @noinspection PhpIncludeInspection */
//1. menambahkan library rest controller (include)
require APPPATH . 'libraries/REST_Controller.php';

class Divisi extends REST_Controller
{
    function __construct($config = 'rest')
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct($config);

        //$this->input->post() kalau extends REST_Controller $this->post

        //cek di kedua jenis method get dan post
        $token = $this->post('token');
        if (!$token) {
            $token = $this->get('token');
        }

        if (!$token) {
            $this->response('access denied', REST_Controller::HTTP_FORBIDDEN);
        }
        //load model user
        $this->load->model('users_model', 'users');
        //cek token apakah valid
        $user = $this->users->find_by_token($token);
        if (!$user) {
            $this->response('invalid token', REST_Controller::HTTP_FORBIDDEN);
        }
        $this->load->model('divisi_model', 'divisi');
    }

    // http://localhost/appkaryawan/api/divisi
    function index_get()
    {
        $data = $this->divisi->find_all();
        if ($data) {
            //kalau ada data nya
            $this->response($data);
        } else {
            //data tidak ada, status 204
            $this->response(null, REST_Controller::HTTP_NO_CONTENT);
        }
    }

    //secara default start index itu nol (0)
    // http://localhost/appkaryawan/api/divisi/pagination/0
    function pagination_get()
    {
        //DATA PAGINATION
        //kalau limit 10 maka hal 0 x 10, 1 x 10, 2 x 10 untuk penentuan start index
        $data = [];
        //jumlah data per halaman
        $limit_per_page = 10;
        //http://localhost/appkaryawan/api/divisi/pagination/0
        $start_index = $this->uri->segment('4') ? $this->uri->segment('4') : 0;
        //get total data di tabel
        $total_records = $this->divisi->get_total();
        if ($total_records > 0) {
            //get data dengan pagination
            $data = $this->divisi->pagination($limit_per_page, $start_index);
        }
        if ($data) {
            //kalau ada datanya
            $this->response($data);
        }
        //kalau datanya gk ada
        $this->response(null, REST_Controller::HTTP_NO_CONTENT);
    }

    // http://localhost/appkaryawan/api/divisi/insert
    function insert_post()
    {
        //mengcustom respon validation
        $this->form_validation->set_rules('kode', 'Kode divisi', 'required', ['required' => 'kode bro']);
        $this->form_validation->set_rules('nama', 'Nama divisi', 'required');

        //cek validasi
        if ($this->form_validation->run() === FALSE) {
            $this->response(validation_errors(), REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $data = [
                'kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama')
            ];
            $result = $this->divisi->insert($data);
            if ($result) {
                //mendapatkan id yang barusan diinputkan
                $data['id'] = $this->db->insert_id();
                $this->response($data);
            } else {
                $this->response($result);
            }
        }
    }

    // http://localhost/appkaryawan/api/divisi/detail/2
    function detail_get()
    {
        $id = $this->uri->segment('4');
        $data = $this->divisi->find_by_id($id);
        if ($data) {
            $this->response($data);
        };
        $this->response(null, REST_Controller::HTTP_NOT_FOUND);
    }

    // http://localhost/appkaryawan/api/divisi/update
    function update_post()
    {
        //get id from post, body
        $id = $this->input->post('id');
        //validator
        $this->form_validation->set_rules('kode', 'Kode divisi', 'required');
        $this->form_validation->set_rules('nama', 'Nama divisi', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->response(validation_errors(), REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $data = [
                'kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama')
            ];

            //data = menampung value dari form ke data untuk input di tabel mysql
            $this->divisi->update($id, $data);
            $data['id'] = $id;
            $this->response($data);
        }
    }

    // http://localhost/appkaryawan/api/divisi/delete/1
    function delete_post()
    {
        //dari url
        $id = $this->uri->segment(4);
        if ($id) {
            $result = $this->divisi->delete($id);
            if (!$result) {
                log_message('DEBUG', implode("-", $this->db->error()));
                $this->response('tidak dapat menghapus data', 500);
            }
            $this->response("Berhasil menghapus data");
        }
        $this->response('tidak dapat menghapus data', 500);
    }
}