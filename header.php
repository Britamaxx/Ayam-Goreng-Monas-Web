<?php 
  $activePage = basename($_SERVER['PHP_SELF']);
  ?>


<section class="main-header">
      <div class="header-left">
        <div class="restaurant-logo">
          <img src="./source/<?= $header['logo']; ?>" alt="Restaurant Logo" />
        </div>
        <div class="restaurant-name">
        <a href="login_admin.php">
          <?= $header['nama_bisnis']; ?>
        </a>
        </div>
      </div>

      <nav class="header-middle">
        <a href="index.php" class="nav home <?= ($activePage == 'index.php') ? 'active' : '' ?>"><?= $header['nav_home']; ?></a>
        <a href="story.php" class="nav story <?= ($activePage == 'story.php') ? 'active' : '' ?>"><?= $header['nav_story']; ?></a>
        <a href="menu.php" class="nav menu <?= ($activePage == 'menu.php') ? 'active' : '' ?>"><?= $header['nav_menu']; ?></a>
        <a href="news.php" class="nav news <?= ($activePage == 'news.php') ? 'active' : '' ?>"><?= $header['nav_news']; ?></a>
        <a href="review.php" class="nav nav-review <?= ($activePage == 'review.php') ? 'active' : '' ?>"><?= $header['nav_review']; ?></a>
      </nav>

      <div class="header-right">
        <a href="location.php" class="find-store <?= ($activePage == 'location.php') ? 'active' : '' ?>">
          <img src="Source/map-pin.svg" alt="map icon" />
          Temukan kami
        </a>
      </div>
</section>