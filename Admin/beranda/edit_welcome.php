<?php
include '../../conn.php';

// Ambil data welcome section
$welcome = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM welcome_section WHERE id = 1"));

// Ketika form disubmit
if (isset($_POST['simpan'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    $query = "UPDATE welcome_section SET 
                judul='$judul', 
                deskripsi='$deskripsi' 
              WHERE id = 1";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Welcome Section berhasil diperbarui!');
                window.location='manage_beranda.php';
              </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Bagian Sambutan</title>

    <link rel="stylesheet" href="../style_admin/manage_menu.css">
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
            margin-bottom: 6px;
            font-size: 14px;
            color: #555;
        }

        .form-input, .form-textarea {
            width: 100%;
            padding: 9px 11px;
            font-size: 14px;
            border: 1.8px solid #f39c12;
            border-radius: 6px;
            outline: none;
            box-sizing: border-box;
        }

        .form-input:focus,
        .form-textarea:focus {
            border-color: #e67e22;
            box-shadow: 0 0 0 2px rgba(230,126,34,0.15);
        }

        .form-textarea {
            min-height: 100px;
            resize: vertical;
        }

        .btn-submit {
            width: 100%;
            padding: 11px;
            background: linear-gradient(to right, #f39c12, #e67e22);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 15px;
            margin-top: 10px;
        }

        .btn-submit:hover {
            opacity: 0.92;
        }
    </style>
</head>

<body>
    <?php 
    include "../layout/header_admin.php";
    include "../layout/sidebar_admin.php";
    ?>

    <div class="page-wrapper">

        <div class="page-title">Kelola Bagian Sambutan</div>
        <div class="page-subtitle">Edit kalimat sambutan yang tampil di halaman beranda pelanggan</div>

        <div class="card">
            <div class="card-title">Edit Sambutan</div>

            <form method="POST">

                <div class="form-group">
                    <label class="form-label">Judul</label>
                    <input 
                        type="text" 
                        name="judul" 
                        class="form-input"
                        value="<?= htmlspecialchars($welcome['judul']); ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea 
                        name="deskripsi" 
                        class="form-textarea"
                        required
                    ><?= htmlspecialchars($welcome['deskripsi']); ?></textarea>
                </div>

                <button type="submit" name="simpan" class="btn-submit">Simpan Perubahan</button>

            </form>
        </div>
    </div>

    <script>
        feather.replace();
    </script>
</body>
</html>
