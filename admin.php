<?php
require 'function.php';

session_start();

$query = "SELECT * FROM user";
$result = mysqli_query($conn, $query);

if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'admin')  {
    echo "<script>alert('Maaf kamu bukan admin!');</script>";
    echo "<script>window.location.href='logout.php';</script>";
    exit();
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kesehatan</title>
    <style>
        * { 
    text-decoration: none;
    margin: 0px;
    padding: 0px;
}

body {
    margin: 0px;
    padding: 0px;
    font-family: 'Open Sans', sans-serif;
    width: 100%;
    
}

.wrapper {
    width:75%;
    margin: auto;
    position: relative;
}

.logo a {
    font-size: 50px;
    font-weight: 800;
    float: left;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #FFF6E9;
}

.menu {
    float: right;
}

nav {
    width: 100%;
    margin: auto;
    display: flex;
    line-height: 80px;
    position: sticky;
    position: -webkit-sticky;
    top: 0;
    background: #50C4ED;
    z-index: 1;
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
}

nav ul li {
    float: left;
}

nav ul li a {
    color:#211C6A;
    font-weight: bold;
    text-align: center;
    padding: 0px 16px 0px 16px;
    text-decoration: none;
}

nav ul li a:hover {
    text-decoration: underline;
}

section {
    margin: auto;
    display: flex;
    margin-bottom: 50px;
}

a.tbl-biru {
    background: #0C2D57;
    border-radius: 20px;
    margin-top: 20px;
    padding: 15px 20px 15px 20px;
    color: #ffffff;
    cursor: pointer;
    font-weight: bold;
    margin-right: 10px;
}

a.tbl-biru:hover {
    background: #427D9D;
    text-decoration: none;
}

table {
            border-collapse: collapse;
            width: 100%; 
            margin-right: 30px;
            margin-top: 30px;
            margin-bottom: 30px;


        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            border-color: #000;
            background-color: #fff;
            color: #000;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;

            

        }
        th{
            background-color: #F8F4EC;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;

        }

        body {
            background-color: #F8F4EC;
            color: #fff;

        }

.data {
   font-size:80px;
   text-align: center;
   color: #0C2D57;
   font-weight: bold;
   font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;

}

a.add-user {
    display: inline-block;
    background: #0C2D57;
    border-radius: 20px;
    padding: 1.5%;
    color: #ffffff;
    cursor: pointer;
    font-weight: bold;
    font-size:20px;
    font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    float: right;
    margin-bottom: 25px;
    margin-right: 30px;
}

a.add-user:hover {
    background: #427D9D;
    text-decoration: none;
}

a.kembali 
{
    display: inline-block;
    background: #0C2D57;
    border-radius: 20px;
    padding: 1.5%;
    color: #ffffff;
    cursor: pointer;
    font-weight: bold;
    font-size:20px;
    font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    float: left;
    margin-bottom: 25px;
    margin-left: 30px;
}

a.kembali:hover  {
    background: #427D9D;
    text-decoration: none;
}

a.edit {
    font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    font-weight: bold;
    display: inline-block;
    padding: 5px 10px;
    background-color:#211C6A ; 
    color: white; 
    text-decoration: none;
    border-radius: 10px;
}

a.hapus {
    font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    font-weight: bold;
    display: inline-block;
    padding: 5px 10px;
    background-color: rgb(235, 71, 76); 
    color: white; 
    text-decoration: none;
    border-radius: 10px;
}

    </style>
</head>
<body>
    <nav>
        <div class="wrapper">
            <div class="logo"><a href=''>Sehat aja</a></div>
                <div class="menu">
                    <ul>
                        <li><a href="">Tabel user</a></li>
                        <li><a href="kategori/datakategori.php">kategori</a></li>
                        <li><a href="obat/dataobat.php">Obat</a></li>
                        <li><a href="ongkir/dataongkir.php">Ongkir</a></li>
                        <li><a href="payment/datapayment.php">payment</a></li>
                        <li><a href="keranjang/datakeranjang.php">Keranjang</a></li>
                        <li><a href="checkout/datacheckout.php">Checkout</a></li>
                        <li><a href="logout.php" class="tbl-biru">Logut</a></li>
                        <?php
                        
                        echo "Halo,". $_SESSION['username'];
                        
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <h1 class="data">Data Tabel User</h1>
<a href="add.php" class = "add-user">ADD USER</a> 


<table>
    <tr>
        <th>id_user</th>
        <th>Username</th>
        <th>Email</th>
        <th>Password</th>
        <th>Operation</th>

    </tr>

    <?php

     if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["id_user"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["password"] . "</td>";
            echo "<td>";
            echo "<a class='edit'href='edit.php?id=".$row['id_user']."'>Edit</a> | ";
            echo "<a class='hapus'href='delete.php?id=".$row['id_user']."'>Hapus</a>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>Tidak ada data yang ditemukan</td></tr>";
    }

  
    ?>
</table>

<a class = 'kembali' href="admin.php">Back</a>
<a href="add.php" class = "add-user">add user</a>   

</body>
</html>

<?php
mysqli_close($conn);
?>

</body>
</html>