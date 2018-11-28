<?php
/**
 * Created by PhpStorm.
 * User: rroos
 * Date: 28-Nov-2018
 * Time: 17:13
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/** @noinspection PhpIncludeInspection */
//1. menambahkan library rest controller (include)
require APPPATH . 'libraries/REST_Controller.php';


class Karyawan extends REST_Controller
{
    function __construct($config = 'rest')
    {
        //CORS
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

        parent::__construct($config);
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

        $this->load->model('karyawan_model', 'karyawan');
    }

    //http://localhost/appkaryawan/api/karyawan
    function index_get()
    {
        $data = $this->karyawan->find_all();
        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(["status" => false, "message" => "tidak ada data"], 404);
        }
    }

    // http://localhost/appkaryawan/api/karyawan/pagination/0
    function pagination_get()
    {
        //DATA PAGINATION KARYAWNA
        $data = [];
        //jumlah limit per response
        $limit_per_page = 10;
        $start_index = $this->uri->segment('4') ? $this->uri->segment('4') : 0;

        //cek apakah ada data di tabel
        $totalRecords = $this->karyawan->get_total();
        if ($totalRecords > 0) {
            //get data by pagination
            $data = $this->karyawan->pagination($limit_per_page, $start_index);
        }
        if ($data) {
            $this->response($data);
        }
        $this->response(["status" => false, "message" => "tidak ada data"], 404);
    }

    // http://localhost/appkaryawan/api/karyawan/insert
    function insert_post()
    {
        $this->form_validation->set_rules('nama', 'Nama Karyawan', 'required');
        $this->form_validation->set_rules('email', 'Email Karyawan', 'required|valid_email');
        $this->form_validation->set_rules('telpon', 'Telpon Karyawan', 'required|alpha_numeric|numeric');
        $this->form_validation->set_rules('jabatan', 'Jabatan Karyawan', 'required');
        $this->form_validation->set_rules('jeniskelamin', 'Jenis Kelamin Karyawan', 'required');
        $this->form_validation->set_rules('iddivisi', 'Divisi Karyawan', 'required');
        $this->form_validation->set_rules('tgllahir', 'Tanggal Lahir Karyawan', 'required');

        if ($this->form_validation->run() == FALSE) {
            //gagal
            $this->response(validation_errors(), REST_Controller::HTTP_BAD_REQUEST);
        } else {
            //upload file
            //http://localhost/appkaryawan/user_guide/libraries/file_uploading.html
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = '*';
            $config['overwrite'] = TRUE;
            $config['max_size'] = '2048000';

            $file_name = "";

            //cek apakah ada file yang diupload
            if ($_FILES['foto']['name'] != "") {
                $this->load->library('upload', $config); //load library
                if ($this->upload->do_upload('foto')) {
                    $upload_data = $this->upload->data();
                    $file_name = $upload_data['file_name'];
                    //selain bisa dpt nama file jg bisa dpt informasi lain spt file_size dll
                    //referensi: http://localhost/appkaryawan/user_guide/libraries/file_uploading.html
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error);
                    exit;
                }
            }

            $data = [
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'telpon' => $this->input->post('telpon'),
                'jabatan' => $this->input->post('jabatan'),
                'jeniskelamin' => $this->input->post('jeniskelamin'),
                'iddivisi' => $this->input->post('iddivisi'),
                'tgllahir' => $this->input->post('tgllahir'),
                'foto' => $file_name
            ];

            //data = menampung value dari form ke data untuk input di tabel mysql
            $result = $this->karyawan->insert($data);
            if ($result) {
                $data['id'] = $this->db->insert_id();
                $this->response($data);
            } else {
                $this->response($result);
            }
        }
    }

    // http://localhost/appkaryawan/api/karyawan/detail/1
    function detail_get()
    {
        $id = $this->uri->segment(4);
        $data = $this->karyawan->find_by_id($id);
        if ($data) {
            $this->response($data);
        } else {
            $this->response(["status" => false, "message" => "Data tidak ditemukan"], 500);
        }
        $this->response(["status" => false, "message" => "Gagal mengambil data"], REST_Controller::HTTP_NO_CONTENT);
    }

    //http://localhost/appkaryawan/api/karyawan/update
    function update_post()
    {
        $id = $this->input->post('id'); //dari input type hidden
        $this->form_validation->set_rules('nama', 'Nama Karyawan', 'required');
        $this->form_validation->set_rules('email', 'Email Karyawan', 'required|valid_email');
        $this->form_validation->set_rules('telpon', 'Telpon Karyawan', 'required|alpha_numeric|numeric');
        $this->form_validation->set_rules('jabatan', 'Jabatan Karyawan', 'required');
        $this->form_validation->set_rules('jeniskelamin', 'Jenis Kelamin Karyawan', 'required');
        $this->form_validation->set_rules('iddivisi', 'Divisi Karyawan', 'required');
        $this->form_validation->set_rules('tgllahir', 'Tanggal Lahir Karyawan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->response(validation_errors(), REST_Controller::HTTP_BAD_REQUEST);
        } else {
            //upload file
            //http://localhost/appkaryawan/user_guide/libraries/file_uploading.html
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = '*';
            $config['overwrite'] = TRUE;
            $config['max_size'] = '2048000';

            $file_name = "";

            //cek apakah ada file yang diupload
            if ($_FILES['foto']['name'] != "") {
                //ada foto
                $this->load->library('upload', $config); //load library
                if ($this->upload->do_upload('foto')) {
                    $upload_data = $this->upload->data();
                    $file_name = $upload_data['file_name'];
                    //selain bisa dpt nama file jg bisa dpt informasi lain spt file_size dll
                    //referensi: http://localhost/appkaryawan/user_guide/libraries/file_uploading.html
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error);
                    exit;
                }
            } else {
                $file_name = $this->input->post('foto');
            }

            $data = [
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'telpon' => $this->input->post('telpon'),
                'jabatan' => $this->input->post('jabatan'),
                'jeniskelamin' => $this->input->post('jeniskelamin'),
                'iddivisi' => $this->input->post('iddivisi'),
                'tgllahir' => $this->input->post('tgllahir'),
                'foto' => $file_name
            ];

            //data = menampung value dari form ke data untuk input di tabel mysql
            $this->karyawan->update($id, $data);
            $data['id'] = $id;
            $this->response($data);
        }
    }

    // http://localhost/appkaryawan/api/karyawan/delete/1
    function delete_post()
    {
        $id = $this->uri->segment(4);
        if ($id) {
            $result = $this->karyawan->delete($id);
            if (!$result) {
                $this->response("Gagal menghapus data", REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
            $this->response("Berhasil menghapus data");
        }
        $this->response("Gagal menghapus data", 500);
    }
}
