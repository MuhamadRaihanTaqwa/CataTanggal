<!-- login.php -->
<!DOCTYPE html>
<html>
<head>
  <title>Login - Catat Tanggal</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container">
    <h2>Login Catat Tanggal</h2>
    <form method="post" action="proses/login_proses.php">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
    <p style="text-align:center; margin-top: 10px;">Belum punya akun? <a href="register.php">Daftar</a></p>
  </div>
</body>
</html>
