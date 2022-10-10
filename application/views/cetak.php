<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cetak</title>
</head>
<body>
	<div style="width: 500px; margin: auto;">
		<br>
		<center>
			<?php echo $this->session->userdata('toko')->nama; ?><br>
			<?php echo $this->session->userdata('toko')->alamat; ?><br><br>
			<table width="100%">
				<tr>
					<td><?php echo $header->nota ?></td>
					<td align="right"><?php echo date('d-m-Y h:i:s', strtotime($header->tanggal)) ?></td>
					<td align="right" width="17%"><?php echo $header->nama ?></td>
				</tr>
			</table>
			<hr>
			<table width="100%">
				<?php foreach ($produk as $key): ?>
					<tr>
						<td><?php echo $key->kode_produk ?></td>
						<td></td>
						<td align="right"><?php echo $key->nama_produk ?></td>
						<td align="right"><?php echo rupiah($key->harga) ?></td>
						<td align="right"><?php echo rupiah($key->total_harga) ?></td>

					</tr>
				<?php endforeach ?>
			</table>
			<hr>
			<table width="100%">
				<tr>
					<td width="76%" align="right">
						Harga Jual
					</td>
					<td width="23%" align="right">
						<?php echo rupiah($header->total_bayar) ?>
					</td>
				</tr>
			</table>
			<hr>
			<table width="100%">
				<tr>
					<td width="76%" align="right">
						Total
					</td>
					<td width="23%" align="right">
						<?php echo rupiah($header->total_bayar) ?>
					</td>
				</tr>
				<?php if ($header->diskon != null):?>
					<tr>
					<td width="76%" align="right">
						Diskon
					</td>
					<td width="23%" align="right">
						<?php echo rupiah($header->diskon) ?>
					</td>
				</tr>
				<?php endif;?>
				<tr>
					<td width="76%" align="right">
						Bayar
					</td>
					<td width="23%" align="right">
						<?php echo rupiah($header->jumlah_uang) ?>
					</td>
				</tr>
				<?php if($header->diskon != null):?>
				<tr>
					<td width="76%" align="right">
						Kembalian
					</td>
					<td width="23%" align="right">
						<?php echo rupiah($header->jumlah_uang - ($header->total_bayar - $header->diskon)) ?>
					</td>
				</tr>
				<?php else: ?>
					<tr>
					<td width="76%" align="right">
						Kembalian
					</td>
					<td width="23%" align="right">
						<?php echo rupiah($header->jumlah_uang - $header->total_bayar) ?>
					</td>
				</tr>
				<?php endif;?>
			</table>
			<br>
			Terima Kasih <br>
			<?php echo $this->session->userdata('toko')->nama; ?>
		</center>
	</div>
	<script>
		window.print()
	</script>
</body>
</html>