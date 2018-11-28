<?php
/**
 * Created by PhpStorm.
 * User: rroos
 * Date: 27-Nov-2018
 * Time: 08:43
 */

defined('BASEPATH') OR exit('No direct script access allowed'); //agar tidak bisa diakses langsung ke lokasi dir/foler

class Karyawan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        //untuk mengecek apakah user sudah login apa belum
        if (!$this->ion_auth->logged_in()) {
            redirect(base_url('login'));
        }

        //untuk mengecek apakah yg login admin?
        if (!$this->ion_auth->is_admin()) {
            redirect(base_url('login'));
        }

        //me load model, nama model dan nama objek model
        $this->load->model('karyawan_model', 'karyawan');
        //juga perlu load divisi, karena ada relasi
        $this->load->model('divisi_model', 'divisi'); //dibutuhkan ketika add karyawan memilih divisi (dropdown divisi)
        $this->load->model('nota_model', 'nota');
        $this->load->model('notadetail_model', 'detail');
    }

    public function index()
    {
        //sehingga bisa manggil find_all disini, menjalankan query
        $data['records'] = $this->karyawan->find_all();

        //menambahkan log menampilkan query sql yang digenerate
//        log_message('DEBUG', $this->db->last_query());

        //mengirim records berisi data divisi ke views/karyawan/index
        $this->load->view('karyawan/index', $data);
    }

    public function tambah()
    {
        //array untuk jabatan,
        //di array [yang akan disimpan di db (key) => yg akan tampil di view (value)]
        $jabatan = [
            "Manager" => "Manager",
            "Supervisor" => "Supervisor",
            "Karyawan" => "Karyawan"
        ];

        //mengirim data jabatan ke view
        $data['jabatan'] = $jabatan;
        //get divisi
        $data['divisi'] = $this->divisi->find_all();
        $this->load->view('karyawan/tambah', $data);
    }

    public function tambah_save()
    {
        //pakai library validasi disisi server
        //http://localhost/appkaryawan/user_guide/libraries/form_validation.html
        //                                field, pesan kesalahan, tipe validasi, (kalau lebih dari 1 validasi pisahkan dengan tanda | )
        $this->form_validation->set_rules('nama', 'Nama Karyawan', 'required');
        $this->form_validation->set_rules('email', 'Email Karyawan', 'required|valid_email');
        $this->form_validation->set_rules('telpon', 'Telpon Karyawan', 'required|alpha_numeric|numeric');
        $this->form_validation->set_rules('jabatan', 'Jabatan Karyawan', 'required');
        $this->form_validation->set_rules('jeniskelamin', 'Jenis Kelamin Karyawan', 'required');
        $this->form_validation->set_rules('iddivisi', 'Divisi Karyawan', 'required');
        $this->form_validation->set_rules('tgllahir', 'Tanggal Lahir Karyawan', 'required');

        if ($this->form_validation->run() == FALSE) {
            //gagal, ada yg error maka tampilkan kembali form
            $jabatan = [
                "Manager" => "Manager",
                "Supervisor" => "Supervisor",
                "Karyawan" => "Karyawan"
            ];

            //mengirim data jabatan ke view
            $data['jabatan'] = $jabatan;
            //get divisi
            $data['divisi'] = $this->divisi->find_all();
            $this->load->view('karyawan/tambah', $data);
            //disini nanti dikeluarkan untuk REST API
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
            $this->karyawan->insert($data);
            redirect(base_url('karyawan')); //redirect ke kontroller karyawan
        }
    }

    public function detail()
    {
        //detail?id=x, menggunakan query string
//        $id = $this->input->get('id');
        //menggunakan segment
        $id = $this->uri->segment(3);
        $data['karyawan'] = $this->karyawan->find_by_id($id);
        $this->load->view('karyawan/detail', $data);
    }

    public function edit()
    {
        $id = $this->uri->segment(3);
        $data['karyawan'] = $this->karyawan->find_by_id($id);

        $jabatan = [
            "Manager" => "Manager",
            "Supervisor" => "Supervisor",
            "Karyawan" => "Karyawan"
        ];

        $data['jabatan'] = $jabatan;
        $data['divisi'] = $this->divisi->find_all();
        $this->load->view('karyawan/edit', $data);
    }

    public function edit_save()
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
            $jabatan = [
                "Manager" => "Manager",
                "Supervisor" => "Supervisor",
                "Karyawan" => "Karyawan"
            ];

            $data['jabatan'] = $jabatan;
            //get divisi
            $data['divisi'] = $this->divisi->find_all();
            $data['karyawan'] = $this->karyawan->find_by_id($id); //id dari input type hidden
            $this->load->view('karyawan/edit', $data);
            //disini nanti dikeluarkan untuk REST API
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
            } else {
                $file_name = $this->input->post('foto_lama');
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
            redirect(base_url('karyawan')); //redirect ke kontroller karyawan
        }
    }

    public function hapus()
    {
        $id = $this->uri->segment(3);
        if ($id) {
            $this->karyawan->delete($id);
        }
        redirect(base_url('karyawan'));
    }

    //menampilkan view surat
    public function surat()
    {
        $data['records'] = $this->karyawan->find_all();
        $this->load->view('karyawan/surat', $data);
    }

    //
    public function surat_save()
    {
        $nota = array(
            'nomor' => $this->input->post('nomor'),
            'tanggal' => date('Y-m-d')
        );
        $this->db->trans_begin();
        $notaid = $this->nota->insert($nota);
        $total = 0;
        for ($i = 0; $i < count($_POST['karyawan']); $i++) {
            $karyawanid = $_POST['karyawan'][$i];
            $biaya = $_POST['biaya'][$i];
            $qty = $_POST['qty'][$i];
            $subtotal = $_POST['subtotal'][$i];
            $detail = array(
                'idnota' => $notaid,
                'karyawanid' => $karyawanid,
                'biaya' => $biaya,
                'qty' => $qty,
                'subtotal' => $subtotal
            );
            $total += $subtotal;
            $this->detail->insert($detail);
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
        $data['nomor'] = $this->input->post('nomor');
        $data['tanggal'] = date('Y-m-d');
        $data['post'] = $_POST;
        $data['total'] = $total;
        $this->load->view("karyawan/nota", $data);
    }

}