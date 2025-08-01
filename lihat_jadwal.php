<?php
include("config/koneksi.php");
// ambil semua data jadwal
$query = mysqli_query($koneksi, "SELECT * FROM jadwal ORDER BY tanggal ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Lihat Jadwal | Catat Tanggal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <style>
    body {
      background-color: #eef2f7;
      font-family: 'Segoe UI', sans-serif;
    }
    .card {
      border-radius: 15px;
      transition: 0.3s;
    }
    .card:hover {
      transform: scale(1.02);
      box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    }
    .btn-back {
      position: fixed;
      top: 20px;
      left: 20px;
      z-index: 1000;
    }
  </style>
</head>
<body>

<!-- Tombol kembali ke dashboard -->
<a href="dashboard.php" class="btn btn-outline-success btn-back">
  <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
</a>

<div class="container mt-5">
  <h3 class="text-center mb-4 text-success"><i class="bi bi-calendar-week"></i> Jadwal Kamu</h3>
  
  <?php if (mysqli_num_rows($query) > 0): ?>
  <div class="row g-4">
    <?php while ($jadwal = mysqli_fetch_assoc($query)) : ?>
      <div class="col-md-6 col-lg-4">
        <div class="card p-3 border-start border-4 border-primary">
          <h5 class="text-primary"><i class="bi bi-alarm"></i> <?= htmlspecialchars($jadwal['judul']) ?></h5>
          <p class="mb-1"><strong>Tanggal:</strong> <?= htmlspecialchars($jadwal['tanggal']) ?></p>
          <p class="mb-1"><strong>Waktu:</strong> <?= htmlspecialchars($jadwal['waktu']) ?></p>
          <p class="mb-1"><strong>Diundang:</strong> <?= htmlspecialchars($jadwal['teman']) ?></p>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
  <?php else: ?>
    <div class="alert alert-warning text-center">
      Belum ada jadwal yang ditambahkan. <br> 
      <a href="tambah_jadwal.php" class="btn btn-sm btn-outline-primary mt-2">Tambah Jadwal Sekarang</a>
    </div>
  <?php endif; ?>
</div>

</body>
</html>
