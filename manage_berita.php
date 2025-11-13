<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_POST['tambah'])) {
  $judul = $_POST['judul'];
  $deskripsi = $_POST['deskripsi'];
  $gambar = $_FILES['gambar']['name'];
  $target = "./Source/Berita/" . basename($gambar);

  $sql = "INSERT INTO berita (judul, gambar, deskripsi) VALUES ('$judul', '$gambar', '$deskripsi')";
  mysqli_query($conn, $sql);
  move_uploaded_file($_FILES['gambar']['tmp_name'], $target);
  echo "<script>alert('Berita berhasil ditambahkan!');</script>";
}

if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  mysqli_query($conn, "DELETE FROM berita WHERE id=$id");
  echo "<script>alert('Berita berhasil dihapus!');</script>";
}

if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $judul = $_POST['judul'];
  $deskripsi = $_POST['deskripsi'];

  if (!empty($_FILES['gambar']['name'])) {
    $gambar = $_FILES['gambar']['name'];
    $target = "./Source/Berita/" . basename($gambar);
    move_uploaded_file($_FILES['gambar']['tmp_name'], $target);
    $query = "UPDATE berita SET judul='$judul', gambar='$gambar', deskripsi='$deskripsi' WHERE id=$id";
  } else {
    $query = "UPDATE berita SET judul='$judul', deskripsi='$deskripsi' WHERE id=$id";
  }

  mysqli_query($conn, $query);
  echo "<script>alert('Berita berhasil diperbarui!');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin - Manage Berita</title>
    <link rel="icon" type="image/png" sizes="16x16" href="./source/Logo.png" />
    <link rel="stylesheet" href="./style/manage_menu.css" />
    <script src="https://unpkg.com/feather-icons"></script>
  </head>
  <body>
    <section class="navbar">
      <div class="header-left">
        <div class="restaurant-logo">
          <img src="./source/Logo.png" alt="restaurant-logo" />
        </div>
        <div class="restaurant-name">AYAM GORENG MONAS</div>
      </div>
      <div class="search-bar">
        <input type="text" placeholder="Search..." />
      </div>
      <div class="header-right">
        <div class="setting-button">
          <i data-feather="settings" class="setting-btn"></i>
        </div>
        <div class="profile">
          <img src="./source/admin.png" alt="admin-profile" />
        </div>
      </div>
    </section>

    <section class="sidebar">
      <ul class="sidebar-menu">
        <li class="dashboard"><a href="admin.php">Dashboard</a></li>
        <li class="manage-menu"><a href="manage_menu.php">Manage Menu</a></li>
        <li class="manage-review"><a href="manage_reviews.php">Manage Reviews</a></li>
        <li class="manage-berita active"><a href="manage_berita.php">Manage Berita</a></li>
      </ul>
    </section>

    <section class="main-content">
      <div class="content-header">
        <h1>Kelola Berita Restoran</h1>
        <p>Tambah, ubah, atau hapus berita yang muncul di halaman pelanggan.</p>
      </div>

      <div class="crud-container">
        <div class="form-section">
          <h2>Tambah Berita Baru</h2>
          <form method="POST" enctype="multipart/form-data">
            <input type="text" name="judul" placeholder="Judul berita" required />
            <input type="file" name="gambar" required />
            <textarea name="deskripsi" rows="4" placeholder="Deskripsi berita..." required></textarea>
            <button type="submit" name="tambah">Tambah</button>
          </form>
        </div>

        <div class="table-section">
          <h2>Daftar Berita</h2>
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
              echo "<td><img src='./Source/Berita/{$row['gambar']}' width='70'></td>";
              echo "<td style='max-width:300px;text-align:justify;'>{$row['deskripsi']}</td>";
              echo "<td>
                      <button onclick=\"fillForm('{$row['id']}', '{$row['judul']}', '{$row['deskripsi']}')\">Edit</button>
                      <a href='?hapus={$row['id']}' onclick='return confirm(\"Hapus berita ini?\")'>
                        <button>Hapus</button>
                      </a>
                    </td>";
              echo "</tr>";
            }
            ?>
          </table>
        </div>

        <div class="form-section">
          <h2>Update Berita</h2>
          <form method="POST" enctype="multipart/form-data">
            <input type="hidden" id="edit-id" name="id" />
            <input type="text" id="edit-judul" name="judul" placeholder="Judul berita" required />
            <input type="file" name="gambar" />
            <textarea id="edit-deskripsi" name="deskripsi" rows="4" placeholder="Deskripsi berita..."></textarea>
            <button type="submit" name="update">Update</button>
          </form>
        </div>
      </div>
    </section>

    <script>
      feather.replace();

      function fillForm(id, judul, deskripsi) {
        document.getElementById("edit-id").value = id;
        document.getElementById("edit-judul").value = judul;
        document.getElementById("edit-deskripsi").value = deskripsi;
        window.scrollTo(0, document.body.scrollHeight);
      }
    </script>
  </body>
</html>
