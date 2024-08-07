<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../css/index.css" />
  <link rel="icon" type="image/x-icon" href="img/icon.png" />
  <title>Master</title>
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
                <li><a href="biosales.php"  >Tambah Sales</a></li>
                <li><a href="biopegawai.php" class="active" >Tambah Pegawai</a></li>
                <li><a href="../login.php">Keluar</a></li>
              </ul>
          </nav>
      </div>

      <div class="main-content">
        <section id="daftar-pegawai">
        <h1>Biodata Pegawai</h1>
          <h5>*Hapus akun terlebih dahulu, Kemudian bisa menghapus biodata anda</h5>
          <table class="product-table">
        <thead>
          <tr>
            <th>No</th>
            <th>ID Pegawai</th>
            <th>Nama Pegawai</th>
            <th>Jabatan</th>
            <th>Email</th>
            <th>No.Telepon</th>
            <th>Alamat</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require("../../koneksi.php");
          $sql = "SELECT * FROM pegawai"; 

          $hasil = mysqli_query($conn, $sql);
          $n = 1;

          while ($row = mysqli_fetch_row($hasil)) {
            list( $id_pegawai, $nama_pegawai, $jabatan, $email, $no_telepon, $alamat) = $row;
            echo "<tr>
                  <td>$n</td>
                  <td>$id_pegawai</td>
                  <td>$nama_pegawai</td>
                  <td>$jabatan</td>
                  <td>$email</td>
                  <td>$no_telepon</td>
                  <td>$alamat</td>
                  <td>
                      <button class='edit-btn'><a href='editbiopegawai.php?id_pegawai=$id_pegawai'><i class='bx bx-edit'></i></a></button>
                      <button class='delete-btn'><a href='aksihapusbiopegawai.php?id_pegawai=$id_pegawai' onclick=\"return confirm('Anda Yakin mau menghapus data ini?')\"><i class='bx bx-trash'></i></a></button>
                  </td>
              </tr>";
            $n++;
          }
          ?>
        </tbody>
      </table>
        </section>

        <section id="form-penambahan">
        <form id="formTambahProduk" action="aksitambahbiopegawai.php" method="post">
              <div class="form-group">
                <div class="form-row">
                  <label for="id_pegawai">ID Pegawai</label>
                  <?php
                  require("../../koneksi.php");
                  // membuat kodeproduk otomatis ketika kodeproduk terbesar diambil maka tambah urutannya dan diawali dengan huruf PROD
                  $query = mysqli_query($conn, "SELECT max(id_pegawai) as kodeTerbesar FROM pegawai");
                  $data = mysqli_fetch_array($query);
                  $id_pegawai = $data['kodeTerbesar'];
                  $urutan = (int) substr($id_pegawai, 4);
                  $urutan++;
                  $id_pegawai = "PGW" . sprintf("%03s", $urutan);
                  ?>
                  <input type="text" id="id_pegawai" name="id_pegawai" value="<?php echo $id_pegawai; ?>" readonly />
                </div>
                <div class="form-row">
                  <label for="nama_pegawai">Nama Pegawai</label>
                  <input type="text" id="nama_pegawai" name="nama_pegawai" required />
                </div>
                <div class="form-row">
                <label for="jabatan">Jabatan</label><br>
                <select name="jabatan" id="jabatan" required>
                    <option value="Admin">Admin</option>
                    <option value="SCM">SCM</option>
                    <option value="Kepala_Gudang">Kepala Gudang</option>
                </select>
                </div>
                <div class="form-row">
                  <label for="email">Email</label>
                  <input type="email" id="email" name="email" required />
                </div>
                <div class="form-row">
                  <label for="no_telepon">No Telepon</label>
                  <input type="text" id="no_telepon" name="no_telepon" required />
                </div>
                <div class="form-row">
                  <label for="alamat">Alamat</label>
                  <input type="textarea" id="alamat" name="alamat" required />
                </div>
              </div>
              <div class="modal1-footer">
                <button type="reset" class="btn btn-secondary">Reset</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
        </section>
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
