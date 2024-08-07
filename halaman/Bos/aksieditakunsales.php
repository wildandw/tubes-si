<?php
// Mengambil atau mengimpor koneksi
require("../../koneksi.php");

// Mengambil data dari form
$id_users = $_POST['id_users'];
$id_sales = $_POST['id_sales'];
$username = $_POST['username'];
$password = $_POST['password'];

// Mengecek apakah ID Sales tidak kosong
if (!empty($id_sales) && !empty($username)) {
    // Menyiapkan query update
    if (!empty($password)) {
        // Jika password diisi, update password juga
        $sql = "UPDATE users_sales SET id_sales = ?, username = ?, password = ? WHERE id_users = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $id_sales, $username, $password, $id_users);
    } else {
        // Jika password tidak diisi, update tanpa mengubah password
        $sql = "UPDATE users_sales SET id_sales = ?, username = ? WHERE id_users = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $id_sales, $username, $id_users);
    }

    // Menjalankan query
    if ($stmt->execute()) {
        echo "<script type='text/javascript'>alert('Data dengan ID Sales $id_sales telah berhasil di-update');document.location='master.php';</script>";
    } else {
        echo "<script type='text/javascript'>alert('Terjadi kesalahan saat meng-update data');document.location='master.php';</script>";
    }

    // Menutup statement dan koneksi
    $stmt->close();
    $conn->close();
} else {
    // Jika ada data yang kosong
    echo "<script type='text/javascript'>alert('Data tidak boleh ada yang kosong');document.location='master.php';</script>";
}
?>
