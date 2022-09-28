<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaksi_model');
		$this->load->model('produk_model');
	}
	
	public function index()
	{
		if ($this->session->userdata('status') == 'login' ) {
			$tgl = date('Y-m-d');
			$data['transaksi_hari'] = $this->transaksi_model->transaksiHari($tgl);
			$data['stok'] = $this->produk_model->StokNow($tgl);
			$data['stok1'] = $this->produk_model->StokNow1($tgl);
			$this->load->view('dashboard',$data);
		} else {
			$this->load->view('login');
		}
	}
}
