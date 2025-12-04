

<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) { die("Koneksi gagal: " . mysqli_connect_error()); }

$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT gambar FROM hero_slider WHERE id=$id"));
$path = "../Background/slider/" . $data['gambar'];

// Hapus file gambar
if (file_exists($path)) {
    unlink($path);
}

// Hapus data dari database
mysqli_query($conn, "DELETE FROM hero_slider WHERE id=$id");

header("Location: manage_beranda.php");
exit;
?>