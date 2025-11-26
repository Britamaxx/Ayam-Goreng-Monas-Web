<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
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

      <div class="table-section">
        <div>
          <h2>Daftar Menu</h2>
          <a href='tambah_menu.php'><button>Tambah</button><a/>
        </div>
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
            echo "<td><img class='menu-img' src='../../Source/Daftar menu/{$row['gambar']}'></td>";
            echo "<td>{$row['status']}</td>";
            echo "<td>
                    <a href='edit_menu.php?id={$row['id']}'><button>Edit</button><a/>
                    <a href='?hapus={$row['id']}' onclick='return confirm(\"Hapus menu ini?\")'>
                      <button>Hapus</button>
                    </a>
                  </td>"; 
            echo "</tr>";
          }
          ?>
        </table>
      </div>
    </section>
  </body>
</html>
