<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

// Header
$header = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM header WHERE id = 1"));

// Footer
$footer = mysqli_query($conn, "SELECT * FROM footer WHERE id = 1");
$f = mysqli_fetch_assoc($footer);

// Hero Slider
$slider = mysqli_query($conn, "SELECT * FROM hero_slider ORDER BY id ASC");

// Welcome Section
$welcome = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM welcome_section WHERE id = 1"));

// Menu Unggulan (JOIN)
$menuUnggulan = mysqli_query($conn, "
  SELECT menu.nama, menu.gambar 
  FROM beranda_menu
  JOIN menu ON beranda_menu.id_menu = menu.id
");

// Review
$reviews = mysqli_query($conn, "SELECT * FROM review ORDER BY id DESC LIMIT 10");
?>

<!DOCTYPE html>
<html>
  <head>
    <title><?= $header['nama_bisnis']; ?></title>
    <link rel="stylesheet" href="./style/header.css" />
    <link rel="stylesheet" href="./style/home.css" />
    <link rel="stylesheet" href="./style/hero.css" />
    <link rel="stylesheet" href="./style/footer.css" />
    <link rel="stylesheet" href="./style/review.css" />
    <link rel="icon" type="image/png" sizes="16x16" href="./source/<?= $header['logo']; ?>" />
    <script src="./script.js" defer></script>
  </head>

  <body>
  <?php include 'header.php'; ?>

  <section id="hero" class="hero">
  <div class="carousel-container">
    <div class="image-carousel">
      <div class="carousel-track">

        <?php while($s = mysqli_fetch_assoc($slider)) : ?>
        <div class="carousel-slide">
          <img src="./Source/Background/slider/<?= $s['gambar']; ?>" alt="slider">
          <div class="hero-overlay"></div>
        </div>
        <?php endwhile; ?>

      </div>
    </div>

    <div class="carousel-dots">
      <?php 
      $totalSlider = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM hero_slider"));
      for ($i = 0; $i < $totalSlider; $i++): ?>
        <button class="dot <?= $i == 0 ? 'active' : '' ?>" data-index="<?= $i ?>"></button>
      <?php endfor; ?>
    </div>

  </div>
</section>

    <section class="home">
      <div class="home-container">

    <!-- Kolom 1: gambar welcome -->
    <div class="home-left">
      <img src="./Source/welcome.png" alt="Welcome image" class="welcome-img">
    </div>

    <!-- Kolom 2: teks (atas) + CTA (bawah) -->
    <div class="home-right">
      <!-- Baris atas: tulisan -->
      <div class="welcome-content">
        <h2 class="tagline"><?= $welcome['judul']; ?></h2>
        <p class="description"><?= nl2br($welcome['deskripsi']); ?></p>
      </div>

      <!-- Baris bawah: CTA -->
      <div class="welcome-cta">
        <div class="cta-buttons">
          <a href="story.php" class="btn btn-secondary">Lihat Cerita Kami</a>
        </div>
      </div>
    </div>

  </div>

  <!-- Menu (tetap diletakkan di bawah) -->
  <div id="menu" class="menu-section">
    <div class="menu-name">
      <h3 class="section-heading">Menu Unggulan</h3>
    </div>

    <div class="menu-grid">
      <?php while($m = mysqli_fetch_assoc($menuUnggulan)) : ?>
        <article class="menu-card">
          <img src="./Source/Daftar menu/<?= $m['gambar'] ?>" alt="<?= $m['nama']; ?>">
          <div class="menu-body">
            <h4><?= $m['nama']; ?></h4>
          </div>
        </article>
      <?php endwhile; ?>
    </div>
     <a class="menu-direct" href="menu.php">Lihat Semua Menu</a>
  </div>

        <section class="review">
          <h2>Apa Kata Mereka?</h2>

          <div class="Card-Review">
            <div class="Review-list">

              <?php while($row = mysqli_fetch_assoc($reviews)) { ?>
                <div class="review-card">

                  <div class="card-profile">
                    <div class="review-photo">
                      <?php if (!empty($row['foto'])) { ?>
                        <img src="<?= $row['foto']; ?>" alt="Foto Reviewer">
                      <?php } else { ?>
                        <div class="photo-placeholder"><span>👤</span></div>
                      <?php } ?>
                    </div>

                    <div class="profile-info">
                      <p class="reviewer-name"><strong><?= htmlspecialchars($row['nama']); ?></strong></p>

                      <div class="stars">
                        <?php
                          $filled = (int)$row['rating'];
                          $empty = 5 - $filled;

                          for ($i=0; $i<$filled; $i++) echo '<span class="star filled">★</span>';
                          for ($i=0; $i<$empty; $i++) echo '<span class="star">★</span>';
                        ?>
                      </div>
                    </div>
                  </div>

                  <div class="card-comment">
                    <p class="review-comment">"<?= htmlspecialchars($row['komentar']); ?>"</p>
                  </div>

                  <div class="card-date">
                    <small class="review-date"><?= $row['tanggal']; ?></small>
                  </div>
                </div>
              <?php } ?>

            </div>
          </div>
        </section>

      </div>
    </section>


    <!-- FOOTER -->
    <?php include 'footer.php'; ?>

  </body>
</html>
