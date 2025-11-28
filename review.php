<?php
include "conn.php";

$reviews = mysqli_query($conn, "SELECT * FROM review ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Ayam Goreng Monas</title>
    <link rel="stylesheet" href="./style/header.css" />
    <link rel="stylesheet" href="./style/review.css" />
    <link rel="stylesheet" href="./style/footer.css" />
    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    />
    <link rel="icon" type="image/png" sizes="16x16" href="./source/Logo.png" />
    <script src="./script.js" defer></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
  </head>
  <body>
    <section class="main-header">
      <div class="header-left">
        <div class="restaurant-logo">
          <img src="./source/Logo.png" alt="Restaurant Logo" />
        </div>
        <div class="restaurant-name">Ayam Goreng Monas</div>
      </div>

      <nav class="header-middle">
        <a href="index.html" class="nav home">Beranda </a>
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
            <img src="./Source/Logo.png" alt="Ayam Goreng Monas Logo" />
            <p class="footer-slogan">Enak Tiada Tanding</p>
          </div>

          <div class="footer-column">
            <h3>Link</h3>
            <ul>
              <li><a href="story.php">Kisah</a></li>
              <li><a href="menu.php">Menu</a></li>
              <li><a href="news.php">Berita</a></li>
            </ul>
          </div>

          <div class="footer-column">
            <h3>Hubungi</h3>
            <ul>
              <li>
                <a href="https://wa.me/6281234567890" target="_blank">WhatsApp</a>
              </li>
              <li><a href="mailto:ayamgorengmonas@gmail.com">Email</a></li>
            </ul>
          </div>

          <div class="Footer-cabang">
      <h3>Cabang utama</h3>
      <div class="footer-cabang-content">
        <p>Samarinda Central Plaza lantai 3 Jl. P. Irian No.1, Karang Mumus,
        Kec. Samarinda Kota, Kota Samarinda</p>
        
      </div>
    </div>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d498.7080246178035!2d117.154641543488!3d-0.5036127999999974!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df67f9e7cce7495%3A0x61022452c2cacfea!2sSamarinda%20Central%20Plaza!5e0!3m2!1sid!2sid!4v1764164547398!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

          <div class="footer-social">
            <a href="#" class="social-icon">
              <img src="./source/instagram.svg" alt="Instagram" />
            </a>
            <a href="#" class="social-icon">
              <img src="./source/tiktok.svg" alt="TikTok" />
            </a>
            <a href="#" class="social-icon">
              <img src="./source/x.svg" alt="X" />
            </a>
            <a href="#" class="social-icon">
              <img src="./source/facebook.svg" alt="Facebook" />
            </a>
          </div>
        </div>

        <div class="footer-bottom">
          <p>Copyright &copy 2025 Ayam Goreng Monas. Hak Cipta Dilindungi.</p>
        </div>
      </section>
  </body>
</html>
