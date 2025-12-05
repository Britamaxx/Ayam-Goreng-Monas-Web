<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../../login_admin.php");
    exit();
}

// TAMBAHKAN INI - Mencegah browser cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

include "../../conn.php";

// Query menu
$qMenu = "SELECT id, nama, gambar, status, deskripsi, kalori, karbohidrat, protein FROM menu ORDER BY nama ASC";
$menus = mysqli_query($conn, $qMenu);
$totalMenu = $menus ? mysqli_num_rows($menus) : 0;

// Query cabang (lokasi)
$qLokasi = "SELECT id, nama, alamat, jam FROM lokasi ORDER BY id ASC";
$lokasi = mysqli_query($conn, $qLokasi);
$totalCabang = $lokasi ? mysqli_num_rows($lokasi) : 0;

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style_admin/manage_menu.css" />
    <link rel="icon" type="image/png" sizes="16x16" href="./source/<?php echo $h['logo']; ?>" />
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Dashboard Admin - Ayam Goreng Monas</title>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Slabo+27px&display=swap");
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        body {
            background: #FFF5F0;
            color: #111827;
        }

        .dashboard-wrapper {
            padding: 1.5rem 2rem 2rem; 
        }

        .section-title {
            font-size: 3rem;
            font-weight: 700;
            color: #DC2626;
            margin-bottom: 0.15rem;
            text-align: center;
            font-family: 'Slabo 27px', serif;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 1.5fr 1.5fr;
            gap: 1.25rem;
        }

        .card {
            background: #ffffff;
            padding: 25px 30px;
            border-radius: 14px;
            border: 1px solid #FFE8C7;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            font-family: 'Slabo 27px', serif;
        }

        .table-wrapper {
            margin-top: 0.5rem;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 1rem;
        }

        th, td {
            padding: 0.45rem 0.4rem;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
            vertical-align: top;
            
        }

        thead {
            background: #f9fafb;
        }

        th {
            font-size: 0.75rem;
            color: #6b7280;
            font-weight: 600;
            font-family: 'Slabo 27px', serif;
        }
        
        strong {
            font-family: 'Slabo 27px', serif;
            font-size:1.2rem;
        }

        .empty-state {
            font-size: 0.8rem;
            color: #9ca3af;
            text-align: center;
            padding: 1.25rem 0.5rem;
        }

        .pill {
            display: inline-block;
            font-size: 0.7rem;
            padding: 0.1rem 0.45rem;
            border-radius: 999px;
            background: #e5e7eb;
            color: #4b5563;
        }

        .pill-fav {
            background: #f97316;
            color: #ffffff;
            font-family: 'Slabo 27px', serif;
            font-size:1rem;
        }

        .menu-name {
            font-weight: 600;
            font-family: 'Slabo 27px', serif;
        }

        .menu-meta {
            font-size: 0.75rem;
            color: #6b7280;
        }

        .nutri {
            font-size: 1rem;
            color: #4b5563;
            font-family: 'Slabo 27px', serif;
        }

        .lokasi-alamat {
            font-size: 1rem;
            color: #4b5563;
            font-family: 'Slabo 27px', serif;
        }

        .lokasi-jam {
            font-size: 1rem;
            color: #6b7280;
            font-family: 'Slabo 27px', serif;
        }

        .summary-row {
            display: flex;
            gap: 1rem;
            margin: 1rem 0 1.2rem;
            flex-wrap: wrap;
        }

        .summary-card {
        display: flex; /* Aktifkan Flexbox */
        align-items: center; 
        justify-content: space-between; 
        
        flex: 1 1 180px;
        background: #fff;
        border-radius: 14px;
        padding: 14px 18px;
        border: 1px solid #FFE8C7;
        }

        .summary-content {
        display: flex;
        flex-direction: column;
        margin-right: 15px; 
        }

        .summary-icon-wrapper {
       
        font-size: 2rem; /* Memperbesar ikon sedikit */
        line-height: 1; /* Penting untuk Flexbox */
         }

        .summary-label {
            font-size: 1rem;
            color: #6b7280;
            margin-bottom: 4px;
            font-family: 'Slabo 27px', serif;
        }

        .summary-value {
            font-size: 1.2rem;
            font-weight: 700;
            font-family: 'Slabo 27px', serif;
        }

        .summary-value.red {
            color: #DC2626;
        }

        .summary-caption {
            font-size: 1rem;
            color: #9CA3AF;
            margin-top: 2px;
            font-family: 'Slabo 27px', serif;
        }

        @media (max-width: 900px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<?php 
include "../layout/header_admin.php";
include "../layout/sidebar_admin.php"; 
?>

<div class="main-content">
    <div class="dashboard-wrapper">
        <header style="margin-bottom: 0.4rem;">
            <h1 class="section-title">Dashboard Admin Ayam Goreng Monas</h1>
        </header>

        <div class="summary-row">
            <div class="summary-card">
                <div class="summary-label">Total menu aktif</div>
                <div class="summary-value"><?= $totalMenu; ?></div>
                <i  class="fa-solid fa-utensils" style="margin-top: 8px; color: #DC2626; font-size: 1.5rem;"></i>
            </div>
            <div class="summary-card">
                <div class="summary-label">Total cabang</div>
                <div class="summary-value"><?= $totalCabang; ?></div>
                <i class="fa-solid fa-store" style="margin-top: 8px; color: #FF7A00; font-size: 1.5rem;"></i>
            </div>
        </div>

        <div class="dashboard-grid">
            <section class="card">
                <div class="card-header">
                    <div>
                        <div class="card-title">Menu</div>
                    </div>
                </div>

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th>nama</th>
                                <th>Status</th>
                                <th>Info Nutrisi</th>
                            </tr>
                        </thead>
                        <tbody>
<?php if ($menus && mysqli_num_rows($menus) > 0): ?>
    <?php mysqli_data_seek($menus, 0); ?>
    <?php while ($m = mysqli_fetch_assoc($menus)): ?>
        <tr>

            <!-- KOLOM 1: MENU (GAMBAR SAJA) -->
            <td>
                <?php if (!empty($m['gambar'])): ?>
                    <img 
                        src="../../Source/Daftar menu/<?= htmlspecialchars($m['gambar']); ?>" 
                        alt="<?= htmlspecialchars($m['nama']); ?>" 
                        style="width: 50px; height: auto; object-fit: cover; border-radius: 8px;"
                    >
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>

            <!-- KOLOM 2: NAMA -->
            <td>
                <strong><?= htmlspecialchars($m['nama']); ?></strong>
            </td>

            <!-- KOLOM 3: STATUS -->
            <td>
                <?php if (!empty($m['status'])): ?>
                    <?php if (strtoupper($m['status']) === 'FAVORITE'): ?>
                        <span class="pill pill-fav"><?= htmlspecialchars($m['status']); ?></span>
                    <?php else: ?>
                        <span class="pill"><?= htmlspecialchars($m['status']); ?></span>
                    <?php endif; ?>
                <?php else: ?>
                    <span class="pill">-</span>
                <?php endif; ?>
            </td>

            <!-- KOLOM 4: INFO NUTRISI -->
            <td>
                <div class="nutri">Kalori: <?= $m['kalori'] !== null ? intval($m['kalori']) . ' kkal' : '-'; ?></div>
                <div class="nutri">Karbohidrat: <?= $m['karbohidrat'] !== null ? intval($m['karbohidrat']) . ' g' : '-'; ?></div>
                <div class="nutri">Protein: <?= $m['protein'] !== null ? intval($m['protein']) . ' g' : '-'; ?></div>
            </td>

        </tr>
    <?php endwhile; ?>
<?php else: ?>
    <tr>
        <td colspan="4" class="empty-state">
            Belum ada data menu di tabel <code>menu</code>.
        </td>
    </tr>
<?php endif; ?>
</tbody>
                    </table>
                </div>
            </section>

            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <section class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">Daftar Cabang</div>
                        </div>
                    </div>

                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Cabang</th>
                                    <th>Info</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if ($lokasi && mysqli_num_rows($lokasi) > 0): ?>
                                <?php mysqli_data_seek($lokasi, 0); ?>
                                <?php while ($l = mysqli_fetch_assoc($lokasi)): ?>
                                    <tr>
                                        <td><?= $l['id']; ?></td>
                                        <td>
                                            <div class="menu-name"><?= htmlspecialchars($l['nama']); ?></div>
                                        </td>
                                        <td>
                                            <div class="lokasi-alamat">
                                                <?= nl2br(htmlspecialchars($l['alamat'])); ?>
                                            </div>
                                            <div class="lokasi-jam">
                                                Jam operasional: <?= htmlspecialchars($l['jam']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="empty-state">
                                        Belum ada data cabang di tabel <code>lokasi</code>.
                                    </td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </section>

    </div>
</div>
<script>
      feather.replace();
</script>
</body>
</html>
