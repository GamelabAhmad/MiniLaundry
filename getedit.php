<?php
// Konfigurasi koneksi ke database
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

// Mendapatkan ID pelanggan dari parameter URL
$id = $_GET['id'];

// Kueri SQL untuk mengambil data pelanggan berdasarkan ID
$sql = "SELECT * FROM pelanggan WHERE ID_Pelanggan = $id";
$result = $conn->query($sql);

// Menangani kesalahan kueri
if (!$result) {
    die("Kueri SQL gagal: " . $conn->error);
}

// Mendapatkan data pelanggan sebagai array asosiatif
$pelanggan = $result->fetch_assoc();

// Menutup koneksi database
$conn->close();

// Mengirimkan data dalam format JSON
echo json_encode($pelanggan);
?>
