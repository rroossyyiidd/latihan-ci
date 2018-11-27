<?php
/**
 * Created by PhpStorm.
 * User: rroos
 * Date: 26-Nov-2018
 * Time: 11:40
 */

defined('BASEPATH') OR exit('No direct script access allowed'); //agar tidak bisa diakses langsung ke lokasi dir

class Divisi extends CI_Controller
{
    //konstruktor ini memanggil konstruktor dari parent
    function __construct()
    {
        parent:: __construct();
        //membuat object divisi dari class divisi model, ini di letak di construk biar nggak dipanggil berulangkali
        $this->load->model('divisi_model', 'divisi'); //params ke 2 itu nama objek
    }

    //segment 2
    public function index()
    {
        //sehingga bisa manggil find_all disini, menjalankan query
        $data['records'] = $this->divisi->find_all();

        //menambahkan log menampilkan query sql yang digenerate
        log_message('DEBUG', $this->db->last_query());

        //mengirim records berisi data divisi ke views/divisi/index
        $this->load->view('divisi/index', $data);
    }

    public function tambah()
    {
        $this->load->view('divisi/tambah');
    }

    public function tambah_save()
    {
        //pakai library validasi disisi server
        //http://localhost/appkaryawan/user_guide/libraries/form_validation.html
        //                                field, pesan kesalahan, tipe validasi
        $this->form_validation->set_rules('kode', 'Kode divisi', 'required');
        $this->form_validation->set_rules('nama', 'Nama divisi', 'required');

        if ($this->form_validation->run() == FALSE) {
            //gagal, ada yg error maka tampilkan kembali form
            $this->load->view('divisi/tambah');
            //disini nanti dikeluarkan untuk REST API
        } else {
            $data = [
                'kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama')
            ];

            //data = menampung value dari form ke data untuk input di tabel mysql
            $this->divisi->insert($data);
            redirect(base_url('divisi'));
        }
    }

    public function detail()
    {
        //detail?id=x, menggunakan query string
//        $id = $this->input->get('id');
        //menggunakan segment
        $id = $this->uri->segment(3);
        $data['divisi'] = $this->divisi->find_by_id($id);
        $this->load->view('divisi/detail', $data);
    }

    public function edit()
    {
        $id = $this->uri->segment(3);
        $data['divisi'] = $this->divisi->find_by_id($id);
        $this->load->view('divisi/edit', $data);
    }

    public function edit_save()
    {
        $id = $this->input->post('id');
        //validator
        $this->form_validation->set_rules('kode', 'Kode divisi', 'required');
        $this->form_validation->set_rules('nama', 'Nama divisi', 'required');

        if ($this->form_validation->run() == FALSE) {
            //gagal, ada yg error maka tampilkan kembali form
            $data['divisi'] = $this->divisi->find_by_id($id);
            $this->load->view('divisi/edit', $data);
        } else {
            $data = [
                'kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama')
            ];

            //data = menampung value dari form ke data untuk input di tabel mysql
            $this->divisi->update($id, $data);
            redirect(base_url('divisi'));
        }
    }

    public function hapus()
    {
        $id = $this->uri->segment(3);
        if ($id) {
            $this->divisi->delete($id);
        }
        redirect(base_url('divisi'));
    }

}