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
              <li><a href="#beranda-utama" class="active">Beranda Utama</a></li>
              <li><a href="biosales.php" >Tambah Sales</a></li>
              <li><a href="biopegawai.php" >Tambah Pegawai</a></li>
              <li><a href="../login.php">Keluar</a></li>
            </ul>
        </nav>
    </div>

    <div class="main-content">
      <section id="daftar-sales">
      <h1>Akun Sales</h1>
        <table class="product-table">
          <thead>
            <tr>
              <th>No</th>
              <th>ID Sales</th>
              <th>Username</th>
              <th>Password</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            require("../../koneksi.php");
            $sql = "SELECT * FROM users_sales"; 

            $hasil = mysqli_query($conn, $sql);
            $n = 1;

            while ($row = mysqli_fetch_row($hasil)) {
              list($id_users, $id_sales, $username, $password,) = $row;
              echo "<tr>
                    <td>$n</td>
                    <td>$id_sales</td>
                    <td>$username</td>
                    <td>$password</td>
                    <td>
                        <button class='edit-btn'><a href='editakunsales.php?id_users=$id_users'><i class='bx bx-edit'></i></a></button>
                        <button class='delete-btn'><a href='aksihapusakunsales.php?id_users=$id_users' onclick=\"return confirm('Anda Yakin mau menghapus data ini?')\"><i class='bx bx-trash'></i></a></button>
                    </td>
                </tr>";
              $n++;
            }
            ?>
          </tbody>
        </table>
      </section>

    <section class="daftar-pegawai">
    <h1>Akun Pegawai</h1>
    <table class="product-table">
        <thead>
          <tr>
            <th>No</th>
            <th>ID Pegawai</th>
            <th>Username</th>
            <th>Password</th>
            <th>Hak Akses</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require("../../koneksi.php");
          $sql = "SELECT * FROM users_pegawai"; 

          $hasil = mysqli_query($conn, $sql);
          $n = 1;

          while ($row = mysqli_fetch_row($hasil)) {
            list($id_users, $id_sales, $username, $password, $hak_akses) = $row;
            echo "<tr>
                  <td>$n</td>
                  <td>$id_sales</td>
                  <td>$username</td>
                  <td>$password</td>
                  <td>$hak_akses</td>
                  <td>
                      <button class='edit-btn'><a href='editakunpegawai.php?id_users=$id_users'><i class='bx bx-edit'></i></a></button>
                      <button class='delete-btn'><a href='aksihapusakunpegawai.php?id_users=$id_users' onclick=\"return confirm('Anda Yakin mau menghapus data ini?')\"><i class='bx bx-trash'></i></a></button>
                  </td>
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
