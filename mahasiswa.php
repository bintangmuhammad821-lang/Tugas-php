<?php
// Konfigurasi Koneksi Database menggunakan PDO
$host = 'localhost';
$dbname = 'kampus_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    // Set mode error PDO ke exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}

$pesan = "";

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $nim = trim($_POST['nim']);
    $nama = trim($_POST['nama']);
    $jurusan = trim($_POST['jurusan']);

    if (!empty($nim) && !empty($nama) && !empty($jurusan)) {
        try {
            // Menggunakan Prepared Statement untuk keamanan dari SQL Injection
            $sql = "INSERT INTO mahasiswa (nim, nama, jurusan) VALUES (:nim, :nama, :jurusan)";
            $stmt = $pdo->prepare($sql);
            
            $stmt->execute([
                ':nim' => $nim,
                ':nama' => $nama,
                ':jurusan' => $jurusan
            ]);

            $pesan = "Data mahasiswa berhasil ditambahkan!";
        } catch (PDOException $e) {
            $pesan = "Gagal menyimpan data: " . $e->getMessage();
        }
    } else {
        $pesan = "Semua kolom wajib diisi!";
    }
}

// Ambil daftar mahasiswa dari database
$query = $pdo->query("SELECT * FROM mahasiswa ORDER BY id DESC");
$daftar_mahasiswa = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah & Daftar Mahasiswa (PDO)</title>
    <style>
        table { border-collapse: collapse; width: 60%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .alert { color: green; font-weight: bold; }
    </style>
</head>
<body>
    <h2>Form Tambah Mahasiswa</h2>
    <?php if (!empty($pesan)): ?>
        <p class="alert"><?= htmlspecialchars($pesan); ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label>NIM:</label><br>
        <input type="text" name="nim" required><br><br>

        <label>Nama:</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Jurusan:</label><br>
        <input type="text" name="jurusan" required><br><br>

        <button type="submit" name="tambah">Simpan Data</button>
    </form>

    <hr>

    <h2>Daftar Mahasiswa</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jurusan</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($daftar_mahasiswa) > 0): ?>
                <?php foreach ($daftar_mahasiswa as $index => $mhs): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= htmlspecialchars($mhs['nim']); ?></td>
                    <td><?= htmlspecialchars($mhs['nama']); ?></td>
                    <td><?= htmlspecialchars($mhs['jurusan']); ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align: center;">Belum ada data mahasiswa.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>