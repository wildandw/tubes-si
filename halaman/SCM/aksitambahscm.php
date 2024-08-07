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
$statuspengajuan = $_POST['statuspengajuan'];

// Menghitung total_harga berdasarkan qty baru dan harga produk dari tabel produk
$sql = "SELECT harga FROM produk WHERE kode_produk = (SELECT kode_produk FROM histori_pengajuan WHERE id_pemesanan = '$id_pemesanan')";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$harga = $row['harga'];
$total_harga = $qty * $harga;

// Memperbarui data di database
$sql_update = "UPDATE histori_pengajuan 
               SET qty = '$qty', statuspengajuan = '$statuspengajuan', total_harga = '$total_harga' 
               WHERE id_pemesanan = '$id_pemesanan'";

if ($conn->query($sql_update) === TRUE) {
    echo "<script>alert('Data berhasil diperbarui!'); document.location='berandascm.php';</script>";
} else {
    echo "Error: " . $sql_update . "<br>" . $conn->error;
}

$conn->close();
?>