<?php
include '../../conn.php';

if (isset($_POST['tambah'])) {
    $nama   = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jam    = $_POST['jam'];

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($tmp, "../../Source/" . $gambar);

    mysqli_query($conn, "INSERT INTO lokasi (nama, alamat, jam, gambar) 
                         VALUES ('$nama', '$alamat', '$jam', '$gambar')");

    header("Location: manage_lokasi.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Lokasi</title>
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
        <h1>Kelola Lokasi</h1>
        <p style ="margin-bottom: 10px">Pilih aksi di bawah untuk menambah, memperbarui, atau menghapus menu.</p>
      </div>

      <div class="crud-container">
        <div class="form-section">
          <h2>Tambah Lokasi Baru</h2>
          <form method="POST" enctype="multipart/form-data">
            <input type="text" name="nama" placeholder="Nama lokasi" required />
            <textarea name="alamat" placeholder ="Alamat" required></textarea>
            <input type="text" name="jam"  placeholder = "Jam operasional"required>
            <input type="file" name="gambar" required />
            <button type="submit" name="tambah">Tambah</button>
          </form>
        </div>
      </div>
    </section>
</body>
</html>