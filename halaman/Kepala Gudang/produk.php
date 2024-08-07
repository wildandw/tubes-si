<?php
session_start(); // Memulai session

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['username']) || !isset($_SESSION['id_sales'])) {
    header("Location: ../login.php");
    exit;
}

// Koneksi ke database
require("../../koneksi.php");

// Query untuk mengambil data produk
$sql = "SELECT kode_produk, nama_produk, merk, stok, harga FROM produk";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCM</title>
    <link rel="stylesheet" href="../../css/index.css" />
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="../../img/logo.png" alt="Logo">
        </div>
        <div class="user-info">
          <h3>SCM</h3>
        </div>
        <nav class="nav-menu">
            <ul>
              <li><a href="beranda_kplgudang.php " >Data Pengajuan Barang</a></li>
              <li><a href="produk.php " class="active" >Produk</a></li>
              <li><a href="../login.php">Keluar</a></li>
            </ul>
        </nav>
    </div>
    <div class="main-content">
      <section id="daftar-produk">
        <h1>Daftar Produk</h1>
        <table class="product-table">
          <thead>
            <tr>
              <th>Kode Produk</th>
              <th>Nama Produk</th>
              <th>Merk</th>
              <th>Stok</th>
              <th>Harga</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Menampilkan data produk dalam tabel
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['kode_produk']}</td>
                        <td>{$row['nama_produk']}</td>
                        <td>{$row['merk']}</td>
                        <td>{$row['stok']}</td>
                        <td>{$row['harga']}</td>
                      </tr>";
              }
            } else {
              echo "<tr><td colspan='5'>Tidak ada data produk</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </section>
    </div>
</body>
</html>
