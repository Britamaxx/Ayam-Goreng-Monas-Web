<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_POST['tambah'])) {
  $nama = $_POST['nama'];
  $status = $_POST['status'];
  $gambar = $_FILES['gambar']['name'];
  $target = "./Source/Daftar menu/" . basename($gambar);

  $sql = "INSERT INTO menu (nama, gambar, status) VALUES ('$nama', '$gambar', '$status')";
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
    <title>Dashboard Admin - Manage Reviews</title>
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
        <h1>Kelola Review Pelanggan</h1>
        <p>Admin dapat melihat dan menghapus review pelanggan di sini.</p>
      </div>

      <div class="crud-container">
        <div class="table-section">
          <h2>Daftar Review</h2>
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
              echo "<td>
                      <a href='?hapus={$row['id']}' onclick='return confirm(\"Hapus review ini?\")'>
                        <button>Hapus</button>
                      </a>
                    </td>";
              echo "</tr>";
            }
            ?>
          </table>
        </div>
      </div>
    </section>
  </body>
</html>
