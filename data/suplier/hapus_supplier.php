<?php
$kiriman = $_GET["data"];

echo $kiriman;

include "../../../koneksi.php";

// Create connection
$db_link = mysqli_connect('localhost', 'root', '', 'book_store');

// Check connection
if (!$db_link) {
    die("Connection failed: " . mysqli_connect_error());
}

// Delete query
$hapus = mysqli_query($db_link, "DELETE FROM `suplier` WHERE id_sp = '".$kiriman."'");

// Check if the delete query was successful
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

// Close the database connection
mysqli_close($db_link);
?>
