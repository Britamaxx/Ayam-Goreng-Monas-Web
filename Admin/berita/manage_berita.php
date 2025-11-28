<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin - Manage Berita</title>
    <link rel="icon" type="image/png" sizes="16x16" href="./source/Logo.png" />
    <link rel="stylesheet" href="../style_admin/manage_menu.css" />
    <script src="https://unpkg.com/feather-icons"></script>
  </head>
  <body>
    <?php 
    include "../layout/header_admin.php";
    include "../layout/sidebar_admin.php"; 
    ?>
    <section class="main-content">
      <div class="table-section">
        <div class="table-header">
          <h2>Daftar Menu</h2>

          <div class="table-tools">
            <input type="text" placeholder="Cari menu..." class="search-menu">

            <button class="filter-btn">
              <i data-feather="sliders"></i>
            </button>

            <a href="tambah_berita.php">
              <button class="add-btn">+ Tambah</button>
            </a>
          </div>
        </div>
        <table border="1" cellpadding="8">
          <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Gambar</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
          </tr>
          <?php
          $result = mysqli_query($conn, "SELECT * FROM berita");
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['judul']}</td>";
            echo "<td><img src='../../../Source/Berita/{$row['gambar']}' width='70'></td>";
            echo "<td style='max-width:300px;text-align:justify;'>{$row['deskripsi']}</td>";
            echo "<td>
                    <a href='edit_berita.php?id={$row['id']}'><button>Edit</button><a/>
                    <a href='?hapus={$row['id']}' onclick='return confirm(\"Hapus menu ini?\")'>
                      <button>Hapus</button>
                    </a>
                  </td>";
            echo "</tr>";
          }
          ?>
        </table>
      </div>
    </section>
  </body>
</html>
