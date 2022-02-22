<?php
include("config.php");
include("fungsi/fungsi_rupiah.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Data Penyakit</title>
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

					<div class='panel panel-info'>
						<div class='panel-heading'>Semua Data Penyakit</div>
						<div class='panel-body'>
							<a class='btn btn-info' href='add_penyakit.php'><i class='fa fa-plus'></i> Tambah Data Penyakit</a>
							<p>
							<table class="table table-hover table-bordered">
							  <thead>
								<tr>
								  <th>Nama Penyakit</th>
								  <th>Tindakan</th>
								  <th>Definisi</th>
								  <th>Obat</th>
								</tr>
							  </thead>
							  <tbody>
								<?php
									$sqlquery = "SELECT * FROM tb_penyakit";
									if ($result = mysqli_query($koneksi, $sqlquery)) {
										while ($row = mysqli_fetch_assoc($result)) {
								?>
								<tr>
								<td><?php echo $row["id_penyakit"];?></td>
								<td><?php echo $row["nama_penyakit"];?></td>
								<td><?php echo $row["tindakan"];?></td>
								<td><?php echo $row["definisi"];?></td>
								<td><?php echo $row["obat"];?></td>
								<td>
								<div class="btn-group">
								 <a href="edit_penyakit.php?id_penyakit=<?php echo $row["id_penyakit"];?>" class="btn btn-xs btn-success" title='Edit'> <i class="fa fa-edit"></i> </a>
								  <a onclick="return confirm('Anda yakin ingin menghapus data tersebut?');" href="aksi_penyakit.php?act=delete&id_penyakit=<?php echo $row["id_penyakit"];?>" class="btn btn-xs btn-danger"> <i class="fa fa-remove" title='Hapus'></i> </a>
								</div>
								</td>
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
