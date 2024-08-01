<?php

require "function.php";

if(isset($_GET['id']) ){

    // ambil id dari query string
    $id = $_GET['id'];

    // buat query hapus
    $sql = "DELETE FROM user WHERE id_user = '$id'";
    $query = mysqli_query($conn, $sql);

    // apakah query hapus berhasil?
    if( $query ){
        echo "<script>
    alert('user berhasil di hapus');
    window.location.href = 'crud.php';
     </script>";
    } else {
        echo "<script>
    alert('user gagal di hapus');
     </script>";
    }

} else {
    die("akses dilarang...");
}

?>