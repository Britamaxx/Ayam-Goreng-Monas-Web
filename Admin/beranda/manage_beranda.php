

<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) { die("Koneksi gagal: " . mysqli_connect_error()); }

$slider = mysqli_query($conn, "SELECT * FROM hero_slider ORDER BY id ASC");
$welcome = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM welcome_section WHERE id = 1"));

$menuUnggulan = mysqli_query($conn, "
    SELECT beranda_menu.id, menu.nama, menu.gambar 
    FROM beranda_menu 
    JOIN menu ON beranda_menu.id_menu = menu.id
");

$review = mysqli_query($conn, "SELECT * FROM review ORDER BY id DESC LIMIT 3");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Beranda</title>
  <link rel="stylesheet" href="../style_admin/manage_menu.css">
  <link rel="icon" type="image/png" sizes="16x16" href="../../Source/Logo.png" />
  <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>

<?php 
  include "../layout/header_admin.php";
  include "../layout/sidebar_admin.php"; 
?>

<section class="main-content">

  <div class="content-header">
    <h1>Kelola Beranda Website</h1>
    <p>Edit banner, bagian sambutan, dan menu unggulan.</p>
  </div>

  <div class="table-section">
    <div class="table-header">
      <h2>Banner Hero Slider</h2>
      <a href="tambah_slider.php"><button class="add-btn">Tambah Gambar</button></a>
    </div>

    <table>
      <thead>
        <tr>
          <th style="width:60px; text-align:center;">No</th>
          <th>Pratinjau</th>
          <th>Aksi</th>
        </tr>
      </thead>

      <tbody>
        <?php $no = 1; while($row = mysqli_fetch_assoc($slider)): ?>
        <tr>
          <td style="text-align:center;"><?= $no++ ?></td>

          <td>
             <img src="../../Source/Background/slider/<?= $row['gambar']; ?>" class="slider-preview">
          </td>


          <td>
            <a href="edit_slider.php?id=<?= $row['id']; ?>">
              <button class="edit-btn">Edit</button>
            </a>

            <a onclick="return confirm('Yakin hapus gambar?')" 
               href="hapus_slider.php?id=<?= $row['id']; ?>">
              <button class="delete-btn">Hapus</button>
            </a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
</div>


  <div class="table-section">
    <div class="table-header">
      <h2>Bagian Sambutan</h2>
      <a href="edit_welcome.php"><button class="add-btn">Edit Sambutan</button></a>
    </div>

    <p>Edit teks sambutan yang tampil pada halaman beranda.</p>
  </div>

<?php
// Ambil semua menu
$allMenu = mysqli_query($conn, "SELECT * FROM menu ORDER BY nama ASC");

// Ambil menu yang sudah dipilih
$selected = mysqli_query($conn, "SELECT id_menu FROM beranda_menu");
$selectedMenu = [];
while ($s = mysqli_fetch_assoc($selected)) {
    $selectedMenu[] = $s['id_menu'];
}

// Jika form disubmit
if (isset($_POST['simpan_menu'])) {
    // Hapus semua data lama
    mysqli_query($conn, "DELETE FROM beranda_menu");

    // Simpan pilihan baru
    if (!empty($_POST['menu'])) {
        foreach ($_POST['menu'] as $idMenu) {
            mysqli_query($conn, "INSERT INTO beranda_menu (id_menu) VALUES ('$idMenu')");
        }
    }

    echo "<script>alert('Menu unggulan berhasil diperbarui!'); window.location.href='manage_beranda.php';</script>";
}
?>

<div class="table-section">
  <div class="table-header">
    <h2>Menu Unggulan</h2>
  </div>

  <form method="POST">
    <table>
      <thead>
        <tr>
          <th>Pilih</th>
          <th>Nama Menu</th>
          <th>Gambar</th>
        </tr>
      </thead>

      <tbody>
        <?php while($m = mysqli_fetch_assoc($allMenu)): ?>
        <tr>
          <td>
            <input 
              type="checkbox" 
              name="menu[]" 
              value="<?= $m['id'] ?>" 
              <?= in_array($m['id'], $selectedMenu) ? 'checked' : '' ?>
            >
          </td>

          <td><?= $m['nama'] ?></td>

        <td>
          <img src="../../Source/Daftar menu/<?= $m['gambar']; ?>" height="60">
        </td>

        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

    <button type="submit" name="simpan_menu" class="add-btn" style="margin-top:20px; display: block; margin-left: auto; margin-right: auto;">
        Simpan Menu Unggulan
    </button>
  </form>
</div>


</section>

<script> feather.replace(); </script>

</body>
</html>