
<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) { die("Koneksi gagal: " . mysqli_connect_error()); }

$header = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM header WHERE id = 1"));
$footer = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM footer WHERE id = 1"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pengaturan Konten Website</title>
</head>

<body>

<h1>Pengaturan Konten Website</h1>
<p>Kelola konten website seperti header dan footer.</p>
<hr>

<h2>Header</h2>
<p>
    Logo, nama bisnis, dan bilah navigasi<br><br>
    <a href="edit_header.php">Edit Header</a>
</p>

<hr>

<h2>Footer</h2>
<p>
    Kontak, cabang utama, peta, dan media sosial<br><br>
    <a href="edit_footer.php">Edit Footer</a>
</p>

</body>
</html>