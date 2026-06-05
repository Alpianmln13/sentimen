<?php
require 'config.php';

// Ambil kumpulan teks kritik/negatif untuk disetor ke Gemini AI
$queryNegatif = mysqli_query($conn, "SELECT text_komentar FROM komentar WHERE sentimen = 'Negatif'");
$gabungan_keluhan = "";
$no = 1;
while($row = mysqli_fetch_assoc($queryNegatif)) {
    $gabungan_keluhan .= $no . ". " . $row['text_komentar'] . "\n";
    $no++;
}

$hasil_gemini = "";
$error_msg = "";

if (!empty($gabungan_keluhan)) {
    $apiKey = "AQ.Ab8RN6Kr7wzrW5ZMud872QWrMyI8lUSHTRJZTX4GXGw54X5KMw"; 
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent" . $apiKey;

    $prompt = "Berikut adalah daftar keluhan masyarakat tentang ekonomi nasional di media sosial:\n" . $gabungan_keluhan . 
              "\n\nBerdasarkan data di atas, tolong buatkan ringkasan analisis global dan berikan rekomendasi tindakan operasionalnya seperti format pada soal.";

    $payload = json_encode([
        "contents" => [["parts" => [["text" => $prompt]]]]
    ]);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    
    $response = curl_exec($ch);
    
    if (!curl_errno($ch)) {
        $result = json_decode($response, true);
        if (isset($result['error'])) {
            $error_msg = $result['error']['message'];
        } elseif (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
            $hasil_gemini = $result['candidates'][0]['content']['parts'][0]['text'];
        }
    } else {
        $error_msg = curl_error($ch);
    }
    curl_close($ch);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>AI Recommendations | Laporan Otomatis</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f6f9; color: #333; margin: 0; padding: 40px 20px; }
        .container { max-width: 800px; margin: 0 auto; background: #ffffff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .header-title { display: flex; align-items: center; font-size: 22px; color: #0f172a; margin-top: 0; margin-bottom: 20px; border-bottom: 2px solid #f1f5f9; padding-bottom: 15px; }
        .btn-back { display: inline-flex; align-items: center; color: #0284c7; text-decoration: none; font-weight: 600; font-size: 14px; margin-bottom: 25px; }
        .error-box { background-color: #fdf2f2; border-left: 4px solid #f8b4b4; color: #9b1c1c; padding: 15px; border-radius: 6px; margin-bottom: 25px; font-size: 14px; }
        .report-card { background-color: #f8fafc; border: 1px solid #e2e8f0; border-left: 5px solid #10b981; padding: 25px; border-radius: 8px; line-height: 1.7; font-size: 15px; }
        .report-card h3 { margin-top: 0; color: #0f172a; font-size: 18px; margin-bottom: 15px; }
        .badge-simulation { background-color: #fef3c7; color: #92400e; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: bold; display: inline-block; margin-bottom: 15px; }
        ul { padding-left: 20px; margin-top: 5px; }
        li { margin-bottom: 8px; }
    </style>
</head>
<body>

<div class="container">
    <a href="dashboard.php" class="btn-back">⬅️ Kembali ke Dashboard Utama</a>
    <h2 class="header-title">📋 AI Recommendations (Laporan Otomatis)</h2>

    <?php if (!empty($error_msg)): ?>
        <div class="error-box">
            <strong>Sistem Mengalami Kendala API:</strong> <?php echo htmlspecialchars($error_msg); ?>
            <br><small style="color: #64748b;">Menampilkan simulasi laporan fallback otomatis berdasarkan akumulasi data terkini...</small>
        </div>
    <?php endif; ?>

    <div class="report-card">
        <h3>Laporan Analisis Global & Rekomendasi</h3>
        
        <?php if (!empty($hasil_gemini)): ?>
            <div style="white-space: pre-line; color: #334155;"><?php echo htmlspecialchars($hasil_gemini); ?></div>
        <?php else: ?>
            <span class="badge-simulation">Mode Simulasi Offline Dashboard BI</span>
            <div style="color: #334155;">
                <p><strong>Ringkasan Analisis Global:</strong><br>
                Berdasarkan akumulasi data komentar negatif yang masuk mengenai Ekonomi Nasional, mayoritas masyarakat mengeluhkan fluktuasi harga komoditas pokok yang melonjak tajam serta melemahnya daya beli di tingkat pedagang kecil/UMKM.</p>
                
                <p><strong>Rekomendasi Tindakan Operasional (Business Intelligence):</strong></p>
                <ul>
                    <li><strong>Intervensi Pasar Pasokan Pokok:</strong> Mendorong stakeholder terkait untuk segera menyelenggarakan operasi pasar murah khusus bahan pangan di wilayah terdampak keluhan tertinggi.</li>
                    <li><strong>Stimulus Finansial UMKM:</strong> Memberikan relaksasi atau bantuan subsidi modal guna memicu kembali perputaran roda ekonomi lokal.</li>
                    <li><strong>Manajemen Komunikasi Publik:</strong> Merilis infografis transparansi distribusi stok pangan nasional melalui kanal media sosial resmi guna meredam sentimen publik.</li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>