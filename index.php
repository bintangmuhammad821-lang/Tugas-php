<?php
function konversiNilai(int $nilai): string {
    if ($nilai >= 81 && $nilai <= 100) {
        return "A";
    } elseif ($nilai >= 76 && $nilai <= 80) {
        return "B";
    } elseif ($nilai >= 61 && $nilai <= 75) {
        return "C";
    } elseif ($nilai >= 36 && $nilai <= 60) {
        return "D";
    } elseif ($nilai >= 0 && $nilai <= 35) {
        return "E";
    } else {
        return "Nilai tidak valid (di luar rentang 0-100)";
    }
}

// Contoh Penggunaan:
$nilai_uji = 25;
echo "Nilai angka $nilai_uji dikonversi menjadi huruf: " . konversiNilai($nilai_uji); 
// Output: E
?>