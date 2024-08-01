<?php
 require 'function.php';
 session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

  
    $email = $_POST["email"];
    $password = $_POST["password"];
    

    // pengambilan data dari database
 $result= mysqli_query ($conn, "SELECT * FROM user WHERE email = '$email'");

//  pengecekan email
if (mysqli_num_rows($result) === 1) {
  // cek passwordo
        $row = mysqli_fetch_assoc($result);
        // Verifikasi password
        if ($password == $row["password"]) { 
            $_SESSION['email'] = $row['email'];
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['level'] = $row['level']; 
            $level = $row['level'];
            if ($level == 'admin') {
                header("location: admin.php");
            }
             else {
                header("location: buy.php");
            }
            exit();
        } else {
            echo '<script>alert("Password atau email salah")</script>';
        }
    } else {
        echo '<script>alert("Username tidak ditemukan")</script>';
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/png" href="logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f8f4ec;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 400px;
            width: 90%;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.3);
            padding: 30px;
            box-sizing: border-box;
        }

        .container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #0c2d57;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            outline: none;
        }

        .form-group input:focus {
            border-color: #0c2d57;
        }

        .error-message {
            color: #ff0000;
            font-size: 14px;
            margin-top: 10px;
            text-align: center;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #002D73;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #40679e;
        }

        .signup-link {
            text-align: center;
            margin-top: 20px;
        }

        .signup-link a {
            color: #0c2d57;
            text-decoration: none;
            font-weight: 500;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Ayo Login</h2>
    <?php if (isset($error)) : ?>
        <p class="error-message">Username atau password salah</p>
    <?php endif; ?>
    <form action="" method="post">
        <div class="form-group">
            <label for="username">Nama</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn-submit" name="login">Login</button>
    </form>
    <div class="signup-link">
        <span>Belum punya akun? <a href="akunbaru.php">Daftar disini</a></span>
    </div>
</div>

</body>
</html>
