<?php
require "koneksi.php";
session_start();

if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'user') {
    header('Location: index.php');
    exit;
}

if (!isset($_GET['id_obat']) || !isset($_GET['jumlah'])) {
    header('Location: index.php');
    exit;
}

$id_user = $_SESSION['id_user'];
$id_obat = $_GET['id_obat'];
$jumlah = $_GET['jumlah'];

// Query untuk menambahkan item ke keranjang
$query = "INSERT INTO keranjang (id_user, id_obat, jumlah) VALUES ('$id_user', '$id_obat', '$jumlah')";
if (mysqli_query($koneksi, $query)) {
    header('Location: cart.php');
    exit;
} else {
    header('Location: selamat-datang.php');
    exit;
}
?>
