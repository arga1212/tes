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

// Mulai transaksi
mysqli_begin_transaction($koneksi);

// Ambil ID pengguna dari sesi
$id_user = $_SESSION['id_user'];

// Ambil data dari tabel keranjang
$query_keranjang = "SELECT keranjang.id_keranjang, keranjang.id_obat, obat.nama_obat, obat.harga_obat, keranjang.jumlah, 
                    (obat.harga_obat * keranjang.jumlah) AS total_harga, obat.img
                    FROM keranjang 
                    INNER JOIN obat ON keranjang.id_obat = obat.id_obat 
                    WHERE keranjang.id_user = '$id_user'";
$result_keranjang = mysqli_query($koneksi, $query_keranjang);

// Ambil data metode pembayaran
$query_payment = "SELECT * FROM payment";
$result_payment = mysqli_query($koneksi, $query_payment);

// Ambil data ongkir
$query_ongkir = "SELECT * FROM ongkir";
$result_ongkir = mysqli_query($koneksi, $query_ongkir);

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $alamat = $_POST['alamat'];
    $payment_id = $_POST['payment'];
    $ongkir_id = $_POST['ongkir'];
    $tanggal_checkout = date('Y-m-d H:i:s'); // Mendapatkan tanggal dan waktu saat ini
    
    // Validasi data
    if (!empty($alamat) && !empty($payment_id) && !empty($ongkir_id)) {
        // Hitung total biaya
        $total_biaya = 0;
        $item_checkout_success = true;
        
        while ($row = mysqli_fetch_assoc($result_keranjang)) {
            $total_harga = $row['total_harga'];
            $id_keranjang = $row['id_keranjang'];
            $id_obat = $row['id_obat'];
            $jumlah = $row['jumlah'];
            
            // Ambil biaya ongkir
            $ongkir_query = "SELECT Harga_ongkir FROM ongkir WHERE id_ongkir = '$ongkir_id'";
            $result_ongkir = mysqli_query($koneksi, $ongkir_query);
            $row_ongkir = mysqli_fetch_assoc($result_ongkir);
            $total_biaya += $total_harga + $row_ongkir['Harga_ongkir'];

            // Masukkan data ke tabel checkout
            $insert_query = "INSERT INTO checkout (id_keranjang, id_user, id_pay, id_ongkir, id_obat, Alamat, jumlah, total_biaya, tanggal_checkout) 
                             VALUES ('$id_keranjang', '$id_user', '$payment_id', '$ongkir_id', '$id_obat', '$alamat', '$jumlah', '$total_harga', '$tanggal_checkout')";

            if (mysqli_query($koneksi, $insert_query)) {
                // Kurangi stok obat dengan jumlah yang dibeli
                $query_stok = "UPDATE obat SET stok_obat = stok_obat - '$jumlah' WHERE id_obat = '$id_obat'";
                if (!mysqli_query($koneksi, $query_stok)) {
                    $item_checkout_success = false;
                    break;
                }
            } else {
                $item_checkout_success = false;
                break;
            }
        }

        if ($item_checkout_success) {
            // Hapus item dari keranjang setelah checkout
            $delete_keranjang = "DELETE FROM keranjang WHERE id_user = '$id_user'";
            if (mysqli_query($koneksi, $delete_keranjang)) {
                // Komit transaksi
                mysqli_commit($koneksi);
                // Redirect ke halaman konfirmasi atau halaman lain yang diinginkan
                header('Location: thankyou.php');
                exit;
            } else {
                mysqli_rollback($koneksi);
                die("Gagal menghapus data dari keranjang: " . mysqli_error($koneksi));
            }
        } else {
            mysqli_rollback($koneksi);
            die("Gagal melakukan checkout: " . mysqli_error($koneksi));
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="icon" type="image/png" href="logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poetsen+One&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
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

        .container {
            width: 75%;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
            grid-column: span 2;
            font-weight: 700;
            font-family: "Montserrat", sans-serif;
            
        }
        .cart-item {
            margin-bottom: 15px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            display: flex;
            align-items: center;
            font-weight: 600;
            font-family: "Montserrat", sans-serif;
        }
        .cart-item img {
            width: 50px;
            height: auto;
            margin-right: 10px;
        }
        .form-group {
            margin-bottom: 15px;
            display: grid;
            grid-template-columns: 1fr;
            font-weight: 700;
            font-family: "Montserrat", sans-serif;
        }
        .form-group label {
            text-align: left;
            font-weight: 700;
            font-family: "Montserrat", sans-serif;
        }
        .form-group input, .form-group select {
            width: 90%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-weight: 700;
            font-family: "Montserrat", sans-serif;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
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
        .error {
            color: red;
            margin-top: 10px;
            grid-column: span 2;
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
                <li><a href="buy.php">Beli Lagi</a></li>
                <?php
                echo '<div class="halo">' . "Halo," . $_SESSION['username'] . '</div>';
                ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h2>Checkout</h2>

    <?php
    // Jalankan ulang query untuk menampilkan item di keranjang belanja
    $result_keranjang = mysqli_query($koneksi, $query_keranjang);
    if (mysqli_num_rows($result_keranjang) > 0): ?>
        <div class="cart-items">
            <?php while ($row = mysqli_fetch_assoc($result_keranjang)): ?>
                <div class="cart-item">
                    <img src="foto/<?php echo $row['img']; ?>" alt="Gambar Obat">
                    <p><?php echo $row['nama_obat']; ?> Rp. <?php echo number_format($row['harga_obat']); ?> <br>
                    Anda membeli sebanyak <?php echo $row['jumlah']; ?> item <br>
                    Total harga = Rp <?php echo number_format($row['total_harga']); ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>Keranjang belanja Anda kosong.</p>
    <?php endif; ?>

    <form method="post">
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" id="alamat" name="alamat" required>
        </div>

        <div class="form-group">
            <label for="payment">Metode Pembayaran</label>
            <select id="payment" name="payment" required>
                <?php while ($row = mysqli_fetch_assoc($result_payment)): ?>
                    <option value="<?php echo $row['id_pay']; ?>"><?php echo $row['method']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="ongkir">Ongkos Kirim</label>
            <select id="ongkir" name="ongkir" required>
                <?php while ($row = mysqli_fetch_assoc($result_ongkir)): ?>
                    <option value="<?php echo $row['id_ongkir']; ?>"><?php echo $row['Jenis']; ?> - Rp <?php echo number_format($row['Harga_ongkir']); ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <button type="submit" class="button">Checkout</button>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
    </form>
</div>

</body>
</html>
