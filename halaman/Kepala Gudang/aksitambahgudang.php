<?php
session_start(); // Memulai session

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['username']) || !isset($_SESSION['id_sales'])) {
    header("Location: ../login.php");
    exit;
}

// Mengimpor koneksi
require("../../koneksi.php");

// Mengambil data dari form
$id_pemesanan = $_POST['id_pemesanan'];
$qty = $_POST['qty'];
$statuspengajuangudang = $_POST['statuspengajuangudang'];

// Memperbarui data di database
$sql_update = "UPDATE histori_pengajuan 
               SET  statuspengajuangudang = '$statuspengajuangudang'
               WHERE id_pemesanan = '$id_pemesanan'";

if ($conn->query($sql_update) === TRUE) {
    echo "<script>alert('Data berhasil diperbarui!'); document.location='beranda_kplgudang.php';</script>";
} else {
    echo "Error: " . $sql_update . "<br>" . $conn->error;
}

$conn->close();
?>