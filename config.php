<?php
    date_default_timezone_set('Asia/Jakarta');

    // Connection to the database using mysqli
    $Open = mysqli_connect("localhost", "root", "", "book_store");

    // Check connection
    if (!$Open) {
        die("MySQL connection error: " . mysqli_connect_error());
    }

    // If you need to select a database explicitly, it's already done in the connection above
    // but you can still use mysqli_select_db if you prefer
    $Koneksi = mysqli_select_db($Open, "book_store");
    if (!$Koneksi) {
        die("Database selection error: " . mysqli_error($Open));
    }
?>
