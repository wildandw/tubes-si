<?php
session_start(); // Memulai session

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['username']) || !isset($_SESSION['id_sales'])) {
    header("Location: ../login.php");
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/index.css" />
    <title>Kepala Gudang</title>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="../../img/logo.png" alt="Logo">
        </div>
        <div class="user-info">
          <h3>KEPALA GUDANG</h3>
        </div>
        <nav class="nav-menu">
            <ul>
              <li><a href="#data-pengajuan.php " class="active" >Data Pengajuan Barang</a></li>
              <li><a href="produk.php ">Produk</a></li>
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
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require("../../koneksi.php");
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
                  <form action='aksitambahgudang.php' method='POST'>
                  <td>$n</td>
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
                  <td><select id='statuspengajuangudang' name='statuspengajuangudang'>
                  <option value='Disetujui' " . ($statuspengajuangudang == 'Disetujui' ? 'selected' : '') . ">Disetujui</option>
                  <option value='Tidak disetujui' " . ($statuspengajuangudang == 'Tidak disetujui' ? 'selected' : '') . ">Tidak disetujui</option>
                  <option value='Sedang diproses' " . ($statuspengajuangudang == 'Sedang diproses' ? 'selected' : '') . ">Sedang diproses</option>
                </select></td>
                  <td>
                      <input type='hidden' name='id_pemesanan' value='$id_pemesanan'>
                      <button type='submit'>Simpan</button>
                  </td>
                  </form>
              </tr>";
            $n++;
          }
          ?>
        </tbody>
          
            </form>>
        </tbody>
      </table>
    </section>
    </div>
</body>
</html>