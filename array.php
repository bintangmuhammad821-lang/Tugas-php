<?php
// Array multidimensi berisi 5 mahasiswa
$mahasiswa = [
    ["NIM" => "2510090", "Nama" => "Ozil ", "Nilai" => 85],
    ["NIM" => "2510080", "Nama" => "galang Hermansyah", "Nilai" => 90],
    ["NIM" => "2510089", "Nama" => "Jojo Santoso", "Nilai" => 78],
    ["NIM" => "2510066", "Nama" => "Indah Lestari", "Nilai" => 88],
    ["NIM" => "2510068", "Nama" => "Yoga prasetyo", "Nilai" => 92]
];

$total_nilai = 0;
$jumlah_mahasiswa = count($mahasiswa);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Nilai Mahasiswa</title>
    <style>
        table { border-collapse: collapse; width: 50%; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Data Nilai Mahasiswa</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mahasiswa as $index => $mhs): 
                $total_nilai += $mhs['Nilai'];
            ?>
            <tr>
                <td><?= $index + 1; ?></td>
                <td><?= htmlspecialchars($mhs['NIM']); ?></td>
                <td><?= htmlspecialchars($mhs['Nama']); ?></td>
                <td><?= $mhs['Nilai']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php
    $rata_rata = $total_nilai / $jumlah_mahasiswa;
    ?>
    <p><strong>Rata-rata Nilai Kelas: </strong> <?= number_format($rata_rata, 2); ?></p>
</body>
</html>
