<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  $query = "DELETE FROM menu WHERE id=$id";
  if (mysqli_query($conn, $query)) {
    echo "<script>
      alert('Menu berhasil dihapus!');
      window.location.href = 'manage_menu.php';
    </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin - Manage Menu</title>
    <link rel="icon" type="image/png" sizes="16x16" href="./source/<?php echo $h['logo']; ?>" />
    <link rel="stylesheet" href="../style_admin/manage_menu.css" />
    <script src="https://unpkg.com/feather-icons"></script>
  </head>
  <body>
    <?php 
    include "../layout/header_admin.php";
    include "../layout/sidebar_admin.php"; 
    ?>
    <section class="main-content">

      <div class="table-section">
        <div class="table-header">
          <h2>Daftar Menu</h2>

          <div class="table-tools">
            <input type="text" placeholder="Cari menu..." class="search-menu">

            <button class="filter-btn">
              <i data-feather="sliders"></i>
            </button>

            <a href="tambah_menu.php">
              <button class="add-btn">+ Tambah</button>
            </a>
          </div>
        </div>

        <table border="1" cellpadding="8">
          <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Gambar</th>
            <th>Status</th>
            <th>Deskripsi</th>
            <th>Kalori</th>
            <th>Karbohidrat</th>
            <th>Protein</th>
            <th>Aksi</th>
          </tr>
          <?php
          $result = mysqli_query($conn, "SELECT * FROM menu");
          while ($row = mysqli_fetch_assoc($result)) {
          
            $namaMenu = htmlspecialchars($row['nama'], ENT_QUOTES);
            
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['nama']}</td>";
            echo "<td><img class='menu-img' src='../../Source/Daftar menu/{$row['gambar']}'></td>";
            echo "<td>{$row['status']}</td>";
            echo "<td>{$row['deskripsi']}</td>";
            echo "<td>{$row['kalori']}</td>";
            echo "<td>{$row['karbohidrat']}</td>";
            echo "<td>{$row['protein']}</td>";

            echo "<td>
                    <a href='edit_menu.php?id={$row['id']}'><button>Edit</button></a>
                    <button onclick=\"showDeleteConfirmation({$row['id']}, '{$namaMenu}', 'menu')\">Hapus</button>
                  </td>"; 
            echo "</tr>";
          }
          ?>
        </table>
      </div>
    </section>

    <script src="../js/admin.js"></script>
    <script>
      feather.replace();
    </script>
  </body>
</html>