<?php
session_start(); // WAJIB di baris pertama!

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Ambil nama pengguna jika tersedia
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Pengguna';
?>

<?php include("config/koneksi.php"); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Jadwal | Catat Tanggal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <style>
    body {
      background: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .card {
      border-radius: 15px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }
    .btn-primary {
      background-color: #4e73df;
      border: none;
    }
    .btn-primary:hover {
      background-color: #2e59d9;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <div class="card p-4">
    <h3 class="mb-4 text-center text-primary"><i class="bi bi-calendar-plus"></i> Tambah Jadwal Baru</h3>
    <form action="proses/tambah_jadwal_proses.php" method="POST">
      <div class="mb-3">
        <label for="judul" class="form-label">Judul Jadwal</label>
        <input type="text" name="judul" class="form-control" placeholder="Contoh: Meeting, Nonton bareng..." required>
      </div>
      <div class="mb-3">
        <label for="tanggal" class="form-label">Tanggal</label>
        <input type="date" name="tanggal" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="waktu" class="form-label">Waktu</label>
        <input type="time" name="waktu" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="tempat" class="form-label">Tempat</label>
        <input type="text" name="tempat" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="teman" class="form-label">Undang Teman (Email)</label>
        <input type="email" name="teman" class="form-control" placeholder="Email teman untuk diundang" required>
      </div>
      <button type="submit" class="btn btn-primary w-100"><i class="bi bi-send-check"></i> Simpan & Undang</button>
    </form>
  </div>
</div>

</body>
</html>
