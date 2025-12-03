<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  $query = "DELETE FROM berita WHERE id=$id";
  if (mysqli_query($conn, $query)) {
    echo "<script>
      alert('Berita berhasil dihapus!');
      window.location.href = 'manage_berita.php';
    </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin - Manage Berita</title>
    <link rel="icon" type="image/png" sizes="16x16" href="./source/<?php echo $h['logo']; ?>" />
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
          <h2>Daftar Berita</h2>

          <div class="table-tools">
            <input type="text" placeholder="Cari berita..." class="search-menu">

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
            $judulBerita = htmlspecialchars($row['judul'], ENT_QUOTES);
            
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['judul']}</td>";
            $gambar = "-";
            if (!empty($row['gambar'])) {
            $gambar = "<img src='../../Source/Berita/{$row['gambar']}' width='70' style='border-radius:6px;'>";
            }
            echo "<td>$gambar</td>";

            echo "<td style='max-width:300px;text-align:justify;'>{$row['deskripsi']}</td>";
            echo "<td>
                    <a href='edit_berita.php?id={$row['id']}'><button class='edit-btn'>Edit</button></a>
                    <button class='delete-btn' onclick=\"showDeleteConfirmation({$row['id']}, '{$judulBerita}', 'berita')\">Hapus</button>
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