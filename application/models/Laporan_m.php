<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_m extends CI_Model {


	function getData($tgl1,$tgl2)
	{
        $query = $this->db->query("SELECT * FROM transaksi where DATE_FORMAT(tanggal, '%Y-%m-%d') between DATE_FORMAT($tgl1, '%Y-%m-%d') AND DATE_FORMAT($tgl2, '%Y-%m-%d')");
        return $query->result();
	}

	

}

/* End of file Satuan_produk_model.php */
/* Location: ./application/models/Satuan_produk_model.php */