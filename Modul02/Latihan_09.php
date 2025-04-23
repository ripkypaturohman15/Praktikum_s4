<?php
require_once "Latihan_06.php";

if (isset($_GET["id"])) {
    $alumni = new Alumni();
    $alumni->id = $_GET["id"];
    $stmt = $alumni->getById();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo "Data tidak ditemukan!";
        exit;
    }
} else {
    echo "ID tidak diberikan!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $alumni->id = $_POST["id"];
    $alumni->nama = $_POST["nama"];
    $alumni->email = $_POST["email"];
    $alumni->jurusan = $_POST["jurusan"];
    $alumni->tahun_lulus = $_POST["tahun_lulus"];

    if ($alumni->update()) {
        header("Location: Latihan_06.php");
        exit;
    } else {
        echo "Gagal memperbarui data.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Alumni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Alumni</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo $data['email']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Jurusan</label>
            <input type="text" name="jurusan" class="form-control" value="<?php echo $data['jurusan']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Tahun Lulus</label>
            <input type="number" name="tahun_lulus" class="form-control" value="<?php echo $data['tahun_lulus']; ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="latihan_02_06.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
