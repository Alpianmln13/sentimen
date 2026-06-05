<?php
require 'config.php';

// Handle Aksi Batalkan / Tandai Selesai (Poin 3c1)
if (isset($_GET['aksi_id'])) {
    $id = intval($_GET['aksi_id']);
    mysqli_query($conn, "UPDATE komentar SET status_respon = 'Selesai' WHERE id = $id");
    header("Location: dashboard.php");
    exit();
}

// Filter Sentimen
$filter = $_GET['f_sentimen'] ?? '';
$where = $filter != '' ? "WHERE sentimen = '$filter'" : "";

// Hitung Data Statistik (Poin 3a)
$total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM komentar"))['t'];
$negatif = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM komentar WHERE sentimen='Negatif'"))['t'];
$positif = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM komentar WHERE sentimen='Positif'"))['t'];
$kritik_mendesak = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM komentar WHERE kategori='Kritik' AND status_respon='Belum'"))['t'];

$persen_negatif = $total > 0 ? round(($negatif / $total) * 100, 1) : 0;
$persen_positif = $total > 0 ? round(($positif / $total) * 100, 1) : 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Executive Dashboard BI</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f8fafc; color: #1e293b; margin: 0; padding: 30px; }
        .container { max-width: 1200px; margin: 0 auto; }
        .top-nav { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .top-nav h1 { margin: 0; font-size: 24px; color: #0f172a; }
        .btn { padding: 10px 16px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 600; }
        .btn-primary { background: #0284c7; color: white; }
        .btn-ai { background: #10b981; color: white; }
        
        /* Grid Statistik (Poin 3a) */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.03); border: 1px solid #e2e8f0; }
        .stat-card p { margin: 0; color: #64748b; font-size: 13px; font-weight: 600; }
        .stat-card h2 { margin: 10px 0 0 0; font-size: 28px; color: #0f172a; }
        .text-red { color: #ef4444 !important; }
        .text-green { color: #10b981 !important; }
        
        /* Filter & Tabel */
        .section-card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.03); border: 1px solid #e2e8f0; }
        .filter-box { margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-size: 14px; }
        select { padding: 8px 12px; border-radius: 6px; border: 1px solid #cbd5e1; outline: none; }
        
        table { width: 100%; border-collapse: collapse; text-align: left; font-size: 14px; }
        th { background-color: #f1f5f9; padding: 12px; color: #475569; font-weight: 600; border-bottom: 2px solid #e2e8f0; }
        td { padding: 14px 12px; border-bottom: 1px solid #e2e8f0; color: #334155; }
        
        /* Badge Sentimen (Poin 3b1) */
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; display: inline-block; }
        .bg-positif { background: #d1fae5; color: #065f46; }
        .bg-negatif { background: #fee2e2; color: #991b1b; }
        .bg-netral { background: #f1f5f9; color: #334155; }
        
        .action-link { color: #0284c7; text-decoration: none; font-weight: 600; }
        .action-link:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="container">
    <div class="top-nav">
        <h1>📈 Dashboard Analisis Sentimen</h1>
        <div>
            <a href="index.php" class="btn btn-primary">🔄 Tarik Data Baru</a>
            <a href="rekomendasi.php" class="btn btn-ai">🤖 Lihat Laporan AI Gemini</a>
        </div>
    </div>

    <!-- Ringkasan Eksekutif (Poin 3a) -->
    <div class="stats-grid">
        <div class="stat-card">
            <p>TOTAL KOMENTAR DIANALISIS</p>
            <h2><?php echo $total; ?></h2>
        </div>
        <div class="stat-card">
            <p>SENTIMEN POSITIF (%)</p>
            <h2 class="text-green"><?php echo $persen_positif; ?>%</h2>
        </div>
        <div class="stat-card">
            <p>SENTIMEN NEGATIF (%)</p>
            <h2 class="text-red"><?php echo $persen_negatif; ?>%</h2>
        </div>
        <div class="stat-card" style="border-top: 4px solid #ef4444;">
            <p>🚨 KRITIK MENDESAK (BELUM MERESPON)</p>
            <h2><?php echo $kritik_mendesak; ?></h2>
        </div>
    </div>

    <!-- Daftar Komentar (Poin 3c) -->
    <div class="section-card">
        <div class="filter-box">
            <span>Filter Berdasarkan Sentimen:</span>
            <form method="GET">
                <select name="f_sentimen" onchange="this.form.submit()">
                    <option value="">-- Semua Data --</option>
                    <option value="Positif" <?php if($filter=='Positif') echo 'selected'; ?>>Positif</option>
                    <option value="Negatif" <?php if($filter=='Negatif') echo 'selected'; ?>>Negatif</option>
                    <option value="Netral" <?php if($filter=='Netral') echo 'selected'; ?>>Netral</option>
                </select>
            </form>
        </div>

        <table style="width: 100%;">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Isi Komentar asli</th>
                    <th>Sentimen (AI/Native)</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($conn, "SELECT * FROM komentar $where ORDER BY id DESC");
                if (mysqli_num_rows($query) == 0) {
                    echo "<tr><td colspan='6' style='text-align:center; color:#94a3b8; padding:30px;'>Belum ada data. Silakan tarik data terlebih dahulu.</td></tr>";
                }
                while ($row = mysqli_fetch_assoc($query)) {
                    $badge_class = 'bg-netral';
                    if ($row['sentimen'] == 'Positif') $badge_class = 'bg-positif';
                    if ($row['sentimen'] == 'Negatif') $badge_class = 'bg-negatif';
                ?>
                <tr>
                    <td style="font-weight: 600; color: #475569;">@<?php echo htmlspecialchars($row['username']); ?></td>
                    <td style="max-width: 400px;"><?php echo htmlspecialchars($row['text_komentar']); ?></td>
                    <td><span class="badge <?php echo $badge_class; ?>"><?php echo $row['sentimen']; ?></span></td>
                    <td>style="font-weight: 500;"<?php echo $row['kategori']; ?></td>
                    <td>
                        <span style="color: <?php echo $row['status_respon'] == 'Selesai' ? '#10b981' : '#f59e0b'; ?>; font-weight: 600;">
                            <?php echo $row['status_respon']; ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($row['status_respon'] == 'Belum'): ?>
                            <a href="dashboard.php?aksi_id=<?php echo $row['id']; ?>" class="action-link">Tandai Selesai</a>
                        <?php else: ?>
                            <span style="color:#94a3b8;">✔ Selesai</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>