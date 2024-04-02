<?php
include 'koneksi.php';

$message = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Kueri SQL untuk mengambil data pelanggan berdasarkan id
    $sql = "SELECT * FROM pelanggan WHERE id_pelanggan=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $pelanggan = $result->fetch_assoc();
    } else {
        echo "Data pelanggan tidak ditemukan.";
        exit;
    }
} else {
    echo "ID pelanggan tidak ditentukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id = $_POST['id_pelanggan'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $titik_lokasi = $_POST['titik_lokasi'];
    $nomor_telepon1 = $_POST['nomor_telepon1'];
    $nomor_telepon2 = $_POST['nomor_telepon2'];

    // Kueri SQL untuk mengubah data pelanggan
    $sql = "UPDATE pelanggan SET
            nama='$nama', alamat='$alamat', titik_lokasi='$titik_lokasi',
            nomor_telepon1='$nomor_telepon1', nomor_telepon2='$nomor_telepon2'
            WHERE id_pelanggan=$id";

    if ($conn->query($sql) === TRUE) {
        $message = "Data pelanggan berhasil diubah.";
        echo "<script>
                alert('$message');
                window.location.href = 'dapel.php';
              </script>";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Pelanggan - Mini Laundry</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://kit.fontawesome.com/91d51d03ee.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<div id="navbar-placeholder"></div>
<script>
    const navbarPlaceholder = document.getElementById('navbar-placeholder');
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'navbar.html', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            navbarPlaceholder.innerHTML = xhr.responseText;
        }
    };
    xhr.send();
</script>
<div class="container-fluid dalneg">
    <a class="dalnegtx" href="javascript:history.back()"><i class="fa-solid fa-chevron-left" style="color: #030303;"></i>&ensp;Edit Pelanggan</a>
</div>
<div class="container">
    <form method="post" action="">
        <input type="hidden" name="id_pelanggan" value="<?php echo $pelanggan['id_pelanggan']; ?>">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $pelanggan['nama']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $pelanggan['alamat']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="titik_lokasi" class="form-label">Titik Lokasi</label>
            <input type="text" class="form-control" id="titik_lokasi" name="titik_lokasi" value="<?php echo $pelanggan['titik_lokasi']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="nomor_telepon1" class="form-label">Nomor Telepon 1</label>
            <input type="tel" class="form-control" id="nomor_telepon1" name="nomor_telepon1" value="<?php echo $pelanggan['nomor_telepon1']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="nomor_telepon2" class="form-label">Nomor Telepon 2</label>
            <input type="tel" class="form-control" id="nomor_telepon2" name="nomor_telepon2" value="<?php echo $pelanggan['nomor_telepon2']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
</body>
</html>