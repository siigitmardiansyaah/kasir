<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_m extends CI_Model {


	function getTransaksiKasir($tgl,$id)
	{
		$result = $this->db->query("SELECT a.*,b.nama from transaksi a join pengguna b on a.kasir = b.id WHERE DATE_FORMAT(a.tanggal, '%Y-%m-%d') = '$tgl' AND a.kasir = $id")->result();
		return $result;
	}

    function getTransaksiAdmin($tgl) {
        $result = $this->db->query("SELECT a.*, b.nama from transaksi a join pengguna b on a.kasir = b.id WHERE DATE_FORMAT(a.tanggal, '%Y-%m-%d') = '$tgl'")->result();
		return $result;
    }

}

/* End of file Transaksi_model.php */
/* Location: ./application/models/Transaksi_model.php */