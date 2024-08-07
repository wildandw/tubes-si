<?php
// Mengambil atau mengimpor koneksi 
require("../../koneksi.php");

// Mengambil ID pengguna dari POST
$id_sales = $_GET['id_sales'];

// Validasi ID pengguna
if (!empty($id_sales)) {
    // Query untuk menghapus akun sales
    $sql = "DELETE FROM sales WHERE id_sales='$id_sales'";
    
    // Eksekusi query
    if (mysqli_query($conn, $sql)) {
        echo "<script type='text/javascript'>alert('Akun sales dengan ID $id_sales telah berhasil dihapus');document.location='master.php';</script>";
    } else {
        echo "<script type='text/javascript'>alert('Gagal menghapus akun sales: " . mysqli_error($conn) . "');document.location='master.php';</script>";
    }
} else {
    echo "<script type='text/javascript'>alert('ID pengguna tidak valid');document.location='master.php';</script>";
}
?>
