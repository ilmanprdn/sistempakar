<?php
include("config.php");

$act=$_GET['act'];

if ($act=='delete'){
	$id_penyakit=$_GET['id_penyakit'];
	$row = mysqli_query($koneksi, "DELETE FROM tb_rules WHERE id_penyakit = '$id_penyakit'");
	header('location:rules.php');
}

elseif ($act=='input'){
	$id_penyakit = $_POST["id_penyakit"];
	$id_gejala = $_POST["id_gejala"];
	

	$sql = "INSERT INTO tb_rules VALUES ('$id_penyakit','$id_gejala')";
	$aksi =mysqli_query($koneksi, $sql);

	if($aksi)
	{
	header('location:rules.php');
	}
	else {echo "gagal";}

}


elseif ($act=='update'){
	$id_penyakit = $_POST["id_penyakit"];
	$id_gejala = $_POST["id_gejala"];

	$sql = "UPDATE tb_rules SET id_penyakit='$id_penyakit', id_gejala='$id_gejala' WHERE id_penyakit='$id_penyakit'";

	if(mysqli_query($koneksi, $sql)){
		mysqli_close($koneksi);
		header('location:rules.php');
	}
	else {
		echo '<script type="text/javascript">';
		echo 'alert("gagal");';
		echo '</script>';
	}

}
?>
