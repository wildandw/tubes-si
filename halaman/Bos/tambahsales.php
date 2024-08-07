<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../css/index.css" />
  <link rel="icon" type="image/x-icon" href="img/icon.png" />
  <title>Dashboard Admin</title>
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
                <li><a href="biopegawai.php" >Tambah Pegawai</a></li>
                <li><a href="../login.php">Keluar</a></li>
              </ul>
          </nav>
      </div>

      <div class="main-content">
        <section id="form-sales">
        <form id="formTambahProduk" action="aksitambahsales.php" method="post">
              <div class="form-group">
                <div class="form-row">
                  <label for="id_sales">ID Sales</label>
                  <?php
                  require("../../koneksi.php");
                  // membuat kodeproduk otomatis ketika kodeproduk terbesar diambil maka tambah urutannya dan diawali dengan huruf PROD
                  $query = mysqli_query($conn, "SELECT max(id_sales) as kodeTerbesar FROM users_sales");
                  $data = mysqli_fetch_array($query);
                  $id_sales = $data['kodeTerbesar'];
                  $urutan = (int) substr($id_sales, 4);
                  $urutan++;
                  $id_sales = "SLS" . sprintf("%03s", $urutan);
                  ?>
                  <input type="text" id="id_sales" name="id_sales" value="<?php echo $id_sales; ?>" readonly />
                </div>
                <div class="form-row">
                  <label for="username">Username</label>
                  <input type="text" id="username" name="username" required />
                </div>
                <div class="form-row">
                  <label for="password">Password</label>
                  <input type="password" id="password" name="password" required />
                </div>
                
              </div>
              <div class="modal1-footer">
                <button type="reset" class="btn btn-secondary">Reset</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
        </section>
      </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
document.getElementById('hak_akses').addEventListener('change', function() {
  const hak_akses = this.value;
  const idUsersField = document.getElementById('id_users');
  let prefix = '';

  // Menentukan prefix berdasarkan hak akses
  if (hak_akses === 'Admin' || hak_akses === 'SCM' || hak_akses === 'Kepala_Gudang') {
    kode = 'PGW';
  } else if (hak_akses === 'Sales') {
    kode = 'SLS';
  }

  // Mengambil ID pengguna otomatis dari server
  fetch(`aksitambahakun.php?kode=${kode}`)
    .then(response => response.text())
    .then(data => {
      idUsersField.value = data; // Mengisi ID pengguna ke field
    });
});
</script>
<script src="../../js/script.js"></script>

</body>

</html>
