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
        <a href="index.php" class="nav home"><?php echo $header['nav_home']; ?></a>
        <a href="story.php" class="nav story"><?php echo $header['nav_story']; ?></a>
        <a href="menu.php" class="nav menu"><?php echo $header['nav_menu']; ?></a>
        <a href="news.php" class="nav news active"><?php echo $header['nav_news']; ?></a>
        <a href="review.php" class="nav nav-review"><?php echo $header['nav_review']; ?></a>
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
              <p class="news-short">
                <?php echo substr($row['deskripsi'], 0, 150) . "..."; ?>
              </p>

              <p class="news-full" style="display:none;">
                <?php echo $row['deskripsi']; ?>
              </p>

              <button class="read-more-btn">Baca selengkapnya →</button>
            </div>

            <div class="card-image">
              <img src="./Source/Berita/<?php echo $row['gambar']; ?>" alt="News Image" />
            </div>
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

  <?php include 'footer.php'; ?>
  </body>
</html>