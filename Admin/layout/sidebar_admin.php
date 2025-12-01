<?php 
$current_page = basename($_SERVER['PHP_SELF']);
?>

<section class="sidebar">
  <ul class="sidebar-menu">
    <li class="dashboard <?php if ($current_page == 'dashboard_admin.php') {echo 'active';} ?>">
      <a href="../dashboard/dashboard_admin.php">Dasboard</a>
    </li>
    <li class="manage-menu <?php if ($current_page == 'manage_menu.php') {echo 'active';} ?>">
      <a href="../menu/manage_menu.php">Kelola Menu</a>
    </li>
    <li class="manage-review <?php if ($current_page == 'manage_reviews.php') {echo 'active';} ?>">
      <a href="../ulasan/manage_reviews.php">Kelola Ulasan</a>
    </li>
    <li class="manage berita <?php if ($current_page == 'manage_berita.php') {echo 'active';} ?>">
      <a href="../berita/manage_berita.php">Kelola Berita</a>
    </li>
    <li class="manage lokasi <?php if ($current_page == 'manage_lokasi.php') {echo 'active';} ?>">
      <a href="../lokasi/manage_lokasi.php">Kelola Lokasi</a>
    </li>
    <li class="manage story <?php if ($current_page == 'manage_story.php') {echo 'active';} ?>">
      <a href="../story/manage_story.php">Kelola Cerita</a>
    </li>
  </ul>
</section>
