<?php
// Mengambil atau mengimpor koneksi 
require("../../koneksi.php");

// Mengambil ID pengguna dari POST
$id_users = $_GET['id_users'];

// Validasi ID pengguna
if (!empty($id_users)) {
    // Query untuk menghapus akun sales
    $sql = "DELETE FROM users_sales WHERE id_users='$id_users'";
    
    // Eksekusi query
    if (mysqli_query($conn, $sql)) {
        echo "<script type='text/javascript'>alert('Akun sales dengan ID $id_users telah berhasil dihapus');document.location='master.php';</script>";
    } else {
        echo "<script type='text/javascript'>alert('Gagal menghapus akun sales: " . mysqli_error($conn) . "');document.location='master.php';</script>";
    }
} else {
    echo "<script type='text/javascript'>alert('ID pengguna tidak valid');document.location='master.php';</script>";
}
?>
