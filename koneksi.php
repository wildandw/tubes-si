<?php
// Menghubungkan ke database
$conn = mysqli_connect("localhost", "root", "", "tubessi");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
