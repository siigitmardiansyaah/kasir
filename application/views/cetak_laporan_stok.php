<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cetak Laporan Stok</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>
<body>
	<div style="width: 500px; margin: auto;">
		<br>
        <h2 style = "font-weight: bold;" class="text-center"><?php echo $this->session->userdata('toko')->nama; ?></h1>
        <h3 style = "font-weight: bold;" class="text-center">Laporan Stok</h3>
        <p class="text-center">Periode : <?php echo date('d/m/Y',strtotime($dtfrom)) ?> - <?php echo date('d/m/Y',strtotime($dtthru)) ?></p>
        <hr>
        <br/>

        <table class="table table-striped table-hover">
        <thead class="text-center">
            <tr >
                <th>No</th>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Stok Awal</th>
                <th>Stok Masuk</th>
                <th>Stok Keluar</th>
                <th>Stok Akhir</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach($data as $da) : ?>
            <tr class="text-center">
                <td><?php echo $no++ ?></td>
                <td><?php echo $da->kode_produk ?></td>
                <td><?php echo $da->nama_produk ?></td>
                <td><?php echo $da->stok_awal ?></td>
                <td><?php echo $da->stok_masuk ?></td>
                <td><?php echo $da->stok_keluar ?></td>
                <td><?php echo $da->stok_akhir ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>

        </table>
	
	</div>
	<script type="text/javascript">
		window.print();
        window.close();
	</script>
</body>
</html>