<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) die("Koneksi gagal: " . mysqli_connect_error());

$story = mysqli_query($conn, "SELECT * FROM story_timeline ORDER BY id DESC");
?>

<h2>Manage Story Timeline</h2>
<a href="tambah_story.php">+ Tambah Story</a>
<br><br>

<table border="1" cellspacing="0" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Tahun</th>
        <th>Judul</th>
        <th>Deskripsi</th>
        <th>Gambar</th>
        <th>Posisi</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($story)) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['tahun']); ?></td>
        <td><?php echo htmlspecialchars($row['judul']); ?></td>
        <td><?php echo htmlspecialchars(substr($row['deskripsi'], 0, 50)); ?>...</td>
        <td><img src="../image/<?php echo $row['gambar']; ?>" width="70"></td>
        <td><?php echo $row['posisi']; ?></td>
        <td>
            <a href="edit_story.php?id=<?php echo $row['id']; ?>">Edit</a> |
            <a href="hapus_story.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Hapus story ini?')">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>
