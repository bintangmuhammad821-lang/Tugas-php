<!DOCTYPE html>
<html>
<head>
    <title>Kalkulator</title>
</head>
<body>

<h2>Kalkulator Sederhana</h2>

<form method="POST">
    Angka pertama:
    <input type="number" name="angka1" required><br><br>

    Operator:
    <select name="operator">
        <option value="+">+</option>
        <option value="-">-</option>
        <option value="*">*</option>
        <option value="/">/</option>
    </select><br><br>

    Angka kedua:
    <input type="number" name="angka2" required><br><br>

    <button type="submit" name="hitung">Hitung</button>
</form>

<?php
if (isset($_POST['hitung'])) {
    $a = $_POST['angka1'];
    $b = $_POST['angka2'];
    $op = $_POST['operator'];

    if ($op == "+") {
        $hasil = $a + $b;
    } elseif ($op == "-") {
        $hasil = $a - $b;
    } elseif ($op == "*") {
        $hasil = $a * $b;
    } elseif ($op == "/") {
        if ($b == 0) {
            die("Tidak bisa dibagi nol!");
        }
        $hasil = $a / $b;
    }

    echo "Hasil: " . $hasil;
}
?>

</body>
</html>