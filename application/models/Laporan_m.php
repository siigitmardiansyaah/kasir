<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_m extends CI_Model {


	function getData($tgl1,$tgl2)
	{
        $query = $this->db->query("SELECT DATE_FORMAT(tanggal,'%d-%m-%Y') as tanggal,nota, IFNULL(total_bayar_jual,0) as sub_total_jual,IFNULL(total_bayar_beli,0) as sub_total_beli, IFNULL(diskon,0) as diskon, IFNULL(total_bayar_jual,0) as total_jual,IFNULL(total_bayar_beli,0) as total_jual_beli, IFNULL(jumlah_uang,0) as pembayaran from transaksi where DATE_FORMAT(tanggal,'%Y-%m-%d') between '$tgl1' AND '$tgl2' order by tanggal asc");
        return $query->result();
	}

    function getDataStock($tgl1,$tgl2) {
        $query = $this->db->query("SELECT a.kode_produk, a.nama_produk, 
        (select IFNULL(sum(jumlah),0) from stok_masuk where id_produk = a.id AND DATE_FORMAT(tanggal,'%Y-%m-%d') < '$tgl1') - (select IFNULL(sum(jumlah),0) from stok_keluar where id_produk = a.id AND DATE_FORMAT(tanggal,'%Y-%m-%d') < '$tgl1') as stok_awal,
        IFNULL(SUM(b.jumlah),0) AS stok_masuk, 
        IFNULL(SUM(c.jumlah),0) as stok_keluar, 
        ((select IFNULL(sum(jumlah),0) from stok_masuk where id_produk = a.id AND DATE_FORMAT(tanggal,'%Y-%m-%d') < '$tgl1') - (select IFNULL(sum(jumlah),0) from stok_keluar where id_produk = a.id AND DATE_FORMAT(tanggal,'%Y-%m-%d') < '$tgl1')) + IFNULL(SUM(b.jumlah),0) - IFNULL(SUM(c.jumlah),0) as stok_akhir 
        from produk a 
        left join stok_masuk b on a.id = b.id_produk 
        left join stok_keluar c on a.id = c.id_produk 
        where a.id IN (SELECT id_produk from stok_masuk where DATE_FORMAT(tanggal,'%Y-%m-%d') between '$tgl1' AND '$tgl2') AND a.id IN (SELECT id_produk from stok_keluar where DATE_FORMAT(tanggal,'%Y-%m-%d') between '$tgl1' AND '$tgl2')
        GROUP by a.kode_produk
        ORDER BY a.kode_produk");
        return $query->result();
    }
    

	

}

/* End of file Satuan_produk_model.php */
/* Location: ./application/models/Satuan_produk_model.php */