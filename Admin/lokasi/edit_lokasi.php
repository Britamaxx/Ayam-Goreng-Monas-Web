<?php
include '../../conn.php';

$id = $_GET['id'];
$lokasi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM lokasi WHERE id=$id"));

if (isset($_POST['update'])) {
    $nama   = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jam    = $_POST['jam'];

    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "../../Source/" . $gambar);
    } else {
        $gambar = $lokasi['gambar']; 
    }

    mysqli_query($conn, "UPDATE lokasi SET 
                            nama='$nama',
                            alamat='$alamat',
                            jam='$jam',
                            gambar='$gambar'
                          WHERE id=$id");

    header("Location: manage_lokasi.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Kelola Lokasi Restoran</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- CSS utama admin -->
    <link rel="stylesheet" href="../style_admin/manage_menu.css" />
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        /* Override ringan supaya nyatu sama layout admin */

        body {
            background-color: #ffefe6; /* peach muda */
        }

        /* area konten di kanan sidebar */
        .page-wrapper {
        padding: 110px 40px 30px;  /* ⬅️ 110px atas biar turun dari navbar */
        margin-left: 230px;        /* sesuaikan dengan lebar sidebar_admin */
        min-height: calc(100vh - 80px);
        box-sizing: border-box;
        }

        @media (max-width: 900px) {
            .page-wrapper {
                margin-left: 0;
                padding: 20px 16px;
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
        .form-file {
            width: 100%;
            box-sizing: border-box;
            border-radius: 6px;
            border: 1.8px solid #f39c12;
            padding: 9px 11px;
            font-size: 14px;
            outline: none;
        }

        .form-input:focus,
        .form-textarea:focus {
            border-color: #e67e22;
            box-shadow: 0 0 0 2px rgba(230, 126, 34, 0.15);
        }

        .form-textarea {
            min-height: 80px;
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
        <div class="page-title">Kelola Lokasi Restoran</div>
        <div class="page-subtitle">
            Tambah, ubah, atau hapus lokasi yang muncul di halaman pelanggan
        </div>

        <div class="card">
            <div class="card-title">Perbarui Lokasi</div>

            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="form-label">Nama lokasi</label>
                    <input
                        type="text"
                        name="nama"
                        class="form-input"
                        value="<?= htmlspecialchars($lokasi['nama']); ?>"
                        required
                    />
                </div>

                <div class="form-group">
                    <label class="form-label">Alamat</label>
                    <textarea
                        name="alamat"
                        class="form-textarea"
                        required
                    ><?= htmlspecialchars($lokasi['alamat']); ?></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Jam operasional</label>
                    <input
                        type="text"
                        name="jam"
                        class="form-input"
                        value="<?= htmlspecialchars($lokasi['jam']); ?>"
                        required
                    />
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
                    />
                </div>

                <button type="submit" name="update" class="btn-submit">
                    Perbarui
                </button>
            </form>
        </div>
    </div>

    <script>
        feather.replace();
    </script>
</body>
</html>