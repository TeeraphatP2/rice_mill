<?php
session_start();
include_once '../connect/conn.php';

if (isset($_POST['add_queue'])) {

    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);

    // เพิ่มข้อมูลลูกค้า่ในตาราง tb_user
    $sql_user = "INSERT INTO `tb_user` (`firstname`, `lastname`, `phone_number`) VALUES ('$firstname', '$lastname', '$phoneNumber');";
    $result_user = mysqli_query($conn, $sql_user);

    if ($result_user) {
        echo "บันทึกข้อมูลผู้ใช้เรียบร้อยแล้ว";

        // ดึง ID ที่สร้างขึ้นในตาราง tb_user
        $id_user_add_queue = mysqli_insert_id($conn);

        $rice_type = $_POST['rice_type_select'];
        $sack = $_POST['sack'];
        $num_sack = $_POST['Number_sacks'];
        $rice_mill_price = $sack * $num_sack ;

        // ใช้ ID ที่ได้จากการสร้างบันทึกในตาราง tb_user เป็น Foreign Key ในตาราง queue
        $sql_queue = "INSERT INTO `queue` (`Number_of_sacks`, `rice_mill_price`, `UserID`, `RiceMillingID`) VALUES ('$num_sack', '$rice_mill_price', '$id_user_add_queue', '$rice_type');";
        $result_queue = mysqli_query($conn, $sql_queue);

        if ($result_queue) {
            echo "จัดคิวเรียบร้อยแล้ว";
            header('location: ./queue.php');
        } else {
            echo "Error: " . $sql_queue . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error: " . $sql_user . "<br>" . mysqli_error($conn);
    }
}

?>
