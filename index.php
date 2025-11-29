

<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

$header = mysqli_query($conn, "SELECT * FROM header WHERE id = 1");
$h = mysqli_fetch_assoc($header);

$footer = mysqli_query($conn, "SELECT * FROM footer WHERE id = 1");
$f = mysqli_fetch_assoc($footer);
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $h['nama_bisnis']; ?></title>

    <link rel="stylesheet" href="./style/header.css" />
    <link rel="stylesheet" href="./style/home.css" />
    <link rel="stylesheet" href="./style/hero.css" />
    <link rel="stylesheet" href="./style/footer.css" />

    <link rel="icon" type="image/png" sizes="16x16" href="./source/<?php echo $h['logo']; ?>" />
    <script src="./script.js" defer></script>
  </head>

  <body>
    <section class="main-header">
      <div class="header-left">
        <div class="restaurant-logo">
          <img src="./source/<?php echo $h['logo']; ?>" alt="Restaurant Logo" />
        </div>
        <div class="restaurant-name">
          <?php echo $h['nama_bisnis']; ?>
        </div>
      </div>

      <nav class="header-middle">
        <a href="index.php" class="nav home active"><?php echo $h['nav_home']; ?></a>
        <a href="story.php" class="nav story"><?php echo $h['nav_story']; ?></a>
        <a href="menu.php" class="nav menu"><?php echo $h['nav_menu']; ?></a>
        <a href="news.php" class="nav news"><?php echo $h['nav_news']; ?></a>
        <a href="review.php" class="nav nav-review"><?php echo $h['nav_review']; ?></a>
      </nav>

      <div class="header-right">
        <a href="location.php" class="find-store">
          <img src="Source/map-pin.svg" alt="map icon" />
          Temukan kami
        </a>
      </div>
      
    </section>

    <section class="hero">
      <div class="carousel-container">
        <div class="image-carousel">
          <div class="carousel-track">
            <div class="carousel-slide">
              <img src="./Source/Poster/Poster1.png" alt="Ayam Goreng Monas Poster 1" />
            </div>
            <div class="carousel-slide">
              <img src="./Source/Poster/Poster2.png" alt="Ayam Goreng Monas Poster 2" />
            </div>
            <div class="carousel-slide">
              <img src="./Source/Poster/Poster3.png" alt="Ayam Goreng Monas Poster 3" />
            </div>
          </div>
        </div>

        <div class="carousel-dots">
          <button class="dot active" data-index="0"></button>
          <button class="dot" data-index="1"></button>
          <button class="dot" data-index="2"></button>
        </div>
      </div>
    </section>

    <section class="home">
      <div class="home-container">
        <div class="welcome-section">
          <h1 class="tagline">Rasa yang tiada tanding</h1>
          <p class="description">
            Lorem ipsum dolor sit amet consectetur, adipisicing elit.
          </p>
          <div class="cta-buttons">
            <a href="menu.php" class="btn btn-primary">Lihat Menu</a>
            <a href="location.php" class="btn btn-secondary">Temukan Kami</a>
          </div>
        </div>
      </div>
    </section>

    <section class="footer">
      <div class="footer-container">

        <div class="footer-logo">
          <img src="./Source/<?php echo $f['logo']; ?>" alt="Ayam Goreng Monas Logo" />
          <p class="footer-slogan"><?php echo $f['slogan']; ?></p>
        </div>

        <div class="footer-column">
          <h3>Link</h3>
          <ul>
            <li><a href="<?php echo $f['link_story']; ?>">Kisah</a></li>
            <li><a href="<?php echo $f['link_menu']; ?>">Menu</a></li>
            <li><a href="<?php echo $f['link_news']; ?>">Berita</a></li>
          </ul>
        </div>

        <div class="footer-column">
          <h3>Hubungi</h3>
          <ul>
            <li><a href="<?php echo $f['whatsapp']; ?>" target="_blank">WhatsApp</a></li>
            <li><a href="mailto:<?php echo $f['email']; ?>">Email</a></li>
          </ul>
        </div>

        <div class="Footer-cabang">
          <h3>Cabang utama</h3>
          <div class="footer-cabang-content">
            <p><?php echo $f['alamat']; ?></p>
          </div>
        </div>

        <?php echo $f['maps_embed']; ?>

        <div class="footer-social">
          <a href="<?php echo $f['instagram']; ?>" class="social-icon">
            <img src="./source/instagram.svg" alt="Instagram" />
          </a>
          <a href="<?php echo $f['tiktok']; ?>" class="social-icon">
            <img src="./source/tiktok.svg" alt="TikTok" />
          </a>
          <a href="<?php echo $f['x']; ?>" class="social-icon">
            <img src="./source/x.svg" alt="X" />
          </a>
          <a href="<?php echo $f['facebook']; ?>" class="social-icon">
            <img src="./source/facebook.svg" alt="Facebook" />
          </a>
        </div>

      </div>

      <div class="footer-bottom">
        <p>Copyright &copy; 2025 Ayam Goreng Monas. Hak Cipta Dilindungi.</p>
      </div>
    </section>

  </body>
</html>