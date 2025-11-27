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
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin - Manage Berita</title>
    <link rel="icon" type="image/png" sizes="16x16" href="../Source/Logo.png" />
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
      </div>
    </section>
  </body>
</html>
