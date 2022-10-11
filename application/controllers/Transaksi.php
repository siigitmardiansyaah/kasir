<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Transaksi extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') !== 'login' ) {
			redirect('/');
		}
		$this->load->model('transaksi_model');
		$this->load->model('produk_model');
	}

	function index()
	{
		$this->load->view('transaksi');
	}

	function read()
	{
		header('Content-type: application/json');
		if ($this->transaksi_model->read()->num_rows() > 0) {
			foreach ($this->transaksi_model->read()->result() as $transaksi) {
				// $barcode = explode(',', $transaksi->barcode);
				// $tanggal = new DateTime($transaksi->tanggal);
				$data[] = array(
					'tanggal' => date('d-m-Y H:i:s'),
					'nama_produk' => '<table>'.$this->transaksi_model->getProduk($barcode, $transaksi->qty).'</table>',
					'total_bayar' => $transaksi->total_bayar,
					'jumlah_uang' => $transaksi->jumlah_uang,
					'diskon' => $transaksi->diskon,
					'pelanggan' => $transaksi->pelanggan,
					'action' => '<a class="btn btn-sm btn-success" href="'.site_url('transaksi/cetak/').$transaksi->id.'">Print</a> <button class="btn btn-sm btn-danger" onclick="remove('.$transaksi->id.')">Delete</button>'
				);
			}
		} else {
			$data = array();
		}
		$transaksi = array(
			'data' => $data
		);
		echo json_encode($transaksi);
	}

	function add()
	{
		$produk = json_decode($this->input->post('produk'));
		$tanggal = new DateTime($this->input->post('tanggal'));
		$barcode = array();
		$detail = array();

			foreach($produk as $produk) {
				$terjual = $this->transaksi_model->getTerjual($produk->id);
				$this->transaksi_model->removeStok($produk->id, $produk->stok);
				$this->transaksi_model->addTerjual($produk->id, $produk->terjual + $terjual->terjual);
				array_push($barcode, $produk->id);
					$item = $this->produk_model->getProduk($produk->id)->row();
					$data1 = array(
							'id_barang' => $produk->id,
							'qty' => $produk->terjual,
							'harga' => $item->harga,
							'total_harga' => $item->harga * $produk->terjual
					);
					array_push($detail,$data1);
			}
		
				// HEADER TRANSAKSI
				$data = array(
					'tanggal' => date('Y-m-d H:i:s'),
					'total_bayar' => $this->input->post('total_bayar'),
					'jumlah_uang' => $this->input->post('jumlah_uang'),
					'diskon' => $this->input->post('diskon'),
					'pelanggan' => $this->input->post('pelanggan'),
					'nota' => $this->input->post('nota'),
					'kasir' => $this->session->userdata('id'),
					'total_item' => count($barcode)
				);
				$header = $this->transaksi_model->create($data);
				$id_header = $this->db->insert_id();
				// HEADER_TRANSAKSI

				if ($header) {
					foreach ($detail as $da) {
						$data2 = array(
									'id_transaksi' =>  $id_header,
									'id_barang' => $da['id_barang'],
									'qty' => $da['qty'],
									'harga' => $da['harga'],
									'total_harga' => $da['total_harga']
					);
					$header_detail = $this->transaksi_model->create1($data2);
					}
				}
				echo json_encode($id_header);
				$data = $this->input->post('form');
	}

	function delete()
	{
		$id = $this->input->post('id');
		if ($this->transaksi_model->delete($id)) {
			echo json_encode('sukses');
		}
	}

	function cetak($id)
	{
		$data['header'] = $this->transaksi_model->getHeader($id);
		$data['produk'] = $this->transaksi_model->getDetail($id);
		$this->load->view('cetak', $data);
	}

	function penjualan_bulan()
	{
		header('Content-type: application/json');
		$day = date('Y-m-d h:i:s');
		$first = date('Y-m-d', strtotime('first day of this month', strtotime($day)));
		$last = date('Y-m-d', strtotime('last day of this month', strtotime($day)));
		$data = $this->transaksi_model->penjualanBulan($first,$last);
		echo json_encode($data);
	}

	function transaksi_hari()
	{
		header('Content-type: application/json');
		$now = date('Y-m-d');
		$total = $this->transaksi_model->transaksiHari($now);
		echo json_encode($total);
	}

	function transaksi_terakhir($value='')
	{
		header('Content-type: application/json');
		$now = date('d m Y');
		foreach ($this->transaksi_model->transaksiTerakhir($now) as $key) {
			$total = explode(',', $key);
		}
		echo json_encode($total);
	}

}

/* End of file Transaksi.php */
/* Location: ./application/controllers/Transaksi.php */