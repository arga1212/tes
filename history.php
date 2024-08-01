<?php
require "koneksi.php";
session_start();

if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'user') {
    header('Location: index.php');
    exit;
}



// Periksa koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Ambil ID pengguna dari sesi
$id_user = $_SESSION['id_user'];

// Query untuk mengambil riwayat pembelian beserta informasi yang diinginkan
$query_riwayat = "SELECT checkout.id_checkout, checkout.tanggal_checkout, checkout.total_biaya, obat.id_obat, obat.nama_obat, obat.harga_obat, checkout.jumlah, ongkir.Jenis AS jenis_ongkir, ongkir.Harga_ongkir, payment.method AS metode_pembayaran, obat.img
                  FROM checkout
                  INNER JOIN obat ON checkout.id_obat = obat.id_obat
                  INNER JOIN ongkir ON checkout.id_ongkir = ongkir.id_ongkir
                  INNER JOIN payment ON checkout.id_pay = payment.id_pay
                  WHERE checkout.id_user = '$id_user'
                  ORDER BY checkout.tanggal_checkout DESC";

$result_riwayat = mysqli_query($koneksi, $query_riwayat);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pembelian</title>
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
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-family: "Montserrat", sans-serif;
        }
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
            display: flex;
            align-items: center;
        }
        .card img {
            width: 100px;
            height: auto;
            border-radius: 8px;
            margin-right: 20px;
        }
        .card-details {
            flex-grow: 1;
        }
        .card-details h3 {
            margin: 0 0 10px;
            color: #007bff;
            font-family: "Montserrat", sans-serif;
            font-weight: 700;
        }
        .card-details p {
            margin: 5px 0;
            color: #666;
            font-family: "Montserrat", sans-serif;
            font-weight: 700;
        }
        .card-details .price {
            color: #e74c3c;
            font-weight: bold;
            font-family: "Montserrat", sans-serif;
        }
        .card-details .total {
            color: #333;
            font-weight: bold;
            font-family: "Montserrat", sans-serif;
        }
        .btn-container {
            text-align: right;
            float: right;
            margin-right: 20px;
        }
        .btn-container a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            font-family: "Montserrat", sans-serif;
        }
        .btn-container a:hover {
            background-color: #0056b3;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            font-size: 18px;
            color: #777;
        }
        
    </style>
</head>
<body>
<div class="btn-container">
<a href="buy.php">Beli Lagi</a>
     </div>
    <div class="container">
        <h1>Riwayat Pembelian <?php echo $_SESSION['username']; ?></h1>

        <?php if (mysqli_num_rows($result_riwayat) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result_riwayat)): ?>
                <div class="card">
                    <img src="foto/<?php echo $row['img']; ?>" alt="Gambar Obat">
                    <div class="card-details">
                        <h3><?php echo $row['nama_obat']; ?></h3>
                        <p>Tanggal Pembelian: <?php echo $row['tanggal_checkout']; ?></p>
                        <p>Harga Obat: Rp <?php echo number_format($row['harga_obat']); ?></p>
                        <p>Jumlah:<?php echo $row['jumlah']; ?></p>
                        <p>Jenis Ongkir:<?php echo $row['jenis_ongkir']; ?></p>
                        <p>Harga Ongkir: Rp <?php echo number_format($row['Harga_ongkir']); ?></p>
                        <p>Metode Pembayaran: <?php echo $row['metode_pembayaran']; ?></p>
                        <p class="total">Total Biaya: Rp <?php echo number_format($row['total_biaya']); ?></p>
                    </div>
                   
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="no-data">Tidak ada riwayat pembelian.</p>
        <?php endif; ?>
    </div>
  
</body>
</html>
