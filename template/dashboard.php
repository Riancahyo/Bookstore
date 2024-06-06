<?php
session_start();
if(!isset($_SESSION['username'])){
    die("Anda belum login"); // jika belum login jangan lanjut
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_store";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch total penjualan and total transaksi
$trx_query = "SELECT SUM(hrg_total) as total_penjualan, COUNT(*) as total_transaksi FROM trx_sementara";
$trx_result = $conn->query($trx_query);
$row_trx = $trx_result->fetch_assoc();

// Fetch total produk
$barang_query = "SELECT COUNT(*) as total_produk FROM barang";
$barang_result = $conn->query($barang_query);
$row_barang = $barang_result->fetch_assoc();

// Fetch total supplier
$supplier_query = "SELECT COUNT(*) as total_supplier FROM suplier";
$supplier_result = $conn->query($supplier_query);
$row_supplier = $supplier_result->fetch_assoc();

// Fetch total user
$user_query = "SELECT COUNT(*) as total_user FROM user";
$user_result = $conn->query($user_query);
$row_user = $user_result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <div class="isi">
        <div class="content-wrapper">
            <section class="content-header">
                <h1>Dashboard</h1>
            </section>

            <section class="content">
                <div class="info-boxes">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-cog"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Penjualan</span>
                            <span class="info-box-number"><?php echo number_format($row_trx['total_penjualan'], 2); ?></span>
                        </div>
                    </div>
                    <div class="info-box">
                        <span class="info-box-icon bg-danger"><i class="fas fa-thumbs-up"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Transaksi</span>
                            <span class="info-box-number"><?php echo $row_trx['total_transaksi']; ?></span>
                        </div>
                    </div>
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fas fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Produk</span>
                            <span class="info-box-number"><?php echo $row_barang['total_produk']; ?></span>
                        </div>
                    </div>
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="fas fa-truck"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Supplier</span>
                            <span class="info-box-number"><?php echo $row_supplier['total_supplier']; ?></span>
                        </div>
                    </div>
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fas fa-user"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total User</span>
                            <span class="info-box-number"><?php echo $row_user['total_user']; ?></span>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
