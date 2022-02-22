<?php
include "conf/inc.koneksi.php";

# Mendapatkan No IP Lokal
$NOIP = $_SERVER['REMOTE_ADDR'];

# Perintah Ambil data tb_analisa
$sql = "SELECT tb_analisa.*, tb_penyakit.*
	FROM tb_analisa,tb_penyakit
	WHERE tb_penyakit.id_penyakit=tb_analisa.id_penyakit
	AND tb_analisa.noip='$NOIP'
	ORDER BY tb_analisa.id DESC LIMIT 1";
$qry = mysqli_query($koneksi, $sql)
	or die ("Query Hasil salam".mysqli_error());
$data= mysqli_fetch_array($qry);

$sql2 = "SELECT * FROM tmp_pasien WHERE noip='$NOIP'";
$qry2 = mysqli_query($koneksi, $sql2)
	or die ("Query Hasil salam".mysqli_error());
$data2= mysqli_fetch_array($qry2);

# Membuat hasil Pria atau Wanita
if ($data2['kelamin']=="P") {
	$kelamin = "Pria";
}
else {
	$kelamin = "Wanita";
}
?>

<body onload="window.print();" Layout="Portrait">

<table width="100%" border="0" cellpadding="3" cellspacing="1">
	<tr align="center">
		<td colspan="3">
		<font color="#d1ad2e"><b>HASIL DIAGNOSA PENYAKIT KULIT</b></font><hr color="#d1ad2e" ></td>
	</tr>
	<tr>
		<td colspan="3"><b>DATA PASIEN:</b></td>
	</tr>
	<tr>
		<td width="86">Nama </td><td> : </td>
		<td width="689"> <?php echo $data2['nama']; ?></td>
	</tr>
	<tr>
		<td>Kelamin </td><td> : </td>
		<td> <?php echo $kelamin; ?></td>
	</tr>
	<tr>
		<td>Alamat </td><td> : </td>
		<td> <?php echo $data2['alamat']; ?></td>
	</tr>
	<tr>
		<td>Pekerjaan </td><td> : </td>
		<td> <?php echo $data2['pekerjaan']; ?></td>
	</tr>
	</table>
	<table width="100%" border="0" cellpadding="2" cellspacing="1">
	<tr>
		<td colspan="2"><b>HASIL ANALISA TERAKHIR:</b></td>
	</tr>
	<tr>
		<td width="86">Penyakit </td>
		<td width="689"><?php echo $data['nama_penyakit']; ?></td>
	</tr>

	<tr>
		<td valign="top">Gejala </td>
		<td>
		<?php
		# Menampilkan Daftar Gejala
	$sql_gejala = "SELECT tb_gejala.* FROM tb_gejala,tb_rules
		WHERE tb_gejala.id_gejala=tb_rules.id_gejala
		AND tb_rules.id_penyakit='$data[id_penyakit]' order by tb_gejala.id_gejala";
	$qry_gejala = mysqli_query($koneksi, $sql_gejala);
    $i = 0;
	while ($hsl_gejala=mysqli_fetch_array($qry_gejala)) {
	$i++;
		echo "$i . $hsl_gejala[nama_gejala] <br>";
	}
?>
		</td>
	</tr>
	<tr>
		<td valign="top">Definisi </td>
		<td><?php echo $data['definisi']; ?></td>
	</tr>
    <tr>
		<td valign="top">Obat</td>
		<td><?php echo $data['obat']; ?></td>
	</tr>
	<tr>
		<td valign="top">Tindakan Preventif</td>
		<td><?php echo $data['tindakan']; ?></td>
	</tr>


</table>
</body>
