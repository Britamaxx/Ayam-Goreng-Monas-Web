<?php
include '../../conn.php';

if (isset($_POST['tambah'])) {
    $nama   = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jam    = $_POST['jam'];

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($tmp, "../../Source/" . $gambar);

    mysqli_query($conn, "INSERT INTO lokasi (nama, alamat, jam, gambar) 
                         VALUES ('$nama', '$alamat', '$jam', '$gambar')");

    header("Location: manage_lokasi.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Lokasi</title>
</head>
<body>

<h2>Tambah Lokasi</h2>

<form method="POST" enctype="multipart/form-data">
    Nama Lokasi:<br>
    <input type="text" name="nama" required><br><br>

    Alamat:<br>
    <textarea name="alamat" required></textarea><br><br>

    Jam Operasional:<br>
    <input type="text" name="jam" required><br><br>

    Upload Gambar:<br>
    <input type="file" name="gambar" required><br><br>

    <button type="submit" name="tambah">Tambah</button>
</form>

</body>
</html>
