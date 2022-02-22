<?php
include("config.php");

$act=$_GET['act'];

if ($act=='delete'){
	$id_penyakit=$_GET['id_penyakit'];
	$row = mysqli_query($koneksi, "DELETE FROM tb_penyakit WHERE id_penyakit = '$id_penyakit'");
	header('location:penyakit.php');
}

elseif ($act=='input'){
	$id_penyakit = $_POST["id_penyakit"];
	$nama_penyakit = $_POST["nama_penyakit"];
	$tindakan = $_POST["tindakan"];
	$definisi = $_POST["definisi"];
	$obat = $_POST["obat"];

	$sql = "INSERT INTO tb_penyakit VALUES ('$id_penyakit','$nama_penyakit','$tindakan','$definisi','$obat')";
	$aksi =mysqli_query($koneksi, $sql);

	if($aksi)
	{
	header('location:penyakit.php');
	}
	else {echo "gagal";}

}

elseif ($act=='update'){
	$id_penyakit = $_POST["id_penyakit"];
	$nama_penyakit = $_POST["nama_penyakit"];
	$tindakan = $_POST["tindakan"];
	$definisi = $_POST["definisi"];
	$obat = $_POST["obat"];

	$sql = "UPDATE tb_penyakit SET id_penyakit='$id_penyakit', nama_penyakit='$nama_penyakit', tindakan='$tindakan', definisi='$definisi', obat='$obat'  WHERE id_penyakit='$id_penyakit'";

	if(mysqli_query($koneksi, $sql)){
		mysqli_close($koneksi);
		header('location:penyakit.php');
	}
	else {
		echo '<script type="text/javascript">';
		echo 'alert("gagal");';
		echo '</script>';
	}

}
?>
