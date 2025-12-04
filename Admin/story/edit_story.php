<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) die("Koneksi gagal: " . mysqli_connect_error());

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM story_timeline WHERE id=$id");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['edit'])) {
    $tahun = $_POST['tahun'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $posisi = $_POST['posisi'];

    // cek apakah ganti gambar
    if ($_FILES['gambar']['name'] != "") {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "../image/" . $gambar);
    } else {
        $gambar = $row['gambar'];
    }

    $sql = "UPDATE story_timeline 
            SET tahun='$tahun', judul='$judul', deskripsi='$deskripsi', gambar='$gambar', posisi='$posisi'
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: manage_story.php");
        exit;
    } else {
        echo "Gagal update: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Edit Story Timeline</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- CSS utama admin -->
    <link rel="stylesheet" href="../style_admin/manage_menu.css" />
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
    body {
        margin: 0;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        background-color: #ffefe6; /* peach muda */
    }

    /* area konten di kanan sidebar & di bawah header */
    .page-wrapper {
        padding: 110px 40px 30px;   /* offset dari navbar */
        margin-left: 260px;         /* ⬅️ SESUAIKAN dengan lebar sidebar kamu */
        box-sizing: border-box;
    }

    @media (max-width: 900px) {
        .page-wrapper {
            margin-left: 0;              /* di mobile sidebar biasanya hidden */
            padding: 100px 16px 20px;
        }
    }

    .page-title {
        font-size: 24px;
        font-weight: 700;
        color: #d35400;
        margin: 0 0 4px 0;
    }

    .page-subtitle {
        font-size: 13px;
        color: #666;
        margin-bottom: 20px;
    }

    .card {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        padding: 24px 28px 28px 28px;
        width: 100%;
        max-width: 1100px;
    }

    .card-title {
        font-size: 18px;
        font-weight: 600;
        color: #e67e22;
        margin-bottom: 18px;
    }

    form {
        margin-top: 5px;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .form-label {
        display: block;
        font-size: 14px;
        margin-bottom: 6px;
        color: #555;
    }

    .form-input,
    .form-textarea,
    .form-file,
    .form-select {
        width: 100%;
        box-sizing: border-box;
        border-radius: 6px;
        border: 1.8px solid #f39c12;
        padding: 9px 11px;
        font-size: 14px;
        outline: none;
    }

    .form-input:focus,
    .form-textarea:focus,
    .form-select:focus {
        border-color: #e67e22;
        box-shadow: 0 0 0 2px rgba(230, 126, 34, 0.15);
    }

    .form-textarea {
        min-height: 90px;
        resize: vertical;
    }

    .current-image {
        margin-top: 6px;
    }

    .current-image img {
        border-radius: 6px;
        border: 1px solid #eee;
    }

    .btn-submit {
        width: 100%;
        padding: 11px 16px;
        border: none;
        border-radius: 6px;
        background: linear-gradient(to right, #f39c12, #e67e22);
        color: #fff;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 5px;
    }

    .btn-submit:hover {
        opacity: 0.93;
    }
</style>

</head>
<body>
    <?php 
    include "../layout/header_admin.php";
    include "../layout/sidebar_admin.php"; 
    ?>

    <div class="page-wrapper">
        <div class="page-title">Kelola Cerita Restoran</div>
        <div class="page-subtitle">
            Ubah detail story timeline yang tampil di halaman pelanggan
        </div>

        <div class="card">
            <div class="card-title">Perbarui Cerita</div>

            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="form-label">Tahun</label>
                    <input 
                        type="text" 
                        name="tahun" 
                        class="form-input" 
                        value="<?= htmlspecialchars($row['tahun']); ?>" 
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">Judul</label>
                    <input 
                        type="text" 
                        name="judul" 
                        class="form-input" 
                        value="<?= htmlspecialchars($row['judul']); ?>" 
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea 
                        name="deskripsi" 
                        class="form-textarea" 
                        required
                    ><?= htmlspecialchars($row['deskripsi']); ?></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Gambar sekarang</label>
                    <div class="current-image">
                        <img src="../../Source/<?= htmlspecialchars($lokasi['gambar']); ?>" width="150" alt="Gambar lokasi">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Ganti gambar</label>
                    <input 
                        type="file" 
                        name="gambar" 
                        class="form-file" 
                        accept="image/*"
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">Posisi</label>
                    <select name="posisi" class="form-select">
                        <option value="left"  <?= $row['posisi']=='left'  ? 'selected' : ''; ?>>Left</option>
                        <option value="right" <?= $row['posisi']=='right' ? 'selected' : ''; ?>>Right</option>
                    </select>
                </div>

                <button type="submit" name="edit" class="btn-submit">
                    Perbarui Cerita
                </button>
            </form>
        </div>
    </div>

    <script>
        feather.replace();
    </script>
</body>

</html>