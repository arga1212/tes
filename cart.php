<?php
require "koneksi.php";
session_start();

if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'user') {
    header('Location: index.php');
    exit;
}


if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$id_user = $_SESSION['id_user'];

// Jika form update jumlah dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_jumlah'])) {
    $id_keranjang = $_POST['id_keranjang'];
    $jumlah_baru = $_POST['jumlah'];

    $update_query = "UPDATE keranjang SET jumlah = '$jumlah_baru' WHERE id_keranjang = '$id_keranjang'";
    mysqli_query($koneksi, $update_query);
    header('Location: cart.php');
    exit;
}

// Query untuk mendapatkan data keranjang
$query = "SELECT keranjang.id_keranjang, obat.nama_obat, obat.harga_obat, keranjang.jumlah, 
                 (obat.harga_obat * keranjang.jumlah) AS total_harga, obat.img 
          FROM keranjang 
          INNER JOIN obat ON keranjang.id_obat = obat.id_obat 
          WHERE keranjang.id_user = '$id_user'";

$result = mysqli_query($koneksi, $query);

// Jika item di keranjang dibatalkan
if (isset($_GET['cancel'])) {
    $id_keranjang = $_GET['cancel'];
    $delete_query = "DELETE FROM keranjang WHERE id_keranjang = '$id_keranjang'";
    mysqli_query($koneksi, $delete_query);
    header('Location: cart.php');
    exit;
}

mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link rel="icon" type="image/png" href="logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poetsen+One&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poetsen+One&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .wrapper {
            width: 75%;
            margin: auto;
            position: relative;
        }

        .logo a {
            font-family: "Montserrat", sans-serif;
            font-size: 30px;
            font-weight: 700;
            float: left;
            color: #002D73;
            text-decoration: none;
            margin-left: -100px;
        }

        .menu {
            float: right;
        }

        nav {
            width: 100%;
            margin: auto;
            display: flex;
            line-height: 80px;
            position: sticky;
            position: -webkit-sticky;
            top: 0;
            background: #AED6F1;
            z-index: 1000;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        nav ul li {
            float: left;
        }

        nav ul li a {
            color: #211C6A;
            font-weight: bold;
            text-align: center;
            padding: 0px 16px 0px 16px;
            text-decoration: none;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        .halo {
            font-weight: bold;
            float: right;
            margin-left: 20px;
            font-family: "Montserrat", sans-serif;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        .cart-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }

        .cart-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 10px;
            padding: 20px;
            width: 250px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .cart-card img {
            width: 60%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 15px;
            margin-left:50px;
            min-height: 150px;
            object-fit: contain; 
        }

        .cart-details {
            flex-grow: 1;
        }

        .cart-details h3 {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
            font-weight: 700;
            font-family: "Montserrat", sans-serif;
        }

        .cart-details p {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
            font-weight: 700;
            font-family: "Montserrat", sans-serif;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .actions {
            text-align: center;
            margin: 20px 0;
        }

        .update-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .update-form input[type="number"] {
            width: 60px;
            padding: 5px;
            margin-bottom: 10px;
        }

        .update-form input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        .update-form input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
<nav>
    <div class="wrapper">
        <div class="logo">
            <a href=''>Sehat aja</a>
        </div>
        <div class="menu">
            <ul>
                <li><a href="selamat-datang.php">Home</a></li>
                <li><a href="checkout.php">Checkout</a></li>
                <li><a href="cart.php">Keranjang</a></li>
                <?php
                echo '<div class="halo">' . "Halo," . $_SESSION['username'] . '</div>';
                ?>
            </ul>
        </div>
    </div>
</nav>

<h2>Keranjang Belanja</h2>

<div class="cart-container">
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="cart-card">
                <img src="foto/<?php echo $row['img']; ?>" alt="Gambar Obat">
                <div class="cart-details">
                    <h3><?php echo $row['nama_obat']; ?></h3>
                    <p>Harga: Rp <?php echo number_format($row['harga_obat']); ?></p>
                    <p>Jumlah: <?php echo $row['jumlah']; ?></p>
                    <p>Total Harga: Rp <?php echo number_format($row['total_harga']); ?></p>
                    <form class="update-form" method="POST" action="cart.php">
                        <input type="hidden" name="id_keranjang" value="<?php echo $row['id_keranjang']; ?>">
                        <input type="number" name="jumlah" value="<?php echo $row['jumlah']; ?>" min="1" required>
                        <input type="submit" name="update_jumlah" value="Update">
                    </form>
                </div>
                <a href="cart.php?cancel=<?php echo $row['id_keranjang']; ?>" class="button">Cancel</a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Keranjang belanja Anda kosong.</p>
    <?php endif; ?>
</div>

<div class="actions">
    <a href="buy.php" class="button">Lanjut Belanja</a>
    <a href="checkout.php" class="button">Checkout</a>
</div>

</body>
</html>
