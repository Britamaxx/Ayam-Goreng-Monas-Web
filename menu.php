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
          <img src="./source/Logo.png" alt="Restaurant Logo" />
        </div>
        <div class="restaurant-name">Ayam Goreng Monas</div>
      </div>

      <nav class="header-middle">
        <a href="index.html" class="nav home">Beranda </a>
        <a href="story.html" class="nav story">Cerita Kami</a>
        <a href="menu.php" class="nav menu active">Menu</a>
        <a href="news.php" class="nav news">Berita</a>
        <a href="review.php" class="nav nav-review">Ulasan</a>
      </nav>

      <div class="header-right">
        <a href="location.html" class="find-store">
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
            if (!empty($row['status'])) {
              echo '    <span class="favorite">#' . htmlspecialchars($row['status']) . '</span>';
            }
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
    <div class="footer-logo">
      <img src="./Source/Logo.png" alt="Ayam Goreng Monas Logo" />
      <p class="footer-slogan">Enak Tiada Tanding</p>
    </div>

    <div class="footer-column">
      <h3>Link</h3>
      <ul>
        <li><a href="story.html">Kisah</a></li>
        <li><a href="menu.php">Menu</a></li>
        <li><a href="news.php">Berita</a></li>
      </ul>
    </div>

    <div class="footer-column">
      <h3>Hubungi</h3>
      <ul>
        <li><a href="https://wa.me/6281234567890" target="_blank">WhatsApp</a></li>
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
      <a href="#" class="social-icon"><img src="./source/instagram.svg" alt="Instagram" /></a>
      <a href="#" class="social-icon"><img src="./source/tiktok.svg" alt="TikTok" /></a>
      <a href="#" class="social-icon"><img src="./source/x.svg" alt="X" /></a>
      <a href="#" class="social-icon"><img src="./source/facebook.svg" alt="Facebook" /></a>
    </div>
  </div>
</section>

      <div class="footer-bottom">
        <p>Copyright &copy; 2025 Ayam Goreng Monas. Hak Cipta Dilindungi.</p>
      </div>
    </section>

    <script>
      function openMenuModal(menuData) {
        const modal = document.getElementById('menuModal');
        document.getElementById('modalImage').src = './Source/Daftar menu/' + menuData.gambar;
        document.getElementById('modalTitle').textContent = menuData.nama;
        document.getElementById('modalDescription').textContent = menuData.deskripsi || 'Deskripsi belum tersedia.';

        const statusEl = document.getElementById('modalStatus');
        if (menuData.status) {
          statusEl.textContent = '#' + menuData.status;
          statusEl.style.display = 'inline-block';
        } else {
          statusEl.style.display = 'none';
        }

        document.getElementById('kaloriValue').textContent = menuData.kalori ? menuData.kalori + ' Kal' : '-';
        document.getElementById('karboValue').textContent = menuData.karbohidrat ? menuData.karbohidrat + ' g' : '-';
        document.getElementById('proteinValue').textContent = menuData.protein ? menuData.protein + ' g' : '-';

        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
      }

      function closeMenuModal() {
        document.getElementById('menuModal').style.display = 'none';
        document.body.style.overflow = 'auto';
      }

      window.onclick = e => {
        const modal = document.getElementById('menuModal');
        if (e.target === modal) closeMenuModal();
      };

      document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeMenuModal();
      });

      document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM loaded'); 
          
        const menuItems = document.querySelectorAll('.menu-item');
        console.log('Found menu items:', menuItems.length); 
          
        if (menuItems.length > 0) {
          menuItems.forEach((item, index) => {
            setTimeout(() => {
              item.classList.add('show');
              console.log('Showing item', index); 
            }, index * 150); 
          });
        }
      });
    </script>
  </body>
</html>