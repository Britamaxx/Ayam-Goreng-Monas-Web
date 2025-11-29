<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) { die("Koneksi gagal: " . mysqli_connect_error()); }

$header = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM header WHERE id = 1"));
$footer = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM footer WHERE id = 1"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin - Kelola Konten</title>
  <link rel="stylesheet" href="../style_admin/manage_menu.css"> <!-- reuse css -->
  <link rel="icon" type="image/png" sizes="16x16" href="./source/Logo.png" />
  <style>
    .content-card {
      background: #fff;
      border-radius: 16px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.08);
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .content-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.12);
    }

    .card-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 12px;
    }

    .card-header h2 {
      margin: 0;
      font-size: 20px;
      color: #1f2937;
    }

    .card-header a button {
      background: linear-gradient(135deg, #DC2626, #EF4444);
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.3s;
    }

    .card-header a button:hover {
      background: linear-gradient(135deg, #DC2626, #EF4444);
    }

    .card-content p {
      margin: 8px 0;
      color: #4B5563;
      line-height: 1.6;
    }

    @media (max-width: 768px) {
      .card-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
      }
    }
  </style>
</head>
<body>
  <?php 
    include "../layout/header_admin.php";
    include "../layout/sidebar_admin.php"; 
  ?>

  <section class="main-content">
    <div class="content-header">
      <h1>Kelola Konten Website</h1>
      <p>Kelola konten website seperti header dan footer melalui dashboard.</p>
    </div>

    <div class="content-card">
      <div class="card-header">
        <h2>Header Website</h2>
        <a href="edit_header.php"><button>Edit Header</button></a>
      </div>
      <div class="card-content">
        <p>
        Logo, nama bisnis, dan bilah navigasi<br><br>
      </div>
    </div>

    <div class="content-card">
      <div class="card-header">
        <h2>Footer Website</h2>
        <a href="edit_footer.php"><button>Edit Footer</button></a>
      </div>
      <div class="card-content">
        <p>
        Kontak, cabang utama, peta, dan media sosial<br><br>
      </div>
    </div>
  </section>

</body>
</html>
