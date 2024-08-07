<?php
require("../../koneksi.php");

$id_users = $_POST['id_users'];
$id_pegawai = $_POST['id_pegawai'];
$username = $_POST['username'];
$password = $_POST['password'];
$hak_akses = $_POST['hak_akses']; 


if (!empty($id_pegawai) && !empty($username)) {

    if (!empty($password)) {
        $sql = "UPDATE users_pegawai SET id_pegawai = ?, username = ?, password = ?, hak_akses = ? WHERE id_users = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $id_pegawai, $username, $password, $hak_akses, $id_users);
    } else {
        $sql = "UPDATE users_pegawai SET id_pegawai = ?, username = ?, hak_akses = ? WHERE id_users = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $id_pegawai, $username, $hak_akses, $id_users);
    }

    // Menjalankan query
    if ($stmt->execute()) {
        echo "<script type='text/javascript'>alert('Data dengan ID Pegawai $id_pegawai telah berhasil di-update');document.location='master.php';</script>";
    } else {
        echo "<script type='text/javascript'>alert('Terjadi kesalahan saat meng-update data');document.location='master.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script type='text/javascript'>alert('Data tidak boleh ada yang kosong');document.location='master.php';</script>";
}
?>
