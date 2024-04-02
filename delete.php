<?php
// Include file koneksi.php untuk menghubungkan ke database
include 'koneksi.php';

// Pastikan ID pelanggan yang akan dihapus ada dalam permintaan POST
if(isset($_POST['id'])) {
    // Escape input untuk mencegah serangan SQL injection
    $id_pelanggan = mysqli_real_escape_string($conn, $_POST['id']);

    // Buat dan jalankan kueri SQL untuk menghapus data pelanggan berdasarkan ID
    $sql = "DELETE FROM pelanggan WHERE id_pelanggan = $id_pelanggan";

    if ($conn->query($sql) === TRUE) {
        // Jika penghapusan berhasil, kembalikan respon berhasil
        http_response_code(200); // Kode status HTTP 200 untuk OK
        echo "Data pelanggan berhasil dihapus.";
    } else {
        // Jika terjadi kesalahan saat menghapus data, kembalikan respon gagal
        http_response_code(500); // Kode status HTTP 500 untuk Internal Server Error
        echo "Gagal menghapus data pelanggan: " . $conn->error;
    }
} else {
    // Jika permintaan tidak menyertakan ID pelanggan, kembalikan respon bad request
    http_response_code(400); // Kode status HTTP 400 untuk Bad Request
    echo "Permintaan tidak valid.";
}

// Tutup koneksi ke database
$conn->close();
?>
