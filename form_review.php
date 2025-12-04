
<?php
include "conn.php";

$header = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM header WHERE id = 1"));

$footer = mysqli_query($conn, "SELECT * FROM footer WHERE id = 1");
$f = mysqli_fetch_assoc($footer);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $rating = intval($_POST['rating']);
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $komentar = mysqli_real_escape_string($conn, $_POST['komentar']);

    $foto = "";
    if (!empty($_FILES['foto']['name'])) {
        $namaFile = $_FILES['foto']['name'];
        $tmpFile = $_FILES['foto']['tmp_name'];

        $folder = "uploads/";
        if (!is_dir($folder)) mkdir($folder, 0777, true);

        $uniqueName = time() . "_" . $namaFile;

        if (move_uploaded_file($tmpFile, $folder . $uniqueName)) {
            $foto = $uniqueName;
        }
    }

    $query = "INSERT INTO review (nama, rating, tanggal, komentar, foto)
              VALUES ('$nama', '$rating', '$tanggal', '$komentar', '$foto')";
              
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Review berhasil ditambahkan!'); window.location='review.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan review.');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Ulasan - Ayam Goreng Monas</title>
    <link rel="stylesheet" href="./style/header.css" />
    <link rel="stylesheet" href="./style/review.css" />
    <link rel="stylesheet" href="./style/footer.css" />
    <link rel="stylesheet" href="./style/form_review.css" />

    <link rel="icon" type="image/png" sizes="16x16" href="./source/<?php echo $header['logo']; ?>" />
    <script src="./script.js" defer></script>
</head>

<body>

<?php include 'header.php'; ?>


<section class="form-section">
    <h2>Tambahkan Ulasan Anda</h2>

    <form action="" method="POST" enctype="multipart/form-data" class="review-form">

        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" required />

        <label for="rating">Rating</label>
        <select id="rating" name="rating" required>
            <option value="">-- Pilih Rating --</option>
            <option value="5">★★★★★ (5)</option>
            <option value="4">★★★★ (4)</option>
            <option value="3">★★★ (3)</option>
            <option value="2">★★ (2)</option>
            <option value="1">★ (1)</option>
        </select>

        <label for="tanggal">Tanggal</label>
        <input type="date" id="tanggal" name="tanggal" required />

        <label for="komentar">Komentar</label>
        <textarea id="komentar" name="komentar" rows="5" required></textarea>

        <label for="foto">Foto</label>
        <input type="file" id="foto" name="foto" accept="image/*" />

        <button type="submit" class="submit-btn">Kirim Ulasan</button>
        <a href="review.php" class="cancel-btn">Batal</a>
    </form>
</section>


<?php include 'footer.php'; ?>

</body>
</html>