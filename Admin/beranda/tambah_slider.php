<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) { die("Koneksi gagal: " . mysqli_connect_error()); }

if (isset($_POST['submit'])) {

    $filename = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    // folder tujuan (samakan struktur folder kamu)
    $folder = "../Source/Background/slider/" . $filename;

    if (move_uploaded_file($tmp, $folder)) {
        mysqli_query($conn, "INSERT INTO hero_slider (gambar) VALUES ('$filename')");
        echo "<script>alert('Banner slider berhasil ditambahkan!'); window.location.href='manage_beranda.php';</script>";
        exit;
    } else {
        echo "<script>alert('Upload gagal!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Slider</title>
    <link rel="stylesheet" href="../style_admin/manage_menu.css">
    <link rel="icon" type="image/png" sizes="16x16" href="./source/Logo.png" />
</head>
<body>

<?php 
include "../layout/header_admin.php";
include "../layout/sidebar_admin.php"; 
?>

<section class="main-content">

    <div class="content-header">
        <h1>Kelola Banner Slider</h1>
        <p style="margin-bottom: 10px">Tambahkan banner untuk hero slider di halaman beranda.</p>
    </div>

    <div class="crud-container">
        <div class="form-section">
            <h2>Tambah Banner Slider</h2>

            <form method="POST" enctype="multipart/form-data">

                <label>Unggah Gambar</label>
                <input type="file" name="gambar" required />

                <button type="submit" name="submit" class="add-btn">Simpan</button>
                <a href="manage_beranda.php">
                    <button type="button" class="cancel-btn">Batal</button>
                </a>

            </form>
        </div>
    </div>

</section>

</body>
</html>
