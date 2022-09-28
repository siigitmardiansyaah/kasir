<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {

	private $table = 'produk';

	public function create($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function read()
	{
		$this->db->select('produk.id, produk.kode_produk, produk.nama_produk, produk.harga, produk.stok, satuan_produk.satuan,produk.qr_code');
		$this->db->from($this->table);
		$this->db->join('satuan_produk', 'produk.satuan = satuan_produk.id');
		return $this->db->get();
	}

	public function update($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update($this->table, $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete($this->table);
	}

	public function getProduk($id)
	{
		$this->db->select('produk.id, produk.kode_produk, produk.nama_produk, produk.harga, produk.stok, satuan_produk.id as satuan_id, satuan_produk.satuan');
		$this->db->from($this->table);
		$this->db->join('satuan_produk', 'produk.satuan = satuan_produk.id');
		$this->db->where('produk.id', $id);
		return $this->db->get();
	}

	public function getBarcode($search='')
	{
		$this->db->select('produk.id, produk.kode_produk');
		$this->db->where('produk.stok > 0');
		return $this->db->get($this->table)->result();
	}

	public function getNama($id)
	{
		$this->db->select('nama_produk, stok');
		$this->db->where('id', $id);
		return $this->db->get($this->table)->row();
	}

	public function getStok($id)
	{
		$this->db->select('stok, nama_produk, harga, kode_produk');
		$this->db->where('id', $id);
		return $this->db->get($this->table)->row();
	}

	public function produkTerlaris()
	{
		return $this->db->query('SELECT produk.nama_produk, produk.terjual FROM `produk` 
		ORDER BY CONVERT(terjual,decimal)  DESC LIMIT 5')->result();
	}

	public function dataStok()
	{
		return $this->db->query('SELECT produk.nama_produk, produk.stok FROM `produk` ORDER BY CONVERT(stok, decimal) DESC LIMIT 50')->result();
	}

	function StokNow($tgl) {
		return $this->db->query("SELECT * FROM stok_masuk where DATE(tanggal) = '$tgl'")->num_rows();
	}

	function StokNow1($tgl) {
		return $this->db->query("SELECT * FROM stok_keluar where DATE(tanggal) = '$tgl'")->num_rows();
	}

	function getItem($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('produk');
		return $query->row();
	}

}

/* End of file Produk_model.php */
/* Location: ./application/models/Produk_model.php */