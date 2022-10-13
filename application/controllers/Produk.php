<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Produk extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') !== 'login' ) {
			redirect('/');
		}
		$this->load->model('produk_model');
		$this->load->library('Zend');
	}

	function index()
	{
		$this->load->view('produk');
	}

	function read()
	{
		header('Content-type: application/json');
		if ($this->produk_model->read()->num_rows() > 0) {
			foreach ($this->produk_model->read()->result() as $produk) {
				$data[] = array(
					'kode_produk' => $produk->kode_produk,
					'nama' => $produk->nama_produk,
					'satuan' => $produk->satuan,
					'harga_jual' => rupiah($produk->harga_jual),
					'harga_beli' => rupiah($produk->harga_beli),
					'stok' => $produk->stok,
					'qr_code' => '<img src="'.base_url().'assets/barcode/'.$produk->qr_code.'" alt="">',
					'action' => '<button class="btn btn-sm btn-success" onclick="edit('.$produk->id.')">Edit</button> <button class="btn btn-sm btn-danger" onclick="remove('.$produk->id.')">Delete</button> <a href="'.base_url().'produk/cetak_barcode/'.$produk->qr_code.'" class="btn btn-sm btn-info" target="_blank">Print</a>'
				);
			}
		} else {
			$data = array();
		}
		$produk = array(
			'data' => $data
		);
		echo json_encode($produk);
	}

	function add()
	{
		$this->zend->load('Zend/Barcode');
		$imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$this->input->post('barcode'),'barHeight'=> 50,'factor' =>3), array())->draw();
		$imageName = $this->input->post('barcode').'.jpg';
		$imagePath = './assets/barcode/'; // penyimpanan file barcode
		imagejpeg($imageResource, $imagePath.$imageName); 
		$pathBarcode = $imagePath.$imageName; //Menyimpan path image bardcode kedatabase
		$data = array(
			'kode_produk' => $this->input->post('barcode'),
			'nama_produk' => $this->input->post('nama_produk'),
			'satuan' => $this->input->post('satuan'),
			'harga_jual' => $this->input->post('harga_jual'),
			'harga_beli' => $this->input->post('harga_beli'),
			'stok' => $this->input->post('stok'),
			'qr_code'=> $imageName
		);
		if ($this->produk_model->create($data)) {
			echo json_encode($data);
		}
	}

	function delete()
	{
		$id = $this->input->post('id');
		$cekItem = $this->produk_model->getItem($id);
		if ($this->produk_model->delete($id)) {
			echo json_encode('sukses');
			unlink("./assets/barcode/$cekItem->qr_code");
		}
	}

	function edit()
	{
		$id = $this->input->post('id');
		$cekItem = $this->produk_model->getItem($id);
		$kd_produk = $this->input->post('barcode');
		if($cekItem->kode_produk !== $kd_produk ) {
			$this->zend->load('Zend/Barcode');
			$imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$this->input->post('barcode'), 
			'barHeight'=> 50,'factor' =>3), array())->draw();
			$imageName = $kd_produk.'.jpg';
			$imagePath = './assets/barcode/'; // penyimpanan file barcode
			imagejpeg($imageResource, $imagePath.$imageName); 
			$pathBarcode = $imagePath.$imageName; //Menyimpan path image bardcode kedatabase
			$data = array(
				'kode_produk' => $this->input->post('barcode'),
				'nama_produk' => $this->input->post('nama_produk'),
				'satuan' => $this->input->post('satuan'),
				'kategori' => $this->input->post('kategori'),
				'harga_jual' => $this->input->post('harga_jual'),
				'harga_beli' => $this->input->post('harga_beli'),
				'stok' => $this->input->post('stok'),
				'qr_code'=> $imageName
			);
			if ($this->produk_model->update($id,$data)) {
				unlink("./assets/barcode/$cekItem->qr_code");
				echo json_encode('sukses');
			}
		}else{
			$data = array(
				'kode_produk' => $this->input->post('barcode'),
				'nama_produk' => $this->input->post('nama_produk'),
				'satuan' => $this->input->post('satuan'),
				'harga_jual' => $this->input->post('harga_jual'),
				'harga_beli' => $this->input->post('harga_beli'),
				'stok' => $this->input->post('stok')
			);
			if ($this->produk_model->update($id,$data)) {
				echo json_encode('sukses');
			}
		}
	}

	function get_produk()
	{
		header('Content-type: application/json');
		$id = $this->input->post('id');
		$kategori = $this->produk_model->getProduk($id);
		if ($kategori->row()) {
			echo json_encode($kategori->row());
		}
	}

	function get_barcode()
	{
		header('Content-type: application/json');
		$barcode = $this->input->post('barcode');
		$search = $this->produk_model->getBarcode($barcode);
		foreach ($search as $barcode) {
			$data[] = array(
				'id' => $barcode->id,
				'text' => $barcode->kode_produk
			);
		}
		echo json_encode($data);
	}

	function get_barcode1()
	{
		header('Content-type: application/json');
		$barcode = $this->input->post('barcode');
		$search = $this->produk_model->getBarcode1($barcode);
		foreach ($search as $barcode) {
			$data[] = array(
				'id' => $barcode->id,
				'text' => $barcode->kode_produk
			);
		}
		echo json_encode($data);
	}

	function get_nama()
	{
		header('Content-type: application/json');
		$id = $this->input->post('id');
		echo json_encode($this->produk_model->getNama($id));
	}
	

	function get_stok()
	{
		header('Content-type: application/json');
		$id = $this->input->post('id');
		echo json_encode($this->produk_model->getStok($id));
	}

	function produk_terlaris()
	{
		header('Content-type: application/json');
		$produk = $this->produk_model->produkTerlaris();
		foreach ($produk as $key) {
			$label[] = $key->nama_produk;
			$data[] = $key->terjual;
		}
		$result = array(
			'label' => $label,
			'data' => $data,
		);
		echo json_encode($result);
	}

	function data_stok()
	{
		header('Content-type: application/json');
		$produk = $this->produk_model->dataStok();
		echo json_encode($produk);
	}

	function cetak_barcode() {
		// header('Content-type: image/jpg');
		$nama = $this->uri->segment(3);
		$data['nama'] = $nama;
		$this->load->view('cetak_barcode',$data);
	}

}

/* End of file Produk.php */
/* Location: ./application/controllers/Produk.php */