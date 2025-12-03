<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_POST['tambah'])) {
  $nama = $_POST['nama'];
  $status = $_POST['status'];
  $gambar = $_FILES['gambar']['name'];
  $deskripsi = $_POST['deskripsi'];
  $kalori = $_POST['kalori'];
  $karbo = $_POST['karbohidrat'];
  $protein = $_POST['protein'];
  $target = "./Source/Daftar menu/" . basename($gambar);

  $sql = "INSERT INTO menu (nama, gambar, status, deskripsi, kalori, karbohidrat, protein) VALUES ('$nama', '$gambar', '$status', '$deskripsi', '$kalori', '$karbo', '$protein')";
  mysqli_query($conn, $sql);
  move_uploaded_file($_FILES['gambar']['tmp_name'], $target);
  echo "<script>alert('Menu berhasil ditambahkan!');</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin - Manage Menu</title>
    <link rel="icon" type="image/png" sizes="16x16" href="./source/Logo.png" />
    <link rel="stylesheet" href="../style_admin/manage_menu.css" />
  </head>
  <body>
    <?php 
    include "../layout/header_admin.php";
    include "../layout/sidebar_admin.php"; 
    ?>
    <section class="main-content">
      <div class="content-header">
        <h1>Kelola Menu Restoran</h1>
        <p style ="margin-bottom: 10px">Pilih aksi di bawah untuk menambah, memperbarui, atau menghapus menu.</p>
      </div>

      <div class="crud-container">
        <div class="form-section">
          <h2>Tambah Menu Baru</h2>
          <form method="POST" enctype="multipart/form-data">
            <input type="text" name="nama" placeholder="Nama menu" required />
            <input type="file" name="gambar" required />
            <input type="text" name="status" placeholder="Status (misal: FAVORITE)" />
            <textarea name="deskripsi" placeholder="Deskripsi menu"></textarea>
            <input type="number" name="kalori" placeholder="Kalori" />
            <input type="number" name="karbohidrat" placeholder="Karbohidrat" />
            <input type="number" name="protein" placeholder="Protein" />

            <button type="submit" name="tambah">Tambah</button>
          </form>
        </div>
      </div>
    </section>
  </body>
</html>
