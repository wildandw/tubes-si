<?php
require("../../koneksi.php");
$id_sales = $_POST['id_sales'];
$id_pemesanan = $_POST['id_pemesanan'];
$total_harga = $_POST['total_harga'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$no_telepon = $_POST['no_telepon'];
$kode_produk = $_POST['kode_produk'];
$qty = $_POST['qty'];
$nama_customer = $_POST['nama_customer'];


// Mendapatkan tanggal saat ini

$tgl_pengajuan= $_POST['tgl_pengajuan'];

// Menetapkan status default

$statuspengajuan = $_POST['statuspengajuan'];
$statuspengajuangudang = $_POST['statuspengajuangudang'];
// Memeriksa apakah kode produk tidak kosong
if ($kode_produk != '') {
    // Mengambil ID terakhir dari histori_pengajuan
    $query = mysqli_query($conn, "SELECT MAX(id_pemesanan) AS kodeTerbesar FROM histori_pengajuan");
    $data = mysqli_fetch_array($query);
    $id_pemesanan_terakhir = $data['kodeTerbesar'];

    if ($id_pemesanan_terakhir) {
        // Mengambil urutan dari ID terakhir
        $urutan = (int) substr($id_pemesanan_terakhir, 3, 3);
        $urutan++;
    } else {
        // Jika tidak ada ID terakhir, mulai dari 1
        $urutan = 1;
    }

    // Membuat ID baru
    $huruf = "PSN";
    $id_pemesanan_baru = $huruf . sprintf("%03s", $urutan);

    // Menyisipkan data ke tabel histori_pengajuan dengan ID baru
    $sql = "INSERT INTO histori_pengajuan (id_pemesanan, id_sales, kode_produk, qty,total_harga, nama_customer, email, no_telepon, alamat, tgl_pengajuan, statuspengajuan,statuspengajuangudang)
            VALUES ('$id_pemesanan_baru', '$id_sales', '$kode_produk', '$qty','$total_harga', '$nama_customer', '$email', '$no_telepon', '$alamat', '$tgl_pengajuan', '$statuspengajuan','$statuspengajuangudang')";
    $hasil = mysqli_query($conn, $sql);

    if ($hasil) {
        // Mengambil harga produk dari tabel produk
        $query = mysqli_query($conn, "SELECT harga FROM produk WHERE kode_produk = '$kode_produk'");
        $data = mysqli_fetch_array($query);
        $harga = $data['harga'];

        // Menghitung total_harga
        $total_harga = $qty * $harga;

        // Memperbarui total_harga di tabel histori_pengajuan
        $sql_update = "UPDATE histori_pengajuan SET total_harga = $total_harga WHERE id_pemesanan = '$id_pemesanan_baru'";
        mysqli_query($conn, $sql_update);

        // Menampilkan informasi berhasil ditambahkan
        echo "Produk telah ditambahkan";
        echo "<script type='text/javascript'>alert('Data dengan kode produk $kode_produk telah berhasil ditambahkan');document.location='berandasales.php';</script>";
    } else {
        echo "<script type='text/javascript'>alert('Gagal menambahkan data');document.location='berandasales.php';</script>";
    }
} else {
    // Jika kode_produk kosong
    echo "<script type='text/javascript'>alert('Data tidak boleh ada yang kosong');document.location='berandasales.php';</script>";
}