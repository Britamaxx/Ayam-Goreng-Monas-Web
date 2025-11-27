<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
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
        <p>Tambah, ubah, atau hapus berita yang muncul di halaman pelanggan</p>
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
