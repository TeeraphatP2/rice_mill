<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rice_mill";

$conn = mysqli_connect($servername,$username,$password,$dbname);
mysqli_set_charset($conn, "utf8");
if(!$conn){
    die("Connection faild: ". mysqli_connect_error());
} else {
    // echo "Connection successfully";
}
?>

