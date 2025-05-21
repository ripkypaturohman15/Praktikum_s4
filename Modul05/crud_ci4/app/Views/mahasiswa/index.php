<!DOCTYPE html>
<html lang="id">

<head>
  <title>Data Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container">
  <h2 class="my-3">Data Mahasiswa</h2>
  <a href="/mahasiswa/create" class="btn btn-primary mb-3">Tambah Mahasiswa</a>
  <table class="table table-bordered">
    <tr>
      <th>ID</th>
      <th>Nama</th>
      <th>Email</th>
    </tr>
    <?php foreach ($mahasiswa as $mhs): ?>
      <tr>
        <td><?= $mhs['id'] ?></td>
        <td><?= $mhs['nama'] ?></td>
        <td><?= $mhs['email'] ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>