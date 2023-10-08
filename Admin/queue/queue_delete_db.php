<?php
include '../connect/conn.php';

    if (isset($_GET['queue_del_id']) && !empty($_GET['queue_del_id'])) {
        $sql = "DELETE FROM `queue` WHERE `QueueID` ='".$_GET['queue_del_id']."' ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $alert = '<script>';
            $alert .= 'alert("ลบข้อมูลสำเร็จ");';
            $alert .= 'window.location.href = "./queue.php";';
            $alert .= '</script>';
            echo $alert;
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
?>