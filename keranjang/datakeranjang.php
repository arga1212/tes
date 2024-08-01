<!DOCTYPE html>
<html>
<head>
    <title>CRUD Keranjang</title>
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
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        form label {
            flex: 1 1 100%;
            margin-bottom: 10px;
        }
        form input[type="number"],
        form input[type="text"],
        form button[type="submit"] {
            flex: 1 1 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
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
            margin-right: 10px;
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

<h2>CRUD Keranjang</h2>

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
    $id_keranjang = sanitize_input($_GET['delete_id']);
    $query = "DELETE FROM keranjang WHERE id_keranjang = '$id_keranjang'";
    if (mysqli_query($koneksi, $query)) {
        echo "<div class='success-msg'>Record deleted successfully</div>";
    } else {
        echo "<div class='error-msg'>Error deleting record: " . mysqli_error($koneksi) . "</div>";
    }
}

// Check if update form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_id'])) {
    $id_keranjang = sanitize_input($_POST['update_id']);
    $jumlah = sanitize_input($_POST['jumlah']);
    $total_harga = sanitize_input($_POST['total_harga']);
    $id_obat = sanitize_input($_POST['id_obat']);
    $id_user = sanitize_input($_POST['id_user']);

    $query = "UPDATE keranjang SET jumlah='$jumlah', total_harga='$total_harga', id_obat='$id_obat', id_user='$id_user' WHERE id_keranjang='$id_keranjang'";
    if (mysqli_query($koneksi, $query)) {
        echo "<div class='success-msg'>Record updated successfully</div>";
    } else {
        echo "<div class='error-msg'>Error updating record: " . mysqli_error($koneksi) . "</div>";
    }
}

// Read
$query = "SELECT * FROM keranjang";
$result = mysqli_query($koneksi, $query);
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>ID Keranjang</th><th>Jumlah</th><th>Total Harga</th><th>ID Obat</th><th>ID User</th><th>Action</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id_keranjang'] . "</td>";
        echo "<td>" . $row['jumlah'] . "</td>";
        echo "<td>" . $row['total_harga'] . "</td>";
        echo "<td>" . $row['id_obat'] . "</td>";
        echo "<td>" . $row['id_user'] . "</td>";
        echo "<td class='action-links'>
                <form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>
                    <input type='hidden' name='update_id' value='" . $row['id_keranjang'] . "'>
                    <input type='number' name='jumlah' value='" . $row['jumlah'] . "' required>
                    <input type='number' name='total_harga' value='" . $row['total_harga'] . "' required>
                    <input type='text' name='id_obat' value='" . $row['id_obat'] . "' required>
                    <input type='text' name='id_user' value='" . $row['id_user'] . "' required>
                    <button type='submit'>Update</button>
                </form>
                <a href='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?delete_id=" . $row['id_keranjang'] . "'>Delete</a>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<div class='error-msg'>No records found</div>";
}
?>
