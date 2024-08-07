<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/struk.css"> <!-- Pastikan Anda mengatur path CSS yang sesuai -->
    <title>Surat Jalan</title>
    <link rel="icon" type="image/x-icon" href="img/icon.png" />
</head>

<center>
    <!-- digunakan untuk mencetak struk -->

    <body onload="window.print(); window.onafterprint = window.close;  ">
        <div class="struk-container">
            <div class="header">
                <h1>Surat Jalan</h1>
            </div>
            <div class="content">
                <div class="detail">
                <?php
                        include '../../koneksi.php';

                        $query = mysqli_query($conn, "SELECT lp.id_laporan, lp.id_pemesanan, lp.id_sales, lp.id_pegawai, lp.kode_produk, p.nama_produk, p.harga, hp.qty, lp.tgl_pengiriman, lp.ekspedisi
                FROM laporan_pengajuan lp
                INNER JOIN produk p ON lp.kode_produk = p.kode_produk
                INNER JOIN histori_pengajuan hp ON lp.id_pemesanan = hp.id_pemesanan");
                        $totalBayar = 0;
                        $no = 1;

                        while ($row = mysqli_fetch_assoc($query)) {
                            $subtotal = $row['harga'] * $row['qty'];
                            $totalBayar += $subtotal;

                            $id_pemesanan = $row['id_pemesanan'];
                            $id_sales = $row['id_sales'];
                            $id_pegawai = $row['id_pegawai'];
                            $tgl_pengiriman = $row['tgl_pengiriman'];
                        }

                        mysqli_close($conn);
                        ?>

                    <!-- menampilkan tanggal -->
                    <table class="produk-table">
                        <thead>
                            <tr>
                                <th>Tanggal: <?php echo date("d F Y"); ?></th>
                            </tr>
                            <tr>
                                <th>ID Pemesanan: <?php echo $id_pemesanan; ?></th>
                            </tr>
                            <tr>
                                <th>ID Sales: <?php echo $id_sales; ?></th>
                                <th>ID Pegawai: <?php echo $id_pegawai; ?></th>
                            </tr>
                        </thead> 
                    </table>
                    
                </div>
                </div>
                <hr>
                <table class="produk-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../../koneksi.php';

                        $query = mysqli_query($conn, "SELECT lp.id_laporan, lp.id_pemesanan, lp.id_sales, lp.id_pegawai, lp.kode_produk, p.nama_produk, p.harga, hp.qty, lp.tgl_pengiriman, lp.ekspedisi
                FROM laporan_pengajuan lp
                INNER JOIN produk p ON lp.kode_produk = p.kode_produk
                INNER JOIN histori_pengajuan hp ON lp.id_pemesanan = hp.id_pemesanan");
                        $totalBayar = 0;
                        $no = 1;

                        while ($row = mysqli_fetch_assoc($query)) {
                            $subtotal = $row['harga'] * $row['qty'];
                            $totalBayar += $subtotal;

                            $id_pemesanan = $row['id_pemesanan'];
                            $id_sales = $row['id_sales'];
                            $id_pegawai = $row['id_pegawai'];
                            $tgl_pengiriman = $row['tgl_pengiriman'];
                           
                            // menambahkan item harga dan jumlah item dari transaksi dan disimpan ke total bayar untuk ditampilkan
                           
                    echo "<tr>
                    <td>$no</td>
                    <td>{$row['kode_produk']}</td>
                    <td>{$row['nama_produk']}</td>
                    <td>{$row['harga']}</td>
                    <td>{$row['qty']}</td>
                    <td>{$subtotal}</td>
                  </tr>";

                            $no++;
                        }

                        mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
                <hr>
                <div class="total">
                    <p>Total Bayar: <?php echo $totalBayar; ?></p>
                    <!-- tampil total bayar -->
                </div>
                
            </div>
            <hr>
            <div class="footer">
                <p>Terima kasih</p>
            </div>
        </div>
    </body>
</center>

</html>