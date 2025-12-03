<?php
include "conn.php";

$header = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM header WHERE id = 1"));

$footer = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM footer WHERE id = 1"));

$lokasi = mysqli_query($conn, "SELECT * FROM lokasi");
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $header['nama_bisnis']; ?></title>

    <link rel="stylesheet" href="./style/header.css" />
    <link rel="stylesheet" href="./style/location.css" />
    <link rel="stylesheet" href="./style/footer.css" />

    <link rel="icon" type="image/png" sizes="16x16" href="./source/<?php echo $header['logo']; ?>" />

    <script src="./script.js" defer></script>
    <script src="https://unpkg.com/feather-icons"></script>
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
        <a href="index.php" class="nav home"><?php echo $header['nav_home']; ?></a>
        <a href="story.php" class="nav story"><?php echo $header['nav_story']; ?></a>
        <a href="menu.php" class="nav menu"><?php echo $header['nav_menu']; ?></a>
        <a href="news.php" class="nav news"><?php echo $header['nav_news']; ?></a>
        <a href="review.php" class="nav nav-review"><?php echo $header['nav_review']; ?></a>
      </nav>

    <div class="header-right">
        <a href="<?php echo $header['location_url']; ?>" class="find-store active">
            <img src="Source/map-pin.svg" alt="map icon" />
            Temukan kami
        </a>
    </div>
</section>



<section class="location">
    <h2>Outlet Ayam Goreng Monas</h2>

    <div class="location-card">
    <?php while ($row = mysqli_fetch_assoc($lokasi)) { ?>
        <div class="card">
            <img src="Source/<?php echo htmlspecialchars($row['gambar']); ?>"
                 alt="<?php echo htmlspecialchars($row['nama']); ?>" />
            
            <div class="card-content">
                <h3><?php echo htmlspecialchars($row['nama']); ?></h3>

                <p><?php echo nl2br(htmlspecialchars($row['alamat'])); ?></p>

                <p class="time">
                    <i data-feather="clock"></i>
                    <span><?php echo htmlspecialchars($row['jam']); ?></span>
                </p>

                <button class="detail-btn">Temukan Kami</button>
            </div>
        </div>
    <?php } ?>
    </div>
</section>


  <section class="footer">
      <div class="footer-container">

        <div class="footer-logo-section">
          <div class="footer-logo">
            <img src="./Source/<?php echo $f['logo']; ?>" alt="Ayam Goreng Monas Logo" />
            <p class="footer-slogan"><?php echo $f['slogan']; ?></p>
          </div>
          <div class="footer-description">
            <p>Ayam goreng terbaik dengan cita rasa autentik dan bumbu khas yang telah dipercaya oleh ribuan pelanggan setia kami.</p>
          </div>
        </div>

        <div class="footer-column">
          <h3>Link</h3>
          <ul>
            <li><a href="<?php echo $f['link_story']; ?>">Cerita</a></li>
            <li><a href="<?php echo $f['link_menu']; ?>">Menu</a></li>
            <li><a href="<?php echo $f['link_news']; ?>">Berita</a></li>
          </ul>
        </div>

        <div class="Footer-cabang">
          <h3>Alamat Kami</h3>
          <div class="footer-cabang-content">
            <p><?php echo $f['alamat']; ?></p>
          </div>
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

      </div>

      <div class="footer-bottom">
        <p>Copyright &copy; 2025 Ayam Goreng Monas. Hak Cipta Dilindungi</p>
      </div>
    </section>


<script>
    feather.replace();
</script>

</body>
</html>