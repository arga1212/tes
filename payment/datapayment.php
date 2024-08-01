<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "username", "password", "kesehatan");

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

// Jika tombol Submit diklik untuk tambah data baru atau edit data
if(isset($_POST["submit"])) {
    $id_pay = $_POST["id_pay"];
    $method = $_POST["method"];
    $action = $_POST["action"];

    // Cek apakah id_pay kosong, jika kosong artinya ini adalah operasi tambah data baru
    if(empty($id_pay)) {
        // Query untuk menambahkan data baru
        $query = "INSERT INTO payment (method) VALUES ('$method')";
    } else {
        // Query untuk update data berdasarkan id_pay
        $query = "UPDATE payment SET method='$method' WHERE id_pay='$id_pay'";
    }

    // Eksekusi query
    if(mysqli_query($koneksi, $query)) {
        echo "Data berhasil disimpan.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}

// Jika tombol Delete diklik
if(isset($_GET["action"]) && $_GET["action"] == "delete") {
    $id_pay = $_GET["id"];
    
    // Query untuk menghapus data berdasarkan id_pay
    $query = "DELETE FROM payment WHERE id_pay='$id_pay'";

    // Eksekusi query
    if(mysqli_query($koneksi, $query)) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}

// Ambil data payment dari database
$query = "SELECT * FROM payment";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD Payment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>CRUD Payment</h1>
        <form action="" method="post">
            <input type="hidden" name="id_pay" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
            <label for="method">Method:</label><br>
            <input type="text" id="method" name="method" value="<?php echo isset($_GET['method']) ? $_GET['method'] : ''; ?>" required><br>
            <input type="hidden" name="action" value="<?php echo isset($_GET['action']) ? $_GET['action'] : ''; ?>">
            <input type="submit" name="submit" value="<?php echo isset($_GET['action']) && $_GET['action'] == 'edit' ? 'Update' : 'Submit'; ?>" class="submit-btn">
        </form>

        <table>
            <tr>
                <th>ID Payment</th>
                <th>Method</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?php echo $row['id_pay']; ?></td>
                <td><?php echo $row['method']; ?></td>
                <td>
                    <a href="datapayment.php?action=edit&id=<?php echo $row['id_pay']; ?>&method=<?php echo $row['method']; ?>" class="edit-btn">Edit</a>
                    <a href="datapayment.php?action=delete&id=<?php echo $row['id_pay']; ?>" class="delete-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <a href="../admin.php" class="edit-btn"Back></a>
</body>
</html>
