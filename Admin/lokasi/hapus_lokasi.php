<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../../login_admin.php");
    exit();
}

// TAMBAHKAN INI - Mencegah browser cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

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
