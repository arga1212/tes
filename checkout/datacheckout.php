<!DOCTYPE html>
<html>
<head>
    <title>CRUD Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h2 {
            margin-top: 20px;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            margin-bottom: 20px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }
        form label {
            grid-column: 1 / 2;
            align-self: center;
        }
        form input[type="text"],
        form input[type="number"],
        form input[type="date"],
        form select,
        form button[type="submit"] {
            grid-column: 2 / 3;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }
        form button[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }
        form button[type="submit"]:hover {
            background-color: #45a049;
        }
        .action-links a {
            color: #337ab7;
            text-decoration: none;
        }
        .action-links a:hover {
            text-decoration: underline;
        }
        .success-msg {
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
            border-radius: 4px;
            padding: 15px;
            margin-top: 20px;
        }
        .error-msg {
            background-color: #f2dede;
            color: #a94442;
            border: 1px solid #ebccd1;
            border-radius: 4px;
            padding: 15px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h2>CRUD Checkout</h2>

<?php
require "../koneksi.php";

// Function to sanitize input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if delete button is clicked
if (isset($_GET['delete_id'])) {
    $id_checkout = sanitize_input($_GET['delete_id']);
    $query = "DELETE FROM checkout WHERE id_checkout = '$id_checkout'";
    if (mysqli_query($koneksi, $query)) {
        echo "<div class='success-msg'>Record deleted successfully</div>";
    } else {
        echo "<div class='error-msg'>Error deleting record: " . mysqli_error($koneksi) . "</div>";
    }
}

// Check if update form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_id'])) {
    $id_checkout = sanitize_input($_POST['update_id']);
    // Retrieve data from the form and sanitize
    $id_keranjang = sanitize_input($_POST['id_keranjang']);
    $id_user = sanitize_input($_POST['id_user']);
    $id_pay = sanitize_input($_POST['id_pay']);
    $id_ongkir = sanitize_input($_POST['id_ongkir']);
    $id_obat = sanitize_input($_POST['id_obat']);
    $alamat = sanitize_input($_POST['alamat']);
    $jumlah = sanitize_input($_POST['jumlah']);
    $total_biaya = sanitize_input($_POST['total_biaya']);
    $tanggal_checkout = sanitize_input($_POST['tanggal_checkout']);

    // Update query
    $query = "UPDATE checkout SET id_keranjang='$id_keranjang', id_user='$id_user', id_pay='$id_pay', id_ongkir='$id_ongkir', id_obat='$id_obat', Alamat='$alamat', jumlah='$jumlah', total_biaya='$total_biaya', tanggal_checkout='$tanggal_checkout' WHERE id_checkout='$id_checkout'";
    if (mysqli_query($koneksi, $query)) {
        echo "<div class='success-msg'>Record updated successfully</div>";
    } else {
        echo "<div class='error-msg'>Error updating record: " . mysqli_error($koneksi) . "</div>";
    }
}

// Read data using JOIN
$query = "SELECT c.id_checkout, c.id_keranjang, c.id_user, u.username, c.id_pay, p.method, c.id_ongkir, o.Jenis, o.Harga_ongkir, c.id_obat, ob.nama_obat, ob.stok_obat, ob.harga_obat, ob.id_kat, k.nama_kat, c.Alamat, c.jumlah, c.total_biaya, c.tanggal_checkout 
          FROM checkout c
          INNER JOIN user u ON c.id_user = u.id_user
          INNER JOIN payment p ON c.id_pay = p.id_pay
          INNER JOIN ongkir o ON c.id_ongkir = o.id_ongkir
          INNER JOIN obat ob ON c.id_obat = ob.id_obat
          INNER JOIN kategori k ON ob.id_kat = k.id_kat";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>Username</th><th>Payment Method</th><th>Jenis Pengiriman</th><th>Harga Ongkir</th><th>Obat</th><th>Stok Obat</th><th>Harga Obat</th><th>Kategori</th><th>Alamat</th><th>Jumlah</th><th>Total Biaya</th><th>Tanggal Checkout</th><th>Action</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['method'] . "</td>";
        echo "<td>" . $row['Jenis'] . "</td>";
        echo "<td>" . $row['Harga_ongkir'] . "</td>";
        echo "<td>" . $row['nama_obat'] . "</td>";
        echo "<td>" . $row['stok_obat'] . "</td>";
        echo "<td>" . $row['harga_obat'] . "</td>";
        echo "<td>" . $row['nama_kat'] . "</td>";
        echo "<td>" . $row['Alamat'] . "</td>";
        echo "<td>" . $row['jumlah'] . "</td>";
        echo "<td>" . $row['total_biaya'] . "</td>";
        echo "<td>" . $row['tanggal_checkout'] . "</td>";
        echo "<td class='action-links'>
                <form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>
                    <input type='hidden' name='update_id' value='" . $row['id_checkout'] . "'>
                    <input type='hidden' name='id_keranjang' value='" . $row['id_keranjang'] . "' required>
                    <input type='hidden' name='id_user' value='" . $row['id_user'] . "' required>
                    <input type='hidden' name='id_pay' value='" . $row['id_pay'] . "' required>
                    <input type='hidden' name='id_ongkir' value='" . $row['id_ongkir'] . "' required>
                    <input type='hidden' name='id_obat' value='" . $row['id_obat'] . "' required>
                    <input type='text' name='alamat' value='" . $row['Alamat'] . "' required>
                    <input type='number' name='jumlah' value='" . $row['jumlah'] . "' required>
                    <input type='number' name='total_biaya' value='" . $row['total_biaya'] . "' required>
                    <input type='date' name='tanggal_checkout' value='" . $row['tanggal_checkout'] . "' required>
                    <button type='submit'>Update</button>
                </form>
                <a href='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?delete_id=" . $row['id_checkout'] . "'>Delete</a>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<div class='error-msg'>No records found</div>";
}
?>

</body>
</html>
