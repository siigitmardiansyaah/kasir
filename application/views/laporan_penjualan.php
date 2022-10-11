<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laporan Penjualan</title>
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
            <h1 class="m-0 text-dark">Laporan Penjualan</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
           <form action="<?php echo base_url()?>laporan/cetak" method="POST">
           <div class="form-group">
            <label for="exampleInputEmail1">Tanggal Dari</label>
            <input type="date" name="dtfrom" class="form-control" id="dtfrom" aria-describedby="emailHelp" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Tanggal Sampai</label>
            <input type="date" name="dtthru" class="form-control" id="exampleInputPassword1" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Jenis Laporan</label>
            <select name="jenis" id="jenis" class="form-control" required>
              <option value="">Pilih Laporan</option>
              <option value="penjualan">Laporan Penjualan</option>
              <option value="stok">Laporan Stok</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Print</button>
           </form>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('partials/footer'); ?>
<script src="<?php echo base_url('assets/vendor/adminlte/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/adminlte/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
</body>
</html>