<?php
$servername = "localhost";
$username = "zdmtyqaz_A02";
$password = "12345";
$dbname = "zdmtyqaz_A02";

$conn = mysqli_connect($servername,$username,$password,$dbname);
mysqli_set_charset($conn, "utf8");

if(!$conn){
    die("Connection faild: ". mysqli_connect_error());
} else {
    // echo "Connection successfully";
}
?>

