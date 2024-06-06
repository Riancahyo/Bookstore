<!DOCTYPE html>
<html>
<head>
    <title>Tabel User</title>
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
    </style>
    <script type="text/javascript">
        function pesan_hapus(dt) {
            var pesan = confirm('Anda yakin akan menghapus data?');
            if (pesan) {
                window.location.href = 'hapus_user.php?data=' + dt;
            }
        }
    </script>
</head>
<body>
    <?php
        // Include pagination function
        include 'pagination.php';

        // Pagination config start
        $q = isset($_REQUEST['q']) ? urldecode($_REQUEST['q']) : ''; // Keyword search
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Page number
        $adjacents = isset($_GET['adjacents']) ? intval($_GET['adjacents']) : 3; // Pagination style 2 and 3
        $rpp = 5; // Records per page

        // Database connection
        $db_link = mysqli_connect('localhost', 'root', '', 'book_store'); // Adjust MySQL credentials

        // Check connection
        if (!$db_link) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM user WHERE username LIKE '%$q%' ORDER BY username"; // Query
        $result = mysqli_query($db_link, $sql); // Execute query

        if (!$result) {
            die("Query failed: " . mysqli_error($db_link));
        }

        $tcount = mysqli_num_rows($result); // Total rows
        $tpages = ($tcount) ? ceil($tcount / $rpp) : 1; // Total pages
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
                <h1>Tabel User</h1>
            </div>
        </div>

        <!-- Search form -->
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

        <!-- Table -->
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="th">No</th>
                            <th class="th">ID User</th>
                            <th class="th">Username</th>
                            <th class="th">Password</th>
                            <th class="th">Nama</th>
                            <th class="th">Alamat</th>
                            <th class="th">Telepon</th>
                            <th class="th">Level</th>
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
                                    <td><?php echo $data['id_user']; ?></td>
                                    <td><?php echo $data['username']; ?></td>
                                    <td><?php echo $data['password']; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td><?php echo $data['alamat']; ?></td>
                                    <td><?php echo $data['no_tlp']; ?></td>
                                    <td><?php echo $data['level']; ?></td>
                                    <td width="120px" class="text-center">
                                        <a href="mutakhir_user.php?data=<?php echo $data['id_user']; ?>"><button type="button" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span></button></a>
                                        <button type="button" class="btn btn-danger" onclick="pesan_hapus('<?php echo $data['id_user']; ?>')"><span class="glyphicon glyphicon-trash"></span></button>
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

        <!-- Pagination -->
        <div class="row">
            <div class="col-md-12">
                <?php echo paginate_one($reload, $page, $tpages); ?>
                <a href="form_user.php"><input type="button" class="btn btn-primary" value="+ Tambah Data User"></a>
            </div>
        </div>
    </div> <!-- container -->
</body>
</html>
