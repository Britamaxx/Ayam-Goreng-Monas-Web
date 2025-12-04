<?php
include "conn.php";

$header = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM header WHERE id = 1"));

$footer = mysqli_query($conn, "SELECT * FROM footer WHERE id = 1");
$f = mysqli_fetch_assoc($footer);

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

<?php include 'header.php'; ?>

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


<?php include 'footer.php'; ?>

<script>
    feather.replace();
</script>

</body>
</html>