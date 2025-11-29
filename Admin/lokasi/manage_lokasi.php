<?php
include "../../conn.php";

if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

// Handle delete request
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  $query = "DELETE FROM lokasi WHERE id=$id";

  if (mysqli_query($conn, $query)) {
    echo "<script>
      alert('Lokasi berhasil dihapus!');
      window.location.href = 'manage_lokasi.php';
    </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin - Manage Lokasi</title>
    <link rel="icon" type="image/png" sizes="16x16" href="../source/Logo.png" />
    <link rel="stylesheet" href="../style_admin/manage_menu.css" />

    <script src="https://unpkg.com/feather-icons"></script>
  </head>

  <body>
    <?php 
    include "../layout/header_admin.php";
    include "../layout/sidebar_admin.php"; 
    ?>

    <section class="main-content">

      <div class="content-header">
        <h1>Kelola Lokasi Cabang</h1>
        <p>Kelola daftar lokasi cabang restoran, termasuk alamat, jam operasional, dan gambar lokasi.</p>
      </div>

      <div class="table-section">

        <div class="table-header">
          <h2>Daftar Lokasi</h2>

          <div class="table-tools">
            <input type="text" placeholder="Cari lokasi..." class="search-menu">
            <button class="filter-btn">
              <i data-feather="sliders"></i>
            </button>

            <a href="tambah_lokasi.php">
              <button class="add-btn">+ Tambah</button>
            </a>
          </div>
        </div>

        <table border="1" cellpadding="8">
          <tr>
            <th>ID</th>
            <th>Nama Lokasi</th>
            <th>Alamat</th>
            <th>Jam Operasional</th>
            <th>Gambar</th>
            <th>Aksi</th>
          </tr>

          <?php
          $result = mysqli_query($conn, "SELECT * FROM lokasi");

          while ($row = mysqli_fetch_assoc($result)) {

            $namaLokasi = htmlspecialchars($row['nama'], ENT_QUOTES);

            // Jika gambar kosong
            $gambar = "-";
            if (!empty($row['gambar'])) {
              $gambar = "<img class='menu-img' src='../../Source/{$row['gambar']}'>";
            }

            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['nama']}</td>";
            echo "<td>{$row['alamat']}</td>";
            echo "<td>{$row['jam']}</td>";
            echo "<td>$gambar</td>";

            echo "<td>
                    <a href='edit_lokasi.php?id={$row['id']}'><button>Edit</button></a>
                    <button onclick=\"showDeleteConfirmation({$row['id']}, '{$namaLokasi}', 'lokasi')\">Hapus</button>
                  </td>";
            echo "</tr>";
          }
          ?>

        </table>
      </div>
    </section>

    <script src="../js/admin.js"></script>
    <script>
      feather.replace();
    </script>
  </body>
</html>
