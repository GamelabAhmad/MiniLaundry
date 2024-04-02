<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $berat = $_POST["berat"];
    $alamat = $_POST["alamat"];
    $no_telpn = $_POST["no_telpn"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $tanggal_daftar = $_POST["tanggal_daftar"];

    $sql = "UPDATE antrian SET nama='$nama', berat='$berat', alamat='$alamat', no_telpn='$no_telpn', jenis_kelamin='$jenis_kelamin', tanggal_daftar='$tanggal_daftar'  WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = 'Data berhasil diubah'; // Menyimpan pesan ke session
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
header("Location: antri.php"); // Mengarahkan kembali ke antri.php
exit();
