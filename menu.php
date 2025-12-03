
<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$header = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM header WHERE id = 1"));
$footer = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM footer WHERE id = 1"));
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Ayam Goreng Monas</title>
    <link rel="stylesheet" href="./style/header.css" />
    <link rel="stylesheet" href="./style/menu.css" />
    <link rel="stylesheet" href="./style/footer.css" />
    <link rel="icon" type="image/png" sizes="16x16" href="./source/Logo.png" />
  </head>
  <body>
    <section class="main-header">
      <div class="header-left">
        <div class="restaurant-logo">
          <img src="./source/<?php echo $header["logo"]; ?>" alt="Restaurant Logo" />
        </div>
        <div class="restaurant-name"><?php echo $header["nama_bisnis"]; ?></div>
      </div>

      <nav class="header-middle">
        <a href="index.php" class="nav home"><?php echo $header['nav_home']; ?></a>
        <a href="story.php" class="nav story"><?php echo $header['nav_story']; ?></a>
        <a href="menu.php" class="nav menu active"><?php echo $header['nav_menu']; ?></a>
        <a href="news.php" class="nav news"><?php echo $header['nav_news']; ?></a>
        <a href="review.php" class="nav nav-review"><?php echo $header['nav_review']; ?></a>
      </nav>


      <div class="header-right">
        <a href="location.php" class="find-store">
          <img src="Source/map-pin.svg" alt="map icon" />
          Temukan kami
        </a>
      </div>
    </section>

    <section class="menu">
      <h2>Menu Kami</h2>
      <div class="menu-grid">
        <?php
        $conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");

        if (!$conn) {
          die("Koneksi gagal: " . mysqli_connect_error());
        }

        $items_per_page = 8;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($page - 1) * $items_per_page;

        $total_items_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM menu");
        $total_items = mysqli_fetch_assoc($total_items_query)['total'];
        $total_pages = ceil($total_items / $items_per_page);

        $sql = "SELECT * FROM menu LIMIT $start, $items_per_page";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $menuData = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
            echo '<div class="menu-item" onclick="openMenuModal(' . $menuData . ')">';
            echo '  <div class="menu-image-wrapper">';
            echo '    <img src="./Source/Daftar menu/' . htmlspecialchars($row['gambar']) . '" alt="' . htmlspecialchars($row['nama']) . '">';
            echo '  </div>';
            echo '  <div class="menu-info">';
            echo '    <p>' . htmlspecialchars($row['nama']) . '</p>';
            
            echo '  </div>';
            echo '</div>';
          }
        } else {
          echo "<p>Tidak ada menu tersedia.</p>";
        }

        mysqli_close($conn);
        ?>
      </div>

      <div class="pagination-container">
        <?php if ($page > 1): ?>
          <a class="pagination-btn" href="?page=<?= $page - 1 ?>">Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
          <a class="pagination-number <?= ($i == $page) ? 'active' : '' ?>"
            href="?page=<?= $i ?>">
            <?= $i ?>
          </a>
        <?php endfor; ?>

        <?php if ($page < $total_pages): ?>
          <a class="pagination-btn" href="?page=<?= $page + 1 ?>">Next</a>
        <?php endif; ?>
      </div>
    </section>

    <div id="menuModal" class="modal">
      <button class="close-btn" onclick="closeMenuModal()">×</button>
      <div class="modal-content">
        <div class="modal-body">
          <div class="modal-image">
            <img id="modalImage" src="" alt="Menu">
          </div>
          <div class="modal-details">
            <h2 id="modalTitle"></h2>
            <span id="modalStatus" class="modal-status"></span>
            <p id="modalDescription"></p>

            <div class="nutrition-info">
              <h3>Ringkasan Gizi</h3>
              <div class="nutrition-grid">
                <div class="nutrient">
                  <img src="./Source/Kalori.svg" alt="Kalori">
                  <div>
                    <p>Kalori</p>
                    <strong id="kaloriValue">-</strong>
                  </div>
                </div>
                <div class="nutrient">
                  <img src="./Source/Karbo.svg" alt="Karbohidrat">
                  <div>
                    <p>Karbohidrat</p>
                    <strong id="karboValue">-</strong>
                  </div>
                </div>
                <div class="nutrient">
                  <img src="./Source/Protein.svg" alt="Protein">
                  <div>
                    <p>Protein</p>
                    <strong id="proteinValue">-</strong>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
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
</html>