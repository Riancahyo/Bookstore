<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['username'])) {
    die("Anda belum login"); // Jika belum login, jangan lanjut
}

include "koneksi.php";

// Menggunakan prepared statement untuk mencari nilai tertinggi di field no_trx
$stmt = $conn->prepare("SELECT MAX(no_trx) AS maxID FROM No_trx");
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$idmax = $data['maxID'];

// Membuat nomor unik baru
$nomor = $idmax + 1;
$no_transaksi = sprintf("%08s", $nomor);

// Update no_trx di database
$stmt = $conn->prepare("UPDATE No_trx SET no_trx = ? WHERE id = 1");
$stmt->bind_param("i", $nomor);
$stmt->execute();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transaksi Baru</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"/> 
    <link rel="stylesheet" href="style.css">
    <script src="../bootstrap/js/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <style>
        /* custom css */
        .pagination, .pager {
            margin-top: 0;
        }
        .table {
            margin-top: 20px;
        }
        .th {
            background-color: #00D9FF;
            font-size: 0.875em;
            font-weight: bold;
        }
        #logo {
            width: 300px;
            float: left;
        }
        * {
            margin: 0 auto;
            padding: 0;
        }
        body {
            background: #FFFFFF;
            font-family: verdana;
            font-size: 10px;
            color: #4c4e55;
        }
        #container {
            width: 95%;
            height: 1369px;
            background: url('bg.jpg') no-repeat;
        }
        #header {
            height: 150px;
            border: 1px solid #00FF64;
        }
        #center {
            float: left;
            width: 100%;
            height: 610px;
            margin: 3px;
            padding: 3px;
            border: 1px solid #009900;
        }
        #sidebar_kanan {
            float: left;
            width: 445px;
            height: 600px;
            margin: 3px 0;
            padding: 3px;
            border: 1px solid #FF0000;
        }
        #detail {
            float: left;
            width: 440px;
            height: 600px;
            margin: 3px 0;
            padding: 3px;
            border: 1px solid transparent;
        }
        p {
            color: #FFFFFF;
        }
    </style>
</head>
<body>
    <div id="container">
        <div id="header">
            <br/>
            <form action="dlt_trx.php">
                <button type="submit" class="btn btn-danger btn-block btn-lg">Transaksi Baru <span class="glyphicon glyphicon-shopping-cart"></span></button>
            </form>
            <br/><br/>
            <form action="lihat_brg.php" method="post" target="lihat">
                <table border="0" align="left" style="background-color:#FFFFFF;font-size:14px;font-family:'Roboto',Arial,Helvetica,sans-serif;color:#34495E;border-radius:30px;">
                    <tr>
                        <td>Kode Transaksi</td>
                        <td><p>&nbsp;&nbsp;:&nbsp;&nbsp;</p></td>
                        <td><input class="form-control" type="text" value="TR<?php echo $no_transaksi; ?>" name="kd_trx" id="sel1" ReadOnly></td>
                        <td><p>...</p></td>
                        <td>Tanggal Transaksi</td>
                        <td><p>&nbsp;&nbsp;:&nbsp;&nbsp;</p></td>
                        <td><input class="form-control" type="text" value="<?php echo date("Y-m-d"); ?>" name="tgl_trx" ReadOnly></td>
                    </tr>
                    <tr>
                        <td><p></p></td>
                    </tr>
                    <tr>
                        <td>Barcode</td>
                        <td><p>&nbsp;&nbsp;:&nbsp;&nbsp;</p></td>
                        <td>
                            <div class="input-group">
                                <input class="form-control" type="text" name="id" id="sel1" placeholder="barcode" value="<?php echo isset($_POST['id']) ? htmlspecialchars($_POST['id']) : ''; ?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">Cari</button>
                                    <button class="btn btn-warning" type="reset">Reset</button>
                                </span>
                            </div>
                        </td>
                        <td><p>...</p></td>
                        <td>Kasir</td>
                        <td><p>&nbsp;&nbsp;:&nbsp;&nbsp;</p></td>
                        <td><input class="form-control" type="text" name="kasir" id="sel1" value="<?php echo isset($_POST['kasir']) ? htmlspecialchars($_POST['kasir']) : $_SESSION['username']; ?>" readOnly></td>
                    </tr>
                </table>
            </form>
        </div>
        <hr color="#0000FF" size="5" width="100%">
        <div id="center"><iframe name="lihat" src="trx.php" id="center"></iframe></div>
    </div>
</body>
</html>
