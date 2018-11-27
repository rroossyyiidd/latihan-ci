<?php
/**
 * Created by PhpStorm.
 * User: rroos
 * Date: 26-Nov-2018
 * Time: 10:22
 */

defined('BASEPATH') OR exit('No direct script access allowed'); //agar tidak bisa diakses langsung ke lokasi dir

class Login extends CI_Controller
{

    function __construct()
    {
        parent:: __construct();
    }

    function index()
    {
        $data['nama'] = "Muhammad Rosyid"; //ini nanti bisa data dari DB
        $data['no'] = "12346"; //ini nanti bisa data dari DB
        $this->load->view('login', $data); //nama file view, di view tidak ada hubungan DB, params ke 2 itu data yg dilempar ke view, yg dilempar dalam bentuk array
//        $this->load->view('login', $data); //kalau di dalam folder maka pakai / ex: /namafolder/login
    }

}