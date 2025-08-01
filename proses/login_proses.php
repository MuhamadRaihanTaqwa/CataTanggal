<?php
session_start();
include '../config/koneksi.php';

$email = $_POST['email'];
$password = $_POST['password'];

// Cari user berdasarkan email
$query = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result);

if ($user) {
    // Verifikasi password
    if (password_verify($password, $user['password'])) {
       $_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['nama']; // pastikan kolom 'username' ada di tabel users

        header("Location: ../dashboard.php");
    } else {
        echo "Password salah!";
    }
} else {
    echo "Akun tidak ditemukan!";
}

?>
