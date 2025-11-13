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
        <a href="menu.php" class="nav menu active">Menu</a>
        <a href="news.html" class="nav news">Berita</a>
        <a href="review.php" class="nav review">Ulasan</a>
        <a href="location.html" class="nav location">Lokasi</a>
      </div>
    </section>

    <section class="menu">
      <h2>Menu Kami</h2>
      <div class="menu-grid">
        <?php
        $conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");

        if (!$conn) {
          die("Koneksi gagal: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM menu";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="menu-item">';
            echo '  <div class="menu-image-wrapper">';
            echo '    <img src="./Source/Daftar menu/' . htmlspecialchars($row['gambar']) . '" alt="' . htmlspecialchars($row['nama']) . '">';
            echo '  </div>';
            echo '  <div class="menu-info">';
            echo '    <p>' . htmlspecialchars($row['nama']) . '</p>';
            if (!empty($row['status'])) {
              echo '    <span class="favorite">#' . htmlspecialchars($row['status']) . '</span>';
            }
            echo '  </div>';
            echo '</div>';
          }
        } else {
          echo "<p>Tidak ada menu tersedia.</p>";
        }

        mysqli_close($conn);
        ?>
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
