<?php
include("config.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Data Analisa</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php include("include/css.php"); ?>
	</head>
	<body>
		<header>
			<?php include("include/header.php"); ?>
		</header>
		<div class='container' style='margin-top:70px'>
			<div class='row' style='min-height:520px'>
				<div class='col-md-12'>


					<div class='panel panel-primary'>
						<div class='panel-heading'>Semua Data Analisa</div>
						<div class='panel-body'>
							<table class="table table-hover table-bordered">
							  <thead>
								<tr>
								  <th>nama</th>
								  <th>jenis kelamin</th>
                                  <th>alamat</th>
								  <th>pekerjaan</th>
                                  <th>penyakit</th>
                                  <th>tanggal</th>
								</tr>
							  </thead>
							  <tbody>
								<?php
									$sqlquery = "SELECT * FROM tb_analisa";
									if ($result = mysqli_query($koneksi, $sqlquery)) {
										while ($row = mysqli_fetch_assoc($result)) {
								?>
								<tr>
								<td><?php echo $row["nama"];?></td>
								<td><?php echo $row["kelamin"];?></td>
                                <td><?php echo $row["alamat"];?></td>
								<td><?php echo $row["pekerjaan"];?></td>
								<td><?php echo $row["id_penyakit"];?></td>
                                <td><?php echo $row["tanggal"];?></td>
								</tr>
								<?php
										}
										mysqli_free_result($result);
									}
									mysqli_close($koneksi);
									?>
							  </tbody>
							</table>
						</div>
					</div>

				</div>
			</div>
		</div>
		<?php include("include/footer.php"); ?>
	</body>
	<?php include("include/js.php"); ?>
</html>
