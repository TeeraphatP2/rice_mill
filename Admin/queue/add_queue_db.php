<?php
session_start();
include_once '../connect/conn.php';

if (isset($_POST['add_queue']) && !empty($_POST['add_queue'])) {

    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $User_add_queue_id = mysqli_real_escape_string($conn, $_POST['add_queue']);
    $rice_type = $_POST['rice_type_select'];
    $sack = $_POST['sack'];
    $num_sack = $_POST['Number_sacks'];
    $rice_mill_price = $sack * $num_sack;

    // เพิ่มข้อมูลลูกค้า่ในตาราง tb_user
    $sql_queue = "INSERT INTO `queue` (`Number_of_sacks`, `rice_mill_price`, `UserID`, `RiceMillingID`) VALUES ('$num_sack', '$rice_mill_price', '$User_add_queue_id', '$rice_type');";
    $result_user = mysqli_query($conn, $sql_queue);

    if ($result_user) {
        $alert = '<script>';
        $alert .= 'alert("รับข้าวเรียบร้อยแล้ว");';
        $alert .= 'window.location.href = "./add_queue.php";';
        $alert .= '</script>';
        echo $alert;
        exit();
    } else {
        echo "Error: " . $sql_user . "<br>" . mysqli_error($conn);
    }
} elseif (isset($_POST['add_queue'])) {

    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $check_existing_query = "SELECT COUNT(*) FROM `tb_user` WHERE phone_number = '$phoneNumber'";
    $check_existing_result = mysqli_query($conn, $check_existing_query);

    if ($check_existing_result) {
        
        $row = mysqli_fetch_row($check_existing_result);
        $count = $row[0];

        if ($count > 0) {
            // หมายเลขโทรศัพท์นี้มีอยู่ในระบบอยู่แล้ว
            $alert = '<script>';
            $alert .= 'alert("หมายเลขโทรศัพท์นี้มีอยู่ในระบบแล้ว");';
            $alert .= 'window.location.href = "./add_queue.php";';
            $alert .= '</script>';
            echo $alert;
            exit();
        } else {
            // หมายเลขโทรศัพท์นี้ไม่มีอยู่ในระบบ ดำเนินการเพิ่มข้อมูลผู้ใช้และรับข้าว
            $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
            $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
            $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);

            $sql_user = "INSERT INTO `tb_user` (`firstname`, `lastname`, `phone_number`) VALUES ('$firstname', '$lastname', '$phoneNumber');";
            $result_user = mysqli_query($conn, $sql_user);

            if ($result_user) {

                // ดึง ID ที่สร้างขึ้นในตาราง tb_user
                $id_user_add_queue = mysqli_insert_id($conn);

                $rice_type = $_POST['rice_type_select'];
                $sack = $_POST['sack'];
                $num_sack = $_POST['Number_sacks'];
                $rice_mill_price = $sack * $num_sack;

                // ใช้ ID ที่ได้จากการสร้างบันทึกในตาราง tb_user เป็น Foreign Key ในตาราง queue
                $sql_queue = "INSERT INTO `queue` (`Number_of_sacks`, `rice_mill_price`, `UserID`, `RiceMillingID`) VALUES ('$num_sack', '$rice_mill_price', '$id_user_add_queue', '$rice_type');";
                $result_queue = mysqli_query($conn, $sql_queue);

                if ($result_queue) {
                    $alert = '<script>';
                    $alert .= 'alert("รับข้าวเรียบร้อยแล้ว");';
                    $alert .= 'window.location.href = "./add_queue.php";';
                    $alert .= '</script>';
                    echo $alert;
                    exit();
                } else {
                    echo "Error: " . $sql_queue . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "Error: " . $sql_user . "<br>" . mysqli_error($conn);
            }
        }
    } else {
        // เกิดข้อผิดพลาดในการตรวจสอบหมายเลขโทรศัพท์
        echo "Error: " . $sql_user . "<br>" . mysqli_error($conn);
    }
}
