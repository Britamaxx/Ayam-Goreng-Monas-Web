<?php
include '../../conn.php';

if (isset($_POST['tambah'])) {
    $tahun     = $_POST['tahun'];
    $judul     = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $posisi    = $_POST['posisi'];

    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($tmp, "../../image/" . $gambar);

    mysqli_query($conn, "
        INSERT INTO story_timeline (tahun, judul, deskripsi, gambar, posisi)
        VALUES ('$tahun', '$judul', '$deskripsi', '$gambar', '$posisi')
    ");

    header("Location: manage_story.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Cerita</title>
    <link rel="icon" type="image/png" href="../source/Logo.png" />
    <link rel="stylesheet" href="../style_admin/manage_menu.css" />
</head>

<body>

<?php 
    include "../layout/header_admin.php";
    include "../layout/sidebar_admin.php"; 
?>

<section class="main-content">

    <div class="content-header">
        <h1>Kelola Cerita</h1>
        <p style="margin-bottom: 10px;">Tambah cerita baru pada timeline sejarah restoran Anda.</p>
    </div>

    <div class="crud-container">
        <div class="form-section">

            <h2>Tambah Cerita Baru</h2>

            <form method="POST" enctype="multipart/form-data">

                <input type="text" 
                       name="tahun" 
                       placeholder="Tahun" 
                       required />

                <input type="text" 
                       name="judul" 
                       placeholder="Judul Story" 
                       required />

                <textarea name="deskripsi" 
                          placeholder="Deskripsi lengkap" 
                          required></textarea>

                <input type="file" 
                       name="gambar" 
                       required />


                <button type="submit" name="tambah">Tambah Cerita</button>

            </form>

        </div>
    </div>

</section>

</body>
</html>
