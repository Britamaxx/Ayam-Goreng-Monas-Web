<section class="main-header">
      <div class="header-left">
        <div class="restaurant-logo">
          <img src="./source/<?= $header['logo']; ?>" alt="Restaurant Logo" />
        </div>
        <div class="restaurant-name">
          <?= $header['nama_bisnis']; ?>
        </div>
      </div>

      <nav class="header-middle">
        <a href="index.php" class="nav home active"><?= $header['nav_home']; ?></a>
        <a href="story.php" class="nav story"><?= $header['nav_story']; ?></a>
        <a href="menu.php" class="nav menu"><?= $header['nav_menu']; ?></a>
        <a href="news.php" class="nav news"><?= $header['nav_news']; ?></a>
        <a href="review.php" class="nav nav-review"><?= $header['nav_review']; ?></a>
      </nav>

      <div class="header-right">
        <a href="location.php" class="find-store">
          <img src="Source/map-pin.svg" alt="map icon" />
          Temukan kami
        </a>
      </div>
</section>