<?php
include "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $rating = intval($_POST['rating']);
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $komentar = mysqli_real_escape_string($conn, $_POST['komentar']);

    $query = "INSERT INTO review (nama, rating, tanggal, komentar)
              VALUES ('$nama', '$rating', '$tanggal', '$komentar')";
              
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
    <link rel="stylesheet" href="./Style/header.css" />
    <link rel="stylesheet" href="./Style/review.css" />
    <link rel="stylesheet" href="./Style/footer.css" />
    <link rel="stylesheet" href="./Style/form_review.css" />
    <link rel="icon" type="image/png" href="./source/Logo.png" />
  </head>
  <body>
    <section class="main-header">
      <div class="header-left">
        <div class="restaurant-logo">
          <img src="./source/Logo.png" alt="restaurant-logo" />
        </div>
        <div class="restaurant-name">AYAM GORENG MONAS</div>
      </div>
      <div class="header-right">
        <a href="index.html" class="nav home">Beranda</a>
        <a href="story.html" class="nav story">Cerita Kami</a>
        <a href="menu.php" class="nav menu">Menu</a>
        <a href="news.html" class="nav news">Berita</a>
        <a href="review.php" class="nav review active">Ulasan</a>
        <a href="location.html" class="nav location">Lokasi</a>
      </div>
    </section>

    <section class="form-section">
      <h2>Tambahkan Review Anda</h2>
      <form action="" method="POST" class="review-form">
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

        <button type="submit" class="submit-btn">Kirim Review</button>
        <a href="review.php" class="cancel-btn">Batal</a>
      </form>
    </section>

    <section class="footer">
      <div class="footer-container">
        <div class="footer-logo">
          <img src="./Source/Logo.png" alt="Ayam Goreng Monas Logo" />
          <p class="footer-slogan">Enak Tiada Tanding</p>
        </div>
        <div class="footer-column">
          <h3>Link</h3>
          <ul>
            <li><a href="story.html">Kisah</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="news.html">Berita</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h3>Pemesanan</h3>
          <ul>
            <li><a href="https://wa.me/6281234567890" target="_blank">WhatsApp</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h3>Hubungi</h3>
          <ul>
            <li><a href="mailto:ayamgorengmonas@gmail.com">Email</a></li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        <p>Copyright &copy; 2025 Ayam Goreng Monas. Hak Cipta Dilindungi.</p>
      </div>
    </section>
  </body>
</html>
