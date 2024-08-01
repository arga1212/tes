<?php
require 'function.php';

if (isset($_POST['register'])) {
    if (registrasi($_POST) > 0 ) {
        echo "<script>
        alert('User berhasil ditambahkan');
        window.location.href = 'login.php';
        </script>";
        exit;
    } else {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <style>
        /* CSS */
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
            background-color:#002D73;
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
    <h2>Ayo Daftar</h2>
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
        <button type="submit" class="btn-submit" name="register">Daftar</button>
    </form>
    <div class="signup-link">
        <span>Sudah punya akun? <a href="login.php">Login disini</a></span>
    </div>
</div>

</body>
</html>
