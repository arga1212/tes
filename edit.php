<?php

require "function.php";

// cek apakah tombol simpan sudah diklik atau belum
if(isset($_POST['simpan'])){

    // ambil data dari formulir
    $id= $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // buat query update
    $sql = "UPDATE user SET username='$username', email='$email', password='$password' WHERE id_user=$id";
    $query = mysqli_query($conn, $sql);

    // apakah query update berhasil?
    if($query) {
        // jika berhasil, alihkan ke halaman data.php atau halaman lain yang diinginkan
        header('Location: admin.php');
        exit; // pastikan untuk keluar dari skrip setelah mengalihkan pengguna
    } else {
        // jika gagal, tampilkan pesan error
        echo "Error: " . mysqli_error($conn);
    }
}

// ambil ID dari query string
$id = $_GET['id'];

// buat query untuk mengambil data pengguna berdasarkan ID
$sql = "SELECT * FROM user WHERE id_user='$id'";
$query = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($query);

// jika data yang akan di-update tidak ditemukan, tampilkan pesan
if(mysqli_num_rows($query) < 1) {
    echo "Data tidak ditemukan...";
    exit; // keluar dari skrip jika data tidak ditemukan
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <style>
       *{margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins , sans serif';

}

body {
    min-height: 100vh;
    width: 100%;
    background-color: #F8F4EC;
}

.container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    max-width: 430px;
    width: 100%;
    background-color: #50C4ED;
    border-radius: 7px;
    box-shadow: 0px 5px 10px rgba(0,0,0,0, 3);

}

.container .registration {
    display: none;
}

#check:checked ~ .registration{
    display: block;
}

#check:checked ~ .login{
    display: block;
}

#check{
    display: none;
}

.container .form{
    padding: 2rem;
}

.form header {
    font-size: 2rem;
    font-weight: 500;
    text-align: center;
    margin-bottom: 1.5rem;
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
}

.form input {
    height: 60px;
    width: 100%;
    padding: 0 15px;
    font-size: 17px;
    margin-bottom: 1.3rem;
    border: 1px solid #ddd;
    border-radius: 6px;
    outline: none;
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
}

.form input:focus {
    box-shadow: 0 1px 0 rgba(0,0,0, 0.2);

}

.form button{
    height: 60px;
    width: 100%;
    padding: 0 15px;
    font-size: 17px;
    margin-bottom: 1.3rem;
    border: 1px solid #ddd;
    border-radius: 6px;
    outline: none;
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
}

.form button{
    color: #fff;
    background-color: #0C2D57;
    font-size: 1.2rem;
    font-weight: 500;
    letter-spacing: 1px;
    margin-top: 1.7rem;
    cursor: pointer;
    transition: 0.4s;
}

.form button:hover{
    background: #FFFF;
}  

.signup{
    font-size: 17px;
    text-align: center;
}

.signup label{
    color: black;
    cursor: pointer;
}

.signup label:hover {
    text-decoration: underline;
} 

.form a{
    font-size: 16px;
    color: white  ;
    text-decoration: none;
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
}

.form a:hover {
    text-decoration: underline;
    color: #F57D1F;
}

a.back
{
    font-weight: bold;
    font-size:20px;
    font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    text-align: center;
}

    </style>

</head>
<body>


<div class="container">
        <input type="checkbox" id="check">
        <div class="form">
            <header>Edit User</header>
            <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $user['id_user']; ?>">

           <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required>
           <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
           <input type="password" id="password" name="password" value="<?php echo $user['password']; ?>" required>

           <button type="submit" name="simpan">Save</button>

        </ul>
        </div>

    </form>
   
    </div>
        </div>
     </div>
</body>
</html>
