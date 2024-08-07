<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username']) || !isset($_SESSION['id_sales']) || !isset($_SESSION['id_pegawai'])) {
    header("Location: ../login.php");
    exit;
}

// Koneksi ke database
require("../../koneksi.php");

// Memeriksa apakah ada ID pengguna yang diterima
if (isset($_GET['id_sales'])) {
    $id_sales = $_GET['id_sales'];

    // Mengambil data pengguna dari database
    $sql = "SELECT * FROM sales WHERE id_sales = '$id_sales'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);

    // Pastikan data ditemukan
    if (!$data) {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    echo "ID pengguna tidak diberikan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../css/index.css" />
    <link rel="icon" type="image/x-icon" href="img/icon.png" />
    <title>Edit Biodata Sales</title>
</head>

<body>
<div class="sidebar">
          <div class="logo">
              <img src="../../img/logo.png" alt="Logo">
          </div>
          <div class="user-info">
            <h3>MASTER</h3>
          </div>
          <nav class="nav-menu">
              <ul>
                <li><a href="master.php" >Beranda Utama</a></li>
                <li><a href="biosales.php" class="active" >Tambah Sales</a></li>
                <li><a href="biopegawai.php"  >Tambah Pegawai</a></li>
                <li><a href="../login.php">Keluar</a></li>
              </ul>
          </nav>
      </div>

      <div class="main-content">
          <section id="form-pegawai">
          <form action="aksieditbiosales.php" method="post">
                <div class="form-group">
                    <div class="form-row">
                        <label for="id_sales">ID Sales</label>
                        <input type="text" id="id_sales" name="id_sales" value="<?php echo $data['id_sales']; ?>" readonly />
                    </div>
                    <div class="form-row">
                        <label for="nama_sales">Nama Sales</label>
                        <input type="text" id="nama_sales" name="nama_sales" value="<?php echo $data['nama_sales']; ?>" required />
                    </div>
                    <div class="form-row">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" value="<?php echo $data['email']; ?>" required />
                    </div>
                    <div class="form-row">
                        <label for="alamat">Alamat</label>
                        <input type="text" id="alamat" name="alamat" value="<?php echo $data['alamat']; ?>" required />
                    </div>
                    <div class="form-row">
                        <label for="no_telepon">No Telepon</label>
                        <input type="text" id="no_telepon" name="no_telepon" value="<?php echo $data['no_telepon']; ?>" required />
                    </div>
                </div>
                <div class="modal1-footer">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

            <div class="form-group">
      </div>
    </div>
    <script src="../../js/script.js"></script>
</body>

</html>
