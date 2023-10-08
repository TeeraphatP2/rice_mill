<?php
session_start();
include '../connect/conn.php';
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$phone_number = $_POST['phone_number'];

$sql = "UPDATE tb_user SET firstname='$firstname', lastname='$lastname', phone_number='$phone_number' WHERE UserID ='" . $_SESSION['id_user'] . "' ";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo "<script>alert('แก้ไขข้อมูลเรียบร้อย');</script>";
    echo "<script>window.location='user.php';</script>";
} else {
    echo "<script>alert('ไม่สามารถแก้ไขข้อมูลได้');</script>";
}
mysqli_close($conn);

?>
