<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../../login_admin.php");
    exit();
}

// TAMBAHKAN INI - Mencegah browser cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

/* ============================================
   HANDLE DELETE
============================================ */
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  $query = "DELETE FROM review WHERE id=$id";
  if (mysqli_query($conn, $query)) {
    echo "<script>
      alert('Review berhasil dihapus!');
      window.location.href = 'manage_reviews.php';
    </script>";
    exit;
  }
}

/* ============================================
   PAGINATION SETUP
============================================ */
$limit = 5; // jumlah data per halaman
$page  = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// total data
$total_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM review");
$total_data   = mysqli_fetch_assoc($total_result)['total'];

$total_page = ceil($total_data / $limit);

/* ambil data sesuai halaman */
$result = mysqli_query($conn, "SELECT * FROM review ORDER BY tanggal DESC LIMIT $start, $limit");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin - Manage Reviews</title>
    <link rel="icon" type="image/png" sizes="16x16" href="./source/Logo.png" />
    <link rel="stylesheet" href="../style_admin/manage_menu.css" />
    <Script src="https://unpkg.com/feather-icons"></script>

    <style>
  .pagination {
    margin-top: 20px;
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
    transition: 0.2s;
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
        <h1>Kelola Ulasan</h1>
        <p>Kelola ulasan dan rating dari pelanggan</p>
      </div>

      <div class="table-section">
        
        <div class="table-header">
          <input type="text" placeholder="Cari ulasan..." class="search-menu">
          <div class="table-tools">
            
          </div>
        </div>

        <table border="1" cellpadding="8" width="100%">
          <thead>
          <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Komentar</th>
            <th>Rating</th>
            <th>Foto</th>
            <th>Tanggal</th>
            <th>Aksi</th>
          </tr>
          </thead>
          <?php
          while ($row = mysqli_fetch_assoc($result)) {

            $foto = "-";
            if (!empty($row['foto'])) {
              // Decide correct src:
              $raw = $row['foto'];

              // Normalize common patterns stored in DB:
              if (strpos($raw, './') === 0) {
                // './path/to/file' -> '../../path/to/file' (from admin folder)
                $imgSrc = preg_replace('#^\.//#', '../../', $raw);
              } elseif (stripos($raw, 'source/') === 0) {
                // 'Source/filename' stored -> make relative from admin: '../../Source/filename'
                $imgSrc = '../../' . $raw;
              } elseif (strpos($raw, '/') === 0) {
                // absolute path starting with '/' - use as-is
                $imgSrc = $raw;
              } else {
                // likely just a filename -> assume it's in main Source folder
                $imgSrc = '../../Source/' . $raw;
              }

              $foto = "<img src='{$imgSrc}' width='70' class='review-img'>";
            }

            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['nama']}</td>";
            echo "<td>{$row['komentar']}</td>";
            echo "<td>{$row['rating']}</td>";
            echo "<td>$foto</td>";
            echo "<td>{$row['tanggal']}</td>";
          
            echo "<td style='white-space: nowrap;'>
                    <button class='delete-btn' onclick=\"showDeleteConfirmation({$row['id']}, '{$row['nama']}')\">Hapus</button>
                  </td>";

            echo "</tr>";
          }
          ?>
        </table>

        <!-- ======================================
             PAGINATION BUTTONS
        ======================================= -->
        <div class="pagination">
  <?php
  for ($i = 1; $i <= $total_page; $i++) {
    $active = ($i == $page) ? "active" : "";
    echo "<a class='page-btn $active' href='manage_reviews.php?page=$i'>$i</a>";
  }
  ?>
</div>


      </div>
    </section>

    <script src="../js/admin.js"></script>
    <script>
      feather.replace();
      </script>
  </body>
</html>
