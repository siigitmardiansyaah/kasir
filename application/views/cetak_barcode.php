<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cetak Barcode</title>
</head>
<body>
	<div style="width: 500px; margin: auto;">
		<br>
		<center>
                    <?php
echo '<img src="'.base_url().'assets/barcode/'.$nama.'"/>';
            ?>		
            </center>
	</div>
	<script>
		window.print()
	</script>
</body>
</html>