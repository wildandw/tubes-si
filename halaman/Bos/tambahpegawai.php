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
      <section id="form-pegawai">
      <form id="formTambahProduk" action="aksitambahpegawai.php" method="post">
              <div class="form-group">
                <div class="form-row">
                  <label for="id_pegawai">ID Pegawai</label>
                  <?php
                  require("../../koneksi.php");
                  // membuat kodeproduk otomatis ketika kodeproduk terbesar diambil maka tambah urutannya dan diawali dengan huruf PROD
                  $query = mysqli_query($conn, "SELECT max(id_pegawai) as kodeTerbesar FROM users_pegawai");
                  $data = mysqli_fetch_array($query);
                  $id_pegawai = $data['kodeTerbesar'];
                  $urutan = (int) substr($id_pegawai, 4);
                  $urutan++;
                  $id_pegawai = "PGW" . sprintf("%03s", $urutan);
                  ?>
                  <input type="text" id="id_pegawai" name="id_pegawai" value="<?php echo $id_pegawai; ?>" readonly />
                </div>
                <div class="form-row">
                  <label for="username">Username</label>
                  <input type="text" id="username" name="username" required />
                </div>
                <div class="form-row">
                  <label for="password">Password</label>
                  <input type="password" id="password" name="password" required />
                </div>
                <div class="form-row">
                <label for="hak_akses">Hak Akses</label><br>
                <select name="hak_akses" id="hak_akses" required>
                    <option value="Admin">Admin</option>
                    <option value="SCM">SCM</option>
                    <option value="Kepala_Gudang">Kepala Gudang</option>
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
