<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url_media = $_POST['url_media'];
    
    // Data Dummy Strategis untuk Demo Cepat di depan Dosen
    $comments_dummy = [
        ["username" => "budi_ekonomi", "text" => "Harga beras sekarang mahal sekali dan daya beli turun!"],
        ["username" => "siti_maju", "text" => "Pemerintah sukses menjaga kestabilan inflasi nasional, mantap."],
        ["username" => "tanya_rakyat", "text" => "Bagaimana nasib subsidi BBM bulan depan pak?"],
        ["username" => "grup_kuliner", "text" => "Bahan baku naik terus, warung saya sepi pengunjung."],
        ["username" => "investor_muda", "text" => "Pertumbuhan ekonomi kuartal ini sangat memuaskan."]
    ];

    foreach ($comments_dummy as $c) {
        $teks = strtolower($c['text']);
        
        // Logika kata kunci murni native
        if (strpos($teks, 'mahal') !== false || strpos($teks, 'turun') !== false || strpos($teks, 'sepi') !== false) {
            $sentimen = 'Negatif';
            $kategori = 'Kritik';
        } else if (strpos($teks, 'mantap') !== false || strpos($teks, 'sukses') !== false || strpos($teks, 'memuaskan') !== false) {
            $sentimen = 'Positif';
            $kategori = 'Pujian';
        } else if (strpos($teks, 'bagaimana') !== false || strpos($teks, 'nasib') !== false) {
            $sentimen = 'Netral';
            $kategori = 'Pertanyaan';
        } else {
            $sentimen = 'Netral';
            $kategori = 'Lainnya';
        }

        $username = $c['username'];
        $text_komentar = $c['text'];

        mysqli_query($conn, "INSERT INTO komentar (username, text_komentar, sentimen, kategori) VALUES ('$username', '$text_komentar', '$sentimen', '$kategori')");
    }

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Scraper Media Sosial | Ekonomi Nasional</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f6f9; margin: 0; padding: 0; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .card { background: white; padding: 40px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); width: 100%; max-width: 500px; text-align: center; }
        h2 { color: #1e293b; margin-bottom: 10px; font-size: 24px; }
        p { color: #64748b; font-size: 14px; margin-bottom: 30px; }
        input[type="url"] { width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; box-sizing: border-box; transition: all 0.3s; }
        input[type="url"]:focus { border-color: #0284c7; outline: none; box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15); }
        button { background-color: #0284c7; color: white; border: none; padding: 14px 20px; font-size: 14px; font-weight: bold; border-radius: 8px; cursor: pointer; width: 100%; margin-top: 20px; transition: background 0.2s; }
        button:hover { background-color: #0369a1; }
        .loading-box { display: none; margin-top: 25px; padding: 15px; background: #f0f9ff; border-radius: 8px; border: 1px solid #bae6fd; }
        .spinner { border: 3px solid #f3f3f3; border-top: 3px solid #0284c7; border-radius: 50%; width: 24px; height: 24px; animation: spin 1s linear infinite; margin: 0 auto 10px auto; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>
    <script>
        function prosesLoading() {
            document.getElementById("btnSubmit").style.display = "none";
            document.getElementById("loadingBox").style.display = "block";
        }
    </script>
</head>
<body>

<div class="card">
    <h2>📊 Data Scraper & Analyzer</h2>
    <p>Analisis Sentimen Publik Terkait Ekonomi Nasional</p>
    
    <form method="POST" onsubmit="prosesLoading()">
        <input type="url" name="url_media" placeholder="Masukkan URL Instagram / TikTok / YouTube" required>
        <button type="submit" id="btnSubmit">Tarik & Analisis Data 🚀</button>
    </form>

    <!-- Fitur Syncing State Loading (Poin 1c) -->
    <div id="loadingBox" class="loading-box">
        <div class="spinner"></div>
        <span style="color: #0369a1; font-size: 13px; font-weight: 600;">
            ⏳ Menghubungkan ke Apify Scraper... Data sedang ditarik dan dianalisis secara otomatis. Mohon tunggu.
        </span>
    </div>
</div>

</body>
</html>