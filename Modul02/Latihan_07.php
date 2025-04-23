<?php 
require_once "Latihan_06.php"; 
$alumni = new Alumni(); 
$stmt = $alumni->getAll(); 
?> 

<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <title>Daftar Alumni</title> 
</head> 
<body> 
    <h1>Daftar Alumni</h1> 
    <a href="Latihan_08.php">Tambah Alumni</a> 
    <table border="1"> 
        <tr> 
            <th>Nama</th> 
            <th>Email</th> 
            <th>Jurusan</th> 
            <th>Tahun Lulus</th> 
            <th>Aksi</th> 
        </tr> 
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>  
            <tr> 
                <td><?php echo $row["nama"]; ?></td> 
                <td><?php echo $row["email"]; ?></td> 
                <td><?php echo $row["jurusan"]; ?></td> 
                <td><?php echo $row["tahun_lulus"]; ?></td> 
                <td> 
                    <a href="latihan_09.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                    <a href="latihan_10.php?id=<?php echo $row['id']; ?>">Hapus</a> 
                </td> 
            </tr> 
        <?php } ?> 
    </table> 
</body> 
</html>
