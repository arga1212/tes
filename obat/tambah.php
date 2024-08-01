<?php
// Koneksi ke database
require "../koneksi.php";

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

// Jika tombol Submit diklik
if (isset($_POST["submit"])) {
    $nama_obat = $_POST["nama_obat"];
    $stok_obat = $_POST["stok_obat"];
    $harga_obat = $_POST["harga_obat"];
    $id_kat = $_POST["id_kat"]; 
    $file = $_FILES["img"]["name"];
    $filetmp = $_FILES['img']['tmp_name'];


    // Proses upload gambar
    $rand = rand();
    $ekstensi =  array('png','jpg','jpeg');
    $filename = $_FILES['img']['name'];
    $ukuran = $_FILES['img']['size'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
     
    if(!in_array($ext,$ekstensi) ) {
        header("location:tambah.php?alert=gagal_ekstensi");
    }else{
        if($ukuran < 10000000000){		
            $xx = $rand.'_'.$filename;
            move_uploaded_file($filetmp, '../foto/'.$rand.'_'.$filename);
             // Query untuk menambahkan data obat baru
                            $query = "INSERT INTO obat (nama_obat, stok_obat, harga_obat, id_kat, img) 
                            VALUES ('$nama_obat', '$stok_obat', '$harga_obat', '$id_kat', '$xx')";
           
                       // Eksekusi query
                       if (mysqli_query($koneksi, $query)) {
                           echo "Obat berhasil ditambahkan.";
                       }
            header("location:tambah.php?alert=berhasil");
        }else{
            header("location:tambah.php?alert=gagal_ukuran");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Obat Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            width: 50%;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        form input[type="text"], form input[type="number"], form select, form input[type="file"] {
            width: calc(100% - 20px);
            padding: 8px 10px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form input[type="submit"] {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .button-back {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            background-color: #6c757d;
            text-align: center;
            margin-top: 20px;
        }

        .button-back:hover {
            background-color: #5a6268;
        }

        .center {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Tambah Obat Baru</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="nama_obat">Nama Obat:</label>
        <input type="text" id="nama_obat" name="nama_obat" required><br>

        <label for="stok_obat">Stok Obat:</label>
        <input type="number" id="stok_obat" name="stok_obat" required><br>

        <label for="harga_obat">Harga Obat:</label>
        <input type="number" id="harga_obat" name="harga_obat" required><br>

        <label for="id_kat">Kategori:</label>
        <select name="id_kat" id="id_kat" required>
            <?php
            $query_kategori = "SELECT id_kat, nama_kat FROM kategori";
            $result_kategori = mysqli_query($koneksi, $query_kategori);
            if (mysqli_num_rows($result_kategori) > 0) {
                while ($row = mysqli_fetch_assoc($result_kategori)) {
                    echo "<option value='" . $row['id_kat'] . "'>" . $row['nama_kat'] . "</option>";
                }
            } else {
                echo "<option value=''>Tidak ada kategori</option>";
            }
            ?>
        </select><br>

        <label for="img">Gambar Obat:</label>
        <input type="file" id="img" name="img" accept="image/*" required><br>

        <input type="submit" name="submit" value="Submit">
    </form>
    <div class="center">
        <a href="dataobat.php" class="button-back">Kembali ke Daftar Obat</a>
    </div>
</body>
</html>
