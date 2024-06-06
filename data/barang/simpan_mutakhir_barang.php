<?php
$id_barang = $_POST['id_barang'];
$nama_buku = $_POST['nama_buku'];
$kategori_buku = $_POST['kategori_buku'];
$penulis = $_POST['penulis'];
$sinopsis = $_POST['sinopsis'];
$id_suplier = $_POST['id_suplier'];
$harga = $_POST['harga'];
$jumlah = $_POST['jumlah'];

include "../../config.php";

// Menggunakan mysqli_query untuk memperbarui data
$mutakhir = mysqli_query($Open, "UPDATE `barang` SET `nama_buku`='$nama_buku', `kategori_buku`='$kategori_buku', `penulis`='$penulis', `sinopsis`='$sinopsis', `id_suplier`='$id_suplier', `harga`='$harga', `jumlah`='$jumlah' WHERE `id_barang`='$id_barang'");

if ($mutakhir) {
?>
    <script type="text/javascript">
        alert('Data Berhasil di Mutakhirkan');
        window.location = 'index.php';
    </script>
<?php
} else {
?>
    <script type="text/javascript">
        alert('Data Gagal di Mutakhirkan');
        window.location = 'index.php';
    </script>
<?php
}
?>
