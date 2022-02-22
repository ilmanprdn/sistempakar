<?php
include "conf/inc.koneksi.php";
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

<div class="panel panel-default" id="consultation">
  <div class="container">
    <form method="post" action="?page=processreg" >
		<table class="table">
			<tr class="success">
				<td colspan="2" >Daftar Diagnosa</td>
			</tr>
			<tr>
				<td >Nama</td>
				<td><input class="form-control"  type="text" name="nama" value="" placeholder="Isi Nama Lengkap" /></td>
			</tr>
			<tr>
				<td >Jenis Kelamin</td>
				<td><input  type="radio" name="jk" value="P"  /> Laki-laki 
					<input  type="radio" name="jk" value="W"  /> Wanita 
				</td>
			</tr>
			<tr>
				<td >Alamat</td>
				<td><input class="form-control"  type="text" name="alamat" value=""  placeholder="Isi Alamat Lengkap"/></td>
			</tr>
			<tr>
				<td >Pekerjaan</td>
				<td><input class="form-control"  type="text" name="pekerjaan" value="" placeholder="Isi Pekerjaan Anda" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td><td>	<input type="submit" class="btn btn-success" name="daftar" value="DAFTAR" />
									<input type="reset" class="btn btn-danger" name="reset" value="BATAL" />
				</td>
			</tr>
		</table>
	</form>

  </div>
</div>
