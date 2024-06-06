<?php
$a = $_POST['id'];
$b = $_POST['username'];
$c = $_POST['password'];
$d = $_POST['nama'];
$e = $_POST['alamat'];
$f = $_POST['telepon'];
$g = $_POST['level'];

include "koneksi.php";

// Prepare an update statement
$stmt = $conn->prepare("UPDATE `user` SET `username`=?, `password`=?, `nama`=?, `alamat`=?, `no_tlp`=?, `level`=? WHERE `id_user`=?");
$stmt->bind_param("sssssss", $b, $c, $d, $e, $f, $g, $a);

// Execute the statement
if ($stmt->execute()) {
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

// Close the statement and connection
$stmt->close();
$conn->close();
?>
