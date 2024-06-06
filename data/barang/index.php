<!DOCTYPE html>
<html>
<head>
    <title>Tabel Buku</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"/> 
    <script src="../bootstrap/js/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <style>
        /* Custom CSS */
        .pagination, .pager {
            margin-top: 0px;
        }
        .table {
            margin-top: 20px;
        }
        .th {
            background-color: #00D9FF;
            font-size: 0.875em;
            font-weight: bold;
        }
        .tr {
            font-size: 0.675em;
        }
    </style>
    <script type="text/javascript">
        function pesan_hapus(dt) {
            var pesan = confirm('Anda yakin akan menghapus data?');
            if (pesan) {
                window.location = 'hapus_barang.php?data=' + dt;
            } else {
                window.location = 'index.php';
            }
        }
    </script>
</head>
<body>
    <?php
    // Include functions for pagination and barcode generation
    include 'pagination.php';
    include '../../barcode/barcode_generator/barcode128.php';

    // Pagination config start
    $q = isset($_REQUEST['q']) ? urldecode($_REQUEST['q']) : ''; // Keyword for search
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Page number
    $adjacents = isset($_GET['adjacents']) ? intval($_GET['adjacents']) : 3; // Pagination style
    $rpp = 10; // Records per page

    // Database connection
    $db_link = mysqli_connect('localhost', 'root', '', 'book_store'); // Adjust username and password

    if (!$db_link) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM barang WHERE nama_buku LIKE '%$q%' OR id_barang LIKE '%$q%' ORDER BY nama_buku"; // Query
    $result = mysqli_query($db_link, $sql); // Execute query

    if ($result) {
        $tcount = mysqli_num_rows($result); // Total rows
        $tpages = isset($tcount) ? ceil($tcount / $rpp) : 1; // Total pages
    } else {
        $tcount = 0;
        $tpages = 1;
    }

    $count = 0; // For pagination
    $i = ($page - 1) * $rpp; // Pagination limit
    $no_urut = ($page - 1) * $rpp; // Row number
    $reload = $_SERVER['PHP_SELF'] . "?q=" . $q . "&amp;adjacents=" . $adjacents; // Link to other pages
    // Pagination config end
    ?>
    <div class="container">
        <!-- Title -->
        <div class="row">
            <div class="col-md-12">
                <h1>Tabel Buku</h1>
            </div>
        </div>

        <!-- Search form -->
        <div class="row">
            <div class="col-md-8">
            </div>
            <div class="col-md-4">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for..." name="q" value="<?php echo htmlspecialchars($q); ?>">
                        <span class="input-group-btn">
                            <?php if ($q !== '') { ?>
                                <a class="btn btn-default" href="<?php echo $_SERVER['PHP_SELF'] ?>">Reset</a>
                            <?php } ?>
                            <button class="btn btn-primary" type="submit">Go!</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table -->
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="th">No</th>
                            <th class="th">ID Buku</th>
                            <th class="th">Nama Buku</th>
                            <th class="th">Kategori Buku</th>
                            <th class="th">Penulis</th>
                            <th class="th">Sinopsis</th>
                            <th class="th">ID Supplier</th>
                            <th class="th">Harga</th>
                            <th class="th">Jumlah</th>
                            <th class="th">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $tcount > 0) { 
                            while (($count < $rpp) && ($i < $tcount)) {
                                mysqli_data_seek($result, $i);
                                $data = mysqli_fetch_array($result);
                        ?>
                            <tr class="tr">
                                <td width="40px">
                                    <?php echo ++$no_urut; ?> 
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($data['id_barang']); ?> 
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($data['nama_buku']); ?> 
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($data['kategori_buku']); ?> 
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($data['penulis']); ?> 
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($data['sinopsis']); ?> 
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($data['id_suplier']); ?> 
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($data['harga']); ?> 
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($data['jumlah']); ?>
                                </td>
                                <td width="150px" class="text-center">
                                    <div class="btn-group btn-group-justified">
                                        <a href="cetak_barcode.php?data=<?php echo htmlspecialchars($data['id_barang']); ?>">
                                            <button type="button" class="btn btn-default">
                                                <span class="glyphicon glyphicon-barcode"></span>
                                            </button>
                                        </a>
                                        <a href="mutakhir_barang.php?data=<?php echo htmlspecialchars($data['id_barang']); ?>">
                                            <button type="button" class="btn btn-info">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </button>
                                        </a>
                                        <a href="hapus_barang.php?data=<?php echo htmlspecialchars($data['id_barang']); ?>" onClick="return confirm('Apakah anda akan menghapus barang ini?');">
                                            <button type="button" class="btn btn-danger">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php 
                                $i++;
                                $count++;
                            } 
                        } else { ?>
                            <tr>
                                <td colspan="10" class="text-center">Tidak ada data ditemukan.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="row">
            <div class="col-md-12">
                <?php echo paginate_one($reload, $page, $tpages); ?>
                <a href="form_barang.php">
                    <input class="btn btn-primary" type="button" value="+ Tambah Data Buku">
                </a>
            </div>
        </div>
    </div> <!-- container -->
</body>
</html>
                            