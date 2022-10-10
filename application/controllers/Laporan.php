<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_penjualan extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') !== 'login' ) {
			redirect('/');
		}
		$this->load->model('laporan_m');
	}

    function index()
	{
		$this->load->view('laporan_penjualan');
	}

    function cetak() {
        $dtfrom = $this->input->post('dtfrom');
        $dtthru = $this->input->post('dtthru');
        $jenis  = $this->input->post('jenis');
        if($jenis == 'penjualan' ) {
            $data['data'] = $this->laporan_m->getData($dtfrom,$dtthru);
            $this->load->view('cetak_laporan_penjualan',$data);
        }else{
            $data['data'] = $this->laporan_m->getDataStok($dtfrom,$dtthru);
            $this->load->view('cetak_laporan_stok',$data);
        }
    }

}

/* End of file Laporan_penjualan.php */
/* Location: ./application/controllers/Laporan_penjualan.php */