<?php
// Panggil file logika API
require_once 'api.php';

// Menangkap parameter 'kota' dari URL (Metode GET)
$kotaInput = isset($_GET['kota']) && !empty($_GET['kota']) ? $_GET['kota'] : 'Tasikmalaya';

// Panggil fungsi untuk mendapatkan data jadwal
$jadwalData = getJadwalSholat($kotaInput);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Sholat - Sajadah Waktu</title>
    <!-- Hubungkan ke CSS Terpisah -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <header class="header">
        <h1>Sajadah Waktu</h1>
        <p class="subtitle">Jadwal Waktu Sholat Harian</p>
    </header>

    <!-- Form Pencarian Kota dengan Metode GET -->
    <form action="index.php" method="GET" class="search-form">
        <input 
            type="text" 
            name="kota" 
            placeholder="Masukkan nama kota (contoh: Jakarta)..." 
            value="<?php echo htmlspecialchars($kotaInput); ?>" 
            required
        >
        <button type="submit">Cari</button>
    </form>

    <?php if ($jadwalData['error']): ?>
        <div class="alert error">
            <?php echo $jadwalData['message']; ?>
        </div>
    <?php else: ?>
        <?php $waktu = $jadwalData['waktu']; ?>
        
        <div class="info-box">
            <h2>Kota: <?php echo ucwords(htmlspecialchars($kotaInput)); ?>, Indonesia</h2>
            <p class="date">
                📅 Masehi: <strong><?php echo $jadwalData['masehi']; ?></strong> | 
                🌙 Hijriah: <strong><?php echo $jadwalData['hijriah']; ?> H</strong>
            </p>
        </div>

        <!-- Container Grid Jadwal Sholat -->
        <div class="jadwal-grid">
            <div class="card" data-time="<?php echo $waktu['Imsak']; ?>">
                <span class="label">Imsak</span>
                <span class="time"><?php echo $waktu['Imsak']; ?></span>
            </div>
            <div class="card" data-time="<?php echo $waktu['Fajr']; ?>">
                <span class="label">Subuh</span>
                <span class="time"><?php echo $waktu['Fajr']; ?></span>
            </div>
            <div class="card" data-time="<?php echo $waktu['Sunrise']; ?>">
                <span class="label">Dhuha</span>
                <span class="time"><?php echo $waktu['Sunrise']; ?></span>
            </div>
            <div class="card" data-time="<?php echo $waktu['Dhuhr']; ?>">
                <span class="label">Dzuhur</span>
                <span class="time"><?php echo $waktu['Dhuhr']; ?></span>
            </div>
            <div class="card" data-time="<?php echo $waktu['Asr']; ?>">
                <span class="label">Ashar</span>
                <span class="time"><?php echo $waktu['Asr']; ?></span>
            </div>
            <div class="card" data-time="<?php echo $waktu['Maghrib']; ?>">
                <span class="label">Maghrib</span>
                <span class="time"><?php echo $waktu['Maghrib']; ?></span>
            </div>
            <div class="card" data-time="<?php echo $waktu['Isha']; ?>">
                <span class="label">Isya</span>
                <span class="time"><?php echo $waktu['Isha']; ?></span>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Hubungkan ke JS Terpisah -->
<script src="script.js"></script>
</body>
</html>