<!doctype html>
<html>
    <head>
        <title>Form Tambah Data Barang</title>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"/> 
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <style>
            /* custom css */
            .pagination, .pager {
                margin-top: 0px;
            }
            .table {
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
                height: 200px; /* Adjust height as needed */
            }
        </style>
    </head>
    <body>
        <div class="container">
            <br/>
            <h3>Form Tambah Data Buku</h3>

            <?php
            // Database connection
            $db_link = mysqli_connect('localhost', 'root', '', 'book_store'); // Adjust username and password

            if (!$db_link) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Fetch supplier IDs
            $supplier_result = mysqli_query($db_link, "SELECT id_sp, nm_sp FROM suplier ORDER BY id_sp");

            if (!$supplier_result) {
                die("Query failed: " . mysqli_error($db_link));
            }
            ?>

            <form method="post" action="simpan_barang.php">
                <table style='font-family:sans-serif;' class='table table-bordered'>
                    <tr>
                        <td>Nama Buku</td>
                        <td><input class="form-control" type="text" name="nama_buku"></td>
                    </tr>
                    <tr>
                        <td>Kategori Buku</td>
                        <td><input class="form-control" type="text" name="kategori_buku"></td>
                    </tr>
                    <tr>
                        <td>Penulis</td>
                        <td><input class="form-control" type="text" name="penulis"></td>
                    </tr>
                    <tr>
                        <td>Sinopsis</td>
                        <td><textarea class="form-control" name="sinopsis"></textarea></td>
                    </tr>
                    <tr>
                        <td>ID Supplier</td>
                        <td>
                            <select class="form-control" name="id_suplier">
                                <?php while ($row = mysqli_fetch_assoc($supplier_result)) { ?>
                                    <option value="<?php echo htmlspecialchars($row['id_sp']); ?>">
                                        <?php echo htmlspecialchars($row['id_sp']) . " - " . htmlspecialchars($row['nm_sp']); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td><input class="form-control" type="text" name="harga"></td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td><input class="form-control" type="text" name="jumlah"></td>
                    </tr>
                    <tr>
                        <td>ID Buku / Barcode</td>
                        <td><input class="form-control" type="text" name="id_barang"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" class="btn btn-primary" value="Simpan"></td>
                    </tr>
                </table>
            </form>

            <?php
            // Close the database connection
            mysqli_close($db_link);
            ?>
        </div>
    </body>
</html>
