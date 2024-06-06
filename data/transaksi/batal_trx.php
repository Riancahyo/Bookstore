<?php
include "koneksi.php";
$kd = "";

// Mendapatkan data dari GET
$kiriman = isset($_GET["data"]) ? $_GET["data"] : '';

// Memastikan bahwa variabel tidak kosong
if (empty($kiriman)) {
    echo "<script>alert('Data tidak valid'); window.location='trx.php';</script>";
    exit;
}

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Persiapan query untuk menghindari SQL injection
$stmt = $conn->prepare("DELETE FROM trx_out WHERE kd_trx = ?");
$stmt->bind_param("s", $kiriman);
$hapus = $stmt->execute();

$stmt1 = $conn->prepare("DELETE FROM trx_sementara WHERE kd_trx = ?");
$stmt1->bind_param("s", $kiriman);
$hapus1 = $stmt1->execute();

// Menampilkan pesan berdasarkan hasil query
if ($hapus && $hapus1) {
    echo "<script>alert('Data Berhasil di Hapus'); window.location='trx.php';</script>";
} else {
    echo "<script>alert('Data Gagal di Hapus'); window.location='trx.php';</script>";
}

// Menutup statement dan koneksi
$stmt->close();
$stmt1->close();
$conn->close();
?>
