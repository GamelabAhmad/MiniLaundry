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
    <div class="container-fluid dalneg">
        <a class="dalnegtx" href="javascript:history.back()"><i class="fa-solid fa-chevron-left" style="color: #030303;">
            </i>&ensp;Tambah Data Antrian</a>

        <form method="POST" action="tambahantri.php">
            <input type="text" name="nama" placeholder="Nama">
            <input type="text" name="berat" placeholder="Berat">
            <input type="text" name="alamat" placeholder="Alamat">
            <input type="text" name="no_telpn" placeholder="No. Telepon">
            <select type="text" name="jenis_kelamin" placeholder="Jenis Kelamin">
                <option value="">pilih gender</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>

            </select>
            <input type="date" name="tanggal_daftar" placeholder="Jenis Kelamin">
            <button type="submit">Tambah</button>
        </form>
        <script></script>
        <?php
        include "koneksi.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama = $_POST["nama"];
            $berat = $_POST["berat"];
            $alamat = $_POST["alamat"];
            $no_telp = $_POST["no_telpn"];
            $jenis_kelamin = $_POST["jenis_kelamin"];
            $tanggal_daftar = date("Y-m-d"); // Tanggal daftar diisi otomatis dengan tanggal saat ini

            $sql = "INSERT INTO antrian (nama, berat, alamat, no_telpn, jenis_kelamin, tanggal_daftar) VALUES ('$nama', '$berat', '$alamat', '$no_telp', '$jenis_kelamin', '$tanggal_daftar')";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success' role='alert'>Data berhasil ditambahkan</div>";
                echo "<script>window.location.href = 'antri.php';</script>"; // Mengarahkan ke antri.php setelah menambahkan data
            } else {
                echo "<div class='alert alert-danger' role='alert'>Error: " . $sql . "<br>" . $conn->error . "</div>";
            }
        }

        $conn->close();
        ?>


    </div>
</body>

</html>