<?php
session_start();

include_once '../connect/conn.php';

if (isset($_POST['add_user'])) {

    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);

    $sql_user = "INSERT INTO `tb_user` (`firstname`, `lastname`, `phone_number`) VALUES ('$firstname', '$lastname', '$phoneNumber');";
    $result_user = mysqli_query($conn, $sql_user);

    if ($result_user) {
        echo "จัดคิวเรียบร้อยแล้ว";
        header('location: ./add_queue.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
