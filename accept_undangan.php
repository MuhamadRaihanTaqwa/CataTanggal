<?php
include '../config/koneksi.php';
$id = $_GET['id'];
mysqli_query($conn, "UPDATE undangan SET status = 'accepted' WHERE id = $id");
header("Location: ../dashboard.php");
?>
