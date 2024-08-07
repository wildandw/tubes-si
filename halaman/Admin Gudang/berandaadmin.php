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
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../css/index.css" />
    <title>Admin</title>
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
              <li><a href="#data-pengajuan" class="active">Data Pengajuan Barang</a></li>
              <li><a href="laporan.php" >Laporan</a></li>
              <li><a href="../login.php">Keluar</a></li>
            </ul>
        </nav>
    </div>
    <div class="main-content">
    <section id="data-pengajuan">
    <h1>Daftar Pengajuan</h1>
      <table class="product-table">
      <thead>
          <tr>
              <th>No</th>
              <th>ID Pemesanan</th>
              <th>Kode Produk</th>
              <th>Nama Produk</th>
              <th>QTY</th>
              <th>Total Harga</th>
              <th>Nama Customer</th>
              <th>Email</th>
              <th>No Telepon</th>
              <th>Alamat</th>
              <th>Tanggal Pengajuan</th>
              <th>Status SCM</th>
              <th>Status kepala gudang</th>
              <th>Ekspedisi</th>
              <th>Tanggal Pengiriman</th>
              <th>Aksi</th>
          </tr>
      </thead>
      <tbody>
          <?php
          require("../../koneksi.php");

          // Mengambil ID Laporan terbaru dan membuat ID baru
          $query = mysqli_query($conn, "SELECT max(id_laporan) as kodeTerbesar FROM laporan_pengajuan");
          $data = mysqli_fetch_array($query);
          $id_laporan_terakhir = $data['kodeTerbesar'];
          $urutan = (int) substr($id_laporan_terakhir, 3, 3);
          $urutan++;
          $id_laporan_baru = "LAP" . sprintf("%03s", $urutan);

          $sql = "SELECT h.id_pemesanan, h.kode_produk, p.nama_produk, h.qty, h.total_harga, h.nama_customer, h.email, h.no_telepon, h.alamat, h.tgl_pengajuan, h.statuspengajuan, h.statuspengajuangudang
          FROM tubessi.histori_pengajuan h
          INNER JOIN tubessi.produk p ON h.kode_produk = p.kode_produk"; 

          $hasil = mysqli_query($conn, $sql);
          $n = 1;

          while ($row = mysqli_fetch_assoc($hasil)) {
              $id_pemesanan = $row['id_pemesanan'];
              $kode_produk = $row['kode_produk'];
              $nama_produk = $row['nama_produk'];
              $qty = $row['qty'];
              $total_harga = $row['total_harga'];
              $nama_customer = $row['nama_customer'];
              $email = $row['email'];
              $no_telepon = $row['no_telepon'];
              $alamat = $row['alamat'];
              $tgl_pengajuan = $row['tgl_pengajuan'];
              $statuspengajuan = $row['statuspengajuan'];
              $statuspengajuangudang = $row['statuspengajuangudang'];

              echo "<tr>
                    <form action='aksitambahlaporan.php' method='POST'>
                    <td>$n</td>
                    <input type='text' id='id_laporan' name='id_laporan' value='$id_laporan_baru' hidden />
                    <td>$id_pemesanan</td>
                    <td>$kode_produk</td>
                    <td>$nama_produk</td>
                    <td>$qty</td>
                    <td>RP. $total_harga</td>
                    <td>$nama_customer</td>
                    <td>$email</td>
                    <td>$no_telepon</td>
                    <td>$alamat</td>
                    <td>$tgl_pengajuan</td>
                    <td>$statuspengajuan</td>
                    <td>$statuspengajuangudang</td>
                    <td><input type='text' id='ekspedisi' name='ekspedisi' required /></td>
                    <td><input type='date' id='tgl_pengiriman' name='tgl_pengiriman' required /></td>
                    <td>
                        <input type='hidden' name='id_pemesanan' value='$id_pemesanan'>
                        <input type='hidden' name='kode_produk' value='$kode_produk'>
                        <input type='text' id='id_sales' name='id_sales' value='$id_sales' hidden />
                        <input type='text' id='id_pegawai' name='id_pegawai' value='$id_pegawai' hidden />
                        <button type='submit'>Simpan</button>
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
    <script src="../../js/script.js"></script>
</body>
</html>