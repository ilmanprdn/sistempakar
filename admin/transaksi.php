<?php
include("config.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Tambah Data Transaksi</title>
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
					<div class='panel panel-danger' id='tambah'>
						<div class='panel-heading'>Tambah Data Transaksi</div>
						<div class='panel-body'>


							<form method='post' action='aksi_transaksi.php?act=input'>
								<div class='form-group'>

									<label>Pilih Pelanggan</label>
									<select name='no_polisi' class='form-control'>
									<?php
									$sqlquery = "SELECT * FROM pelanggan";
									if ($result = mysqli_query($koneksi, $sqlquery)) {
										while ($row = mysqli_fetch_assoc($result)) {
											$no_polisi = $row["no_polisi"];
											$pelanggan = $row["no_polisi"];
											echo "<option value='$no_polisi'>$pelanggan</option>";
										}
										mysqli_free_result($result);
									}
									?>
									</select>

								</div>
								<div class='form-group'>
									<label>Pilih Jenis Sparepart</label>
									<select name='no_sparepart' class='form-control'>
									<?php
									$sqlquery = "SELECT * FROM sparepart";
									if ($result = mysqli_query($koneksi, $sqlquery)) {
										while ($row = mysqli_fetch_assoc($result)) {
											$no_sparepart = $row["no_sparepart"];
											$sparepart = $row["nama_sparepart"];
											echo "<option value='$no_sparepart'>$sparepart</option>";
										}
										mysqli_free_result($result);
									}
									?>
									</select>
									</select>
								</div>
								<div class='form-group'>
									<label>Jumlah)</label>
									<input type='number' name='qty' class='form-control' required/>
								</div>
								<button type='input' name='input' class='btn btn-danger'>Simpan</button>
							</form>

						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include("include/footer.php"); ?>
	</body>
	<?php include("include/js.php"); ?>
</html>
