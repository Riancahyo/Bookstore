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

// Check if the supplier already exists
$supplier = mysqli_query($db_link, "SELECT * FROM suplier WHERE id_sp='$a'");

if (mysqli_num_rows($supplier) == 1) {
    echo "Data Sudah Ada";
    exit;
} else {
    // Insert new supplier
    $simpan = mysqli_query($db_link, "INSERT INTO `suplier`(`id_sp`, `nm_sp`, `alamat_sp`, `tlp_sp`) VALUES ('$a','$b','$c','$d')");

    if ($simpan) {
        ?>
        <script type="text/javascript">
            alert('Data berhasil disimpan');
            window.location = 'index.php';
        </script>
        <?php
    } else {
        ?>
        <script type="text/javascript">
            alert('Data gagal disimpan');
            window.location = 'index.php';
        </script>
        <?php
    }
}

// Close the database connection
mysqli_close($db_link);
?>
