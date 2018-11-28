<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->helper('url');

		$this->load->view('welcome_message');
	}

    //segmen 1 = welcome
    //http://localhost/appkaryawan/index.php/welcome/name/halo
    public function name()
    {
//        $this->load->helper("url");
//        echo $this->uri->segment("3");
        //me url decode value segment 3 yaitu "halo"
        echo urldecode($this->uri->segment("3")); //untuk menghilangkan index.php musti disetting .htaccess (merewrite konfigurasi dari apache)
    }

    public function cari()
    {
        $this->load->view('karyawan/cari');
    }

    public function cari_action()
    {
        $this->load->model('karyawan_model', 'karyawan');
        $nama = $this->input->post('nama');
        $data['records'] = $this->karyawan->find_by_name($nama);
        $this->load->view('karyawan/cari', $data);
    }


}
