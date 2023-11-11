<?php
//koneksi
session_start();
include ("koneksi.php");
include './includes/header.php';
//perintah untuk menampilkan hasil edit
$id_krit  = $_GET['id_kriteria'];
$kriteria = $koneksi->query("SELECT * FROM tab_kriteria WHERE id_kriteria = '$id_krit' ");

while ($row = $kriteria->fetch_row())
  {
    $nama_kriteria  = $row[1];
    $bobot = $row[2];
    $status = $row[3];
  }

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

  </head>
  <body>

    <!--menu-->
    <nav class="">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">SPK Pemilihan Motor Matic Metode Topsis</a>
        </div>

        <div class="collapse navbar-collapse">

        </div>
      </div>
    </nav>

    <div class="container">

      <div class="row">
        <!--form kriteria-->
        <div class="col-lg-6 col-lg-offset-3">
          <div class="panel panel-default">
            <div class="panel-heading text-center">
              Edit Kriteria
            </div>

            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
                  <form class="form" action="editk.php" method="post">
                    <div class="form-group">
                      <input class="form-control" type="text" name="id_kriteria" value= <?php echo $_GET['id_kriteria']; ?> readonly>
                    </div>
                    <div class="form-group">
                      <input class="form-control" type="text" name="nama_kriteria" value= <?php echo $nama_kriteria; ?> >
                    </div>
                    <div class="form-group">
                      <input class="form-control" type="text" name="bobot" value= <?php echo $bobot; ?> >
                    </div>
                    <div class="form-group">
                      <input class="form-control" type="text" name="status" value= <?php echo $status; ?> >
                    </div>
                    <div class="form-group">
                      <a href="kriteria.php"><button type="button" class="btn btn-danger">Batal</button></a>
                      <button type="submit" class="btn btn-success">Ubah</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--form kriteria-->

      </div>
    </div>

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
