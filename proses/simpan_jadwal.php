<?php
session_start();
include '../config/koneksi.php';

$judul = $_POST['judul'];
$tanggal = $_POST['tanggal'];
$catatan = $_POST['catatan'];
$user_id = $_SESSION['user_id'];

$query = "INSERT INTO jadwal (user_id, judul, tanggal, catatan) 
          VALUES ('$user_id', '$judul', '$tanggal', '$catatan')";

if (mysqli_query($koneksi, $query)) {
    echo "Jadwal berhasil disimpan. <a href='../lihat_jadwal.php'>Lihat Jadwal</a>";
} else {
    echo "Gagal menyimpan jadwal: " . mysqli_error($koneksi);
}
?>
