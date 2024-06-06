<?php
// Mengambil data dari form
$a = $_POST['id_barang'];
$b = $_POST['nama_buku'];
$c = $_POST['kategori_buku'];
$d = $_POST['penulis'];
$e = $_POST['sinopsis'];
$f = $_POST['id_suplier'];
$g = $_POST['harga'];
$h = $_POST['jumlah'];

// Menyertakan file konfigurasi untuk koneksi ke database
include "../../config.php";

// Memastikan koneksi ke database berhasil
if (!$Open) {
    die("Connection failed: " . mysqli_connect_error());
}

// Mengecek apakah data barang sudah ada berdasarkan id_barang
$barang = mysqli_query($Open, "SELECT * FROM barang WHERE id_barang='$a'");

if (!$barang) {
    die("Query error: " . mysqli_error($Open));
}

$jm_baris_query = mysqli_num_rows($barang);

if ($jm_baris_query == 1) {
    echo "Data Sudah Ada";
    exit;
} else {
    // Menyimpan data baru ke dalam tabel barang
    $simpan = mysqli_query($Open, "INSERT INTO `barang`(`id_barang`, `nama_buku`, `kategori_buku`, `penulis`, `sinopsis`, `id_suplier`, `harga`, `jumlah`) 
                                   VALUES ('$a','$b','$c','$d','$e','$f','$g','$h')");

    if (!$simpan) {
        die("Insert query error: " . mysqli_error($Open));
    }
    ?>
    <script type="text/javascript">
        // Mengarahkan kembali ke halaman index setelah berhasil menyimpan data
        window.location='index.php';
    </script>
    <?php
}
?>
