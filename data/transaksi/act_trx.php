<?php

include "koneksi.php";

// Mendapatkan data dari POST
$id_barang = $_POST['id_barang'];
$kd_trx = $_POST['kd_trx'];
$kasir = $_POST['kasir'];
$nama_buku = $_POST['nama_buku'];
$jumlah = $_POST['jumlah'];
$harga = $_POST['harga'];
$tgl_trx = $_POST['tgl_trx'];
$hrg_total = $jumlah * $harga;

// Prepare the first SQL statement
$sql1 = "INSERT INTO trx_sementara (kd_trx, id_barang, kasir, nama_buku, jumlah, harga, hrg_total, tgl_trx) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt1 = $conn->prepare($sql1);

// Check if the statement was prepared correctly
if ($stmt1 === false) {
    die("Error preparing statement: " . $conn->error);
}

// Bind parameters
$stmt1->bind_param("sissiiis", $kd_trx, $id_barang, $kasir, $nama_buku, $jumlah, $harga, $hrg_total, $tgl_trx);

// Execute the statement
if ($stmt1->execute()) {
    // Prepare the second SQL statement
    $sql2 = "INSERT INTO trx_out (kd_trx, id_barang, kasir, nama_buku, jumlah, harga, hrg_total, tgl_trx) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt2 = $conn->prepare($sql2);

    // Check if the statement was prepared correctly
    if ($stmt2 === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt2->bind_param("sissiiis", $kd_trx, $id_barang, $kasir, $nama_buku, $jumlah, $harga, $hrg_total, $tgl_trx);

    // Execute the statement
    $stmt2->execute();

    // Redirect to trx.php
    header("Location: trx.php");
} else {
    echo "Error: " . $stmt1->error;
}

// Close statements and connection
$stmt1->close();
$stmt2->close();
$conn->close();
?>
