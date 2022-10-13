<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>History Transaksi</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/vendor/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendor/adminlte/plugins/sweetalert2/sweetalert2.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendor/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">
  <?php $this->load->view('partials/head'); ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php $this->load->view('includes/nav'); ?>

  <?php $this->load->view('includes/aside'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col">
            <h1 class="m-0 text-dark">History Transaksi Hari Ini</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <!--  -->
          <div class="card-body">
            <table class="table w-100 table-bordered table-hover" id="history">
              <thead>
                <tr class="text-center">
                <th>No</th>
                  <th>Nota</th>
                  <th>Tanggal</th>
                  <th>Total Belanja</th>
                  <th>Jumlah Pembayaran</th>
                  <th>Jumlah Produk</th>
                  <th>Kasir</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach($transaksi as $tra): ?>
                <tr class="text-center">
                <td><?php echo $no++ ?></td>
                <td><?php echo $tra->nota ?></td>
                <td><?php echo date('d-m-Y h:i:s',strtotime($tra->tanggal)) ?></td>
                <td><?php echo rupiah($tra->total_bayar_jual) ?></td>
                <td><?php echo rupiah($tra->jumlah_uang) ?></td>
                <td><?php echo $tra->total_item ?></td>
                <td><?php echo $tra->nama ?></td>
                <td>
                <button class="btn btn-sm btn-success btn-sm col-xs-2" onclick="print(<?php echo $tra->id ?>)">Print Struk</button>
                <button class="btn btn-sm btn-primary col-xs-2" data-toggle="modal" data-target="#myModal<?php echo $tra->id?>" data-id="<?php echo $tra->id?>">Lihat Detail</button>
                </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
              <?php
              foreach ($transaksi as $d) :?>
                <div class="modal fade" id="myModal<?php echo $d->id?>" role="dialog">
                  <div class="modal-dialog modal-lg"> 
                    <div class="modal-content">  
                      <div class="modal-header">  
                          <h4 class="modal-title">Detail Transaksi</h4>  
                      </div>
                      <div class="modal-body">
                        <table class="table w-100 table-bordered table-hover" id="detail_transaksi">
                        <thead>
                          <tr class="text-center">
                            <th>No</th>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            $id = $d->id;
                            $query = $this->db->query("SELECT b.kode_produk, b.nama_produk, a.qty, b.harga_jual, a.qty * b.harga_jual as total_harga from detail_transaksi a join
                            produk b on a.id_barang = b.id where a.id_transaksi = '$id'")->result();
                            $no = 1;
                            foreach ($query as $q) : ?>
                            <tr class="text-center">
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $q->kode_produk ?></td>
                            <td><?php echo $q->nama_produk ?></td>
                            <td><?php echo $q->qty ?></td>
                            <td><?php echo rupiah($q->harga_jual) ?></td>
                            <td><?php echo rupiah($q->total_harga) ?></td>
                            </tr>
                            <?php endforeach; ?>
                          </tbody>
                      </table>
                      </div>  
                    </div> 
                  </div>
                </div>
                <?php endforeach;?>


<!-- ./wrapper -->
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('partials/footer'); ?>
<script src="<?php echo base_url('assets/vendor/adminlte/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/adminlte/plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/adminlte/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
<script>
  var readUrl = '<?php echo site_url('history/read') ?>';
</script>
<script src="<?php echo base_url('assets/js/history.min.js') ?>"></script>
</body>
</html>
