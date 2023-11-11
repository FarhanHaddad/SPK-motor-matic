<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

include './includes/header.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SPK PEMILIHAN MOTOR MATIC METODE TOPSIS</title>
    <!--bootstrap-->
    <link href="tampilan/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles/slider.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/styles.css" rel="stylesheet" type="text/css" media="all">

  </head>
  <body><br>
<!--navbar navbar-default navbar-custom-->
    <!--menu-->
      <div class="container">
          <a class="navbar-brand">SPK Pemilihan Motor Matic Metode Topsis</a>
        </div>
  
    <div id="slider" >
      <figure>
        <img src="gambar/motorfino.jpg">
        <img src="gambar/motorscoopy.png">
        <img src="gambar/motornex.jpg">
        <img src="gambar/motorbeatstreet.jpg">
        <img src="gambar/motorxride.jpg">
      </figure>
    </div> <br><br>
    <!--footer-->
    <footer class="text-center">
      <div class="footer-below">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <em>Sistem Pendukung Keputusan Pemilihan Motor Matic Metode Topsis</em>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!--plugin-->
    <script src="tampilan/js/bootstrap.min.js"></script>

  </body>
</html>
<?php
include './includes/footer.php';
?>