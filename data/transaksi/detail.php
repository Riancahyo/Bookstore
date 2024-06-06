<!DOCTYPE html>
<html>
<head>
    <title>Daftar Barang</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="style.css">
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
    </style>
</head>
<body>
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        include "../../config.php";
        
        // Koneksi ke database
        $conn = new mysqli('localhost', 'root', '', 'book_store');

        // Cek koneksi
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query untuk mengambil data
        $query = $conn->query("SELECT * FROM trx_sementara");
        if ($query->num_rows > 0) {
            $i = 0;
            while ($data = $query->fetch_assoc()) {
                $i++;
                echo "<tr>";
                echo "<td>" . $i . "</td>";
                echo "<td>" . $data['nama_brg'] . "</td>";
                echo "<td>" . $data['jumlah'] . "</td>";
                echo "<td>Rp. " . number_format($data['harga'], 0, ".", ".") . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
        }

        // Tutup koneksi
        $conn->close();
        ?>
        </tbody>
    </table>
</body>
</html>
