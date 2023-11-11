<?php
session_start();

// DEFINE('DB_USER', 'root');
// DEFINE('DB_PASSWORD', '');
// DEFINE('DB_HOST', 'localhost');
// DEFINE('DB_NAME', 'spk_motor');

// $dbc = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASSWORD);

$host = "localhost";
$username = "root";
$dbname = "spk_motor";
$pass = "";
$dbc = mysqli_connect($host, $username, $pass, $dbname);
if (!$dbc) {
    echo "Belum Konek";
} else {
    //echo "Sudah Konek";
}
