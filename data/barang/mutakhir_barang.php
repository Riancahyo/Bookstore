<?php
$kiriman = $_GET['data'];

include "../../config.php";

// Memastikan koneksi ke database berhasil
if (!$Open) {
    die("Connection failed: " . mysqli_connect_error());
}

// Mengecek apakah data barang sudah ada berdasarkan id_barang
$barang = mysqli_query($Open, "SELECT * FROM barang WHERE id_barang='$kiriman'");

if (!$barang) {
    die("Query error: " . mysqli_error($Open));
}

$data_barang = mysqli_fetch_array($barang);

// Fetch supplier IDs
$suppliers = mysqli_query($Open, "SELECT id_sp, nm_sp FROM suplier ORDER BY id_sp");

if (!$suppliers) {
    die("Query error: " . mysqli_error($Open));
}

echo "
<!doctype html>
<html>
    <head>
        <title>Edit Data Barang</title>
        <link rel='stylesheet' href='../bootstrap/css/bootstrap.min.css'/> 
        <script src='../bootstrap/js/jquery.min.js'></script>
        <script src='../bootstrap/js/bootstrap.min.js'></script>
        <style>
            /*custom css*/
            .pagination, .pager{
                margin-top: 0px;
            }
            .table{
                margin-top: 20px;
            }
            body {
                padding-left: 15px;
                padding-right: 15px;
            }
            .container {
                margin-top: 20px;
            }
            textarea {
                width: 100%;
                height: 500px; /* Adjust height as needed */
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <center>
                <form action='simpan_mutakhir_barang.php' method='post'>
                    <table style='font-family:sans-serif;' class='table table-bordered'>
                        <tr>
                            <td>ID Buku</td>
                            <td>:</td>
                            <td><input class='form-control' type='text' name='id_barang' value='{$data_barang['id_barang']}' readonly></td> 
                        </tr>
                        <tr>
                            <td>Nama Buku</td>
                            <td>:</td>
                            <td><input class='form-control' type='text' name='nama_buku' value='{$data_barang['nama_buku']}'></td>
                        </tr>
                        <tr>
                            <td>Kategori Buku</td>
                            <td>:</td>
                            <td><input class='form-control' type='text' name='kategori_buku' value='{$data_barang['kategori_buku']}'></td>
                        </tr>
                        <tr>
                            <td>Penulis</td>
                            <td>:</td>
                            <td><input class='form-control' type='text' name='penulis' value='{$data_barang['penulis']}'></td>
                        </tr>
                        <tr>
                            <td>Sinopsis</td>
                            <td>:</td>
                            <td><textarea class='form-control' name='sinopsis'>{$data_barang['sinopsis']}</textarea></td>
                        </tr>
                        <tr>
                            <td>ID Suplier</td>
                            <td>:</td>
                            <td>
                                <select class='form-control' name='id_suplier'>
";
while ($supplier = mysqli_fetch_assoc($suppliers)) {
    $selected = ($supplier['id_sp'] == $data_barang['id_suplier']) ? "selected" : "";
    echo "<option value='{$supplier['id_sp']}' $selected>{$supplier['id_sp']} - {$supplier['nm_sp']}</option>";
}
echo "
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Harga</td>
                            <td>:</td>
                            <td><input class='form-control' type='text' name='harga' value='{$data_barang['harga']}'></td>
                        </tr>
                        <tr>
                            <td>Jumlah</td>
                            <td>:</td>
                            <td><input class='form-control' type='text' name='jumlah' value='{$data_barang['jumlah']}'></td>
                        </tr>
                        <tr>
                            <td><input type='submit' class='btn btn-primary' value='Simpan Mutakhir'></td>
                            <td><a href='index.php'><input class='btn btn-primary' type='button' value='Batal'></a></td>
                        </tr>
                    </table>
                </form>
            </center>
        </div>
    </body>
</html>
";
?>
