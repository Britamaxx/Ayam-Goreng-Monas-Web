<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) die("Koneksi gagal: " . mysqli_connect_error());

if (isset($_POST['tambah'])) {
    $tahun = $_POST['tahun'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $posisi = $_POST['posisi'];

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($tmp, "../image/" . $gambar);

    $sql = "INSERT INTO story_timeline (tahun, judul, deskripsi, gambar, posisi)
            VALUES ('$tahun', '$judul', '$deskripsi', '$gambar', '$posisi')";

    if (mysqli_query($conn, $sql)) {
        header("Location: manage_story.php");
        exit;
    } else {
        echo "Gagal: " . mysqli_error($conn);
    }
}
?>

<h2>Tambah Story</h2>

<form method="POST" enctype="multipart/form-data">
    <label>Tahun:</label><br>
    <input type="text" name="tahun" required><br><br>

    <label>Judul:</label><br>
    <input type="text" name="judul" required><br><br>

    <label>Deskripsi:</label><br>
    <textarea name="deskripsi" required></textarea><br><br>

    <label>Gambar:</label><br>
    <input type="file" name="gambar" required><br><br>

    <label>Posisi:</label><br>
    <select name="posisi">
        <option value="left">Left</option>
        <option value="right">Right</option>
    </select><br><br>

    <button type="submit" name="tambah">Simpan</button>
</form>
