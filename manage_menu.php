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

if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  mysqli_query($conn, "DELETE FROM menu WHERE id=$id");
  echo "<script>alert('Menu berhasil dihapus!');</script>";
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
        <li class="dashboard"><a href="admin.html">Dashboard</a></li>
        <li class="manage-menu active"><a href="manage_menu.php">Manage Menu</a></li>
        <li class="manage-review"><a href="manage_reviews.html">Manage Reviews</a></li>
      </ul>
    </section>

    <section class="main-content">
      <div class="content-header">
        <h1>Kelola Menu Restoran</h1>
        <p>Pilih aksi di bawah untuk menambah, memperbarui, atau menghapus menu.</p>
      </div>

      <div class="crud-container">
        <div class="form-section">
          <h2>Tambah Menu Baru</h2>
          <form method="POST" enctype="multipart/form-data">
            <input type="text" name="nama" placeholder="Nama menu" required />
            <input type="file" name="gambar" required />
            <input type="text" name="status" placeholder="Status (misal: FAVORITE)" />
            <button type="submit" name="tambah">Tambah</button>
          </form>
        </div>

        <div class="table-section">
          <h2>Daftar Menu</h2>
          <table border="1" cellpadding="8">
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>Gambar</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM menu");
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>{$row['id']}</td>";
              echo "<td>{$row['nama']}</td>";
              echo "<td><img src='./Source/Daftar menu/{$row['gambar']}' width='70'></td>";
              echo "<td>{$row['status']}</td>";
              echo "<td>
                      <button onclick=\"fillForm('{$row['id']}', '{$row['nama']}', '{$row['status']}')\">Edit</button>
                      <a href='?hapus={$row['id']}' onclick='return confirm(\"Hapus menu ini?\")'>
                        <button>Hapus</button>
                      </a>
                    </td>";
              echo "</tr>";
            }
            ?>
          </table>
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
