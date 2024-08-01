<?php
$koneksi = mysqli_connect("localhost", "username", "password", "kesehatan");

$id = $_GET['id'];
$result = mysqli_query($koneksi, "SELECT * FROM ongkir WHERE id_ongkir='$id'");
$row = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $jenis = $_POST['jenis'];
    $harga = $_POST['harga'];
    
    $query = "UPDATE ongkir SET Jenis='$jenis', Harga_ongkir='$harga' WHERE id_ongkir='$id'";
    mysqli_query($koneksi, $query);
    
   
    echo "<script>
    alert('Data Berhasil diupdate');
    window.location.href = 'dataongkir.php';
    </script>";
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Ongkir</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Ongkir</h1>
    <form method="post">
        <label for="jenis">Jenis:</label>
        <input type="text" id="jenis" name="jenis" value="<?php echo $row['Jenis']; ?>" required>
        <label for="harga">Harga:</label>
        <input type="number" id="harga" name="harga" value="<?php echo $row['Harga_ongkir']; ?>" required>
        <button type="submit" name="submit">Update</button>
    </form>
</body>
</html>
