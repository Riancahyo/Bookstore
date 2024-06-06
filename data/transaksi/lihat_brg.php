<!DOCTYPE html>
<html>
<head>
    <title>Transaksi</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"/> 
    <link rel="stylesheet" href="style.css">
    <script src="../bootstrap/js/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <style>
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
include "koneksi.php";

$id = isset($_POST['id']) ? $_POST['id'] : '';
$kd_trx = isset($_POST['kd_trx']) ? $_POST['kd_trx'] : '';
$kasir = isset($_POST['kasir']) ? $_POST['kasir'] : '';
$tgl = isset($_POST['tgl_trx']) ? $_POST['tgl_trx'] : '';

$query = $conn->prepare("SELECT * FROM barang WHERE id_barang = ?");
$query->bind_param("s", $id);
$query->execute();
$result = $query->get_result();

while ($data = $result->fetch_assoc()) {
?>

<table>
<form action="act_trx.php" method="POST">
    <input type="hidden" name="kd_trx" value="<?php echo htmlspecialchars($kd_trx); ?>">    
    <input type="hidden" name="kasir" value="<?php echo htmlspecialchars($kasir); ?>"> 
    <input type="hidden" name="tgl_trx" value="<?php echo htmlspecialchars($tgl); ?>"> 
    <tr>
        <th>ID Barang</th>
        <th>Nama Barang</th>
        <th>Harga Asal</th>
        <th>Harga Jual</th>
        <th>Jumlah</th>
        <th></th>
    </tr>    
    <tr> 
        <td><input type="text" class="form-control input-sm" name="id_barang" size="10" value="<?php echo htmlspecialchars($data['id_barang']); ?>" readonly></td>
        <td><input type="text" class="form-control input-sm" name="nama_buku" size="30" value="<?php echo htmlspecialchars($data['nama_buku']); ?>" readonly></td>    
        <td><input type="text" class="form-control input-sm" value="<?php echo htmlspecialchars($data['harga']); ?>" readonly></td> 
        <td><input type="text" class="form-control input-sm" name="harga" value="<?php echo htmlspecialchars($data['harga']); ?>"></td>
        <td><input class="form-control input-sm" name="jumlah" size="2" value="1" type="text"></td>
        <td>
            <button type="submit" class="btn btn-success">Simpan <span class="glyphicon glyphicon-send"></span></button>
            <a href="trx.php" class="btn btn-danger">Batal <span class="glyphicon glyphicon-remove"></span></a>
        </td>
    </tr>
</form> 
</table>

<?php
}
?>

<hr color="#0000FF" size="5" width="100%">

<table class="table">
    <tr>
        <th>No.</th>
        <th>Nama Barang</th>
        <th>Harga Barang</th>
        <th>Jumlah</th>
        <th>Jumlah Harga</th>
    </tr>

<?php

$query = $conn->prepare("SELECT * FROM trx_sementara");
$query->execute();
$result = $query->get_result();
$i = 0;
$kd_trx_latest = '';

while ($data = $result->fetch_assoc()) {
    $i++; 
    $kd_trx_latest = $data['kd_trx'];  // Mengambil kd_trx terbaru
    $harga = $data['harga']; 
    $jumlah = $data['jumlah'];
    $jml_hrg = $harga * $jumlah;
?>

<tr>
    <td><?php echo $i; ?></td>
    <td><?php echo htmlspecialchars($data['nama_buku']); ?></td>
    <td>Rp.<?php echo number_format($harga, 0, ".", "."); ?></td>
    <td><?php echo $jumlah; ?></td>
    <td>Rp.<?php echo number_format($jml_hrg, 0, ".", "."); ?></td>
</tr>

<?php
}

$query1 = $conn->prepare("SELECT SUM(hrg_total) as total FROM trx_sementara");
$query1->execute();
$result1 = $query1->get_result();
$data1 = $result1->fetch_assoc();
$total = $data1['total'];

?>

<tr>
    <td></td>
    <td></td>
    <td></td>
    <td><b>Total Bayar</b></td>
    <td><b>Rp.<?php echo number_format($total, 0, ".", "."); ?></b></td>
</tr>
<tr>
    <td>
        <a href="cetak.php" class="btn btn-success">Cetak <span class="glyphicon glyphicon-print"></span></a>
    </td>
    <td>
        <a href="batal_trx.php?data=<?php echo htmlspecialchars($kd_trx_latest); ?>" class="btn btn-danger">Batal <span class="glyphicon glyphicon-trash"></span></a>
    </td>
</tr>
</table>

</body>
</html>

<?php
$conn->close();
?>
