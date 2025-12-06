<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../../login_admin.php");
    exit();
}

// TAMBAHKAN INI - Mencegah browser cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

include '../../conn.php';

$id = $_GET['id'];
$slider = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM hero_slider WHERE id=$id"));

if (isset($_POST['update'])) {

    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "../../Background/slider/" . $gambar);
    } else {
        $gambar = $slider['gambar'];
    }

    mysqli_query($conn, "UPDATE hero_slider SET 
                            gambar='$gambar'
                         WHERE id=$id");

    header("Location: manage_beranda.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Edit Slider</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <link rel="stylesheet" href="../style_admin/manage_menu.css" />
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        body {
            background-color: #ffefe6;
        }

        .page-wrapper {
            padding: 110px 40px 30px;
            margin-left: 230px;
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
            margin-bottom: 4px;
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
            padding: 24px 28px;
            width: 100%;
            max-width: 1100px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: #e67e22;
            margin-bottom: 18px;
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

        .form-file {
            width: 100%;
            box-sizing: border-box;
            border-radius: 6px;
            border: 1.8px solid #f39c12;
            padding: 9px 11px;
            font-size: 14px;
            outline: none;
        }

        .form-file:focus {
            border-color: #e67e22;
            box-shadow: 0 0 0 2px rgba(230,126,34,0.15);
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
        <div class="page-title">Kelola Gambar Slider</div>
        <div class="page-subtitle">
            Edit banner yang tampil pada halaman beranda pelanggan
        </div>

        <div class="card">
            <div class="card-title">Edit Banner</div>

            <form method="POST" enctype="multipart/form-data">

            
                <div class="form-group">
                    <label class="form-label">Ganti Gambar</label>
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
