<?php
/**
 * Created by PhpStorm.
 * User: rroos
 * Date: 28-Nov-2018
 * Time: 10:29
 */

defined('BASEPATH') OR exit('No direct script access allowed'); //agar tidak bisa diakses langsung ke lokasi dir/foler

/** @noinspection PhpIncludeInspection */
//1. menambahkan library rest controller (include)
require APPPATH . 'libraries/REST_Controller.php';

//2. extends REST_Controller
class Api extends REST_Controller
{
    //default rest
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        //me load model karyawan untuk model
//        $this->load->model('karyawan_model', 'karyawan');
    }

    //buat function get atau post
    //                                      folder/class/function
    //aksesnya: http://localhost/appkaryawan/api/api/index
    function index_get()
    {
        $info = [
            'version' => '0.1-dev',
            'name' => 'API SIM SDM'
        ];
        //mengambil data seluruh karyawan
//        $data = $this->karyawan->find_all();
        //merubah ke json, dua parameter: responsenya apa, status
        $this->response($info);
    }
}