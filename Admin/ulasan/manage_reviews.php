<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

// Handle delete request
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  $query = "DELETE FROM review WHERE id=$id";
  if (mysqli_query($conn, $query)) {
    echo "<script>
      alert('Review berhasil dihapus!');
      window.location.href = 'manage_reviews.php';
    </script>";
  }
}

if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $status = $_POST['status'];

  if (!empty($_FILES['gambar']['name'])) {
    $gambar = $_FILES['gambar']['name'];
    $target = "./Source/Daftar menu/" . basename($gambar);
    move_uploaded_file($_FILES['gambar']['tmp_name'], $target);
    $query = "UPDATE menu SET nama='$nama', gambar='$gambar', status='$status' WHERE id=$id";
  } else {
    $query = "UPDATE menu SET nama='$nama', status='$status' WHERE id=$id";
  }

  mysqli_query($conn, $query);
  echo "<script>alert('Menu berhasil diperbarui!');</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin - Manage Reviews</title>
    <link rel="icon" type="image/png" sizes="16x16" href="./source/Logo.png" />
    <link rel="stylesheet" href="../style_admin/manage_menu.css" />
  </head>
  <body>
    <?php 
    include "../layout/header_admin.php";
    include "../layout/sidebar_admin.php"; 
    ?>
  
    <section class="main-content">
      <div class="table-section">
        
        <div class="table-header">
          <h2>Daftar Ulasan</h2>
          
          <div class="table-tools">
            <input type="text" placeholder="Cari ulasan..." class="search-menu">

            <button class="filter-btn">
              <i data-feather="sliders"></i>
            </button>

            <a href="tambah_review.php">
              <button class="add-btn">+ Tambah</button>
            </a>
          </div>
        </div>

        <table border="1" cellpadding="8">
          <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Komentar</th>
            <th>Rating</th>
            <th>Foto</th>
            <th>Tanggal</th>
            <th>Aksi</th>
          </tr>
          <?php
          $result = mysqli_query($conn, "SELECT * FROM review ORDER BY tanggal DESC");
          while ($row = mysqli_fetch_assoc($result)) {

            $foto = "-";
            if (!empty($row['foto'])) {
              $foto = "<img src='./uploads/{$row['foto']}' width='70'>";
            }

            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['nama']}</td>";
            echo "<td>{$row['komentar']}</td>";
            echo "<td>{$row['rating']}</td>";
            echo "<td>$foto</td>";
            echo "<td>{$row['tanggal']}</td>";
            echo "<td style='white-space: nowrap;'>
                    <a href='edit_review.php?id={$row['id']}' style='display: inline-block; text-decoration: none;'><button>Edit</button></a>
                    <button onclick=\"showDeleteConfirmation({$row['id']}, '{$row['nama']}')\">Hapus</button>
                  </td>";
            echo "</tr>";
          }
          ?>
        </table>
      </div>
    </section>

    <script src="../js/admin.js"></script>
  </body>
</html>