<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include("../config/koneksi.php");

echo "1. Koneksi dan session dimulai<br>";
header("Location: ../lihat_jadwal.php");
exit;

if (!isset($_SESSION['user_id'])) {
    echo "2. Tidak ada session user_id";
    header("Location: ../login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "3. POST diterima<br>";

    $user_id = $_SESSION['user_id'];
    $judul = mysqli_real_escape_string($conn, $_POST['judul'] ?? '');
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal'] ?? '');
    $waktu = mysqli_real_escape_string($conn, $_POST['waktu'] ?? '');
    $tempat = mysqli_real_escape_string($conn, $_POST['tempat'] ?? '');
    $teman = mysqli_real_escape_string($conn, $_POST['teman'] ?? '');

    echo "4. Data form diterima<br>";

    if (empty($judul) || empty($tanggal) || empty($waktu) || empty($teman)) {
        die("5. Validasi gagal: Ada kolom kosong");
    }
echo '<pre>';
print_r($_POST);
echo '</pre>';
if (empty($_POST['judul']) || empty($_POST['tempat'])) {
    echo "Judul atau Tempat tidak boleh kosong!";
    exit;
}

    $query = "INSERT INTO jadwal (user_id, judul, tanggal, waktu, tempat, teman) 
              VALUES ('$user_id', '$judul', '$tanggal', '$waktu', '$tempat', '$teman')";

    echo "6. Query siap: $query<br>";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "7. Query sukses<br>";
        $pesan_email = "Halo $teman, kamu diundang untuk menghadiri acara '$judul' di $tempat pada $tanggal pukul $waktu.";
        echo "<script>
            alert('Jadwal berhasil disimpan.\\n\\nSimulasi email ke teman:\\n$pesan_email');
            window.location.href = '../lihat_jadwal.php';
        </script>";
        exit;
    } else {
        die("8. Gagal menyimpan jadwal: " . mysqli_error($conn));
    }

} else {
    die("9. Akses tidak sah: Bukan metode POST");
}
?>
