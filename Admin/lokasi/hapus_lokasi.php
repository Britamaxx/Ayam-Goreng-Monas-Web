<?php
include '../../conn.php';

$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT gambar FROM lokasi WHERE id=$id"));
$gambar = $data['gambar'];

if (file_exists("../../Source/$gambar")) {
    unlink("../../Source/$gambar");
}

mysqli_query($conn, "DELETE FROM lokasi WHERE id=$id");

header("Location: manage_lokasi.php");
exit();
?>
