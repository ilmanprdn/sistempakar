<?php
include "conf/inc.koneksi.php";

$NOIP = $_SERVER['REMOTE_ADDR'];

# Periksa apabila sudah ditemukan
// Periksa data solusi di dalam tmp
$sql_cekh = "SELECT * FROM tmp_penyakit WHERE noip='$NOIP' GROUP BY id_penyakit";
$qry_cekh = mysqli_query($koneksi, $sql_cekh);
$hsl_cekh = mysqli_num_rows($qry_cekh);
if ($hsl_cekh == 1) {
	// Apabila data tmp_solusi isinya 1
	$hsl_data = mysqli_fetch_array($qry_cekh);
	
	// Memindahkan data tmp ke tabel hasil_analisa
	$sql_pasien = "SELECT * FROM tmp_pasien WHERE noip='$NOIP'";
	$qry_pasien = mysqli_query($koneksi, $sql_pasien);
	$hsl_pasien = mysqli_fetch_array($qry_pasien);
		// Perintah untuk memindah data
		$sql_in = "INSERT INTO tb_analisa SET
			nama='$hsl_pasien[nama]',
			kelamin='$hsl_pasien[kelamin]',
			alamat='$hsl_pasien[alamat]',
			pekerjaan='$hsl_pasien[pekerjaan]',
			id_penyakit='$hsl_data[id_penyakit]',
			noip='$hsl_pasien[noip]',
			tanggal='$hsl_pasien[tanggal]'";
			mysqli_query($koneksi, $sql_in);
			
		// Redireksi setelah pemindahan data
			echo "<meta http-equiv='refresh' content='0;
			url=index.php?page=result'>";
		exit;
}

# Apabila BELUM MENEMUKAN solusi
$sqlcek = "SELECT * FROM tmp_analisa WHERE noip='$NOIP'";
$qrycek = mysqli_query($koneksi, $sqlcek);
$datacek = mysqli_num_rows($qrycek);
if ($datacek >= 1) {
	// Seandainya tmp_analisa tidak kosong
	// SQL ambil data gejala yang tidak ada di dalam
	// tabel tmp_gejala (NOT IN....)
	$sqlg = "SELECT tb_gejala.* FROM tb_gejala,tmp_analisa
		WHERE tb_gejala.id_gejala=tmp_analisa.id_gejala
		AND tmp_analisa.noip='$NOIP'
		AND NOT tmp_analisa.id_gejala
		IN(SELECT id_gejala
			FROM tmp_gejala WHERE noip='$NOIP')
			ORDER BY tb_gejala.id_gejala LIMIT 1";
	$qryg = mysqli_query($koneksi, $sqlg);
	$datag = mysqli_fetch_array($qryg);
		
	$idgejala = $datag['id_gejala'];
	$gejala = $datag['nama_gejala'];
}
else {
	// Seandainya tmp kosong
	// Ambil data gejala dari tabel gejala
	$sqlg = "SELECT * FROM tb_gejala ORDER BY id_gejala LIMIT 1";
	$qryg = mysqli_query($koneksi, $sqlg);
	$datag = mysqli_fetch_array($qryg);
	
	$idgejala = $datag['id_gejala'];
	$gejala = $datag['nama_gejala'];
	$geje = "gaul";
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

<div class="container panel panel-default">
  <div class="panel-body">
<form action="?page=processcon" method="post" name="form1" target="_self">
	<table class="table" width="100%" border="0" cellpadding="2" cellspacing="1" >
	<tr class="success">
				<td colspan="2" >JAWABLAH PERTANYAAN BERIKUT :</td>
	</tr>
	<tr>
		<td colspan="2" align="center"><h3><span class="label label-default">Apakah <?php echo "$gejala";?> ? </span></h3>
		
		<input name="TxtIdGejala" type="hidden" value="<?php echo $idgejala; ?>"></td>
	</tr>
	<tr>
		<td>
			<span class="input-group-addon"><input type="radio" name="RbPilih" value="YA" checked>
			Benar (YA) </span>
			<span class="input-group-addon"><input type="radio" name="RbPilih" value="TIDAK">
			Salah (TIDAK) </span>

			
		</td>
	</tr>
	<tr>
		<td align="center">
			<input type="submit" class="btn btn-success" name="Submit" value="LANJUT >>"></td>
	</tr>
	</table>
</form>

  </div>
</div>
