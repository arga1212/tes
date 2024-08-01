<?php

$koneksi = mysqli_connect("localhost", "username", "password", "kesehatan");

$result = mysqli_query($koneksi, "SELECT * FROM ongkir");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Ongkir</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Data Ongkir</h1>
    <a href="create.php" class="button">Tambah Ongkir</a>
    <a href="../admin.php" class="button">Back</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Jenis</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id_ongkir']; ?></td>
                    <td><?php echo $row['Jenis']; ?></td>
                    <td><?php echo $row['Harga_ongkir']; ?></td>
                    <td>
                        <a href="update.php?id=<?php echo $row['id_ongkir']; ?>" class="button">Edit</a>
                        <a href="delete.php?id=<?php echo $row['id_ongkir']; ?>" class="button" onclick="return confirm('Yakin ingin menghapus?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
