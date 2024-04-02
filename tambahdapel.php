<?php
include 'koneksi.php';

// Inisialisasi variabel untuk menyimpan pesan kesalahan atau berhasil
$message = '';

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $titik_lokasi = $_POST['titik_lokasi'];
    $nomor_telepon1 = $_POST['nomor_telepon1'];
    $nomor_telepon2 = $_POST['nomor_telepon2'];

    // Kueri SQL untuk menyisipkan data ke database
    $sql = "INSERT INTO pelanggan (nama, alamat, titik_lokasi, nomor_telepon1, nomor_telepon2) 
            VALUES ('$nama', '$alamat', '$titik_lokasi', '$nomor_telepon1', '$nomor_telepon2')";

    if ($conn->query($sql) === TRUE) {
        $message = "Data pelanggan berhasil ditambahkan.";
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
    <style>
        /* CSS untuk pesan pop-up */
        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: none;
        }
    </style>
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
    <div class="container">
        <div class="mt-3">
            <h2>Tambah Pelanggan</h2>
            <form method="post">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="titik_lokasi" class="form-label">Titik Lokasi</label>
                    <input type="text" class="form-control" id="titik_lokasi" name="titik_lokasi" required>
                </div>
                <div class="mb-3">
                    <label for="nomor_telepon1" class="form-label">Nomor Telepon 1</label>
                    <input type="text" class="form-control" id="nomor_telepon1" name="nomor_telepon1" required>
                </div>
                <div class="mb-3">
                    <label for="nomor_telepon2" class="form-label">Nomor Telepon 2</label>
                    <input type="text" class="form-control" id="nomor_telepon2" name="nomor_telepon2">
                </div>
                <button type="submit" class="btn btn-primary">Tambahkan</button>
            </form>
            <div id="popup" class="popup">
                <?php echo $message; ?>
            </div>
        </div>
    </div>

    <script>
        // JavaScript untuk menampilkan pesan pop-up
        const popup = document.getElementById('popup');
        if (popup.innerHTML !== '') {
            popup.style.display = 'block';
            setTimeout(() => {
                popup.style.display = 'none';
            }); // Hide popup after 3 seconds
            
        }
        
    </script>
</body>
</html>
