<?php
// Mengambil atau mengimpor koneksi
require("../../koneksi.php");

// Mengambil data dari form
$id_sales = $_POST['id_sales'];
$nama_sales = $_POST['nama_sales'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$no_telepon = $_POST['no_telepon'];

// Mengecek apakah ID Sales tidak kosong
if (!empty($id_sales) && !empty($nama_sales)) {
    // Menyiapkan query update
    $sql = "UPDATE sales SET nama_sales = ?, email = ?, alamat = ?, no_telepon = ? WHERE id_sales = ?";
    $stmt = $conn->prepare($sql);

    // Menggunakan bind_param untuk mengikat parameter
    $stmt->bind_param("sssss", $nama_sales, $email, $alamat, $no_telepon, $id_sales);

    // Menjalankan query
    if ($stmt->execute()) {
        echo "<script type='text/javascript'>alert('Data dengan ID Sales $id_sales telah berhasil di-update');document.location='biosales.php';</script>";
    } else {
        echo "<script type='text/javascript'>alert('Terjadi kesalahan saat meng-update data');document.location='biosales.php';</script>";
    }

    // Menutup statement dan koneksi
    $stmt->close();
    $conn->close();
} else {
    // Jika ada data yang kosong
    echo "<script type='text/javascript'>alert('Data tidak boleh ada yang kosong');document.location='biosales.php';</script>";
}
?>
