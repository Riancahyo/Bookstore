<?php
$kiriman = $_GET["data"];

// Sanitize input to prevent SQL injection
$kiriman = htmlspecialchars($kiriman, ENT_QUOTES, 'UTF-8');

include "koneksi.php";

// Create a prepared statement
$stmt = $conn->prepare("DELETE FROM `user` WHERE id_user = ?");
$stmt->bind_param("s", $kiriman);

// Execute the statement and check for success
if ($stmt->execute()) {
    ?>
    <script type="text/javascript">
        alert('Data Berhasil di Hapus');
        window.location = 'index.php';
    </script>
    <?php
} else {
    ?>
    <script type="text/javascript">
        alert('Data Gagal di Hapus');
        window.location = 'index.php';
    </script>
    <?php
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
