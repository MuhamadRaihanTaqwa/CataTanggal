<?php
include 'config/koneksi.php';
session_start();
$username = $_SESSION['username'];

$query = "SELECT * FROM jadwal WHERE username = '$username' ORDER BY tanggal DESC";
$result = mysqli_query($conn, $query);
?>

<h2>Riwayat Jadwal</h2>
<?php while ($data = mysqli_fetch_assoc($result)): ?>
  <div>
    <strong><?= $data['nama_jadwal'] ?></strong> (<?= $data['tanggal'] ?>)
  </div>
<?php endwhile; ?>
