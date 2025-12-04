<section class="footer">
  <!-- Footer Top: dua kolom utama -->
  <div class="footer-top">
    <!-- KOLOM KIRI: logo (gambar) + teks (slogan + deskripsi) -->
    <div class="footer-left">
      <div class="footer-left-inner">
        <div class="footer-logo-img">
          <img src="./Source/<?php echo $f['logo']; ?>" alt="Ayam Goreng Monas Logo" />
        </div>
        <div class="footer-logo-text">
          <h2 class="footer-slogan"><?php echo $f['slogan']; ?></h2>
          <p class="footer-desc">
            Ayam goreng terbaik dengan cita rasa autentik dan bumbu khas yang telah dipercaya oleh ribuan pelanggan setia kami.
          </p>
        </div>
      </div>
    </div>

    <!-- KOLOM KANAN: alamat + sosial -->
    <div class="footer-right">
      <h3 class="footer-right-title">Alamat Kami</h3>
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

  <!-- Footer Bottom: copyright -->
  <div class="footer-bottom">
    <p>Copyright &copy; 2025 Ayam Goreng Monas. Hak Cipta Dilindungi</p>
  </div>
</section>
