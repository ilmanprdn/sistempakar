<?php
include("config.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Edit Data Gejala</title>
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


					<?php
						$id_gejala = $_GET['id_gejala'];
						$sqlquery = "SELECT * FROM tb_gejala WHERE id_gejala='$id_gejala'";
						$result = mysqli_query($koneksi, $sqlquery) or die (mysqli_connect_error());
						$row = mysqli_fetch_assoc($result);
						?>
					<div class='panel panel-success'>
						<div class='panel-heading'>Edit Data Gejala</div>
						<div class='panel-body'>
							<form method='post' action='aksi_gejala.php?act=update'>
								<div class='form-group'>
									<label>id_gejala</label>
									<input type='text' class='form-control' name='id_gejala' value="<?php echo $row["id_gejala"]; ?>" required/>
								</div>
								<div class='form-group'>
								<label>nama_gejala</label>
									<input type='text' class='form-control' name='nama_gejala' value="<?php echo $row["nama_gejala"]; ?>" required/>
								</div>
								<button type='input' name='update' class='btn btn-success'>Edit</button>
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
