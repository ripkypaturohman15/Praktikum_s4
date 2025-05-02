<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Biodata</title>
</head>

<body>
    <h2>Form Biodata Mahasiswa</h2>
    <form action="/salam/store" method="post">
        <label for="nama">Nama:</label><br>
        <input type="text" name="nama" id="nama" required>
        <br><br>

        <label for="nim">NIM:</label><br>
        <input type="text" name="nim" id="nim" required>
        <br><br>


        <label for="kelas">Kelas:</label><br>
        <input type="text" name="kelas" id="kelas" required>
        <br><br>

        <button type="submit">Kirim</button>
    </form>
</body>

</html>