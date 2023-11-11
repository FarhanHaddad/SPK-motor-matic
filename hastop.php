<?php
//koneksi
session_start();
include ("koneksi.php");
include './includes/header.php';
$tampil = $koneksi->query("SELECT b.nama_alternatif,c.nama_kriteria,a.nilai,c.bobot,c.status
      FROM
        tab_topsis a
        JOIN
          tab_alternatif b USING(id_alternatif)
        JOIN
          tab_kriteria c USING(id_kriteria)");

$data      =array();
$kriterias =array();
$bobot     =array();
$nilai_kuadrat =array();
$status=array();

if ($tampil) {
  while($row=$tampil->fetch_object()){
    if(!isset($data[$row->nama_alternatif])){
      $data[$row->nama_alternatif]=array();
    }
    if(!isset($data[$row->nama_alternatif][$row->nama_kriteria])){
      $data[$row->nama_alternatif][$row->nama_kriteria]=array();
    }
    if(!isset($nilai_kuadrat[$row->nama_kriteria])){
      $nilai_kuadrat[$row->nama_kriteria]=0;
    }
    $bobot[$row->nama_kriteria]=$row->bobot;
    $data[$row->nama_alternatif][$row->nama_kriteria]=$row->nilai;
    $nilai_kuadrat[$row->nama_kriteria]+=pow($row->nilai,2);
    $kriterias[]=$row->nama_kriteria;
    $status[$row->nama_kriteria]=$row->status;
  }
}

$kriteria     =array_unique($kriterias);
$jml_kriteria =count($kriteria);
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

      </div>
    </nav>

    <!--tabel-tabel-->
    <div class="container"> <!--container-->
      <div class="row">
      	<div class="col-lg-8 col-lg-offset-2">
      	  <div class="panel panel-default">
      	    <div class="panel-heading">
              Evaluation Matrix (x<sub>ij</sub>)
      	    </div>
            <div class="panel-body">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th rowspan='3'>No</th>
                    <th rowspan='3'>Alternatif</th>
                    <th rowspan='3'>Nama</th>
                    <th colspan='<?php echo $jml_kriteria;?>'>Kriteria</th>
                  </tr>
                  <tr>
                    <?php
                    foreach($kriteria as $k)
                      echo "<th>$k</th>\n";
                    ?>
                  </tr>
                  <tr>
                    <?php
                    for($n=1;$n<=$jml_kriteria;$n++)
                      echo "<th>K$n</th>";
                    ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i=0;
                  foreach($data as $nama=>$krit){
                    echo "<tr>
                      <td>".(++$i)."</td>
                      <th>A$i</th>
                      <td>$nama</td>";
                    foreach($kriteria as $k){
                      echo "<td align='center'>$krit[$k]</td>";
                    }
                    echo "</tr>\n";
                  }
                  ?>
                </tbody>
              </table>
            </div>
      	  </div>
      	</div>
      </div>

      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading">
              Rating Kinerja Ternormalisasi (r<sub>ij</sub>)
            </div>
            <div class="panel-body">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th rowspan='3'>No</th>
                    <th rowspan='3'>Alternatif</th>
                    <th rowspan='3'>Nama</th>
                    <th colspan='<?php echo $jml_kriteria;?>'>Kriteria</th>
                  </tr>
                  <tr>
                    <?php
                    foreach($kriteria as $k)
                      echo "<th>$k</th>\n";
                    ?>
                  </tr>
                  <tr>
                    <?php
                    for($n=1;$n<=$jml_kriteria;$n++)
                      echo "<th>K$n</th>";
                    ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i=0;
                  foreach($data as $nama=>$krit){
                    echo "<tr>
                      <td>".(++$i)."</td>
                      <th>A{$i}</th>
                      <td>{$nama}</td>";
                    foreach($kriteria as $k){
                      echo 
                      "<td align='center'>".round(($krit[$k]/sqrt($nilai_kuadrat[$k])),4).
                      "</td>";
                    }
                    echo
                     "</tr>\n";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading">
              Rating Bobot Ternormalisasi(y<sub>ij</sub>)
            </div>
            <div class="panel-body">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th rowspan='3'>No</th>
                    <th rowspan='3'>Alternatif</th>
                    <th rowspan='3'>Nama</th>
                    <th colspan='<?php echo $jml_kriteria;?>'>Kriteria</th>
                  </tr>
                  <tr>
                    <?php
                    foreach($kriteria as $k)
                      echo "<th>$k</th>\n";
                    ?>
                  </tr>
                  <tr>
                    <?php
                    for($n=1;$n<=$jml_kriteria;$n++)
                      echo "<th>K$n</th>";
                    ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i=0;
                  $y=array();
                  foreach($data as $nama=>$krit){
                    echo "<tr>
                      <td>".(++$i)."</td>
                      <th>A{$i}</th>
                      <td>{$nama}</td>";
                    foreach($kriteria as $k){
                      $y[$k][$i-1]=round(($krit[$k]/sqrt($nilai_kuadrat[$k])),4)*$bobot[$k];
                      echo "<td align='center'>".$y[$k][$i-1]."</td>";
                    }
                    echo
                     "</tr>\n";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading">
              Solusi Ideal positif (A<sup>+</sup>)
            </div>
            <div class="panel-body">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th colspan='<?php echo $jml_kriteria;?>'>Kriteria</th>
                  </tr>
                  <tr>
                    <?php
                    foreach($kriteria as $k)
                      echo "<th>$k</th>\n";
                    ?>
                  </tr>
                  <tr>
                    <?php
                    for($n=1;$n<=$jml_kriteria;$n++)
                      echo "<th>y<sub>{$n}</sub><sup>+</sup></th>";
                    ?>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php
                    $yplus=array();
                    foreach($kriteria as $k){
                      $yplus[$k]=($status[$k]=='Benefit'?max($y[$k]):min($y[$k]));
                    
                      echo "<th>$yplus[$k]</th>";

                    }
                    ?>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading">
              Solusi Ideal negatif (A<sup>-</sup>)
            </div>
            <div class="panel-body">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th colspan='<?php echo $jml_kriteria;?>'>Kriteria</th>
                  </tr>
                  <tr>
                    <?php
                    foreach($kriteria as $k)
                      echo "<th>{$k}</th>\n";
                    ?>
                  </tr>
                  <tr>
                    <?php
                    for($n=1;$n<=$jml_kriteria;$n++)
                      echo "<th>y<sub>{$n}</sub><sup>-</sup></th>";
                    ?>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php
                    $ymin=array();
                    foreach($kriteria as $k){
                      $ymin[$k]=($status[$k]=='Cost'?max($y[$k]):min($y[$k]));
                      echo "<th>{$ymin[$k]}</th>";
                    }

                    ?>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading">
              Jarak positif (D<sub>i</sub><sup>+</sup>)
            </div>
            <div class="panel-body">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Alternatif</th>
                    <th>Nama</th>
                    <th>D<suo>+</sup></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i=0;
                  $dplus=array();
                  foreach($data as $nama=>$krit){
                    echo "<tr>
                      <td>".(++$i)."</td>
                      <th>A{$i}</th>
                      <td>{$nama}</td>";
                    foreach($kriteria as $k){
                      if(!isset($dplus[$i-1])) $dplus[$i-1]=0;
                      $dplus[$i-1]+=pow($yplus[$k]-$y[$k][$i-1],2);
                    }
                    echo "<td>".round(sqrt($dplus[$i-1]),4)."</td>
                     </tr>\n";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading">
              Jarak negatif (D<sub>i</sub><sup>-</sup>)
            </div>
            <div class="panel-body">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Alternatif</th>
                    <th>Nama</th>
                    <th>D<suo>-</sup></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i=0;
                  $dmin=array();
                  foreach($data as $nama=>$krit){
                    echo "<tr>
                      <td>".(++$i)."</td>
                      <th>A{$i}</th>
                      <td>{$nama}</td>";
                    foreach($kriteria as $k){
                      if(!isset($dmin[$i-1]))$dmin[$i-1]=0;
                      $dmin[$i-1]+=pow($ymin[$k]-$y[$k][$i-1],2);
                    }
                    echo "<td>".round(sqrt($dmin[$i-1]),4)."</td>

                     </tr>\n";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading">
              Nilai Preferensi(V<sub>i</sub>)
            </div>
            <div class="panel-body">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Alternatif</th>
                    <th>Nama</th>
                    <th>V<sub>i</sub></th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                          $i=0;
                          $V=array();
                          $Y=array();
                          $Z=array();                        
                          $hasilakhir=array();
                          

                          foreach ($data as $nama => $krit) {
                            echo "<tr>
                            <td>".(++$i)."</td>
                            <th>A{$i}</th>
                            <td>{$nama}</td>";             
                     foreach($kriteria as $k){
                      $V[$i-1]=round(sqrt($dmin[$i-1]),4)/(round(sqrt($dmin[$i-1]),4)+round(sqrt($dplus[$i-1]),4));
                    }
                    echo "<td>{$V[$i-1]}</td></tr>\n";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    

    

              <div class="col-lg-8 col-lg-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading">
              Perankingan(V<sub>i</sub>)
            </div>
            <div class="panel-body">
              <table id="tab_alternatif" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Rangking</th>
                                    <th>Nama Motor</th>
                                    <th>Vi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                uasort($V, 'V');
                                for ($i = 0; $i < $n; $i++) {
                                    if ($i == 0) {
                                        echo '<tr><td>' . $no++ . '</td>';
                                        echo '<td>' . $nama[array_search(end($V), $V)][0] . '</td>';
                                        echo '<td>' . current($V) . '</td></tr>';
                                    } elseif ($i == ($nama)) {
                                        echo '<tr><td>' . $no++ . '</td>';
                                        echo '<td>' . $nama[array_search((prev($V)), $V)][0] . '</td>';
                                        echo '<td>' . current($V) . '</td></tr>';
                                    } else {
                                        echo '<tr><td>' . $no++ . '</td>';
                                        echo '<td>' . $nama[array_search(prev($V), $V)][0] . '</td>';
                                        echo '<td>' . current($V) . '</td></tr>';
                                    }
                                }
                                function V($n, $nama)
                                {
                                    if ($n == $nama) {
                                        return 0;
                                    }
                                    return ($n < $nama) ? -1 : 1;
                                }
                                ?>

                            </tbody>
                        </table>
                              </div>
                              </div>
              </div> <!--container-->

              <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading">
              Nilai Preferensi Tertinggi(V<sub>max</sub>)
            </div>
            <div class="panel-body">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Alternatif</th>
                    
                   
                    <th>V<sub>i</sub></th>
                  </tr>
                </thead>
                <tbody>
														<?php
														$testmax = max($V);
														for ($i=0; $i < count($V); $i++) { 
															if ($V[$i] == $testmax) {
																?>
																<td><center><?php echo "V".($i+1); ?></center></td>
                               
																<td><center><?php echo $V[$i]; ?></center></td>

																
																<?php
															}
														}
													 ?>
												</tr>
											</tbody>
										</table>
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
