<!DOCTYPE html>
<html>
<head>
    <title>Print Data</title>
    <script>
        window.print();
    </script>
</head>
<body>
<?php 
include "koneksi.php";

// Koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk mengambil data
$user = $conn->query("SELECT * FROM trx_sementara GROUP BY kd_trx");
if ($user->num_rows > 0) {
    while($data = $user->fetch_assoc()) {
        echo "
        <table>
        <tr>
            <td colspan='5'>
                <center><b>Rian Bookstore</b><br>
                Jl. Raya Ngawi - Maospati, Alun Alun Ngawi</center>
            </td>
        </tr>
        <tr>
            <td><br></td>
        </tr>
        <tr>
            <td colspan='5'>
                Kasir: " . $data['kasir'] . "<br>
                Tanggal: " . $data['tgl_trx'] . "
                <hr color='#000000' size='1' width='100%'>
            </td>
        </tr>
        <tr>
            <th>No.</th><th>Nama</th><th>Harga</th><th>Jumlah</th><th>Jumlah Harga</th>
        </tr>";
        
        $i = 0;
        $query = $conn->query("SELECT * FROM trx_sementara");
        while ($row = $query->fetch_assoc()) {
            $i++;
            $harga = $row['harga']; 
            $jumlah = $row['jumlah'];
            $jml_hrg = $harga * $jumlah;
            echo "
            <tr>
                <td>" . $i . "</td>
                <td>" . $row['nama_buku'] . "</td>
                <td>Rp." . number_format($harga, 0, ".", ".") . "</td>
                <td align='center'>" . $jumlah . "</td>
                <td>Rp." . number_format($jml_hrg, 0, ".", ".") . "</td>
            </tr>";
        }

        // Menghitung total
        $query1 = $conn->query("SELECT SUM(hrg_total) AS total FROM trx_sementara");
        $total = 0;
        if ($query1->num_rows > 0) {
            $data1 = $query1->fetch_assoc();
            $total = $data1['total'];
        }

        // Contoh nilai bayar dan kembali
        $a = 100000; // Misalnya nilai dari input user
        $b = $a - $total; // Hitung kembali

        echo "
        <tr>
            <td colspan='5'><hr color='#000000' size='1' width='100%'></td>
        </tr>
        <tr>
            <td></td><td></td><td></td><td><b>Total :</b></td><td><b>Rp." . number_format($total, 0, ".", ".") . "</b></td>
        </tr>
        <tr>
            <td></td><td></td><td></td><td>Bayar </td><td>Rp." . number_format($a, 0, ".", ".") . "</td>
        </tr>
        <tr>
            <td></td><td></td><td></td><td>Kembali </td><td>Rp." . number_format($b, 0, ".", ".") . "</td>
        </tr>
        <tr>
            <td><br></td>
        </tr>
        <tr>
            <td colspan='5'><center><p>- Terimakasih -</p></center></td>
        </tr>
        </table><br/>";
    }
}
$conn->close();
?>
</body>
</html>
