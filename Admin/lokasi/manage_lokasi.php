<?php
include '../../conn.php';

$data = mysqli_query($conn, "SELECT * FROM lokasi");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Lokasi - Admin</title>
    <link rel="stylesheet" href="../style_admin/admin.css">
</head>
<body>

<h2>Manage Lokasi</h2>
<a href="tambah_lokasi.php" class="btn-add">+ Tambah Lokasi</a>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama Lokasi</th>
        <th>Alamat</th>
        <th>Jam Operasional</th>
        <th>Gambar</th>
        <th>Aksi</th>
    </tr>

    <?php 
    $no = 1;
    while ($row = mysqli_fetch_assoc($data)) { 
    ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['nama']; ?></td>
        <td><?= $row['alamat']; ?></td>
        <td><?= $row['jam']; ?></td>
        <td><img src="../../Source/<?= $row['gambar']; ?>" width="120"></td>
        <td>
            <a href="edit_lokasi.php?id=<?= $row['id']; ?>" class="btn-edit">Edit</a>
            <a href="hapus_lokasi.php?id=<?= $row['id']; ?>" 
               class="btn-delete"
               onclick="return confirm('Yakin ingin menghapus?')">
               Hapus
            </a>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
