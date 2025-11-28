<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
$footer = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM footer WHERE id = 1"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Footer</title>
</head>

<body>
<h2>Edit Footer</h2>

<form action="proses_update.php" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="tipe" value="footer">

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

    <label>Logo (biarkan kosong jika tidak diubah)</label><br>
    <input type="file" name="logo"><br><br>

    <button type="submit">Simpan Perubahan</button>

</form>

</body>
</html>
