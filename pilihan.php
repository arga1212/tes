<?php

session_start();

require 'koneksi.php';

if(!isset($_SESSION['login']) ) {
    header("location: index.php");
    exit;
}


if(isset($_SESSION['admin']) ) {
    header("location: admin.php");
    exit;
}

