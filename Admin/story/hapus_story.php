<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) die("Koneksi gagal: " . mysqli_connect_error());

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM story_timeline WHERE id=$id");

header("Location: manage_story.php");
exit;
?>
