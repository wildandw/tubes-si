<?php
// Mengambil atau mengimpor koneksi 
require("../../koneksi.php");

// Mengambil ID pengguna dari POST
$id_pegawai = $_GET['id_pegawai'];

// Validasi ID pengguna
if (!empty($id_pegawai)) {
    // Query untuk menghapus akun pegawai
    $sql = "DELETE FROM pegawai WHERE id_pegawai='$id_pegawai'";
    
    // Eksekusi query
    if (mysqli_query($conn, $sql)) {
        echo "<script type='text/javascript'>alert('Akun pegawai dengan ID $id_pegawai telah berhasil dihapus');document.location='biopegawai.php';</script>";
    } else {
        echo "<script type='text/javascript'>alert('Gagal menghapus akun pegawai: " . mysqli_error($conn) . "');document.location='biopegawai.php';</script>";
    }
} else {
    echo "<script type='text/javascript'>alert('ID pengguna tidak valid');document.location='biopegawai.php';</script>";
}
?>
