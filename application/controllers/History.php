<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class History extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') !== 'login' ) {
			redirect('/');
		}
		$this->load->model('transaksi_model');
		$this->load->model('produk_model');
		$this->load->model('history_m');
	}

	function index()
	{
        $role = $this->session->userdata('role');
        $id = $this->session->userdata('id');
        $tgl = date('Y-m-d');
        if($role == 'admin') {
            $data['transaksi'] = $this->history_m->getTransaksiAdmin($tgl) ;
        }else{
            $data['transaksi'] = $this->history_m->getTransaksiKasir($tgl,$id) ;
        }
        $this->load->view('history',$data);   
	}
		

}

/* End of file Transaksi.php */
/* Location: ./application/controllers/Transaksi.php */