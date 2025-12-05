<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

/* =======================
   HAPUS DATA
======================= */
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  $query = "DELETE FROM berita WHERE id=$id";
  if (mysqli_query($conn, $query)) {
    echo "<script>
      alert('Berita berhasil dihapus!');
      window.location.href = 'manage_berita.php';
    </script>";
    exit;
  }
}

/* =======================
   PAGINATION
======================= */
$limit = 5; // jumlah berita per halaman
$page  = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// total data
$total_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM berita");
$total_data   = mysqli_fetch_assoc($total_result)['total'];

$total_page = ceil($total_data / $limit);

// ambil data sesuai halaman
$result = mysqli_query($conn, "
  SELECT * FROM berita 
  ORDER BY id ASC 
  LIMIT $start, $limit
");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dasbor Admin - Kelola Berita</title>
    <link rel="stylesheet" href="../style_admin/manage_menu.css" />
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
      .pagination {
        margin-top: 25px;
        text-align: center;
      }

      .page-btn {
        display: inline-block;
        padding: 8px 14px;
        margin: 2px;
        border-radius: 6px;
        border: 1px solid #ddd;
        text-decoration: none;
        font-size: 14px;
        color: #333;
        transition: 0.25s;
      }

      .page-btn:hover {
        background: #ff7a00;
        color: white;
        border-color: #ff7a00;
      }

      .page-btn.active {
        background: #ff7a00;
        color: white;
        border-color: #ff7a00;
      }
    </style>
  </head>

  <body>
    <?php 
      include "../layout/header_admin.php";
      include "../layout/sidebar_admin.php"; 
    ?>

    <section class="main-content">

      <div class="content-header">
        <h1>Kelola Berita</h1>
        <p>Kelola artikel dan berita restoran</p>
      </div>

      <div class="table-section">
        <div class="table-header">
          <input type="text" placeholder="Cari berita..." class="search-menu">

          <div class="table-tools">

            <a href="tambah_berita.php">
              <button class="add-btn">+ Tambah</button>
            </a>
          </div>
        </div>

        <table border="1" cellpadding="8" width="100%">
          <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Gambar</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
          </tr>

          <?php
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

            echo "<td style='max-width:300px; text-align:justify;'>{$row['deskripsi']}</td>";

            echo "<td>
                    <a href='edit_berita.php?id={$row['id']}'><button class='edit-btn'>Edit</button></a>
                    <button class='delete-btn' onclick=\"showDeleteConfirmation({$row['id']}, '{$judulBerita}', 'berita')\">Hapus</button>
                  </td>";
            echo "</tr>";
          }
          ?>
        </table>

        <!-- ==============================
             PAGINATION
        =============================== -->
        <div class="pagination">
          <?php
            for ($i = 1; $i <= $total_page; $i++) {
              $active = ($i == $page) ? "active" : "";
              echo "<a href='manage_berita.php?page=$i' class='page-btn $active'>$i</a>";
            }
          ?>
        </div>

      </div>

    </section>

    <script src="../js/admin.js"></script>
    <script> feather.replace(); </script>
  </body>
</html>
