<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $result = mysqli_query($conn, "SELECT * FROM menu WHERE id = $id");
  $menu = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $status = $_POST['status'];
  $deskripsi = $_POST['deskripsi'];
  $kalori = $_POST['kalori'];
  $karbo = $_POST['karbohidrat'];
  $protein = $_POST['protein'];

  if (!empty($_FILES['gambar']['name'])) {
    $gambar = $_FILES['gambar']['name'];
    $target = "../../Source/Daftar menu/" . basename($gambar);

    move_uploaded_file($_FILES['gambar']['tmp_name'], $target);

    $query = "UPDATE menu SET 
                nama='$nama',
                gambar='$gambar',
                status='$status',
                deskripsi='$deskripsi',
                kalori='$kalori',
                karbohidrat='$karbo',
                protein='$protein'
              WHERE id=$id";
  } else {
    $query = "UPDATE menu SET 
                nama='$nama',
                status='$status',
                deskripsi='$deskripsi',
                kalori='$kalori',
                karbohidrat='$karbo',
                protein='$protein'
              WHERE id=$id";
  }

  mysqli_query($conn, $query);
  echo "<script>alert('Menu berhasil diperbarui!'); window.location='manage_menu.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Menu</title>
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
        <h1>Edit Menu</h1>
        <p>Perbarui informasi menu di bawah ini.</p>
      </div>

      <div class="form-section">
        <h2>Form Edit Menu</h2>

        <form method="POST" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $menu['id']; ?>">

          <label>Nama Menu</label>
          <input type="text" name="nama" value="<?php echo $menu['nama']; ?>" required />

          <label>Gambar (opsional)</label>
          <input type="file" name="gambar" />

          <p>Gambar saat ini:</p>
          <img src="../../Source/Daftar menu/<?php echo $menu['gambar']; ?>" width="120">

          <label>Status</label>
          <input type="text" name="status" value="<?php echo $menu['status']; ?>" />

          <label>Deskripsi</label>
          <textarea name="deskripsi" rows="4"><?php echo $menu['deskripsi']; ?></textarea>

          <label>Kalori</label>
          <input type="number" name="kalori" value="<?php echo $menu['kalori']; ?>" />

          <label>Karbohidrat</label>
          <input type="number" name="karbohidrat" value="<?php echo $menu['karbohidrat']; ?>" />

          <label>Protein</label>
          <input type="number" name="protein" value="<?php echo $menu['protein']; ?>" />

          <button type="submit" name="update">Perbarui Menu</button>
        </form>
      </div>
    </section>

    <script>
      feather.replace()
    </script>
  </body>
</html>
