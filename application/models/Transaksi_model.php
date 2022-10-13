<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

	private $table = 'transaksi';

	function removeStok($id, $stok)
	{
		$this->db->where('id', $id);
		$this->db->set('stok', $stok);
		return $this->db->update('produk');
	}

	function addTerjual($id, $jumlah)
	{
		$this->db->where('id', $id);
		$this->db->set('terjual', $jumlah);
		return $this->db->update('produk');;
	}

	function create($data)
	{
		return $this->db->insert($this->table, $data);
	}

	function create1($data)
	{
		return $this->db->insert("detail_transaksi", $data);
	}

	function read()
	{
		$this->db->select('transaksi.id, transaksi.tanggal, transaksi.barcode, transaksi.qty, transaksi.total_bayar, transaksi.jumlah_uang, transaksi.diskon, pelanggan.nama as pelanggan');
		$this->db->from($this->table);
		$this->db->join('pelanggan', 'transaksi.pelanggan = pelanggan.id', 'left outer');
		return $this->db->get();
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete($this->table);
	}

	function getProduk($barcode, $qty)
	{
		$total = explode(',', $qty);
		foreach ($barcode as $key => $value) {
			$this->db->select('nama_produk');
			$this->db->where('id', $value);
			$data[] = '<tr><td>'.$this->db->get('produk')->row()->nama_produk.' ('.$total[$key].')</td></tr>';
		}
		return join($data);
	}


	function penjualanBulan($first,$last)
	{
		$qty = $this->db->query("SELECT DATE_FORMAT(tanggal,'%d') as hari,count(id) as qty FROM transaksi WHERE DATE_FORMAT(tanggal, '%Y-%m-%d') BETWEEN DATE_FORMAT('$first', '%Y-%m-%d') AND DATE_FORMAT('$last', '%Y-%m-%d') GROUP BY DATE_FORMAT(tanggal,'%d')")->result();
		return $qty;
	}

	function transaksiHari($hari)
	{
		return $this->db->query("SELECT * FROM transaksi WHERE DATE_FORMAT(tanggal,'%Y-%m-%d') = '$hari'")->num_rows();
	}

	function transaksi($hari)
	{
		return $this->db->query("SELECT (SUM(total_bayar_jual) - SUM(total_bayar_beli)) as total FROM transaksi WHERE DATE_FORMAT(tanggal,'%Y-%m-%d') = '$hari'")->row();
	}

	function transaksiTerakhir($hari)
	{
		return $this->db->query("SELECT transaksi.qty FROM transaksi WHERE DATE_FORMAT(tanggal, '%d %m %Y') = '$hari' LIMIT 1")->row();
	}

	function getAll($id)
	{
		$this->db->select('transaksi.nota, transaksi.tanggal, produk.nama_produk, detail_transaksi.qty, transaksi.total_bayar, transaksi.jumlah_uang, pengguna.nama as kasir');
		$this->db->from('transaksi');
		$this->db->join('pengguna', 'transaksi.kasir = pengguna.id');
		$this->db->join('detail_transaksi','transaksi.id = detail_transaksi.id_transaksi');
		$this->db->join('produk','detail_transaksi.id_barang = produk.id');
		$this->db->where('transaksi.id', $id);
		return $this->db->get()->result();
	}

	function getName($barcode)
	{
		foreach ($barcode as $b) {
			$this->db->select('nama_produk, harga');
			$this->db->where('id', $b);
			$data[] = $this->db->get('produk')->row();
		}
		return $data;
	}

	function getHeader($id) {
		$this->db->join('pengguna b','a.kasir = b.id');
		$this->db->where('a.id',$id);
		$query = $this->db->get('transaksi a')->row();
		return $query;
	}

	function getDetail($id) {
		$this->db->join('produk b','a.id_barang = b.id');
		$this->db->where('a.id_transaksi',$id);
		$query = $this->db->get('detail_transaksi a')->result();
		return $query;
	}

	function getTerjual($id) {
		$this->db->where('id',$id);
		return $this->db->get('produk')->row();
	}

}

/* End of file Transaksi_model.php */
/* Location: ./application/models/Transaksi_model.php */