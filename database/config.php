<?php 

$server = "localhost";
$database = "pstFrankAnuma";
$user = "root";
$pass = "";


$conn = mysqli_connect($server, $user, $pass, $database);

if (!$conn) {
    die("<script>alert('Connection Failed.')</script>");
}

?>