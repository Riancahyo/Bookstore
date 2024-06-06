<?php
$a 	= $_POST['id'];
$b 	= $_POST['username'];
$c	= $_POST['password'];
$d	= $_POST['nama'];
$e	= $_POST['alamat'];
$f	= $_POST['telepon'];
$g	= $_POST['level'];

include "../../config.php";

$user = mysqli_query($Open, "SELECT * FROM user WHERE id_user='$a'");

$jm_baris_query = mysqli_num_rows($user);

if($jm_baris_query == 1) {
    echo "Data Sudah Ada";
    exit;
} else {
    $simpan = mysqli_query($Open, "INSERT INTO `user`(`id_user`, `username`, `password`, `nama`, `alamat`, `no_tlp`, `level`) VALUES ('$a','$b','$c','$d','$e','$f','$g')");					

    if ($simpan) {
?>		
        <script type="text/javascript">
            alert('Data berhasil disimpan');
            window.location='index.php';
        </script>
<?php
    } else {
?>
        <script type="text/javascript">
            alert('Data gagal disimpan');
            window.location='index.php';
        </script>
<?php
    }
}
?>
