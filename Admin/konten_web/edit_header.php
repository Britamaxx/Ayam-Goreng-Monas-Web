<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama_bisnis   = $_POST['nama_bisnis'];
    $location_url  = $_POST['location_url'];
    $nav_home      = $_POST['nav_home'];
    $nav_story     = $_POST['nav_story'];
    $nav_menu      = $_POST['nav_menu'];
    $nav_news      = $_POST['nav_news'];
    $nav_review    = $_POST['nav_review'];

    // Upload logo baru jika ada
    if (!empty($_FILES['logo']['name'])) {

        $targetDir = "source/"; // <-- disamakan dengan header.php

        if (!is_dir($targetDir)) {
            mkdir($targetDir);
        }

        $logoName = time() . "_" . basename($_FILES['logo']['name']);
        move_uploaded_file($_FILES['logo']['tmp_name'], $targetDir . $logoName);

        $logo_sql = ", logo='$logoName'";
    } else {
        $logo_sql = "";
    }

    mysqli_query($conn, "
        UPDATE header SET
            nama_bisnis='$nama_bisnis',
            location_url='$location_url',
            nav_home='$nav_home',
            nav_story='$nav_story',
            nav_menu='$nav_menu',
            nav_news='$nav_news',
            nav_review='$nav_review'
            $logo_sql
        WHERE id = 1
    ");

    echo "<script>alert('Header berhasil diperbarui'); window.location='manage_konten.php';</script>";
    exit;
}

$header = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM header WHERE id = 1"));
?>

<!DOCTYPE html>
<html lang="en">

<style>
.orange-btn {
    background-color: #ff7a00;
    color: white;
    border: none;
    padding: 12px 18px;
    border-radius: 8px;
    font-size: 15px;
    cursor: pointer;
    transition: 0.2s;
}
.orange-btn:hover {
    background-color: #e86d00;
}
</style>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Header Website</title>
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
            <h1>Edit Header Website</h1>
            <p>Perbarui informasi header dan navigasi website Anda.</p>
        </div>

        <div class="form-section">
            <h2>Form Edit Header</h2>

            <form method="POST" enctype="multipart/form-data">

                <label>Logo Saat Ini</label><br>

                <?php if (!empty($header['logo'])): ?>
                    <img 
                        src="./source/<?= $header['logo']; ?>" 
                        width="120" 
                        style="border-radius: 10px; margin-bottom: 15px;"
                    >
                <?php else: ?>
                    <p style="color: gray; margin-bottom: 15px;">Belum ada logo.</p>
                <?php endif; ?>

                <label>Ganti Logo</label>
                <input type="file" name="logo">

                <label>Nama Bisnis</label>
                <input type="text" name="nama_bisnis" value="<?= $header['nama_bisnis'] ?>" required>

                <h3 style="margin-top: 25px;">Nama Menu Navigasi</h3>

                <label>Beranda</label>
                <input type="text" name="nav_home" value="<?= $header['nav_home'] ?>">

                <label>Cerita Kami</label>
                <input type="text" name="nav_story" value="<?= $header['nav_story'] ?>">

                <label>Menu</label>
                <input type="text" name="nav_menu" value="<?= $header['nav_menu'] ?>">

                <label>Berita</label>
                <input type="text" name="nav_news" value="<?= $header['nav_news'] ?>">

                <label>Ulasan</label>
                <input type="text" name="nav_review" value="<?= $header['nav_review'] ?>">

                <button type="submit" class="orange-btn" style="margin-top: 20px;">
                 Simpan Perubahan
                </button>

            </form>
        </div>

    </section>

    <script>
        feather.replace()
    </script>
</body>
</html>
