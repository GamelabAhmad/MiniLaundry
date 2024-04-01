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
      </i>&ensp;Antrian</a>
  </div>
  <div class="container">
    <button class="floating-button" id="btn-tambah" onclick="window.location.href = 'tambahantri.php';"><i class="fa-solid fa-plus"></i></button>
    <div>
      <?php
      session_start(); // Mulai session
      ?>
      <div class="container">
        <h1>Antrian</h1>
        <table id="antrian-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>Berat</th>
              <th>Alamat</th>
              <th>No telpn</th>
              <th>Jenis kelamin</th>
              <th>Tanggal daftar</th>
              <th>Action</th>
            </tr>
          </thead>
          <td>
            <?php
            include "koneksi.php";

            $sql = "SELECT * FROM antrian";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nama"] . "</td>";
                echo "<td>" . $row["berat"] . "</td>";
                echo "<td>" . $row["alamat"] . "</td>";
                echo "<td>" . $row["no_telpn"] . "</td>";
                echo "<td>" . $row["jenis_kelamin"] . "</td>";
                echo "<td>" . $row["tanggal_daftar"] . "</td>";
                echo "<td><a href='edit_antrian.php?id=" . $row["id"] . "'>Edit</a> | <a href='antri.php?id=" . $row["id"] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
                      |selesai
                      </td>";
                echo "</tr>";
              }
            } else {
              echo "0 results";
            }

            $conn->close();

            ?>


          </td>
        </table>
      </div>


      <?php

      include "koneksi.php";

      // Periksa apakah ada parameter ID yang dikirim melalui URL untuk penghapusan
      if (isset($_GET['id'])) {
        $id = $_GET['id']; // Dapatkan ID dari URL

        // Query untuk menghapus data dari tabel antrian
        $sql = "DELETE FROM antrian WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
          // Set pesan berhasil dihapus ke session
          $_SESSION['message'] = 'Data berhasil dihapus';
          // Mengarahkan kembali ke halaman antri.php setelah menghapus
          header("Location: antri.php");
          exit();
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }

      // Ambil data antrian dari database
      $sql = "SELECT * FROM antrian";
      $result = $conn->query($sql);
      ?>

    </div>
  </div>
  <?php
  // Periksa apakah pesan disetel di session
  if (isset($_SESSION['message'])) {
    // Tampilkan alert JavaScript
    echo "<script>alert('" . $_SESSION['message'] . "');</script>";
    // Hapus pesan dari session agar tidak tampil lagi
    unset($_SESSION['message']);
  }
  ?>
</body>

</html>