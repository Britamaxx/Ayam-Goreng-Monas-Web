<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

// Handle delete request
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  $query = "DELETE FROM berita WHERE id=$id";
  if (mysqli_query($conn, $query)) {
    echo "<script>
      alert('Berita berhasil dihapus!');
      window.location.href = 'manage_berita.php';
    </script>";
  }
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
    <style>
      /* Modal Overlay */
      .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        opacity: 0;
        transition: opacity 0.3s ease;
      }

      .modal-overlay.show {
        opacity: 1;
      }

      .modal-overlay.show .modal-content {
        transform: scale(1);
        opacity: 1;
      }

      /* Modal Content */
      .modal-content {
        background: #ffffff;
        border-radius: 20px;
        padding: 40px;
        max-width: 450px;
        width: 90%;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        transform: scale(0.9);
        opacity: 0;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
      }

      /* Modal Icon */
      .modal-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, #FEE2E2, #FECACA);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: pulse 2s infinite;
      }

      .modal-icon svg {
        color: #DC2626;
      }

      @keyframes pulse {
        0%, 100% {
          transform: scale(1);
        }
        50% {
          transform: scale(1.05);
        }
      }

      /* Modal Title */
      .modal-title {
        font-size: 26px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 12px;
        font-family: "Poppins", sans-serif;
      }

      /* Modal Message */
      .modal-message {
        font-size: 16px;
        color: #4B5563;
        margin-bottom: 12px;
        line-height: 1.6;
      }

      .modal-message strong {
        color: #DC2626;
        font-weight: 600;
      }

      /* Modal Warning */
      .modal-warning {
        font-size: 14px;
        color: #DC2626;
        font-weight: 500;
        margin-bottom: 30px;
        padding: 10px;
        background: #FEF2F2;
        border-radius: 8px;
        border-left: 4px solid #DC2626;
      }

      /* Modal Actions */
      .modal-actions {
        display: flex;
        gap: 12px;
        justify-content: center;
      }

      .modal-actions button {
        flex: 1;
        padding: 14px 24px;
        border: none;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
        font-family: "Poppins", sans-serif;
      }

      /* Cancel Button */
      .btn-cancel {
        background: #F3F4F6;
        color: #6B7280;
        border: 2px solid #E5E7EB;
      }

      .btn-cancel:hover {
        background: #E5E7EB;
        color: #374151;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      }

      /* Delete Button */
      .btn-delete {
        background: linear-gradient(135deg, #DC2626, #EF4444);
        color: white;
        box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
      }

      .btn-delete:hover {
        background: linear-gradient(135deg, #B91C1C, #DC2626);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(220, 38, 38, 0.4);
      }

      @media (max-width: 768px) {
        .modal-content {
          padding: 30px 20px;
        }
        
        .modal-actions {
          flex-direction: column;
        }
      }
    </style>
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
          <h2>Daftar Berita</h2>

          <div class="table-tools">
            <input type="text" placeholder="Cari berita..." class="search-menu">

            <button class="filter-btn">
              <i data-feather="sliders"></i>
            </button>

            <a href="tambah_berita.php">
              <button class="add-btn">+ Tambah</button>
            </a>
          </div>
        </div>
        <table border="1" cellpadding="8">
          <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Gambar</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
          </tr>
          <?php
          $result = mysqli_query($conn, "SELECT * FROM berita");
          while ($row = mysqli_fetch_assoc($result)) {
            // Escape judul berita untuk JavaScript
            $judulBerita = htmlspecialchars($row['judul'], ENT_QUOTES);
            
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['judul']}</td>";
            echo "<td><img src='../../../Source/Berita/{$row['gambar']}' width='70'></td>";
            echo "<td style='max-width:300px;text-align:justify;'>{$row['deskripsi']}</td>";
            echo "<td>
                    <a href='edit_berita.php?id={$row['id']}'><button>Edit</button></a>
                    <button onclick=\"showDeleteConfirmation({$row['id']}, '{$judulBerita}', 'berita')\">Hapus</button>
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