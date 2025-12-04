<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}
$header = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM header WHERE id = 1"));

$footer = mysqli_query($conn, "SELECT * FROM footer WHERE id = 1");
$f = mysqli_fetch_assoc($footer);
$timeline = mysqli_query($conn, "SELECT * FROM story_timeline ORDER BY tahun ASC");
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Ayam Goreng Monas</title>
    <link rel="stylesheet" href="./style/header.css" />
    <link rel="stylesheet" href="./style/story.css" />
    <link rel="stylesheet" href="./style/footer.css" />
    <link rel="icon" type="image/png" sizes="16x16" href="./source/Logo.png" />

    <script src="./script.js" defer></script>
  </head>
  <body>
   <?php include 'header.php'; ?>

    <section class="story-section">
      <div class="story-header">
        <h2>Perjalanan Kami</h2>
      </div>

      <div class="timeline">

        <?php while ($row = mysqli_fetch_assoc($timeline)) { ?>
          <div class="timeline-item <?php echo $row['posisi']; ?>">
            <div class="timeline-dot"></div>

            <div class="timeline-content">
              <div class="timeline-year"><?php echo $row['tahun']; ?></div>
              <h2 class="timeline-title"><?php echo $row['judul']; ?></h2>
              <p class="timeline-description">
                <?php echo $row['deskripsi']; ?>
              </p>
            </div>

            <div class="timeline-image">
              <img src="./source/<?php echo $row['gambar']; ?>" alt="Timeline Image" />
            </div>
          </div>
        <?php } ?>

      </div>
    </section>

    <?php include 'footer.php'; ?>
  </body>
</html>