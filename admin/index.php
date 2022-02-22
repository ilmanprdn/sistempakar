<?php
session_start();
if(!isset($_SESSION["username"])){
header("Location: login.php");
exit(); }
?>



<!DOCTYPE html>

<html>

<head>

  <title>Service Motor</title>

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

        <div class="jumbotron">

          <center>
            <h1>Selamat Datang Admin</h1>

            <p>Pengelolaan Sistem Pakar</p>

            <p>

              <a class='btn btn-primary' href='gejala.php'>Data Gejala</a>

              <a class='btn btn-info' href='penyakit.php'>Data Penyakit</a>

              <a class='btn btn-danger' href='rules.php'>Data Rules</a>

              <a class='btn btn-success' href='analisa.php'>Data Analisa</a>

            </center>

          </div>

        </div>

      </div>

    </div>

    <?php include("include/footer.php"); ?>

  </body>

  <?php include("include/js.php"); ?>
  
</html>
