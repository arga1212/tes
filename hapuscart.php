<?php 
session_start(); 

// Memastikan ID Obat tersedia di URL
if (isset($_GET["id"])) {
    $id_obat = $_GET["id"];

    // Memastikan ID Obat ada dalam keranjang sebelum dihapus
    if (isset($_SESSION["keranjang"][$id_obat])) {
        unset($_SESSION["keranjang"][$id_obat]);
        echo "<script>alert('Produk telah berhasil dihapus dari keranjang');</script>";
    } else {
        echo "<script>alert('Produk tidak ditemukan dalam keranjang');</script>";
    }
} else {
    echo "<script>alert('ID Produk tidak ditemukan');</script>";
}

// Mengarahkan kembali ke halaman cart.php
echo "<script>location='cart.php';</script>";
?>
