<?php
$koneksi = mysqli_connect("localhost", "username", "password", "kesehatan");

$id = $_GET['id'];
$query = "DELETE FROM ongkir WHERE id_ongkir='$id'";
mysqli_query($koneksi, $query);
  
echo "<script>
alert('Data Berhasil dihapus');
window.location.href = 'dataongkir.php';
</script>";

?>
