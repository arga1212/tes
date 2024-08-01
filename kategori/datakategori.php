<?php
// Koneksi ke database
require "../koneksi.php";
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// CREATE
if(isset($_POST['submit'])) {
    $nama_kategori = $_POST['nama_kategori'];
    $sql_create = "INSERT INTO kategori (nama_kat) VALUES ('$nama_kategori')";
    if(mysqli_query($koneksi, $sql_create)) {
        echo "<script>alert('Data kategori berhasil ditambahkan.');window.location.href='';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan. Data gagal ditambahkan.');</script>";
    }
}

// READ
$sql_read = "SELECT * FROM kategori";
$result = mysqli_query($koneksi, $sql_read);

// UPDATE
if(isset($_POST['update'])) {
    $id_kat = $_POST['id_kat'];
    $nama_kategori = $_POST['nama_kategori'];
    $sql_update = "UPDATE kategori SET nama_kat='$nama_kategori' WHERE id_kat='$id_kat'";
    if(mysqli_query($koneksi, $sql_update)) {
        echo "<script>alert('Data kategori berhasil diperbarui.');window.location.href='';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan. Data gagal diperbarui.');</script>";
    }
}

// DELETE
if(isset($_POST['delete'])) {
    $id_kat = $_POST['id_kat'];
    $sql_delete = "DELETE FROM kategori WHERE id_kat='$id_kat'";
    if(mysqli_query($koneksi, $sql_delete)) {
        echo "<script>alert('Data kategori berhasil dihapus.');window.location.href='';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan. Data gagal dihapus.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Kategori Atribut</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin-top: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="text"] {
            padding: 10px;
            margin: 10px 0;
            width: 80%;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            margin-top: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e2e2e2;
        }

        .btn-warning {
            background-color: #ffc107;
        }

        .btn-danger {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Daftar Kategori</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['id_kat']; ?></td>
                    <td><?php echo $row['nama_kat']; ?></td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="id_kat" value="<?php echo $row['id_kat']; ?>">
                            <input type="text" name="nama_kategori" value="<?php echo $row['nama_kat']; ?>">
                            <button type="submit" name="update" class="btn-warning">Update</button>
                            <button type="submit" name="delete" class="btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile;?>
        </table>
        
        <h2>Tambah Kategori</h2>
        <form method="POST">
            <input type="text" name="nama_kategori" placeholder="Nama Kategori">
            <button type="submit" name="submit">Tambah Kategori</button>
            <button class="btn-danger"><a href="../admin.php">Back</a></button>
        </form>
    </div>
</body>
</html>
