<?php
$koneksi = mysqli_connect("localhost", "username", "password", "kesehatan");

if (isset($_POST['submit'])) {
    $jenis = $_POST['jenis'];
    $harga = $_POST['harga'];
    
    $query = "INSERT INTO ongkir (Jenis, Harga_ongkir) VALUES ('$jenis', '$harga')";
    mysqli_query($koneksi, $query);
   
    echo "<script>
    alert('Data Berhasil ditambah');
    window.location.href = 'dataongkir.php';
    </script>";
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Ongkir</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Tambah Ongkir</h1>
    <form method="post">
        <label for="jenis">Jenis:</label>
        <input type="text" id="jenis" name="jenis" required>
        <label for="harga">Harga:</label>
        <input type="number" id="harga" name="harga" required>
        <button type="submit" name="submit">Simpan</button>
    </form>
</body>
</html>
