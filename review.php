<?php
include "conn.php";

$header = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM header WHERE id = 1"));

$footer = mysqli_query($conn, "SELECT * FROM footer WHERE id = 1");
$f = mysqli_fetch_assoc($footer);

$reviews = mysqli_query($conn, "SELECT * FROM review ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $header['nama_bisnis']; ?></title>
    <link rel="stylesheet" href="./style/header.css" />
    <link rel="stylesheet" href="./style/review.css" />
    <link rel="stylesheet" href="./style/footer.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="icon" type="image/png" sizes="16x16" href="./source/<?php echo $header['logo']; ?>" />
    <script src="./script.js" defer></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
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
        <a href="review.php" class="nav nav-review active"><?php echo $header['nav_review']; ?></a>
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
          <div class="card-profile">
            <?php if (!empty($row['foto'])) { ?>
              <div class="review-photo">
                <img src="<?php echo htmlspecialchars($row['foto']); ?>" alt="Foto Reviewer">
              </div>
            <?php } else { ?>
              <div class="review-photo">
                <div class="photo-placeholder">
                  <span>👤</span>
                </div>
              </div>
            <?php } ?>

            <div class="profile-info">
              <p class="reviewer-name"><strong><?php echo htmlspecialchars($row['nama']); ?></strong></p>
              <div class="stars">
                <?php
                  $filled = (int)$row['rating'];
                  $empty = 5 - $filled;
                  for ($i = 0; $i < $filled; $i++) echo '<span class="star filled">★</span>';
                  for ($i = 0; $i < $empty; $i++) echo '<span class="star">★</span>';
                ?>
              </div>
            </div>
          </div>

          <div class="card-comment">
            <p class="review-comment">
              "<?php echo htmlspecialchars($row['komentar']); ?>"
            </p>
          </div>

          <div class="card-date">
            <small class="review-date">
              <?php echo htmlspecialchars($row['tanggal']); ?>
            </small>
          </div>
        </div>

      <?php } ?>
    </div>

    <div class="submit-section">
      <a href="form_review.php" class="add-review-btn">Tambahkan Ulasan</a>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>
  </body>
</html>