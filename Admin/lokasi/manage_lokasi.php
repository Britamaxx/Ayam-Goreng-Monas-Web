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

include "../../conn.php";

if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  $query = "DELETE FROM lokasi WHERE id=$id";

  if (mysqli_query($conn, $query)) {
    echo "<script>
      alert('Lokasi berhasil dihapus!');
      window.location.href = 'manage_lokasi.php';
    </script>";
    exit;
  }
}


$limit = 5; // jumlah data per halaman
$page  = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// total data
$total_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM lokasi");
$total_data   = mysqli_fetch_assoc($total_result)['total'];

$total_page = ceil($total_data / $limit);

// ambil data sesuai halaman
$result = mysqli_query($conn, "
  SELECT * FROM lokasi 
  ORDER BY id ASC 
  LIMIT $start, $limit
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dasbor Admin - Kelola Lokasi</title>
  <link rel="icon" type="image/png" sizes="16x16" href="../source/Logo.png" />
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

    .menu-img {
      width: 70px;
      border-radius: 6px;
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
    <h1>Kelola Lokasi</h1>
    <p>Kelola cabang dan lokasi restoran</p>
  </div>

  <div class="table-section">

    <div class="table-header">
       <input type="text" placeholder="Cari lokasi..." class="search-menu">
      <div class="table-tools">

        <a href="tambah_lokasi.php">
          <button class="add-btn">+ Tambah</button>
        </a>
      </div>
    </div>

    <table border="1" cellpadding="8" width="100%">
      <tr>
        <th>ID</th>
        <th>Nama Lokasi</th>
        <th>Alamat</th>
        <th>Jam Operasional</th>
        <th>Gambar</th>
        <th>Aksi</th>
      </tr>

      <?php
      while ($row = mysqli_fetch_assoc($result)) {
        $namaLokasi = htmlspecialchars($row['nama'], ENT_QUOTES);

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

        echo "<td style='white-space: nowrap;'>
                <a href='edit_lokasi.php?id={$row['id']}'><button class='edit-btn'>Edit</button></a>
                <button class='delete-btn' onclick=\"showDeleteConfirmation({$row['id']}, '{$namaLokasi}', 'lokasi')\">Hapus</button>
              </td>";
        echo "</tr>";
      }
      ?>

    </table>

    <!-- PAGINATION -->
    <div class="pagination">
      <?php
      for ($i = 1; $i <= $total_page; $i++) {
        $active = ($i == $page) ? "active" : "";
        echo "<a href='manage_lokasi.php?page=$i' class='page-btn $active'>$i</a>";
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
