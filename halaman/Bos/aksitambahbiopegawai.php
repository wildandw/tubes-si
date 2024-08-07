<?php
// mengambil atau mengimpor koneksi 
require("../../koneksi.php");
// metode post digunakan untuk mengirimkan data ke server
$id_pegawai      = $_POST['id_pegawai'];
$nama_pegawai      = $_POST['nama_pegawai'];
$jabatan      = $_POST['jabatan'];
$email        = $_POST['email'];
$no_telepon           = $_POST['no_telepon'];
$alamat           = $_POST['alamat'];

// jika kode produk tidak kosong insert atau tambahkan ke dalam tabel produk
if ($id_pegawai != '') {
    $sql = "INSERT into pegawai values ('$id_pegawai','$nama_pegawai', '$jabatan', '$email', '$no_telepon', '$alamat')";
    $hasil = mysqli_query($conn, $sql);

    // ini untuk membuat kode produk otomatis dengan berawalan prod dan ditambahkan urutan yg dibuat dari 000 dan terus bertambah seiring bertambahnya data
    $query = mysqli_query($conn, "SELECT max(id_pegawai) as kodeTerbesar FROM pegawai");
    $data = mysqli_fetch_array($query);
    $id_pegawai = $data['kodeTerbesar'];
    $urutan = (int) substr($id_pegawai, 3, 3);
    $urutan++;
    $huruf = "PGW";
    $id_pegawai = $huruf . sprintf("%03s", $urutan);
    // memunculkan informasi bahwa data berhasil ditambahkan dengan menggunakn echo
    echo "Produk telah ditambahkan";
    echo "<script type='text/javascript'>alert('Data dengan ID Pegawai $id_pegawai telah berhasil ditambahkan');document.location='tambahpegawai.php';</script> ";
} else {
    // jika kodeproduk terisi halaman langsung berpindah ke produk.php dan beri informasi bahwa data tidak boleh ada yg kosong
    echo "<script type='text/javascript'>alert('Data tidak boleh ada yang kosong');document.location='master.php';</script> ";
}
