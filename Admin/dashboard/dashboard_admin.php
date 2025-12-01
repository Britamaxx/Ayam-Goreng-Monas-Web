<?php
include "../../conn.php";

// Query menu
$qMenu = "SELECT id, nama, gambar, status, deskripsi, kalori, karbohidrat, protein FROM menu ORDER BY nama ASC";
$menus = mysqli_query($conn, $qMenu);
$totalMenu = $menus ? mysqli_num_rows($menus) : 0;

// Query cabang (lokasi)
$qLokasi = "SELECT id, nama, alamat, jam FROM lokasi ORDER BY id ASC";
$lokasi = mysqli_query($conn, $qLokasi);
$totalCabang = $lokasi ? mysqli_num_rows($lokasi) : 0;

// ============ DATA PESANAN (DARI DB) ============
// total pesanan hari ini
$qPesananHariIni = "
    SELECT COUNT(*) AS total 
    FROM pesanan 
    WHERE DATE(created_at) = CURDATE()
";
$rPesananHariIni = mysqli_query($conn, $qPesananHariIni);
$pesananHariIni = 0;
if ($rPesananHariIni && mysqli_num_rows($rPesananHariIni) > 0) {
    $rowPesanan = mysqli_fetch_assoc($rPesananHariIni);
    $pesananHariIni = (int)$rowPesanan['total'];
}

// ============ DATA PEKERJA (DARI DB) ============
// join pekerja dengan lokasi biar dapat nama cabang
$qPekerja = "
    SELECT p.id, p.nama, p.posisi, p.shift, p.status, l.nama AS nama_cabang
    FROM pekerja p
    LEFT JOIN lokasi l ON p.cabang_id = l.id
    ORDER BY l.id ASC, p.posisi ASC
