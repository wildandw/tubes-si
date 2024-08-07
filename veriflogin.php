<?php
session_start(); // Memulai session
// mengambil atau mengimpor koneksi 
require 'koneksi.php';

// mengirim username dan password ke server
$username = $_POST['username'];
$password = $_POST['password'];

// kemudian mengambil data dari yang sudah diinputkan dan dicocokkan dengan database tabel users
$sql = "SELECT * FROM users_pegawai WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

$sql2 = "SELECT * FROM users_sales WHERE username = '$username' AND password = '$password' ";
$result2 = $conn->query($sql2);

$sql3 = "SELECT * FROM tabel_master WHERE username = '$username' AND password = '$password'";
$result3 = $conn->query($sql3);

if ($result->num_rows == 1) {


    $user_pegawai = $result2->fetch_assoc();
        $id_pegawai = $user_pegawai['id_pegawai'];
        
        // Ambil detail pegawai dari tabel pegawai
        $sql_pegawai = "SELECT * FROM pegawai WHERE id_pegawai = '$id_pegawai'";
        $result_pegawai = $conn->query($sql_pegawai);
        if ($result_pegawai->num_rows == 1) {
            $pegawai_data = $result_pegawai->fetch_assoc();
            $_SESSION['id_pegawai'] = $pegawai_data['id_pegawai'];
        }
    // jika result ada dan sesuai masuk ke halaman dashbord
    $user = $result->fetch_assoc();
    // Verifikasi password (Anda harus memastikan bahwa password sudah di-hash saat penyimpanan)
        // jika result ada dan sesuai, cek hak akses
        $_SESSION['username'] = $username;
        $_SESSION['hak_akses'] = $user['hak_akses'];

        if ($user['hak_akses'] == 'Admin') {
            header("Location: halaman/Admin Gudang/berandaadmin.php");
        } elseif ($user['hak_akses'] == 'SCM') {
            header("Location: halaman/SCM/berandascm.php");
        } elseif ($user['hak_akses'] == 'Kepala_Gudang') {
            header("Location: halaman/Kepala Gudang/beranda_kplgudang.php");
        } else {
            echo "<script type='text/javascript'>alert('Hak akses tidak valid!');document.location='halaman/login.php';</script>";
        }
 }else if ($result2->num_rows == 1 ){

    $user_sales = $result2->fetch_assoc();
        $id_sales = $user_sales['id_sales'];
        
        // Ambil detail sales dari tabel sales
        $sql_sales = "SELECT * FROM sales WHERE id_sales = '$id_sales'";
        $result_sales = $conn->query($sql_sales);
        if ($result_sales->num_rows == 1) {
            $sales_data = $result_sales->fetch_assoc();
            $_SESSION['id_sales'] = $sales_data['id_sales'];
        }


    $_SESSION['username'] = $username;
    $_SESSION['password'] = $user['password'];

    header("Location: halaman/Sales/berandasales.php");
 }else if ($result3->num_rows == 1 ){

    $_SESSION['username'] = $username;
    $_SESSION['password'] = $user['password'];

    header("Location: halaman/Bos/master.php");

 } else {
    // jika salah tampilkan alert username atau password salah 
    echo "<script type='text/javascript'>alert('Username atau password salah!');document.location='halaman/login.php';</script> ";
}