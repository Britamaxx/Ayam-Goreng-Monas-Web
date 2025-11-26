<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
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
    <title>Dashboard Admin - Manage Menu</title>
    <link rel="icon" type="image/png" sizes="16x16" href="./source/Logo.png" />
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
        <h1>Kelola Menu Restoran</h1>
        <p>Pilih aksi di bawah untuk menambah, memperbarui, atau menghapus menu.</p>
      </div>
      
      <div class="form-section">
        <h2>Update Menu</h2>
        <form method="POST" enctype="multipart/form-data">
          <input type="hidden" id="edit-id" name="id" />
          <input type="text" id="edit-nama" name="nama" placeholder="Nama menu" required />
          <input type="file" name="gambar" />
          <input type="text" id="edit-status" name="status" placeholder="Status" />
          <button type="submit" name="update">Update</button>
        </form>
      </div>
    </section>

    <script>
      feather.replace()
      function fillForm(id, nama, status) {
        document.getElementById("edit-id").value = id;
        document.getElementById("edit-nama").value = nama;
        document.getElementById("edit-status").value = status;
        window.scrollTo(0, document.body.scrollHeight);
      }
    </script>
  </body>
</html>
