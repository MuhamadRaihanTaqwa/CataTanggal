<!-- register.php -->
<!DOCTYPE html>
<html>
<head>
  <title>Register - Catat Tanggal</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container">
    <h2>Daftar Akun</h2>
    <form method="post" action="proses/register_proses.php">
      <input type="text" name="nama" placeholder="Nama lengkap" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Daftar</button>
    </form>
    <p style="text-align:center; margin-top: 10px;">Sudah punya akun? <a href="login.php">Login</a></p>
  </div>
</body>
</html>
