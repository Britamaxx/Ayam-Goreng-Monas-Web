<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  mysqli_query($conn, "DELETE FROM review WHERE id=$id");
  echo "<script>alert('Review berhasil dihapus!');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin - Manage Reviews</title>
    <link rel="icon" type="image/png" sizes="16x16" href="./source/Logo.png" />
    <link rel="stylesheet" href="./style/admin.css" />
    <link rel="stylesheet" href="./style/manage_reviews.css" />
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
        <li class="manage-review active"><a href="manage_reviews.php">Manage Reviews</a></li>
        <li class="manage berita"><a href="manage_berita.php">Manage berita</a></li>
      </ul>
    </section>

    <section class="main-content">
      <div class="content-header">
        <h1>Kelola Review Pelanggan</h1>
        <p>Admin dapat melihat dan menghapus review pelanggan di sini.</p>
      </div>

      <div class="table-section">
        <h2>Daftar Review</h2>
        <table border="1" cellpadding="8">
          <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Komentar</th>
            <th>Rating</th>
            <th>Tanggal</th>
            <th>Aksi</th>
          </tr>
          <?php
          $result = mysqli_query($conn, "SELECT * FROM review ORDER BY tanggal DESC");
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['nama']}</td>";
            echo "<td>{$row['komentar']}</td>";
            echo "<td>{$row['rating']}</td>";
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
    </section>

    <script>
      feather.replace()
    </script>
  </body>
</html>
