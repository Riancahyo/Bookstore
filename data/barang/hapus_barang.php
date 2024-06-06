<?php
$kiriman = $_GET["data"];

echo $kiriman;

include "../../config.php";

// Use mysqli_query with the correct number of arguments
$hapus = mysqli_query($Open, "DELETE FROM `barang` WHERE id_barang = '".$kiriman."'");

if ($hapus) {
?>
    <script type="text/javascript">
        alert('Data Berhasil di Hapus');
        window.location = 'index.php';
    </script>
<?php
} else {
?>
    <script type="text/javascript">
        alert('Data Gagal di Hapus');
        window.location = 'index.php';
    </script>
<?php
}
?>
