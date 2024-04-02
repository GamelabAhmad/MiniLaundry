<?php
<<<<<<< HEAD
$host = 'localhost'; // Sesuaikan dengan host database Anda
$username = 'root'; // Sesuaikan dengan username database Anda
$password = ''; // Sesuaikan dengan password database Anda
$database = 'laundry'; // Sesuaikan dengan nama database Anda

// Membuat koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
?>
=======
$host = "localhost"; // Sesuaikan dengan host Anda
$username = "root"; // Sesuaikan dengan username database Anda
$password = ""; // Sesuaikan dengan password database Anda
$database = "t_praktik3"; // Sesuaikan dengan nama database Anda

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
>>>>>>> 273a5dc9a499102bd05b76733770f70f256dbf1a