";
$pekerja = mysqli_query($conn, $qPekerja);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style_admin/manage_menu.css" />
    <title>Dashboard Admin - Ayam Goreng Monas</title>

    <style>
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
            font-size: 28px;
            font-weight: 700;
            color: #DC2626;
            margin-bottom: 0.15rem;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1.3fr;
            gap: 1.25rem;
        }

        .card {
            background: #ffffff;
            padding: 25px 30px;
            border-radius: 14px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
            border: 1px solid #FFE8C7;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .card-title {
            font-size: 0.95rem;
            font-weight: 600;
        }

        .card-subtitle {
            font-size: 0.8rem;
            color: #6b7280;
        }

        .badge {
            display: inline-block;
            font-size: 0.7rem;
            padding: 0.15rem 0.5rem;
            border-radius: 999px;
            background: #ffedd5;
            color: #c2410c;
        }

        .table-wrapper {
            margin-top: 0.5rem;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
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
        }

        .menu-name {
            font-weight: 600;
        }

        .menu-meta {
            font-size: 0.75rem;
            color: #6b7280;
        }

        .nutri {
            font-size: 0.75rem;
            color: #4b5563;
        }

        .lokasi-alamat {
            font-size: 0.8rem;
            color: #4b5563;
        }

        .lokasi-jam {
            font-size: 0.75rem;
            color: #6b7280;
        }

        /* ====== CARD RINGKASAN ATAS ====== */
        .summary-row {
            display: flex;
            gap: 1rem;
            margin: 1rem 0 1.2rem;
            flex-wrap: wrap;
        }

        .summary-card {
            flex: 1 1 180px;
            background: #fff;
            border-radius: 14px;
            padding: 14px 18px;
            border: 1px solid #FFE8C7;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        }

        .summary-label {
            font-size: 0.8rem;
            color: #6b7280;
            margin-bottom: 4px;
        }

        .summary-value {
            font-size: 1.2rem;
            font-weight: 700;
        }

        .summary-value.red {
            color: #DC2626;
        }

        .summary-caption {
            font-size: 0.75rem;
            color: #9CA3AF;
            margin-top: 2px;
        }

        .pekerja-list {
            list-style: none;
        }

        .pekerja-item + .pekerja-item {
            margin-top: 0.6rem;
            padding-top: 0.6rem;
            border-top: 1px solid #F3F4F6;
        }

        .pekerja-nama {
            font-size: 0.9rem;
            font-weight: 600;
        }

        .pekerja-posisi {
            font-size: 0.8rem;
            color: #F97316;
            margin-bottom: 2px;
        }

        .pekerja-meta {
            font-size: 0.78rem;
            color: #6B7280;
        }

        .pekerja-status {
            font-size: 0.75rem;
            padding: 0.05rem 0.4rem;
            border-radius: 999px;
            background: #DCFCE7;
            color: #166534;
            margin-left: 6px;
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
                <div class="summary-label">Pesanan hari ini</div>
                <div class="summary-value red"><?= $pesananHariIni; ?></div>
                <div class="summary-caption">Total order masuk (dari tabel <code>pesanan</code>)</div>
            </div>
            <div class="summary-card">
                <div class="summary-label">Total menu aktif</div>
                <div class="summary-value"><?= $totalMenu; ?></div>
                <div class="summary-caption">Data dari tabel <code>menu</code></div>
            </div>
            <div class="summary-card">
                <div class="summary-label">Total cabang</div>
                <div class="summary-value"><?= $totalCabang; ?></div>
                <div class="summary-caption">Data dari tabel <code>lokasi</code></div>
            </div>
        </div>

        <div class="dashboard-grid">
            <section class="card">
                <div class="card-header">
                    <div>
                        <div class="card-title">Menu</div>
                        <div class="card-subtitle">tabel menu</div>
                    </div>
                    <span class="badge">Menu</span>
                </div>

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th>Status</th>
                                <th>Info Nutrisi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($menus && mysqli_num_rows($menus) > 0): ?>
                            <?php mysqli_data_seek($menus, 0); ?>
                            <?php while ($m = mysqli_fetch_assoc($menus)): ?>
                                <tr>
                                    <td>
                                        <div class="menu-name"><?= htmlspecialchars($m['nama']); ?></div>
                                        <?php if (!empty($m['gambar'])): ?>
                                            <div class="menu-meta">
                                                <img 
                                                    src="../../Source/Daftar menu/<?= htmlspecialchars($m['gambar']); ?>" 
                                                    alt="<?= htmlspecialchars($m['nama']); ?>" 
                                                    style="width: 50px; height: auto; object-fit: cover;"
                                                >
                                            </div>
                                        <?php endif; ?>
                                    </td>
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
                                    <td>
                                        <div class="nutri">
                                            Kalori:
                                            <?= $m['kalori'] !== null ? intval($m['kalori']) . ' kkal' : '-'; ?>
                                        </div>
                                        <div class="nutri">
                                            Karbohidrat:
                                            <?= $m['karbohidrat'] !== null ? intval($m['karbohidrat']) . ' g' : '-'; ?>
                                        </div>
                                        <div class="nutri">
                                            Protein:
                                            <?= $m['protein'] !== null ? intval($m['protein']) . ' g' : '-'; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="empty-state">
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
                            <div class="card-subtitle">Data dari tabel <code>lokasi</code></div>
                        </div>
                        <span class="badge">Cabang</span>
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

                <!-- CARD PEKERJA (DARI DB) -->
                <section class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">Daftar Pekerja</div>
                            <div class="card-subtitle">Data dari tabel <code>pekerja</code></div>
                        </div>
                        <span class="badge">Pekerja</span>
                    </div>

                    <?php if ($pekerja && mysqli_num_rows($pekerja) > 0): ?>
                        <ul class="pekerja-list">
                            <?php while ($p = mysqli_fetch_assoc($pekerja)): ?>
                                <li class="pekerja-item">
                                    <div class="pekerja-nama">
                                        <?= htmlspecialchars($p['nama']); ?>
                                        <?php if ($p['status'] !== 'aktif'): ?>
                                            <span class="pekerja-status">
                                                <?= htmlspecialchars(ucfirst($p['status'])); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="pekerja-posisi"><?= htmlspecialchars($p['posisi']); ?></div>
                                    <div class="pekerja-meta">
                                        Cabang: <?= htmlspecialchars($p['nama_cabang'] ?? '-'); ?><br>
                                        Shift: <?= htmlspecialchars($p['shift']); ?>
                                    </div>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php else: ?>
                        <div class="empty-state">
                            Belum ada data pekerja di tabel <code>pekerja</code>.
                        </div>
                    <?php endif; ?>
                </section>
            </div>
        </div>
        <?php
        $qPesananTerbaru = "
            SELECT ps.kode_pesanan,
                   ps.nama_pelanggan,
                   ps.total_harga,
                   ps.status,
                   ps.created_at,
                   l.nama AS nama_cabang
            FROM pesanan ps
            LEFT JOIN lokasi l ON ps.cabang_id = l.id
            ORDER BY ps.created_at DESC
            LIMIT 5
        ";
        $pesananTerbaru = mysqli_query($conn, $qPesananTerbaru);
        ?>

        <div style="margin-top: 1.5rem;">
            <section class="card">
                <div class="card-header">
                    <div>
                        <div class="card-title">Pesanan Terbaru</div>
                        <div class="card-subtitle">
                            5 pesanan terakhir dari tabel <code>pesanan</code>
                        </div>
                    </div>
                    <span class="badge">Pesanan</span>
                </div>

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Pelanggan</th>
                                <th>Cabang</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($pesananTerbaru && mysqli_num_rows($pesananTerbaru) > 0): ?>
                            <?php while ($p = mysqli_fetch_assoc($pesananTerbaru)): ?>
                                <tr>
                                    <td><?= htmlspecialchars($p['kode_pesanan']); ?></td>
                                    <td><?= htmlspecialchars($p['nama_pelanggan']); ?></td>
                                    <td><?= htmlspecialchars($p['nama_cabang'] ?? '-'); ?></td>
                                    <td>Rp <?= number_format($p['total_harga'], 0, ',', '.'); ?></td>
                                    <td>
                                        <span class="pill">
                                            <?= htmlspecialchars(ucfirst($p['status'])); ?>
                                        </span>
                                    </td>
                                    <td><?= date('d M Y H:i', strtotime($p['created_at'])); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="empty-state">
                                    Belum ada data pesanan.
                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

    </div>
</div>

</body>
</html>
