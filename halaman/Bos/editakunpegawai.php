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
if (isset($_GET['id_users'])) {
    $id_users = $_GET['id_users'];

    // Mengambil data pengguna dari database
    $sql = "SELECT * FROM users_pegawai WHERE id_users = '$id_users'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);

    // Pastikan data ditemukan
    if (!$data) {
        echo "Data tidak ditemukan.";
        exit;
    }

    // Mendapatkan hak akses dari data pengguna
    $hak_akses = $data['hak_akses']; // Pastikan kolom ini ada dalam tabel users_pegawai
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
    <title>Edit Akun Pegawai</title>
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
                <li><a href="biosales.php" >Tambah Sales</a></li>
                <li><a href="biopegawai.php" class="active" >Tambah Pegawai</a></li>
                <li><a href="../login.php">Keluar</a></li>
              </ul>
          </nav>
      </div>

      <div class="main-content">
          <section id="form-pegawai">
          <form action="aksieditakunpegawai.php" method="post">
                <input type="hidden" name="id_users" value="<?php echo $id_users; ?>">
                <div class="form-group">
                <div class="form-row">
                    <label for="id_pegawai">ID Pegawai</label>
                    <input type="text" id="id_pegawai" name="id_pegawai" value="<?php echo $data['id_pegawai']; ?>" readonly />
                </div>
                <div class="form-row">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?php echo $data['username']; ?>" required />
                </div>
                <div class="form-row">
                    <label for="password">Password</label>
                    <input type="text" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengganti" />
                </div>
                <div class="form-row">
                    <label for="hakakses">Hak Akses</label>
                    <select id="hakakses" name="hak_akses">
                        <option value="Admin" <?php echo ($hak_akses == 'Admin' ? 'selected' : ''); ?>>Admin</option>
                        <option value="SCM" <?php echo ($hak_akses == 'SCM' ? 'selected' : ''); ?>>SCM</option>
                        <option value="Kepala_Gudang" <?php echo ($hak_akses == 'Kepala_Gudang' ? 'selected' : ''); ?>>Kepala Gudang</option>
                    </select>
                </div>
                </div>
                <div class="modal1-footer">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

          </section>
      </div>
      <script src="../../js/script.js"></script>
</body>

</html>
