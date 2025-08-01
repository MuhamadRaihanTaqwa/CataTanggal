<?php
ob_start();
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once 'config/koneksi.php';

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$query = "SELECT * FROM jadwal WHERE user_id = '$user_id' ORDER BY tanggal ASC, waktu ASC";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query error: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Catat Tanggal</title>
  <!-- Bootstrap 5 CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .logout-btn {
      background: #dc3545;
      color: white;
      padding: 8px 12px;
      text-decoration: none;
      border-radius: 6px;
      margin-left: 10px;
    }
    header .user-info {
      display: flex;
      align-items: center;
    }
    header .user-info span {
      margin-right: 10px;
    }
  </style>
</head>
<body>
<header>
  <h1>Catat Tanggal</h1>
  <div class="user-info">
    <span>Halo, <?= htmlspecialchars($username) ?>!</span>
    <a href="logout.php" class="logout-btn">Logout</a>
  </div>
</header>

<main>
<h2>Jadwal Anda</h2>
<table border="1" cellpadding="8">
    <tr>
        <th>Judul</th>
        <th>Tanggal</th>
        <th>Waktu</th>
        <th>Tempat</th>
        <th>Teman</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= htmlspecialchars($row['judul']) ?></td>
            <td><?= htmlspecialchars($row['tanggal']) ?></td>
            <td><?= htmlspecialchars($row['waktu']) ?></td>
            <td><?= htmlspecialchars($row['tempat']) ?></td>
            <td><?= htmlspecialchars($row['teman']) ?></td>
        </tr>
    <?php endwhile; ?>
</table>

  <a href="tambah_jadwal.php" class="btn-primary">+ Tambah Jadwal</a>
  <section class="jadwal-list">
    <!-- Jadwal Mendatang -->
<div class="card my-4">
  <div class="card-header bg-primary text-white">
    Jadwal Mendatang
  </div>
  <div class="card-body">
    <?php if (mysqli_num_rows($result) > 0): ?>
      <?php mysqli_data_seek($result, 0); while ($jadwal = mysqli_fetch_assoc($result)) : ?>
        <div class="mb-3 border-bottom pb-2">
          <h5><?= htmlspecialchars($jadwal['judul']) ?></h5>
          <p><?= htmlspecialchars($jadwal['tanggal']) ?> - <?= htmlspecialchars($jadwal['waktu']) ?></p>
          <p><?= htmlspecialchars($jadwal['tempat']) ?> - <?= htmlspecialchars($jadwal['teman']) ?></p>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-muted">Belum ada jadwal mendatang.</p>
    <?php endif; ?>
  </div>
</div>

    <?php
// Ambil undangan untuk user yang login
// Ambil user_id dari session
$user_id = $_SESSION['user_id'];

// Ambil daftar undangan dari user lain
$query_invite = "SELECT 
                    i.id AS invite_id, 
                    u.nama AS pengirim, 
                    j.judul
                FROM invites i
                JOIN users u ON i.from_user_id = u.id
                JOIN jadwal j ON i.id_jadwal = j.id
                WHERE i.to_user_id = '$user_id' AND i.status = 'pending'";


$result_invite = mysqli_query($koneksi, $query_invite);

?>

<div class="card my-4">
  <div class="card-header bg-warning">
    Undangan Jadwal dari Teman
  </div>
  <div class="card-body">
    <?php if (mysqli_num_rows($result_invite) > 0): ?>
      <?php while ($row = mysqli_fetch_assoc($result_invite)): ?>
        <div class="mb-3">
          <p><strong><?= $row['pengirim'] ?></strong> mengundang kamu ke jadwal "<em><?= $row['nama_jadwal'] ?></em>"</p>
          <form action="proses/handle_invite.php" method="POST" class="d-inline">
            <input type="hidden" name="invite_id" value="<?= $row['invite_id'] ?>">
            <button class="btn btn-sm btn-success" name="action" value="accept">Accept</button>
            <button class="btn btn-sm btn-danger" name="action" value="reject">Remove</button>
          </form>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-muted">Tidak ada undangan baru.</p>
    <?php endif; ?>
  </div>
</div>


<?php
// Ambil jadwal yang sudah lewat (baik yang dibuat sendiri maupun diundang dan sudah diterima)
$today = date('Y-m-d');

$history_query = "
    SELECT j.judul, j.tanggal, j.waktu
    FROM jadwal j
    LEFT JOIN invite_jadwal i ON j.id = i.jadwal_id
    WHERE 
        j.user_id = $user_id 
        OR (i.penerima_id = $user_id AND i.status = 'accepted')
        AND j.tanggal < '$today'
    ORDER BY j.tanggal DESC
";
$history_result = mysqli_query($koneksi, $history_query);
?>

<div class="card my-4">
  <div class="card-header bg-secondary text-white">
    Riwayat Jadwal
  </div>
  <div class="card-body">
    <?php if (mysqli_num_rows($history_result) > 0): ?>
      <ul class="list-group">
        <?php while ($h = mysqli_fetch_assoc($history_result)): ?>
          <li class="list-group-item"><?= $h['nama_jadwal'] ?> (<?= $h['tanggal'] ?> <?= $h['waktu'] ?>)</li>
        <?php endwhile; ?>
      </ul>
    <?php else: ?>
      <p class="text-muted">Tidak ada jadwal yang sudah lewat.</p>
    <?php endif; ?>
  </div>
</div>
<form action="proses/kirim_undangan.php" method="post">
  <input type="hidden" name="id_jadwal" value="<?= $jadwal['id'] ?>">
  <input type="text" name="penerima" placeholder="Username teman">
  <button type="submit">Kirim Undangan</button>
</form>

  </section>
</main>
</body>
</html>
<link rel="stylesheet" href="assets/css/style.css">
<a href="history.php">Riwayat Jadwal</a>
