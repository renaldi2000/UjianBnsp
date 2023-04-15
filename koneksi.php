<?php
session_start();

if(empty($_SESSION['username'])){
    header("Location: index.php");
}
//Koneksi Database
$server = "localhost";
$user = "root";
$pass = "";
$database = "dosen";

$koneksi = mysqli_connect($server, $user, $pass, $database) or die(mysqli_error($koneksi));