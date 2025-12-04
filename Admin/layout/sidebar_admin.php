<?php 
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!-- FONT AWESOME -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<section class="sidebar">

    <style>
      .sidebar-menu li a i {
    font-size: 18px;
    width: 22px;
    margin-right: 12px;   /* 💛 Tambahan jarak ikon ke teks */
}

      </style>

    <ul class="sidebar-menu">

        <li class="<?php if ($current_page == 'dashboard_admin.php') echo 'active'; ?>">
            <a href="../dashboard/dashboard_admin.php">
                <i class="fa-solid fa-gauge"></i>
                <span>Dasbor Admin</span>
            </a>
        </li>

        <li class="<?php if ($current_page == 'manage_beranda.php') echo 'active'; ?>">
            <a href="../beranda/manage_beranda.php">
                <i class="fa-solid fa-house"></i>
                <span>Kelola Beranda</span>
            </a>
        </li>

        <li class="<?php if ($current_page == 'manage_menu.php') echo 'active'; ?>">
            <a href="../menu/manage_menu.php">
                <i class="fa-solid fa-utensils"></i>
                <span>Kelola Menu</span>
            </a>
        </li>

        <li class="<?php if ($current_page == 'manage_reviews.php') echo 'active'; ?>">
            <a href="../ulasan/manage_reviews.php">
                <i class="fa-solid fa-comments"></i>
                <span>Kelola Ulasan</span>
            </a>
        </li>

        <li class="<?php if ($current_page == 'manage_berita.php') echo 'active'; ?>">
            <a href="../berita/manage_berita.php">
                <i class="fa-solid fa-newspaper"></i>
                <span>Kelola Berita</span>
            </a>
        </li>

        <li class="<?php if ($current_page == 'manage_lokasi.php') echo 'active'; ?>">
            <a href="../lokasi/manage_lokasi.php">
                <i class="fa-solid fa-map-location-dot"></i>
                <span>Kelola Lokasi</span>
            </a>
        </li>

        <li class="<?php if ($current_page == 'manage_story.php') echo 'active'; ?>">
            <a href="../story/manage_story.php">
                <i class="fa-solid fa-book-open"></i>
                <span>Kelola Cerita</span>
            </a>
        </li>

        <li class="<?php if ($current_page == 'manage_konten.php') echo 'active'; ?>">
            <a href="../konten_Web/manage_konten.php">
                <i class="fa-solid fa-gear"></i>
                <span>Pengaturan Konten</span>
            </a>
        </li>

    </ul>

</section>
