
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

    if (!empty($_FILES['logo']['name'])) {
        $targetDir = "uploads/";
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
<html>
<head>
    <title>Edit Header</title>
</head>

<body>

<h2>Edit Header</h2>

<form method="POST" enctype="multipart/form-data">

  <label>Logo </label><br>
  <input type="file" name="logo"><br><br>

  <label>Nama Bisnis:</label><br>
  <input type="text" name="nama_bisnis" value="<?= $header['nama_bisnis'] ?>"><br><br>

  <label>URL Lokasi:</label><br>
  <input type="text" name="location_url" value="<?= $header['location_url'] ?>"><br><br>

  <label>Nama Navigasi:</label><br>

  Home:<br>
  <input type="text" name="nav_home" value="<?= $header['nav_home'] ?>"><br>

  Story:<br>
  <input type="text" name="nav_story" value="<?= $header['nav_story'] ?>"><br>

  Menu:<br>
  <input type="text" name="nav_menu" value="<?= $header['nav_menu'] ?>"><br>

  News:<br>
  <input type="text" name="nav_news" value="<?= $header['nav_news'] ?>"><br>

  Review:<br>
  <input type="text" name="nav_review" value="<?= $header['nav_review'] ?>"><br><br>

  <button type="submit">Simpan Perubahan</button>

</form>

</body>
</html>