
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

    echo "<script>alert('Footer berhasil diperbarui'); window.location='manage_konten.php';</script>";
    exit;
}

$footer = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM footer WHERE id = 1"));
?>

<!DOCTYPE html>
<html>
<head><title>Edit Footer</title></head>

<body>
<h2>Edit Footer</h2>

<form method="POST" enctype="multipart/form-data">

    <label>Slogan</label><br>
    <input type="text" name="slogan" value="<?= $footer['slogan'] ?>"><br><br>

    <label>Link Story</label><br>
    <input type="text" name="link_story" value="<?= $footer['link_story'] ?>"><br><br>

    <label>Link Menu</label><br>
    <input type="text" name="link_menu" value="<?= $footer['link_menu'] ?>"><br><br>

    <label>Link Berita</label><br>
    <input type="text" name="link_news" value="<?= $footer['link_news'] ?>"><br><br>

    <label>No WhatsApp</label><br>
    <input type="text" name="whatsapp" value="<?= $footer['whatsapp'] ?>"><br><br>

    <label>Email</label><br>
    <input type="text" name="email" value="<?= $footer['email'] ?>"><br><br>

    <label>Alamat</label><br>
    <textarea name="alamat"><?= $footer['alamat'] ?></textarea><br><br>

    <label>Google Maps Iframe</label><br>
    <textarea name="maps_embed"><?= $footer['maps_embed'] ?></textarea><br><br>

    <label>Instagram</label><br>
    <input type="text" name="instagram" value="<?= $footer['instagram'] ?>"><br><br>

    <label>TikTok</label><br>
    <input type="text" name="tiktok" value="<?= $footer['tiktok'] ?>"><br><br>

    <label>X (Twitter)</label><br>
    <input type="text" name="x" value="<?= $footer['x'] ?>"><br><br>

    <label>Facebook</label><br>
    <input type="text" name="facebook" value="<?= $footer['facebook'] ?>"><br><br>

    <label>Logo</label><br>
    <input type="file" name="logo"><br><br>

    <button type="submit">Simpan Perubahan</button>

</form>

</body>
</html>