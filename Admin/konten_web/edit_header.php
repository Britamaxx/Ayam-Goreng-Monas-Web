<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
$header = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM header WHERE id = 1"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Header</title>
</head>

<body>
<h2>Edit Header</h2>

<form action="proses_update.php" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="tipe" value="header">

    <label>Nama Bisnis</label><br>
    <input type="text" name="nama_bisnis" value="<?= $header['nama_bisnis'] ?>"><br><br>

    <label>URL Lokasi Button</label><br>
    <input type="text" name="location_url" value="<?= $header['location_url'] ?>"><br><br>

    <label>Logo (biarkan kosong jika tidak diubah)</label><br>
    <input type="file" name="logo"><br><br>

    <button type="submit">Simpan Perubahan</button>

</form>

</body>
</html>
