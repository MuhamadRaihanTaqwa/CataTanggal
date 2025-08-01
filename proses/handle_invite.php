<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $invite_id = $_POST['invite_id'];
    $action = $_POST['action'];

    if ($action === 'accept') {
        // Ambil jadwal_id dari undangan
        $query = "SELECT id_jadwal FROM invites WHERE id = '$invite_id' AND to_user_id = '$user_id'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $jadwal_id = $row['id_jadwal'];

            // Tambahkan ke tabel relasi jadwal_user (jika kamu pakai tabel ini)
            $insert = "INSERT INTO jadwal_user (user_id, jadwal_id) VALUES ('$user_id', '$jadwal_id')";
            mysqli_query($conn, $insert);

            // Update status undangan jadi 'accepted'
            $update = "UPDATE invites SET status = 'accepted' WHERE id = '$invite_id'";
            mysqli_query($conn, $update);
        }
    } elseif ($action === 'reject') {
        // Update status undangan jadi 'rejected'
        $update = "UPDATE invites SET status = 'rejected' WHERE id = '$invite_id' AND to_user_id = '$user_id'";
        mysqli_query($conn, $update);
    }
}

header("Location: ../lihat_jadwal.php");
exit();
