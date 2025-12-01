<?php
include "../../conn.php";

if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

$story = mysqli_query($conn, "SELECT * FROM story_timeline ORDER BY id ASC");

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

        $path1 = "../../image/" . $row['gambar'];
        $path2 = "../../Source/" . $row['gambar'];
        $path3 = "../image/" . $row['gambar'];

        if (file_exists($path1)) {
            $gambar = "<img class='menu-img' src='$path1'>";
        } 
        else if (file_exists($path2)) {
            $gambar = "<img class='menu-img' src='$path2'>";
        } 
        else if (file_exists($path3)) {
            $gambar = "<img class='menu-img' src='$path3'>";
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

        <td>
          <a href="edit_story.php?id=<?= $row['id']; ?>">
            <button>Edit</button>
          </a>

          <button onclick="showDeleteConfirmation(<?= $row['id']; ?>, '<?= htmlspecialchars($row['judul'], ENT_QUOTES); ?>', 'story_timeline')">
            Hapus
          </button>
        </td>
      </tr>

      <?php } ?>

    </table>
  </div>
</section>

<script src="../js/admin.js"></script>
<script>
  feather.replace();
</script>

</body>
</html>
