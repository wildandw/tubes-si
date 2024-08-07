<?php
session_start(); // Memulai session

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['username']) || !isset($_SESSION['id_sales'])) {
    header("Location: ../login.php");
    exit;
}

// Mengambil data dari sesi
$id_sales = $_SESSION['id_sales'];

// Koneksi ke database
require("../../koneksi.php");

// Mengambil nama lengkap sales berdasarkan id_sales
$sql_nama_sales = "SELECT s.nama_sales 
                   FROM sales s 
                   INNER JOIN users_sales us ON s.id_sales = us.id_sales 
                   WHERE us.id_sales = ?";
$stmt = $conn->prepare($sql_nama_sales);
$stmt->bind_param("s", $id_sales);
$stmt->execute();
$stmt->bind_result($nama_sales);
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
            <h3>SALES</h3>
        </div>
        <nav class="nav-menu">
            <ul>
              <li><a href="#history-pengajuan" class="active">History Pengajuan</a></li>
              <li><a href="#form-pengajuan" >Form Pengajuan Barang</a></li>
              <li><a href="../login.php">Keluar</a></li>
            </ul>
        </nav>
    </div>
    <div class="main-content">
        <section id="history-pengajuan">
            <h1>History Pengajuan</h1>
            <table product-table>
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Total Harga</th>
                    <th>Nama Customer</th>
                    <th>Email</th>
                    <th>No Telepon</th>
                    <th>Alamat</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Status SCM</th>
                    <th>Status kepala gudang</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT h.kode_produk, p.nama_produk, h.total_harga, h.nama_customer, h.email, h.no_telepon, h.alamat, h.tgl_pengajuan, h.statuspengajuan, h.statuspengajuangudang
                          FROM tubessi.histori_pengajuan h
                          INNER JOIN tubessi.produk p ON h.kode_produk = p.kode_produk"; 
                  
                  $hasil = mysqli_query($conn, $sql);
                  $n = 1;

                  while ($row = mysqli_fetch_row($hasil)) {
                    list($kode_produk, $nama_produk, $total_harga, $nama_customer, $email, $no_telepon, $alamat, $tgl_pengajuan, $statuspengajuan, $statuspengajuangudang) = $row;
                    echo "<tr>
                          <td>$n</td>
                          <td>$kode_produk</td>
                          <td>$nama_produk</td>
                          <td>RP. $total_harga</td>
                          <td>$nama_customer</td>
                          <td>$email</td>
                          <td>$no_telepon</td>
                          <td>$alamat</td>
                          <td>$tgl_pengajuan</td>
                          <td>$statuspengajuan</td>
                          <td>$statuspengajuangudang</td>
                      </tr>";
                    $n++;
                  }
                  ?>
                </tbody>
            </table>
        </section>
        <section id="form-pengajuan">
            <h1>Formulir Pengajuan Barang</h1>
            <form id="formTambahProduk" action="aksitambahpemesanan.php" method="post">
                <label for="id_pemesanan">ID Pemesanan</label>
                <?php
                  // membuat kodeproduk otomatis ketika kodeproduk terbesar diambil maka tambah urutannya dan diawali dengan huruf PSN
                  $query = mysqli_query($conn, "SELECT max(id_pemesanan) as kodeTerbesar FROM histori_pengajuan");
                  $data = mysqli_fetch_array($query);
                  $id_pemesanan = $data['kodeTerbesar'];
                  $urutan = (int) substr($id_pemesanan, 3);
                  $urutan++;
                  $id_pemesanan = "PSN" . sprintf("%03s", $urutan);
                ?>
                <input type="text" id="id_pemesanan" name="id_pemesanan" value="<?php echo $id_pemesanan; ?>" readonly />
                <label for="id_sales">Id Sales</label>
                <input type="text" id="id_sales" name="id_sales" value="<?php echo htmlspecialchars($id_sales); ?>" readonly />
                <label for="Produk">Produk</label>
                <select name="kode_produk" id="kode_produk" required>
                  <option value="P11">CANCIMEN EP</option>
                  <option value="P12">CANCIMEN TY</option>
                  <option value="P21">SRINAGA CHILI 135ML</option>
                  <option value="P22">SRINAGA CHILI 200GR</option>
                  <option value="P23">SRINAGA TOMAT 135ML</option>
                  <option value="P24">SRINAGA TOMAT 200GR</option>
                </select>
                <label for="qty">Qty</label>
                <input type="text" id="qty" name="qty" required />
                <label for="nama_customer">Nama Customer</label>
                <input type="text" id="nama_customer" name="nama_customer">
                <label for="email">Email</label>
                <input type="email" id="email" name="email">
                <label for="no_telepon">Nomor Telepon</label>
                <input type="tel" id="no_telepon" name="no_telepon">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat"></textarea>
                <label for="tgl_pengajuan">Tanggal Pengajuan</label>
                <input type="date" id="tgl_pengajuan" name="tgl_pengajuan" required />
                <input type="text" id="statuspengajuan" name="statuspengajuan" hidden value="Sedang diproses" required />
                <input type="text" id="statuspengajuangudang" name="statuspengajuangudang" hidden value="Sedang diproses" required />
                <button type="submit">Submit</button>
            </form>
        </section>
    </div>
    <script src="../../js/script.js"></script>
</body>
</html>
