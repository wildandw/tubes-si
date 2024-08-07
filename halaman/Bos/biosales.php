<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../css/index.css" />
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
                <li><a href="biosales.php" class="active" >Tambah Sales</a></li>
                <li><a href="biopegawai.php" >Tambah Pegawai</a></li>
                <li><a href="../login.php">Keluar</a></li>
              </ul>
          </nav>
      </div>

      <div class="main-content">
      <section id="daftar-sales">
      <h1>Biodata Sales</h1>
        <h5>*Hapus akun terlebih dahulu, Kemudian bisa menghapus biodata anda</h5>
        <table class="product-table">
        <thead>
          <tr>
            <th>No</th>
            <th>ID Sales</th>
            <th>Nama Sales</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>No.Telepon</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require("../../koneksi.php");
          $sql = "SELECT * FROM sales"; 

          $hasil = mysqli_query($conn, $sql);
          $n = 1;

          while ($row = mysqli_fetch_row($hasil)) {
            list( $id_sales, $nama_sales, $email, $alamat, $no_telepon) = $row;
            echo "<tr>
                  <td>$n</td>
                  <td>$id_sales</td>
                  <td>$nama_sales</td>
                  <td>$email</td>
                  <td>$alamat</td>
                  <td>$no_telepon</td>
                  <td>
                      <button class='edit-btn'><a href='editbiosales.php?id_sales=$id_sales'><i class='bx bx-edit'></i></a></button>
                      <button class='delete-btn'><a href='aksihapusbiosales.php?id_sales=$id_sales' onclick=\"return confirm('Hapus akun anda terlebih dahulu! Anda Yakin mau menghapus data ini?')\"><i class='bx bx-trash'></i></a></button> 
                  </td>
              </tr>";
            $n++;
          }
          ?>
        </tbody>
      </table>
      </section>

      <section id="form-penambahan">
        <h1>Formulir Penambahan Sales</h1>
      <form id="formTambahProduk" action="aksitambahbiosales.php" method="post">
              <div class="form-group">
                <div class="form-row">
                  <label for="id_sales">ID Sales</label>
                  <?php
                  require("../../koneksi.php");
                  // membuat kodeproduk otomatis ketika kodeproduk terbesar diambil maka tambah urutannya dan diawali dengan huruf PROD
                  $query = mysqli_query($conn, "SELECT max(id_sales) as kodeTerbesar FROM sales");
                  $data = mysqli_fetch_array($query);
                  $id_sales = $data['kodeTerbesar'];
                  $urutan = (int) substr($id_sales, 4);
                  $urutan++;
                  $id_sales = "SLS" . sprintf("%03s", $urutan);
                  ?>
                  <input type="text" id="id_sales" name="id_sales" value="<?php echo $id_sales; ?>" readonly />
                </div>
                <div class="form-row">
                  <label for="nama_sales">Nama Sales</label>
                  <input type="text" id="nama_sales" name="nama_sales" required />
                </div>
                <div class="form-row">
                  <label for="email">Email</label>
                  <input type="email" id="email" name="email" required />
                </div>
                <div class="form-row">
                  <label for="alamat">Alamat</label>
                  <input type="textarea" id="alamat" name="alamat" required />
                </div>
                <div class="form-row">
                  <label for="no_telepon">No Telepon</label>
                  <input type="text" id="no_telepon" name="no_telepon" required />
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
