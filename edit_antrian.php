<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mini Laundry</title>
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
    <?php
    include "koneksi.php";

    $id = $_GET['id']; // Dapatkan ID dari URL
    $sql = "SELECT * FROM antrian WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nama = $row["nama"];
        $berat = $row["berat"];
        $alamat = $row["alamat"];
        $no_telpn = $row["no_telpn"];
        $jenis_kelamin = $row["jenis_kelamin"];
        $tanggal_daftar = $row["tanggal_daftar"];
    } else {
        echo "Data tidak ditemukan";
    }

    $conn->close();
    ?>

    <form method="POST" action="update_antrian.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="text" name="nama" value="<?php echo $nama; ?>" placeholder="Nama">
        <input type="text" name="berat" value="<?php echo $berat; ?>" placeholder="Berat">
        <input type="text" name="alamat" value="<?php echo $alamat; ?>" placeholder="Alamat">
        <input type="text" name="no_telpn" value="<?php echo $no_telpn; ?>" placeholder="No. Telepon">
        <select type="text" name="jenis_kelamin" placeholder="Jenis Kelamin">
            <option value=""><?php echo $jenis_kelamin; ?></option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>

        </select>
        <input type="date" name="tanggal_daftar" value="<?php echo $tanggal_daftar; ?>" placeholder="tanggal_daftar">
        <button type="submit">Update</button>
    </form>

    </div>
</body>

</html>