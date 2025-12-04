<?php
include "../../conn.php";

if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

/* ===========================
   PAGINATION
   =========================== */
$limit = 5; // jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Hitung total data
$totalData = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM story_timeline"));
$totalPages = ceil($totalData / $limit);

// Ambil data STORY sesuai halaman
$query = "SELECT * FROM story_timeline ORDER BY id ASC LIMIT $start, $limit";
$story = mysqli_query($conn, $query);

/* ===========================
   DELETE
   =========================== */
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  $query = "DELETE FROM story_timeline WHERE id=$id";

  if (mysqli_query($conn, $query)) {
    echo "<script>
      alert('Story berhasil dihapus!');
      window.location.href = 'manage_story.php';
    </script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
  <title>Dashboard Admin - Manage Story</title>

  <link rel="stylesheet" href="../style_admin/manage_menu.css" />
  <script src="https://unpkg.com/feather-icons"></script>

  <style>
    /* ===========================
       PAGINATION STYLE
       =========================== */

    .pagination {
      margin-top: 20px;
      text-align: center;
    }

    .pagination a {
      display: inline-block;
      padding: 8px 14px;
      margin: 0 4px;
      font-size: 14px;
      border-radius: 6px;
      text-decoration: none;
      color: #333;
      background: #f3f3f3;
      border: 1px solid #ddd;
      transition: 0.2s;
    }

    .pagination a:hover {
      background: #e6e6e6;
    }

    .pagination a.active {
      background: #ff7f00;
      color: white;
      border-color: #ff7f00;
      font-weight: bold;
    }

    .pagination .prev,
    .pagination .next {
      font-weight: 600;
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
    <h1>Kelola Cerita</h1>
    <p>Kelola timeline sejarah restoran</p>
  </div>

  <div class="table-section">

    <div class="table-header">
      <h2>Daftar Cerita</h2>

      <div class="table-tools">
        <input type="text" placeholder="Cari cerita..." class="search-menu">
        <button class="filter-btn">
          <i data-feather="sliders"></i>
        </button>

        <a href="tambah_story.php">
          <button class="add-btn">+ Tambah</button>
        </a>
      </div>
    </div>

    <table border="1" cellpadding="8">
      <tr>
        <th>ID</th>
        <th>Tahun</th>
        <th>Judul</th>
        <th>Deskripsi</th>
        <th>Gambar</th>
        <th>Posisi</th>
        <th>Aksi</th>
      </tr>

      <?php while ($row = mysqli_fetch_assoc($story)) { ?>

      <?php 
        $deskripsi = nl2br(htmlspecialchars($row['deskripsi']));

        $gambar = "-";
        if (!empty($row['gambar'])) {
            $paths = [
                "../../image/" . $row['gambar'],
                "../../Source/" . $row['gambar'],
                "../image/" . $row['gambar']
            ];

            foreach ($paths as $p) {
                if (file_exists($p)) {
                    $gambar = "<img class='menu-img' src='$p'>";
                    break;
                }
            }
        }
      ?>

      <tr>
        <td><?= $row['id']; ?></td>
        <td><?= htmlspecialchars($row['tahun']); ?></td>
        <td><?= htmlspecialchars($row['judul']); ?></td>
        <td><?= $deskripsi; ?></td>
        <td><?= $gambar; ?></td>
        <td><?= $row['posisi']; ?></td>

        <td style="white-space: nowrap;">
          <a href="edit_story.php?id=<?= $row['id']; ?>" style="text-decoration: none;">
            <button class='edit-btn'>Edit</button>
          </a>

          <button class='delete-btn' 
            onclick="showDeleteConfirmation(<?= $row['id']; ?>, '<?= htmlspecialchars($row['judul'], ENT_QUOTES); ?>', 'story_timeline')">
            Hapus
          </button>
        </td>
      </tr>

      <?php } ?>

    </table>

    <!-- ===========================
         PAGINATION
    ============================ -->
    <div class="pagination">
      <?php if ($page > 1) : ?>
        <a href="?page=<?= $page - 1 ?>" class="prev">‹ Prev</a>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
        <a 
          href="?page=<?= $i ?>" 
          class="<?= ($i == $page) ? 'active' : '' ?>">
          <?= $i ?>
        </a>
      <?php endfor; ?>

      <?php if ($page < $totalPages) : ?>
        <a href="?page=<?= $page + 1 ?>" class="next">Next ›</a>
      <?php endif; ?>
    </div>

  </div>
</section>

<script src="../js/admin.js"></script>
<script>
  feather.replace();
</script>

</body>
</html>
