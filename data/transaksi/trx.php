<?php
// koneksi.php content, make sure this file contains the following:
$koneksi = new mysqli('localhost', 'root', '', 'book_store'); // Adjust parameters as needed

if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transaction Form</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"/> 
    <link rel="stylesheet" href="style.css">
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
    </style>
</head>
<body>
    <?php 
    include "koneksi.php";
    $kd = "";
    ?>
    <table>
        <form action="#" method="POST">
            <tr>
                <th>ID Buku</th>
                <th>Nama Buku</th>
                <th>Harga Asal</th>
                <th>Harga Jual</th>
                <th>Jumlah</th>
                <th></th>
            </tr>   
            <tr> 
                <td><input type="text" class="form-control input-sm" name="id_barang" readonly></td>
                <td><input type="text" class="form-control input-sm" name="nama_buku" size="15" readonly></td>
                <td><input type="text" class="form-control input-sm" name="--" readonly></td> 
                <td><input type="text" class="form-control input-sm" name="harga" readonly></td>
                <td><input class="form-control input-sm" name="jumlah" size="4" type="text" readonly></td>
                <td>
                    <button type="submit" class="btn btn-success" disabled>Simpan <span class="glyphicon glyphicon-send"></span></button>
                    <button type="reset" class="btn btn-danger" disabled>Batal <span class="glyphicon glyphicon-remove"></span></button>
                </td>
            </tr>
        </form> 
    </table>
    <hr color="#0000FF" size="5" width="100%">
    <table class="table">
        <tr>
            <th>No.</th>
            <th>Nama Buku</th>
            <th>Harga Buku</th>
            <th width="150px">Jumlah</th>
            <th>Jumlah Harga</th>
        </tr>
        <?php 
        $i = 0;
        $total = 0;
        $query = mysqli_query($koneksi, "SELECT * FROM trx_sementara");
        $query_kd = mysqli_query($koneksi, "SELECT kd_trx FROM trx_sementara LIMIT 1");
        if ($query_kd && mysqli_num_rows($query_kd) > 0) {
            $row_kd = mysqli_fetch_assoc($query_kd);
            $kd = $row_kd['kd_trx'];
        }
        while ($data = mysqli_fetch_array($query)) {
            $i++; 
            $harga = $data['harga']; 
            $jumlah = $data['jumlah'];
            $jml_hrg = $harga * $jumlah;
            $total += $jml_hrg;
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $data['nama_buku']; ?></td>
            <td>Rp.<?php echo number_format($harga, 0, ".", "."); ?></td>
            <td><?php echo $jumlah; ?></td>
            <td>Rp.<?php echo number_format($jml_hrg, 0, ".", "."); ?></td>
        </tr>
        <?php } ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><b>Total Bayar</b></td>
            <td><b>Rp.<?php echo number_format($total, 0, ".", ".");?></b></td>
        </tr>
        <form action="cetak.php" method="post">
            <tr>
                <td><button type="submit" class="btn btn-success">Cetak <span class="glyphicon glyphicon-print"></span></button></td>
                <td><a href="batal_trx.php?data=<?php echo $kd; ?>" class="btn btn-danger">Batal <span class="glyphicon glyphicon-trash"></span></a></td>
                <td></td>
                <td>Bayar :<input type="text" class="form-control input-sm" id="txt1" value="0" name="txt1" onkeyup="sum();" /></td>
                <td>Kembali :<input class="form-control input-sm" type="text" id="txt3" value="0" name="txt3"/></td>
            </tr>
        </form>
    </table>
    <input type="hidden" class="form-control input-sm" id="txt2" value="<?php echo $total;?>" onkeyup="sum();" />
    <script>
        function sum() {
            var txtFirstNumberValue = document.getElementById('txt1').value;
            var txtSecondNumberValue = document.getElementById('txt2').value;
            var result = parseInt(txtFirstNumberValue) - parseInt(txtSecondNumberValue);
            if (!isNaN(result)) {
                document.getElementById('txt3').value = result;
            }
        }
    </script>
</body>
</html>
