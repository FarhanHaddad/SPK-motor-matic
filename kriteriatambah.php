<?php
//koneksi
session_start();
include ("koneksi.php");
include './includes/header.php';
//pemberian kode id secara otomatis
$carikode = $koneksi->query("SELECT id_kriteria FROM tab_kriteria") or die(mysqli_error());
$datakode = $carikode->fetch_array();
$jumlah_data = mysqli_num_rows($carikode);

if ($datakode) {
  $nilaikode = substr($jumlah_data[0], 1);
  $kode = (int) $nilaikode;
  $kode = $jumlah_data + 1;
  $kode_otomatis = str_pad($kode, 0, STR_PAD_LEFT);
} else {
  $kode_otomatis = "1";
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

    <!--icon-->
    <link href="tampilan/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
      </div>
    </nav>

    <div class="container">

      <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    Kriteria
                </div>

                <ul class="nav nav-tabs">
                    <li>
                      <a href="kriteria.php" data-toggle="tab">Tabel Kriteria</a>
                    </li>
                    <li class="active">
                      <a href="kriteriatambah.php" data-toggle="tab">Tambah Kriteria</a>
                    </li>
                </ul>

                <div class="panel-body">
                    <!-- Tab panes -->
                    <div class="tab-content">
                      <!--form kriteria-->
                      <form class="form" action="tambahkriteria.php" method="post">
                        <div class="form-group">
                          <input class="form-control" type="text" name="id_krit" value="<?php echo $kode_otomatis; ?>" readonly>
                        </div>
                        <div class="form-group">
                          <input class="form-control" type="text" name="nm_krit" placeholder="Nama Kriteria">
                        </div>
                        <div class="form-group">
                          <input class="form-control" type="text" name="bobot" placeholder="Bobot">
                        </div>
                        <div class="form-group">
                          <input class="form-control" type="text" name="status" placeholder="Status">
                        </div>
                        <div class="form-group">
                          <input class="btn btn-success" type="submit" name="simpan" value="Tambah">
                        </div>
                      </form>
                      <!--form kriteria-->
                    </div>
                </div>
            </div>
        </div>
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
