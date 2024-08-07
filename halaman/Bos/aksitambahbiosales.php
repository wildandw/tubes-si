<?php
// mengambil atau mengimpor koneksi 
require("../../koneksi.php");
// metode post digunakan untuk mengirimkan data ke server
$id_sales      = $_POST['id_sales'];
$nama_sales      = $_POST['nama_sales'];
$email        = $_POST['email'];
$alamat           = $_POST['alamat'];
$no_telepon           = $_POST['no_telepon'];

// jika kode produk tidak kosong insert atau tambahkan ke dalam tabel produk
if ($id_sales != '') {
    $sql = "INSERT into sales values ('$id_sales','$nama_sales','$email','$alamat', '$no_telepon') ";
    $hasil = mysqli_query($conn, $sql);

    // ini untuk membuat kode produk otomatis dengan berawalan prod dan ditambahkan urutan yg dibuat dari 000 dan terus bertambah seiring bertambahnya data
    $query = mysqli_query($conn, "SELECT max(id_sales) as kodeTerbesar FROM sales");
    $data = mysqli_fetch_array($query);
    $id_sales = $data['kodeTerbesar'];
    $urutan = (int) substr($id_sales, 3, 3);
    $urutan++;
    $huruf = "SLS";
    $id_sales = $huruf . sprintf("%03s", $urutan);
    // memunculkan informasi bahwa data berhasil ditambahkan dengan menggunakn echo
    echo "Produk telah ditambahkan";
    echo "<script type='text/javascript'>alert('Data dengan Id Sales $id_sales telah berhasil ditambahkan');document.location='tambahsales.php';</script> ";
} else {
    // jika kodeproduk terisi halaman langsung berpindah ke produk.php dan beri informasi bahwa data tidak boleh ada yg kosong
    echo "<script type='text/javascript'>alert('Data tidak boleh ada yang kosong');document.location='master.php';</script> ";
}
