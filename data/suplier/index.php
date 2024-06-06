<script type="text/javascript">
function pesan_hapus(dt) {
    var pesan = confirm('Anda yakin akan menghapus data?');
    if (pesan) {
        window.location = 'hapus_supplier.php?data=' + dt;
    } else {
        window.location = 'index.php';
    }
}
</script>

<!DOCTYPE html>
<html>
<head>
    <title>Tabel Supplier</title>
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
        .th { background-color:#00D9FF; font-size: 0.875em; font-weight: bold; }
    </style>
</head>
<body>
    <?php
    // includekan fungsi paginasi
    include 'pagination.php';
    // pagination config start
    $q = isset($_REQUEST['q']) ? urldecode($_REQUEST['q']) : ''; // untuk keyword pencarian
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1; // untuk nomor halaman
    $adjacents = isset($_GET['adjacents']) ? intval($_GET['adjacents']) : 3; // khusus style pagination 2 dan 3
    $rpp = 5; // jumlah record per halaman

    // Database connection
    $db_link = mysqli_connect('localhost', 'root', '', 'book_store'); // sesuaikan username dan password mysqli anda

    // Check connection
    if (!$db_link) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM suplier WHERE nm_sp LIKE '%$q%' ORDER BY nm_sp"; // query silahkan disesuaikan
    $result = mysqli_query($db_link, $sql); // eksekusi query

    if (!$result) {
        die("Query failed: " . mysqli_error($db_link));
    }

    $tcount = mysqli_num_rows($result); // jumlah total baris
    $tpages = isset($tcount) ? ceil($tcount / $rpp) : 1; // jumlah total halaman
    $count = 0; // untuk paginasi
    $i = ($page - 1) * $rpp; // batas paginasi
    $no_urut = ($page - 1) * $rpp; // nomor urut
    $reload = $_SERVER['PHP_SELF'] . "?q=" . $q . "&amp;adjacents=" . $adjacents; // untuk link ke halaman lain
    // pagination config end
    ?>
    <div class="container">
        <!--judul -->
        <div class="row">
            <div class="col-md-12">
                <h1>Tabel Supplier</h1>
            </div>
        </div>

        <!--form pencarian-->
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for..." name="q" value="<?php echo $q ?>">
                        <span class="input-group-btn">
                            <?php if ($q <> '') { ?>
                                <a class="btn btn-default" href="<?php echo $_SERVER['PHP_SELF'] ?>">Reset</a>
                            <?php } ?>
                            <button class="btn btn-primary" type="submit">Go!</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>

        <!--tabel-->
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="th">No</th>
                            <th class="th">ID Supplier</th>
                            <th class="th">Nama Supplier</th>
                            <th class="th">Alamat</th>
                            <th class="th">Telepon</th>
                            <th class="th">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while (($count < $rpp) && ($i < $tcount)) {
                            mysqli_data_seek($result, $i);
                            $data = mysqli_fetch_array($result);
                        ?>
                            <tr>
                                <td width="80px"><?php echo ++$no_urut; ?></td>
                                <td><?php echo $data['id_sp']; ?></td>
                                <td><?php echo $data['nm_sp']; ?></td>
                                <td><?php echo $data['alamat_sp']; ?></td>
                                <td><?php echo $data['tlp_sp']; ?></td>
                                <td width="120px" class="text-center">
                                    <a href="mutakhir_supplier.php?data=<?php echo $data['id_sp']; ?>"><button type="button" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span></button></a>
                                    <a href="hapus_supplier.php?data=<?php echo $data['id_sp']; ?>"><button type="button" class="btn btn-danger" onClick="return confirm('Apakah anda akan menghapus data ini?');"><span class="glyphicon glyphicon-trash"></span></button></a>
                                </td>
                            </tr>
                        <?php
                            $i++;
                            $count++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!--pagination-->
        <div class="row">
            <div class="col-md-12">
                <?php echo paginate_one($reload, $page, $tpages); ?>
                <a href="form_supplier.php"><input class="btn btn-primary" type="button" value="+ Tambah Data Supplier"></a>
            </div>
        </div>
    </div> <!-- container -->
</body>
</html>
