<?php
require("../../koneksi.php");
$id_laporan = $_POST['id_laporan'];
$id_pemesanan = $_POST['id_pemesanan'];
$id_sales = $_POST['id_sales'];
$id_pegawai = $_POST['id_pegawai'];
$kode_produk = $_POST['kode_produk'];
$tgl_pengiriman= $_POST['tgl_pengiriman'];
$ekspedisi= $_POST['ekspedisi'];


// Memeriksa apakah kode produk tidak kosong
if ($id_laporan != '') {
    // Mengambil ID terakhir dari histori_pengajuan
    $query = mysqli_query($conn, "SELECT MAX(id_laporan) AS kodeTerbesar FROM laporan_pengajuan");
    $data = mysqli_fetch_array($query);
    $id_laporan_terakhir = $data['kodeTerbesar'];

    if ($id_laporan_terakhir) {
        // Mengambil urutan dari ID terakhir
        $urutan = (int) substr($id_laporan_terakhir, 3, 3);
        $urutan++;
    } else {
        // Jika tidak ada ID terakhir, mulai dari 1
        $urutan = 1;
    }

    // Membuat ID baru
    $huruf = "LAP";
    $id_laporan_baru = $huruf . sprintf("%03s", $urutan);

    // Menyisipkan data ke tabel histori_pengajuan dengan ID baru
    $sql = "INSERT INTO laporan_pengajuan (id_laporan, id_pemesanan, id_sales, id_pegawai, kode_produk, tgl_pengiriman, ekspedisi)
            VALUES ('$id_laporan_baru', '$id_pemesanan', '$id_sales', '$id_pegawai', '$kode_produk', '$tgl_pengiriman', '$ekspedisi')";
    $laporan = mysqli_query($conn, $sql);

    
    echo "<script type='text/javascript'>alert('Data dengan Id Pemesanan $id_pemesanan telah berhasil ditambahkan');document.location='berandaadmin.php';</script>";
   
} else {
    // Jika kode_produk kosong
    echo "<script type='text/javascript'>alert('Data tidak boleh ada yang kosong');document.location='berandaadmin.php';</script>";
}