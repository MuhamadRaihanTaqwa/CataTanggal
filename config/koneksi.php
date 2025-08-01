<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "catat_tanggal";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
<?php
$koneksi = mysqli_connect("localhost", "root", "", "catat_tanggal");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
