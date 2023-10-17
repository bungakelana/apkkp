<?php

//nama file :koneksi.php
$servername = "localhost";
$username   = "root";
$password = "";
$database = "db_inventory";
$conn = mysqli_connect($servername, $username, $password, $database);

//cek koneksi
if (!$conn) {
    die("Koneksi Gagal :".mysqli_connect_error());
}

//echo "Koneksi berhasil";
mysqli_close($conn);
?>