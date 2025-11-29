

<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

$header = mysqli_query($conn, "SELECT * FROM header WHERE id = 1");
$h = mysqli_fetch_assoc($header);

$footer = mysqli_query($conn, "SELECT * FROM footer WHERE id = 1");
$f = mysqli_fetch_assoc($footer);

$reviews = mysqli_query($conn, "SELECT * FROM review ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $h['nama_bisnis']; ?></title>

    <link rel="stylesheet" href="./style/header.css" />
    <link rel="stylesheet" href="./style/home.css" />
    <link rel="stylesheet" href="./style/hero.css" />
    <link rel="stylesheet" href="./style/footer.css" />
    <link rel="stylesheet" href="./style/review.css" />

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

    <section id="hero" class="hero">
    <div class="carousel-container">
      <div class="image-carousel">
        <div class="carousel-track">
          <div class="carousel-slide">
            <img src="./Source/Background/Banner.png" alt="bann 1" />
            <div class="hero-overlay">
            </div>
          </div>

          <div class="carousel-slide">
            <img src="./Source/Background/Banner1.png" alt="bann 2" />
            <div class="hero-overlay">
            </div>
          </div>

          <div class="carousel-slide">
            <img src="./Source/Background/Banner2.png" alt="bann 3" />
            <div class="hero-overlay">
            </div>
          </div>
        </div>
      </div>

      <div class="carousel-dots" role="tablist" aria-label="Carousel Navigation">
        <button class="dot active" data-index="0" aria-label="Slide 1"></button>
        <button class="dot" data-index="1" aria-label="Slide 2"></button>
        <button class="dot" data-index="2" aria-label="Slide 3"></button>
      </div>
    </div>
  </section>

    <section class="home">
    <div class="home-container">
      <div class="welcome-section">
        <h2 class="tagline">Rasa yang Tiada Tanding</h2>
        <p class="description">
          Kami menyajikan ayam goreng dengan resep turun-temurun, bumbu meresap, dan tekstur yang selalu renyah. Cocok untuk disantap bersama keluarga atau teman
        </p>
        <div class="cta-buttons">
          <!-- <a href="menu.html" class="btn btn-primary">Lihat Menu</a> -->
          <a href="story.html" class="btn btn-secondary">Lihat Kisah Kami</a></div>
      </div>

      <div id="menu" class="menu-section">
        <div class="menu-name">
          <h3 class="section-heading">Menu Unggulan</h3>
          <a class="menu-direct" href="menu.html">Lihat Semua Menu</a>
        </div>
        <div class="menu-grid">
          <article class="menu-card">
            <img src="./Source/Daftar menu/Bakwan.png" alt="Bakwan">
            <div class="menu-body">
              <h4>Bakwan</h4>
              <!-- <p class="price">Rp 28.000</p> -->
              <!-- <a class="menu-btn" href="#">Pesan</a> -->
            </div>
          </article>

          <article class="menu-card">
            <img src="./Source/Daftar menu/Paket Monas.png" alt="paket monas">
            <div class="menu-body">
              <h4>Paket Ayam Monas</h4>
              <!-- <p class="price">Rp 30.000</p> -->
              <!-- <a class="menu-btn" href="#">Pesan</a> -->
            </div>
          </article>

          <article class="menu-card">
            <img src="./Source/Daftar menu/Es Blewah.png" alt="blewah">
            <div class="menu-body">
              <h4>Es Blewah</h4>
              <!-- <p class="price">Mulai Rp 45.000</p> -->
              <!-- <a class="menu-btn" href="#">Pesan</a> -->
            </div>
          </article>
        </div>
      </div>

<section class="review">
  <h2>Apa Kata Mereka?</h2>

  <div class="Card-Review">
    <div class="Review-list">
      <?php while($row = mysqli_fetch_assoc($reviews)) { ?>
        <div class="review-card">

          <?php if (!empty($row['foto'])) { ?>
            <div class="review-photo">
              <img src="<?php echo htmlspecialchars($row['foto']); ?>" alt="Foto Reviewer">
            </div>
          <?php } ?>

          <div class="stars">
            <?php
              $filled = $row['rating'];
              $empty = 5 - $filled;
              for ($i = 0; $i < $filled; $i++) echo '<span class="star filled">★</span>';
              for ($i = 0; $i < $empty; $i++) echo '<span class="star">★</span>';
            ?>
          </div>

          <p class="review-comment">
            “<?php echo htmlspecialchars($row['komentar']); ?>”
          </p>

          <p class="reviewer-name">
            <strong><?php echo htmlspecialchars($row['nama']); ?></strong>
          </p>

          <small class="review-date">
            <?php echo htmlspecialchars($row['tanggal']); ?>
          </small>

        </div>
      <?php } ?>
    </div>

    <div class="submit-section">
      <a href="form_review.php" class="add-review-btn">Tambahkan Review</a>
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
    <p>Copyright &copy; 2025 Ayam Goreng Monas. Hak Cipta Dilindungi</p>
  </div>
</section>

  </body>
</html>