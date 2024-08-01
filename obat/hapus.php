<?php
require "../koneksi.php";

if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

$id_obat = $_GET['id'];

// Hapus data terkait dari tabel pembelian
$query_delete_pembelian = "DELETE FROM pembelian WHERE id_obat = $id_obat";
mysqli_query($koneksi, $query_delete_pembelian);

// Query untuk menghapus obat berdasarkan ID
$query = "DELETE FROM obat WHERE id_obat = $id_obat";

if (mysqli_query($koneksi, $query)) {
    echo "Obat berhasil dihapus.";
    header("Location: dataobat.php");
    exit();
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}
?>
