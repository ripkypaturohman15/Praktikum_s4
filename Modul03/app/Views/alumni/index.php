<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Alumni</title>

    <!-- Menambahkan Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Daftar Alumni</h2>
        <a href="<?= base_url('alumni/create'); ?>" class="btn btn-primary mb-3">Tambah Alumni</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Angkatan</th>
                    <th>Jurusan</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alumni as $a): ?>
                    <tr>
                        <td><?= $a['id']; ?></td>
                        <td><?= $a['nama']; ?></td>
                        <td><?= $a['angkatan']; ?></td>
                        <td><?= $a['jurusan']; ?></td>
                        <td><?= $a['email']; ?></td>
                        <td><?= $a['telepon']; ?></td>
                        <td>
                            <a href="<?= base_url('alumni/edit/' . $a['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="<?= base_url('alumni/delete/' . $a['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>