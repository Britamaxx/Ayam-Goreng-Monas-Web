<?php
include "conn.php";

$header = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM header WHERE id = 1"));

$footer = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM footer WHERE id = 1"));

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
    <title>Tambah Review - Ayam Goreng Monas</title>
    <link rel="stylesheet" href="./style/header.css" />
    <link rel="stylesheet" href="./style/review.css" />
    <link rel="stylesheet" href="./style/footer.css" />
    <link rel="stylesheet" href="./style/form_review.css" />

    <link rel="icon" type="image/png" sizes="16x16" href="./source/<?php echo $header['logo']; ?>" />
    <script src="./script.js" defer></script>
</head>

<body>

<section class="main-header">
    <div class="header-left">
        <div class="restaurant-logo">
            <img src="./source/<?php echo $header['logo']; ?>" alt="Restaurant Logo" />
        </div>
        <div class="restaurant-name"><?php echo $header['nama_bisnis']; ?></div>
    </div>
    <nav class="header-middle">
        <a href="<?php echo $header['location_url']; ?>" class="nav home">Beranda</a>
        <a href="story.php" class="nav story">Cerita Kami</a>
        <a href="menu.php" class="nav menu">Menu</a>
        <a href="news.php" class="nav news">Berita</a>
        <a href="review.php" class="nav nav-review active">Ulasan</a>
      </nav>

      <div class="header-right">
        <a href="location.php" class="find-store">
          <img src="Source/map-pin.svg" alt="map icon" />
          Temukan kami
        </a>
      </div>

</section>


<section class="form-section">
    <h2>Tambahkan Review Anda</h2>

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

        <button type="submit" class="submit-btn">Kirim Review</button>
        <a href="review.php" class="cancel-btn">Batal</a>
    </form>
</section>


<section class="footer">
    <div class="footer-container">

        <div class="footer-logo">
            <img src="./Source/<?php echo $footer['logo']; ?>" alt="Ayam Goreng Monas Logo" />
            <p class="footer-slogan"><?php echo $footer['slogan']; ?></p>
        </div>

        <div class="footer-column">
            <h3>Link</h3>
            <ul>
                <li><a href="<?php echo $footer['link_story']; ?>">Kisah</a></li>
                <li><a href="<?php echo $footer['link_menu']; ?>">Menu</a></li>
                <li><a href="<?php echo $footer['link_news']; ?>">Berita</a></li>
            </ul>
        </div>

        <div class="footer-column">
            <h3>Hubungi</h3>
            <ul>
                <li><a href="<?php echo $footer['whatsapp']; ?>" target="_blank">WhatsApp</a></li>
                <li><a href="mailto:<?php echo $footer['email']; ?>">Email</a></li>
            </ul>
        </div>

        <div class="Footer-cabang">
            <h3>Cabang utama</h3>
            <div class="footer-cabang-content">
                <p><?php echo nl2br($footer['alamat']); ?></p>
            </div>
        </div>

        <?php echo $footer['maps_embed']; ?>

        <div class="footer-social">
            <?php if (!empty($footer['instagram'])): ?>
                <a href="<?php echo $footer['instagram']; ?>" class="social-icon" target="_blank">
                    <img src="./source/instagram.svg" alt="Instagram" />
                </a>
            <?php endif; ?>

            <?php if (!empty($footer['tiktok'])): ?>
                <a href="<?php echo $footer['tiktok']; ?>" class="social-icon" target="_blank">
                    <img src="./source/tiktok.svg" alt="TikTok" />
                </a>
            <?php endif; ?>

            <?php if (!empty($footer['x'])): ?>
                <a href="<?php echo $footer['x']; ?>" class="social-icon" target="_blank">
                    <img src="./source/x.svg" alt="X" />
                </a>
            <?php endif; ?>

            <?php if (!empty($footer['facebook'])): ?>
                <a href="<?php echo $footer['facebook']; ?>" class="social-icon" target="_blank">
                    <img src="./source/facebook.svg" alt="Facebook" />
                </a>
            <?php endif; ?>
        </div>

    </div>

    <div class="footer-bottom">
        <p>Copyright &copy; 2025 Ayam Goreng Monas. Hak Cipta Dilindungi.</p>
    </div>
</section>

</body>
</html>
