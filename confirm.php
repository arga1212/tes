<?php
require "koneksi.php";
session_start();

if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'user') {
    header('Location: index.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id_obat = $_GET['id'];

$query = "SELECT * FROM obat WHERE id_obat = $id_obat";
$result = mysqli_query($koneksi, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    header('Location: index.php');
    exit;
}

$obat = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jumlah = $_POST["jumlah"];
    if (!is_numeric($jumlah) || $jumlah <= 0) {
        $error = "Masukkan jumlah obat yang valid.";
    } else {
        header("Location: add_cart.php?id_obat=$id_obat&jumlah=$jumlah");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembelian</title>
    <link rel="icon" type="image/png" href="logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poetsen+One&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            text-align: center;
        }
        .card img {
            width: 50%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .card h3 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }
        .card p {
            font-size: 18px;
            color: #666;
            margin-bottom: 10px;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        label {
            font-size: 18px;
            margin-bottom: 10px;
        }
        input[type="number"] {
            padding: 10px;
            margin-bottom: 15px;
            font-size: 16px;
            width: 80px;
            text-align: center;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<h2>Konfirmasi Pembelian</h2>

<div class="card">
    <img src="foto/<?php echo $obat['img']; ?>" alt="Gambar Obat">
    <h3><?php echo $obat['nama_obat']; ?></h3>
    <p>Harga: Rp <?php echo number_format($obat['harga_obat']); ?></p>
    <p>Ketersediaan barang: <?php echo $obat['stok_obat']; ?></p>

    <?php if ($obat['stok_obat'] > 0): ?>
        <form method="post">
            <label for="jumlah">Jumlah:</label>
            <input type="number" id="jumlah" name="jumlah" min="1" max="<?php echo $obat['stok_obat']; ?>" required>
            <input type="submit" value="Tambahkan ke Keranjang">
        </form>
    <?php else: ?>
        <p style="color: red; font-weight: bold;">Obat tidak tersedia.</p>
    <?php endif; ?>

    <?php if (isset($error)) { ?>
        <p class="error"><?php echo $error; ?></p>
    <?php } ?>
</div>

</body>
</html>
