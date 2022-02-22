<?php
include("config.php");

$act=$_GET['act'];

if ($act=='delete'){
	$id_gejala=$_GET['id_gejala'];
	$row = mysqli_query($koneksi, "DELETE FROM tb_gejala WHERE id_gejala = '$id_gejala'");
	header('location:gejala.php');
}

elseif ($act=='input'){
	$id_gejala = $_POST["id_gejala"];
	$nama_gejala = $_POST["nama_gejala"];
	

	$sql = "INSERT INTO tb_gejala VALUES ('$id_gejala','$nama_gejala')";
	$aksi =mysqli_query($koneksi, $sql);

	if($aksi)
	{
	header('location:gejala.php');
	}
	else {echo "gagal";}

}


elseif ($act=='update'){
	$id_gejala = $_POST["id_gejala"];
	$nama_gejala = $_POST["nama_gejala"];

	$sql = "UPDATE tb_gejala SET id_gejala='$id_gejala', nama_gejala='$nama_gejala' WHERE id_gejala='$id_gejala'";

	if(mysqli_query($koneksi, $sql)){
		mysqli_close($koneksi);
		header('location:gejala.php');
	}
	else {
		echo '<script type="text/javascript">';
		echo 'alert("gagal");';
		echo '</script>';
	}

}
?>
