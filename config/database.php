<?php
$host = "localhost";
$user = "root";
$pass = ""; // Kosongkan jika password root Laragon Anda kosong
$db   = "db_mvc_native";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>