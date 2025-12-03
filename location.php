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

        <div class="footer-logo">
            <img src="./Source/<?php echo $footer['logo']; ?>" alt="Logo" />
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
                <p><?php echo nl2br($footer['alamat']); ?></p>
            </div>
        </div>

        <?php echo $footer['maps_embed']; ?>

        <div class="footer-social">
            <?php if (!empty($footer['instagram'])): ?>
                <a href="<?php echo $footer['instagram']; ?>" class="social-icon" target="_blank">
                    <img src="./source/instagram.svg" alt="Instagram" />
                </a>
            <?php endif; ?>

            <?php if (!empty($footer['tiktok'])): ?>
                <a href="<?php echo $footer['tiktok']; ?>" class="social-icon" target="_blank">
                    <img src="./source/tiktok.svg" alt="TikTok" />
                </a>
            <?php endif; ?>

            <?php if (!empty($footer['x'])): ?>
                <a href="<?php echo $footer['x']; ?>" class="social-icon" target="_blank">
                    <img src="./source/x.svg" alt="X" />
                </a>
            <?php endif; ?>

            <?php if (!empty($footer['facebook'])): ?>
                <a href="<?php echo $footer['facebook']; ?>" class="social-icon" target="_blank">
                    <img src="./source/facebook.svg" alt="Facebook" />
                </a>
            <?php endif; ?>
        </div>

    </div>

    <div class="footer-bottom">
        <p>Copyright &copy; 2025 <?php echo $header['nama_bisnis']; ?>. Hak Cipta Dilindungi.</p>
    </div>
</section>


<script>
    feather.replace();
</script>

</body>
</html>