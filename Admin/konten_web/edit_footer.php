<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $slogan     = $_POST['slogan'];
    $link_story = $_POST['link_story'];
    $link_menu  = $_POST['link_menu'];
    $link_news  = $_POST['link_news'];
    $whatsapp   = $_POST['whatsapp'];
    $email      = $_POST['email'];
    $alamat     = $_POST['alamat'];
    $maps_embed = $_POST['maps_embed'];
    $instagram  = $_POST['instagram'];
    $tiktok     = $_POST['tiktok'];
    $x          = $_POST['x'];
    $facebook   = $_POST['facebook'];

    // Upload logo jika ada file baru
    if (!empty($_FILES['logo']['name'])) {
        $logo = "uploads/" . basename($_FILES['logo']['name']);
        move_uploaded_file($_FILES['logo']['tmp_name'], $logo);
        $logo_update = ", logo='$logo'";
    } else {
        $logo_update = "";
    }

    $query = "
        UPDATE footer SET
            slogan='$slogan',
            link_story='$link_story',
            link_menu='$link_menu',
            link_news='$link_news',
            whatsapp='$whatsapp',
            email='$email',
            alamat='$alamat',
            maps_embed='$maps_embed',
            instagram='$instagram',
            tiktok='$tiktok',
            x='$x',
            facebook='$facebook'
            $logo_update
        WHERE id = 1
    ";

    mysqli_query($conn, $query);

    echo "<script>alert('Footer berhasil diperbarui!'); window.location='manage_konten.php';</script>";
    exit;
}

$footer = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM footer WHERE id = 1"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Footer</title>

    <link rel="icon" type="image/png" sizes="16x16" href="./source/Logo.png" />
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
            <h1>Edit Footer</h1>
            <p>Perbarui informasi footer website di bawah ini.</p>
        </div>

        <div class="form-section">
            <h2>Form Edit Footer</h2>

            <form method="POST" enctype="multipart/form-data">

                <label>Slogan</label>
                <input type="text" name="slogan" value="<?= $footer['slogan'] ?>" required />

                <label>Link Story</label>
                <input type="text" name="link_story" value="<?= $footer['link_story'] ?>" />

                <label>Link Menu</label>
                <input type="text" name="link_menu" value="<?= $footer['link_menu'] ?>" />

                <label>Link Berita</label>
                <input type="text" name="link_news" value="<?= $footer['link_news'] ?>" />

                <label>No WhatsApp</label>
                <input type="text" name="whatsapp" value="<?= $footer['whatsapp'] ?>" />

                <label>Email</label>
                <input type="text" name="email" value="<?= $footer['email'] ?>" />

                <label>Alamat</label>
                <textarea name="alamat" rows="3"><?= $footer['alamat'] ?></textarea>

                <label>Google Maps Embed</label>
                <textarea name="maps_embed" rows="3"><?= $footer['maps_embed'] ?></textarea>

                <label>Instagram</label>
                <input type="text" name="instagram" value="<?= $footer['instagram'] ?>" />

                <label>TikTok</label>
                <input type="text" name="tiktok" value="<?= $footer['tiktok'] ?>" />

                <label>X (Twitter)</label>
                <input type="text" name="x" value="<?= $footer['x'] ?>" />

                <label>Facebook</label>
                <input type="text" name="facebook" value="<?= $footer['facebook'] ?>" />

                <label>Logo </label>
                <input type="file" name="logo" />

                <p>Logo saat ini </p>
                <?php if (!empty($footer['logo'])): ?>
                    <img src="<?= $footer['logo'] ?>" width="120">
                <?php else: ?>
                    <p><i>Belum ada logo</i></p>
                <?php endif; ?>

                <button type="submit">Simpan Perubahan</button>

            </form>
        </div>

    </section>

    <script>
        feather.replace()
    </script>

</body>
</html>
