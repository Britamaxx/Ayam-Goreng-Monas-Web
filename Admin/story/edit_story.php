<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) die("Koneksi gagal: " . mysqli_connect_error());

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM story_timeline WHERE id=$id");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['edit'])) {
    $tahun = $_POST['tahun'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $posisi = $_POST['posisi'];

    // cek apakah ganti gambar
    if ($_FILES['gambar']['name'] != "") {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "../image/" . $gambar);
    } else {
        $gambar = $row['gambar'];
    }

    $sql = "UPDATE story_timeline 
            SET tahun='$tahun', judul='$judul', deskripsi='$deskripsi', gambar='$gambar', posisi='$posisi'
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: manage_story.php");
        exit;
    } else {
        echo "Gagal update: " . mysqli_error($conn);
    }
}
?>

<h2>Edit Story</h2>

<form method="POST" enctype="multipart/form-data">

    <label>Tahun:</label><br>
    <input type="text" name="tahun" value="<?= $row['tahun'] ?>" required><br><br>

    <label>Judul:</label><br>
    <input type="text" name="judul" value="<?= $row['judul'] ?>" required><br><br>

    <label>Deskripsi:</label><br>
    <textarea name="deskripsi" required><?= $row['deskripsi'] ?></textarea><br><br>

    <label>Gambar:</label><br>
    <img src="../image/<?= $row['gambar'] ?>" width="120"><br><br>
    <input type="file" name="gambar"><br><br>

    <label>Posisi:</label><br>
    <select name="posisi">
        <option value="left" <?= $row['posisi']=='left'?'selected':'' ?>>Left</option>
        <option value="right" <?= $row['posisi']=='right'?'selected':'' ?>>Right</option>
    </select><br><br>

    <button type="submit" name="edit">Update</button>
</form>
