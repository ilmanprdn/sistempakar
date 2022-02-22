<?php
include "conf/inc.koneksi.php";

# Mendapatkan No IP Lokal
$NOIP = $_SERVER['REMOTE_ADDR'];

# Perintah Ambil data analisa_hasil
$sql = "SELECT tb_analisa.*, tb_penyakit.*
	FROM tb_analisa,tb_penyakit
	WHERE tb_penyakit.id_penyakit=tb_analisa.id_penyakit
	AND tb_analisa.noip='$NOIP'
	ORDER BY tb_analisa.id DESC LIMIT 1";
$qry = mysqli_query($koneksi, $sql)
	or die ("Query Hasil salam".mysqli_error($koneksi));
$data= mysqli_fetch_array($qry);

$sql2 = "SELECT * FROM tmp_pasien WHERE noip='$NOIP'";
$qry2 = mysqli_query($koneksi,  $sql2)
	or die ("Query Hasil salam".mysqli_error($koneksi));
$data2= mysqli_fetch_array($qry2);

# Membuat hasil Pria atau Wanita
if ($data2['kelamin']=="P") {
	$kelamin = "Pria";
}
else {
	$kelamin = "Wanita";
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Expert</title>

        <!-- CSS FILES -->        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        
        <link rel="stylesheet" href="owlcarousel/owl.carousel.min.css">

        <link rel="stylesheet" href="owlcarousel/owl.theme.default.min.css">

        <link href="css/templatemo-medic-care.css" rel="stylesheet">

		<link rel="stylesheet" href="css/style.css">
<!--

TemplateMo 566 Medic Care

https://templatemo.com/tm-566-medic-care

-->
   
<section class="hero" id="hero">
                <div class="container">
                    <div class="row">

                        <div class="col-12">
                            <div id="myCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="images/slider/portrait-successful-mid-adult-doctor-with-crossed-arms.jpg" class="img-fluid" alt="">
                                    </div>

                                    <div class="carousel-item">
                                        <img src="images/slider/young-asian-female-dentist-white-coat-posing-clinic-equipment.jpg" class="img-fluid" alt="">
                                    </div>

                                    <div class="carousel-item">
                                        <img src="images/slider/doctor-s-hand-holding-stethoscope-closeup.jpg" class="img-fluid" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="heroText d-flex flex-column justify-content-center">

                                <h1 class="mt-auto mb-2">
                                    Better
                                    <div class="animated-info">
                                        <span class="animated-item">health</span>
                                        <span class="animated-item">days</span>
                                        <span class="animated-item">lives</span>
                                    </div>
                                </h1>

                                <p class="mb-4">Website ini dibuat untuk membantu masyarakat dalam mengatasi penyakit kulit.</p>

                                <div class="heroLinks d-flex flex-wrap align-items-center">
                                    <a class="custom-link me-4" href="?page=consultation" data-hover="Konsultasi">Konsultasi</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
</section>

<div class="panel panel-default">
  <div class="panel-body">
<table width="100%" border="0" cellpadding="2" cellspacing="1" class="table">
	<tr align="center" class="success">
		<td colspan="3">
		<font color="#d1ad2e"><b>HASIL DIAGNOSA PENYAKIT</b></font></td>
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
    <table width="100%" border="0" cellpadding="2" cellspacing="1" class="table">
	<tr>
		<td colspan="2"><b>HASIL ANALISA TERAKHIR:</b></td>
	</tr>
	<tr>
		<td width="86">Penyakit </td>
		<td width="689"><?php echo $data['nama_penyakit']; ?></td>
	</tr>
	
	<tr>
		<td valign="top">Gejala</td>
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
	<tr>
		<td colspan=2><a href="laporan.php" class="btn btn-info" target="_blank"> Cetak Hasil Diagnosa</a></td>
	</tr>
	</table>

</div>
</div>
