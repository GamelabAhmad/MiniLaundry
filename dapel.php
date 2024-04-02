<?php
include 'koneksi.php';

// Kueri SQL untuk mengambil data pelanggan
$sql = "SELECT * FROM pelanggan";
$result = $conn->query($sql);
?>
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
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
        }

        .action-buttons button {
            margin-right: 5px;
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
<div class="container-fluid dalneg">                   
    <a class="dalnegtx" href="javascript:history.back()"><i class="fa-solid fa-chevron-left" style="color: #030303;"></i>&ensp;Data Pelanggan</a>
</div>
<div class="container">
    <button class="floating-button" onclick="window.location.href = 'tambahdapel.php';"><i class="fa-solid fa-plus"></i></button>
    <div style="height: 2000px;">
        <h2>Data Pelanggan</h2>
        <table>
            <tr>
                <th>ID Pelanggan</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Titik Lokasi</th>
                <th>Nomor Telepon 1</th>
                <th>Nomor Telepon 2</th>
                <th>Action</th> <!-- New column for action buttons -->
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['id_pelanggan']."</td>";
                    echo "<td>".$row['nama']."</td>";
                    echo "<td>".$row['alamat']."</td>";
                    echo "<td>".$row['titik_lokasi']."</td>";
                    echo "<td>".$row['nomor_telepon1']."</td>";
                    echo "<td>".$row['nomor_telepon2']."</td>";
                    // Add action buttons for edit and delete
                    echo "<td class='action-buttons'>
                            <button onclick='editFunction(".$row['id_pelanggan'].")'>Edit</button>
                            <button onclick='deleteFunction(".$row['id_pelanggan'].")'>Delete</button>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Tidak ada data pelanggan</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<!-- JavaScript functions for edit and delete -->
<script>
    function editFunction(id) {
        // Add your edit logic here, e.g., redirect to edit page with the specific id
        window.location.href = 'update.php?id=' + id;
    }

    function deleteFunction(id) {
    // Konfirmasi pengguna sebelum menghapus
    var confirmation = confirm('Apakah Anda yakin ingin menghapus catatan ini?');
    if (confirmation) {
        // Kirim permintaan AJAX untuk menghapus data
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'delete.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    // Berhasil menghapus
                    // Reload halaman untuk memperbarui daftar data
                    window.location.reload();
                } else {
                    // Gagal menghapus, tindakan apa yang perlu dilakukan?
                    alert('Gagal menghapus data.');
                }
            }
        };
        // Kirim ID pelanggan yang akan dihapus ke skrip delete.php
        xhr.send('id=' + id);
    }
}

</script>
</body>
</html>
