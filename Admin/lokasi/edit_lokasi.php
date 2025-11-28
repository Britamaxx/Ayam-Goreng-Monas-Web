<?php
include '../../conn.php';

$id = $_GET['id'];
$lokasi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM lokasi WHERE id=$id"));

if (isset($_POST['update'])) {
    $nama   = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jam    = $_POST['jam'];

    if ($_FILES['gambar']['name'] != "") {
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
<html>
<head>
    <title>Edit Lokasi</title>
</head>
<body>

<h2>Edit Lokasi</h2>

<form method="POST" enctype="multipart/form-data">
    Nama Lokasi:<br>
    <input type="text" name="nama" value="<?= $lokasi['nama']; ?>" required><br><br>

    Alamat:<br>
    <textarea name="alamat" required><?= $lokasi['alamat']; ?></textarea><br><br>

    Jam Operasional:<br>
    <input type="text" name="jam" value="<?= $lokasi['jam']; ?>" required><br><br>

    Gambar Sekarang:<br>
    <img src="../../Source/<?= $lokasi['gambar']; ?>" width="150"><br><br>

    Ganti Gambar (opsional):<br>
    <input type="file" name="gambar"><br><br>

    <button type="submit" name="update">Update</button>
</form>

</body>
</html>
