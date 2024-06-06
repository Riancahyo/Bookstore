<?php
include "../../config.php";

// Koneksi ke database menggunakan mysqli
$conn = new mysqli('localhost', 'root', '', 'book_store');

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Eksekusi query pertama untuk menghapus data dari trx_sementara
$query1 = $conn->query("DELETE FROM trx_sementara");

// Eksekusi query kedua untuk menghapus data dari batal_jual
$query2 = $conn->query("DELETE FROM temp_batal_jual");

// Cek apakah query pertama berhasil
if ($query1 && $query2) {
    // Redirect ke halaman index.php jika berhasil
    header("Location: index.php");
} else {
    // Tampilkan pesan error jika gagal
    echo "Error: " . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
