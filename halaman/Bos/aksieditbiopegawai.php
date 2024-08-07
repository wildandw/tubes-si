<?php
// Mengambil atau mengimpor koneksi
require("../../koneksi.php");

// Mengambil data dari form
$id_pegawai = $_POST['id_pegawai'];
$nama_pegawai = $_POST['nama_pegawai'];
$jabatan = $_POST['jabatan'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$no_telepon = $_POST['no_telepon'];

// Mengecek apakah ID pegawai tidak kosong
if (!empty($id_pegawai) && !empty($nama_pegawai)) {
    // Menyiapkan query update
    $sql = "UPDATE pegawai SET nama_pegawai = ?, jabatan = ?, email = ?, alamat = ?, no_telepon = ? WHERE id_pegawai = ?";
    $stmt = $conn->prepare($sql);

    // Menggunakan bind_param untuk mengikat parameter
    $stmt->bind_param("ssssss", $nama_pegawai, $jabatan, $email, $alamat, $no_telepon, $id_pegawai);

    // Menjalankan query
    if ($stmt->execute()) {
        echo "<script type='text/javascript'>alert('Data dengan ID pegawai $id_pegawai telah berhasil di-update');document.location='biopegawai.php';</script>";
    } else {
        echo "<script type='text/javascript'>alert('Terjadi kesalahan saat meng-update data');document.location='biopegawai.php';</script>";
    }

    // Menutup statement dan koneksi
    $stmt->close();
    $conn->close();
} else {
    // Jika ada data yang kosong
    echo "<script type='text/javascript'>alert('Data tidak boleh ada yang kosong');document.location='biopegawai.php';</script>";
}
?>
