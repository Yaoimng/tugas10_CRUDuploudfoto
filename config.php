<?php
$server = "localhost";
$user = "root";
$password = "";
$nama_database = "pendaftaran_siswa";

$db = mysqli_connect($server, $user, $password, $nama_database);

if (!$db) {
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}

// Set timezone
date_default_timezone_set('UTC');

// Session start
if (!isset($_SESSION)) {
    session_start();
}
?>