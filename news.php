
<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

$berita = mysqli_query($conn, "SELECT * FROM berita ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Ayam Goreng Monas</title>
    <link rel="stylesheet" href="./style/header.css" />
    <link rel="stylesheet" href="./style/menu.css" />
    <link rel="stylesheet" href="./style/location.css" />
    <link rel="stylesheet" href="./style/review.css" />
    <link rel="stylesheet" href="./style/home.css" />
    <link rel="stylesheet" href="./style/story.css" />
    <link rel="stylesheet" href="./style/footer.css" />
    <link rel="stylesheet" href="./style/news.css" />
    <link rel="icon" type="image/png" sizes="16x16" href="./source/Logo.png" />
    <script src="./script.js" defer></script>
  </head>
  <body>

    <section class="main-header">
      <div class="header-left">
        <div class="restaurant-logo">
          <img src="./Source/Logo.png" alt="restaurant-logo" />
        </div>
        <div class="restaurant-name">AYAM GORENG MONAS</div>
      </div>
      <div class="header-right">
        <a href="index.html" class="nav home">Beranda</a>
        <a href="story.html" class="nav story">Cerita Kami</a>
        <a href="menu.php" class="nav menu">Menu</a>
        <a href="news.php" class="nav news active">Berita</a>
        <a href="review.php" class="nav review">Ulasan</a>
        <a href="location.html" class="nav location">Lokasi</a>
      </div>
    </section>

    <section class="news">
      <h2>Berita</h2>
      <div class="Card-news">

        <?php while ($row = mysqli_fetch_assoc($berita)) { ?>
          <div class="card-item">
            <div class="card-item-content">
              <h3><?php echo $row['judul']; ?></h3>
              <p><?php echo $row['deskripsi']; ?></p>
            </div>

            <img src="./Source/Berita/<?php echo $row['gambar']; ?>" 
                 alt="News Image" />
          </div>
        <?php } ?>
      </div>
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
            <li><a href="news.php">Berita</a></li>
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
            <li><a href="https://wa.me/6281234567890" target="_blank">WhatsApp</a></li>
            <li><a href="mailto:ayamgorengmonas@gmail.com">Email</a></li>
          </ul>
        </div>

        <div class="footer-social">
          <a href="#" class="social-icon"><img src="./source/instagram.svg" alt="Instagram" /></a>
          <a href="#" class="social-icon"><img src="./source/tiktok.svg" alt="TikTok" /></a>
          <a href="#" class="social-icon"><img src="./source/x.svg" alt="X" /></a>
          <a href="#" class="social-icon"><img src="./source/facebook.svg" alt="Facebook" /></a>
        </div>
      </div>

      <div class="footer-bottom">
        <p>Copyright &copy; 2025 Ayam Goreng Monas. Hak Cipta Dilindungi.</p>
      </div>
    </section>

  </body>
</html>