<?php
include 'connect/conn.php';
$username = $_POST['username'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$phone_number = $_POST['phone_number'];


$sql = "INSERT INTO tb_user (username, firstname, lastname, phone_number) VALUES('$username' ,'$firstname', '$lastname', '$phone_number') ";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo "<script>alert('บันทึกข้อมูลเรียบร้อย');</script>";
    echo "<script>window.location='user.php';</script>";
} else {
    echo "<script>alert('ไม่สามารถบันทึกข้อมูลได้');</script>";
}
mysqli_close($conn);

?>
<a href="user.php" class="btn btn-success">กลับหน้าแรก</a>