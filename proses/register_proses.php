<?php
include '../config/koneksi.php';

$nama = $_POST['nama'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Cek apakah email sudah terdaftar
$cek = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email'");
if (mysqli_num_rows($cek) > 0) {
    echo "Email sudah terdaftar. Silakan gunakan email lain.";
    exit;
}

// Simpan ke database
$query = "INSERT INTO users (nama, email, password) VALUES ('$nama', '$email', '$password')";
$simpan = mysqli_query($koneksi, $query);

if ($simpan) {
    echo "Registrasi berhasil! <a href='../login.php'>Login sekarang</a>";
} else {
    echo "Registrasi gagal: " . mysqli_error($koneksi);
}
?>
