<?php
/**
 * Fungsi untuk mengambil data jadwal sholat berdasarkan kota
 */
function getJadwalSholat($kota = 'Tasikmalaya', $negara = 'Indonesia') {
    // Sanitasi input nama kota
    $kotaClean = urlencode(trim($kota));
    $negaraClean = urlencode(trim($negara));

    // Endpoint API Aladhan (Method 11 = Kemenag RI)
    $apiUrl = "https://api.aladhan.com/v1/timingsByCity?city={$kotaClean}&country={$negaraClean}&method=11";

    // Ambil data JSON dari API
    $response = @file_get_contents($apiUrl);

    if ($response === FALSE) {
        return ['error' => true, 'message' => 'Gagal terhubung ke API Aladhan.'];
    }

    $data = json_decode($response, true);

    if (isset($data['code']) && $data['code'] == 200) {
        return [
            'error' => false,
            'waktu' => $data['data']['timings'],
            'masehi' => $data['data']['date']['readable'],
            'hijriah' => $data['data']['date']['hijri']['day'] . ' ' . $data['data']['date']['hijri']['month']['en'] . ' ' . $data['data']['date']['hijri']['year']
        ];
    } else {
        return ['error' => true, 'message' => 'Kota "' . htmlspecialchars($kota) . '" tidak ditemukan.'];
    }
}