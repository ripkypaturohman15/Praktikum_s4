<?php
require_once "Latihan_05.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $alumni = new Alumni();

    $alumni->nama = $_POST["nama"];
    $alumni->email = $_POST["email"];
    $alumni->jurusan = $_POST["jurusan"];
    $alumni->tahun_lulus = $_POST["tahun_lulus"];

    if ($alumni->add()) {
        header("Location: Latihan_06.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Alumni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Tambah Alumni</h2>
        <form method="POST">
            <input type="text" name="nama" class="form-control mb-2" placeholder="Nama" required>
            <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
            <input type="text" name="jurusan" class="form-control mb-2" placeholder="Jurusan" required>
            <input type="number" name="tahun_lulus" class="form-control mb-2" placeholder="Tahun Lulus" required>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</body>
</html>
