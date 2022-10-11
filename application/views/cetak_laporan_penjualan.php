<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cetak Laporan Stok</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<br>
        <h2 style = "font-weight: bold;" class="text-center"><?php echo $this->session->userdata('toko')->nama; ?></h1>
        <h3 style = "font-weight: bold;" class="text-center">Laporan Penjualan</h3>
        <p class="text-center">Periode : <?php echo date('d/m/Y',strtotime($dtfrom)) ?> - <?php echo date('d/m/Y',strtotime($dtthru)) ?></p>
        <hr>
        <br/>

        <table class="table table-striped table-hover">
        <thead class="text-center">
            <tr >
                <th>No</th>
                <th>Tanggal</th>
                <th>Nota</th>
                <th>Sub Total</th>
                <th>Diskon</th>
                <th>Total Penjualan</th>
                <th>Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $gas = array();
            foreach($data as $da) :
            array_push($gas,$da->pembayaran);
            ?>
            <tr class="text-center">
                <td><?php echo $no++ ?></td>
                <td><?php echo $da->tanggal ?></td>
                <td><?php echo $da->nota ?></td>
               <?php if($da->diskon == 0) : ?>
                <td><?php echo rupiah($da->sub_total) ?></td>
                <?php else: ?>
                <td><?php 
                    $diskon = $da->sub_total + $da->diskon;
                    echo rupiah($diskon)  ?></td>
                <?php endif; ?>
                <td><?php echo rupiah($da->diskon) ?></td>
                <td><?php echo rupiah($da->sub_total) ?></td>
                <td><?php echo rupiah($da->pembayaran) ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="text-center">
            <td colspan = "6" style="font-weight: bold;"> Total </td>
            <td colspan = "4" style="font-weight: bold;">Rp. <?php echo rupiah(array_sum($gas)) ?></td>
            </tr>
        </tbody>

        </table>
	
	</div>
	<script type="text/javascript">
		window.print();
        window.close();
	</script>
</body>
</html>