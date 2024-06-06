<!doctype html>
<html>
<head>
    <title>Pagination with Bootstrap 3 - harviacode.com</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"/>
    <script src="../bootstrap/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <style>
        /* Custom CSS */
        .pagination, .pager {
            margin-top: 0px;
        }
        .table {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php
    $kiriman = $_GET['data'];

    include "../../config.php";

    // Connect to the database
    $db_link = mysqli_connect('localhost', 'root', '', 'book_store');
    
    if (!$db_link) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $supplier = mysqli_query($db_link, "SELECT * FROM suplier WHERE id_sp='$kiriman'");

    if ($supplier && mysqli_num_rows($supplier) > 0) {
        $data_supplier = mysqli_fetch_array($supplier);
        echo "
        <form action='simpan_mutakhir_supplier.php' method='post'>
            <table style='font-family:sans-serif;' class='table table-bordered'>
                <tr>
                    <td>ID Supplier</td>
                    <td><input type='text' class='form-control' name='id' value='{$data_supplier['id_sp']}' readonly></td>
                </tr>
                <tr>
                    <td>Nama Supplier</td>
                    <td><input type='text' class='form-control' name='nama' value='{$data_supplier['nm_sp']}'></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><input type='text' class='form-control' name='alamat' value='{$data_supplier['alamat_sp']}'></td>
                </tr>
                <tr>
                    <td>Telepon</td>
                    <td><input type='text' class='form-control' name='telepon' value='{$data_supplier['tlp_sp']}'></td>
                </tr>
                <tr>
                    <td><input type='submit' class='btn btn-primary' value='Simpan Mutakhir'></td>
                    <td><a href='index.php'><input class='btn btn-danger' type='button' value='Batal'></a></td>
                </tr>
            </table>
        </form>";
    } else {
        echo "Data supplier tidak ditemukan.";
    }

    // Close the database connection
    mysqli_close($db_link);
    ?>
</body>
</html>
