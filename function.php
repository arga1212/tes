<?php
$server ="localhost";
$username = "root";
$password = "";
$database_name = "kesehatan";

$conn = mysqli_connect ($server, $username, $password, $database_name);

function registrasi($data){
    global $conn;

    $username = $data['username'];
    $email = $data['email'];
    $password = $data['password'];
    $level = "user";

    
    $result = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");

    if ( mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('email sudah terdaftar')
        </script>";
        return false;
    }

    
    mysqli_query($conn , "INSERT INTO user VALUES (NULL, '$username', '$email', '$password', '$level' )");

    return mysqli_affected_rows($conn);
}


function check_login() {
    return isset($_SESSION['username']);
}





?>