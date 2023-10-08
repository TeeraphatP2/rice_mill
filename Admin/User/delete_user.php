<?php
include '../connect/conn.php';


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $sql = "DELETE FROM tb_user WHERE UserID = '" . $_GET['id'] . "' ";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>alert('ลบข้อมูลเรียบร้อย');</script>";
        echo "<script>window.location='user.php';</script>";
        exit();
    } else {
        echo "Error : " . $sql . "<br>" . mysqli_error($conn);
        echo "<script>alert('ไม่สามารถลบข้อมูลได้');</script>";
    }
}
