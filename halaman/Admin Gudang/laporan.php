<?php
session_start(); // Memulai session

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['username']) || !isset($_SESSION['id_sales']) || !isset($_SESSION['id_pegawai'])) {
    header("Location: ../login.php");
    exit;
}

// Mengambil data dari sesi
$id_sales = $_SESSION['id_sales'];
$id_pegawai = $_SESSION['id_pegawai'];

// Koneksi ke database
require("../../koneksi.php");

// Mengambil nama lengkap dan jabatan admin berdasarkan id_pegawai
$sql_nama_admin = "SELECT p.nama_pegawai, p.jabatan 
                   FROM pegawai p 
                   INNER JOIN users_pegawai up ON p.id_pegawai = up.id_pegawai 
                   WHERE up.id_pegawai = ?";
$stmt = $conn->prepare($sql_nama_admin);
$stmt->bind_param("s", $id_pegawai);
$stmt->execute();
$stmt->bind_result($nama_admin, $jabatan);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales</title>
    <link rel="stylesheet" href="../../css/index.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="../../img/logo.png" alt="Logo">
        </div>
        <div class="user-info">
          <h3>ADMIN</h3>
        </div>
        <nav class="nav-menu">
            <ul>
              <li><a href="berandaadmin.php" >Data Pengajuan Barang</a></li>
              <li><a href="#laporan" class="active" >Laporan</a></li>
              <li><a href="../login.php">Keluar</a></li>
            </ul>
        </nav>
    </div>

    <div class="main-content">
      <section id="laporan">
      <h1>Laporan</h1>
      <table class="product-table">
    <thead>
        <tr>
            <th>No</th>
            <th>ID laporan</th>
            <th>ID pemesanan</th>
            <th>ID sales</th>
            <th>ID pegawai</th>
            <th>Kode produk</th>
            <th>Tanggal pengiriman</th>
            <th>Ekspedisi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require("../../koneksi.php");

        $sql = "SELECT * FROM laporan_pengajuan"; 

        $hasil = mysqli_query($conn, $sql);
        $n = 1;

        while ($row = mysqli_fetch_assoc($hasil)) {
            $id_laporan = $row['id_laporan'];
            $id_pemesanan = $row['id_pemesanan'];
            $id_sales = $row['id_sales'];
            $id_pegawai = $row['id_pegawai'];
            $kode_produk = $row['kode_produk'];
            $tgl_pengiriman= $row['tgl_pengiriman'];
            $ekspedisi= $row['ekspedisi'];
           

            echo "<tr>
                  <form action='cetak.php' method='POST'>
                  <td>$n</td>
                  <td>$id_laporan</td>
                  <td>$id_pemesanan</td>
                  <td>$id_sales</td>
                  <td>$id_pegawai</td>
                  <td>$kode_produk</td>
                  <td>$tgl_pengiriman</td>
                  <td>$ekspedisi</td>
                  <td>
                      <button type='submit'>Cetak</button>
                  </td>
                  </form>
              </tr>";
            $n++;
        }
        ?>
    </tbody>
</table>
        
      </section>
    </div>
</body>
</html>
