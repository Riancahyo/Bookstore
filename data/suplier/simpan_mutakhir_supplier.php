<?php
$a  = $_POST['id'];
$b  = $_POST['nama'];
$c  = $_POST['alamat'];
$d  = $_POST['telepon'];

include "../../config.php";

// Create connection
$db_link = mysqli_connect('localhost', 'root', '', 'book_store');

// Check connection
if (!$db_link) {
    die("Connection failed: " . mysqli_connect_error());
}

// Update query
$mutakhir = mysqli_query($db_link, "UPDATE `suplier` SET `nm_sp`='$b', `alamat_sp`='$c', `tlp_sp`='$d' WHERE `id_sp`='$a'");

// Check if the update query was successful
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

// Close the database connection
mysqli_close($db_link);
?>
