<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

$header = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM header WHERE id = 1"));

$footer = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM footer WHERE id = 1"));

$limit = 4; 
$page  = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$berita = mysqli_query($conn, 
  "SELECT * FROM berita ORDER BY id DESC LIMIT $start, $limit"
);

$total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM berita"));
$pages = ceil($total / $limit);
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $header['nama_bisnis']; ?></title>
    <link rel="stylesheet" href="./style/header.css" />
    <link rel="stylesheet" href="./style/footer.css" />
    <link rel="stylesheet" href="./style/news.css" />
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
        <a href="news.php" class="nav nav-news active">Berita</a>
        <a href="review.php" class="nav review">Ulasan</a>
      </nav>

      <div class="header-right">
        <a href="location.php" class="find-store">
          <img src="Source/map-pin.svg" alt="map icon" />
          Temukan kami
        </a>
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

              <a href="news-detail.php?id=<?php echo $row['id']; ?>" class="read-more">
                Baca selengkapnya →
              </a>
            </div>
            <img src="./Source/Berita/<?php echo $row['gambar']; ?>" alt="News Image" />
          </div>
        <?php } ?>
      </div>

      <div class="pagination">
        <?php for ($i = 1; $i <= $pages; $i++) { ?>
          <a 
            class="page-btn <?php echo ($i == $page) ? 'active' : ''; ?>"
            href="news.php?page=<?php echo $i; ?>"
          >
            <?php echo $i; ?>
          </a>
        <?php } ?>
      </div>
    </section>

    <section class="footer">
      <div class="footer-container">

        <div class="footer-logo">
          <img src="./Source/<?php echo $footer['logo']; ?>" alt="Logo AGM" />
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
            <p><?php echo $footer['alamat']; ?></p>
          </div>
        </div>

        <?php echo $footer['maps_embed']; ?>

        <div class="footer-social">
          <a href="<?php echo $footer['instagram']; ?>" class="social-icon"><img src="./source/instagram.svg" /></a>
          <a href="<?php echo $footer['tiktok']; ?>" class="social-icon"><img src="./source/tiktok.svg" /></a>
          <a href="<?php echo $footer['x']; ?>" class="social-icon"><img src="./source/x.svg" /></a>
          <a href="<?php echo $footer['facebook']; ?>" class="social-icon"><img src="./source/facebook.svg" /></a>
        </div>

      </div>

      <div class="footer-bottom">
        <p>Copyright &copy; 2025 <?php echo $header['nama_bisnis']; ?>. Hak Cipta Dilindungi.</p>
      </div>
    </section>

  </body>
</html>
